<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\VentaCabecera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    // HELPER: Obtiene el carrito activo o lo crea
    private function obtenerCarrito()
    {
        return VentaCabecera::firstOrCreate(
            ['usuario_id' => auth()->id(), 'estado' => 'carrito'],
            ['total' => 0]
        );
    }

    // HELPER: Recalcula el total
    private function recalcularTotal(VentaCabecera $carrito)
    {
        $carrito->load('detalles');
        $total = $carrito->detalles->sum(fn($d) => $d->cantidad * $d->precio_unitario);
        $carrito->update(['total' => $total]);
    }

    // Mostrar carrito
    public function index()
    {
        if (!auth()->check()) {
            return view('carrito', ['carrito' => null, 'items' => collect()]);
        }

        $carrito = $this->obtenerCarrito();
        $items   = $carrito->detalles()->with(['producto'])->get();
        return view('carrito', compact('carrito', 'items'));
    }

    // Agregar al carrito
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if (!$producto->activo) {
            return back()->with('error', 'Este producto no está disponible.');
        }

        $carrito           = $this->obtenerCarrito();
        $item              = $carrito->detalles()->where('producto_id', $producto->id)->first();
        $cantidadEnCarrito = $item ? $item->cantidad : 0;

        // Verificar stock acumulado
        if ($producto->stock < ($cantidadEnCarrito + $request->cantidad)) {
            $disponible = $producto->stock - $cantidadEnCarrito;
            if ($disponible <= 0) {
                return back()->with('error', "No podés agregar más unidades de \"{$producto->nombre}\". Ya tenés el máximo disponible en tu carrito ({$producto->stock} unidades).");
            }
            return back()->with('error', "Solo podés agregar {$disponible} unidad(es) más de \"{$producto->nombre}\". Ya tenés {$cantidadEnCarrito} en el carrito y el stock disponible es de {$producto->stock}.");
        }

        if ($item) {
            $nuevaCantidad = $item->cantidad + $request->cantidad;
            $item->update([
                'cantidad' => $nuevaCantidad,
                'subtotal' => $nuevaCantidad * $item->precio_unitario,
            ]);
        } else {
            $carrito->detalles()->create([
                'producto_id'     => $producto->id,
                'cantidad'        => $request->cantidad,
                'precio_unitario' => $producto->precio,
                'subtotal'        => $producto->precio * $request->cantidad,
            ]);
        }

        $this->recalcularTotal($carrito);
        return back()->with('exito', "\"{$producto->nombre}\" agregado al carrito correctamente.");
    }

    // Eliminar un ítem del carrito
    public function eliminar($id)
    {
        $carrito = $this->obtenerCarrito();
        $carrito->detalles()->where('id', $id)->delete();
        $this->recalcularTotal($carrito);
        return back()->with('exito', 'Producto eliminado del carrito.');
    }

    // Vaciar el carrito completo
    public function vaciar()
    {
        $carrito = $this->obtenerCarrito();
        $carrito->detalles()->delete();
        $carrito->update(['total' => 0]);
        return back()->with('exito', 'Carrito vaciado correctamente.');
    }

    // GET: Formulario de checkout
    public function formularioCheckout()
    {
        $carrito = $this->obtenerCarrito();

        if ($carrito->detalles->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        foreach ($carrito->detalles as $item) {
            if ($item->producto->stock < $item->cantidad) {
                return redirect()->route('carrito.index')->with('error',
                    "Stock insuficiente para \"{$item->producto->nombre}\". Solo quedan {$item->producto->stock} unidades."
                );
            }
        }

        $items = $carrito->detalles()->with('producto')->get();
        $user  = Auth::user();
        return view('checkout', compact('carrito', 'items', 'user'));
    }

    // POST: Confirmar compra con datos de envío y pago
    public function confirmar(Request $request)
    {
        // Limpiar espacios y guiones del número de tarjeta antes de validar
        if ($request->has('tarjeta_numero')) {
            $request->merge([
                'tarjeta_numero' => str_replace([' ', '-'], '', $request->tarjeta_numero)
            ]);
        }

        // ── Reglas base ──────────────────────────────────────
        $reglas = [
            'tipo_entrega'    => ['required', 'in:retiro,envio'],
            'checkout_nombre' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'checkout_dni'    => ['required', 'digits_between:7,8'],
            'metodo_pago'     => ['required', 'in:mercadopago,tarjeta,efectivo'],
        ];

        // ── Reglas de domicilio (solo si es envío) ───────────
        if ($request->tipo_entrega === 'envio') {
            $reglas['envio_calle']         = ['required', 'string', 'min:2', 'max:150', 'regex:/^[\pL0-9\s\.]+$/u'];
            $reglas['envio_numero']        = ['required', 'regex:/^\d+$/'];
            $reglas['envio_departamento']  = ['nullable', 'string', 'max:50'];
            $reglas['envio_codigo_postal'] = ['required', 'digits:4'];
            $reglas['envio_descripcion']   = ['nullable', 'string', 'max:255'];
        }

        // ── Reglas de tarjeta (solo si paga con tarjeta) ─────
        if ($request->metodo_pago === 'tarjeta') {
            $reglas['tarjeta_tipo']        = ['required', 'in:debito,credito'];
            $reglas['tarjeta_numero']      = ['required', 'digits:16']; // exactamente 16 dígitos
            $reglas['tarjeta_titular']     = ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s]+$/u'];
            $reglas['tarjeta_vencimiento'] = ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'];
            $reglas['tarjeta_cvv']         = ['required', 'digits:3']; // exactamente 3 dígitos

            // Cuotas solo si es crédito
            if ($request->tarjeta_tipo === 'credito') {
                $reglas['tarjeta_cuotas'] = ['required', 'integer', 'min:1', 'max:24'];
            }
        }

        $mensajes = [
            'tipo_entrega.required'         => 'Seleccioná el tipo de entrega.',
            'checkout_nombre.required'      => 'El nombre y apellido es obligatorio.',
            'checkout_nombre.regex'         => 'El nombre solo puede contener letras y espacios.',
            'checkout_nombre.min'           => 'El nombre debe tener al menos 3 caracteres.',
            'checkout_dni.required'         => 'El DNI es obligatorio.',
            'checkout_dni.digits_between'   => 'El DNI debe tener entre 7 y 8 dígitos numéricos.',
            'metodo_pago.required'          => 'Seleccioná un método de pago.',
            'envio_calle.required'          => 'La calle es obligatoria.',
            'envio_calle.regex'             => 'La calle solo puede contener letras, números y puntos.',
            'envio_numero.required'         => 'El número de calle es obligatorio.',
            'envio_numero.regex'            => 'El número de calle solo puede contener dígitos.',
            'envio_codigo_postal.required'  => 'El código postal es obligatorio.',
            'envio_codigo_postal.digits'    => 'El código postal debe tener exactamente 4 dígitos.',
            'tarjeta_tipo.required'         => 'Seleccioná el tipo de tarjeta (débito o crédito).',
            'tarjeta_tipo.in'               => 'El tipo de tarjeta debe ser débito o crédito.',
            'tarjeta_numero.required'       => 'El número de tarjeta es obligatorio.',
            'tarjeta_numero.digits'         => 'El número de tarjeta debe tener exactamente 16 dígitos.',
            'tarjeta_titular.required'      => 'El nombre del titular es obligatorio.',
            'tarjeta_titular.regex'         => 'El titular solo puede contener letras y espacios.',
            'tarjeta_vencimiento.required'  => 'La fecha de vencimiento es obligatoria.',
            'tarjeta_vencimiento.regex'     => 'El formato debe ser MM/AA (ej: 08/27).',
            'tarjeta_cvv.required'          => 'El código de seguridad es obligatorio.',
            'tarjeta_cvv.digits'            => 'El código de seguridad debe tener exactamente 3 dígitos.',
            'tarjeta_cuotas.required'       => 'Seleccioná la cantidad de cuotas.',
        ];

        $request->validate($reglas, $mensajes);

        $carrito = $this->obtenerCarrito();

        if ($carrito->detalles->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        // Re-verificar stock justo antes de confirmar
        foreach ($carrito->detalles as $item) {
            if ($item->producto->stock < $item->cantidad) {
                return redirect()->route('carrito.index')->with('error',
                    "Stock insuficiente para \"{$item->producto->nombre}\". Solo quedan {$item->producto->stock} unidades."
                );
            }
        }

        DB::transaction(function () use ($carrito, $request) {
            foreach ($carrito->detalles as $item) {
                $item->producto->decrement('stock', $item->cantidad);
            }

            $datos = [
                'estado'          => 'confirmado',
                'fecha_venta'     => now(),
                'checkout_nombre' => trim($request->checkout_nombre),
                'checkout_dni'    => $request->checkout_dni,
                'tipo_entrega'    => $request->tipo_entrega,
                'metodo_pago'     => $request->metodo_pago,
            ];

            if ($request->tipo_entrega === 'envio') {
                $datos['envio_calle']         = trim($request->envio_calle);
                $datos['envio_numero']        = $request->envio_numero;
                $datos['envio_departamento']  = trim($request->envio_departamento) ?: null;
                $datos['envio_codigo_postal'] = $request->envio_codigo_postal;
                $datos['envio_descripcion']   = trim($request->envio_descripcion) ?: null;
            }

            if ($request->metodo_pago === 'tarjeta') {
                $datos['tarjeta_tipo']        = $request->tarjeta_tipo;
                $datos['tarjeta_numero']      = $request->tarjeta_numero;
                $datos['tarjeta_titular']     = trim($request->tarjeta_titular);
                $datos['tarjeta_vencimiento'] = $request->tarjeta_vencimiento;
                // Cuotas solo si es crédito, sino null
                $datos['tarjeta_cuotas']      = $request->tarjeta_tipo === 'credito'
                                                ? $request->tarjeta_cuotas
                                                : null;
                // NUNCA se guarda el CVV — norma de seguridad PCI-DSS
            }

            $carrito->update($datos);
        });

        session()->put('ultima_venta_id', $carrito->id);
        session()->save();

        return redirect()->route('compra.confirmada')
            ->with('tipo_entrega', $request->tipo_entrega)
            ->with('exito', '¡Pedido confirmado con éxito!');
    }

    // GET: Vista de confirmación de compra exitosa
    public function compraConfirmada()
    {
        $ventaId = session('ultima_venta_id');

        if (!$ventaId) {
            return redirect()->route('carrito.index')->with('error', 'No hay registros de compras recientes.');
        }

        $venta = VentaCabecera::with(['detalles.producto'])
            ->where('usuario_id', auth()->id())
            ->findOrFail($ventaId);

        return view('compra.confirmada', compact('venta'));
    }

    // GET: Descargar comprobante PDF
    public function descargarComprobante()
    {
        $ventaId = session('ultima_venta_id');
        if (!$ventaId) {
            return redirect()->route('carrito.index')->with('error', 'Sesión expirada.');
        }

        $venta = VentaCabecera::with(['detalles.producto'])
            ->where('usuario_id', auth()->id())
            ->findOrFail($ventaId);

        $data = [
            'user'  => Auth::user(),
            'items' => $venta->detalles,
            'total' => $venta->total,
            'fecha' => $venta->fecha_venta
                        ? $venta->fecha_venta->format('d/m/Y H:i')
                        : now()->format('d/m/Y H:i'),
        ];

        $pdf = app('dompdf.wrapper')->loadView('emails.comprobante', $data);
        return $pdf->download('comprobante_evolvex.pdf');
    }

    // Historial con filtros de fecha
    public function historial(Request $request)
    {
        $query = VentaCabecera::where('usuario_id', auth()->id())
            ->where('estado', 'confirmado')
            ->with(['detalles.producto'])
            ->orderBy('fecha_venta', 'desc');

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_venta', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_venta', '<=', $request->fecha_hasta);
        }

        $compras = $query->paginate(3);
        return view('backend.usuarios.historial', compact('compras'));
    }
}

    