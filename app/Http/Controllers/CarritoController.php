<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    // ─────────────────────────────────────────────
    // HELPER PRIVADO: obtiene o crea el carrito activo del usuario
    // ─────────────────────────────────────────────
    private function obtenerCarrito()
    {
        return VentaCabecera::firstOrCreate(
            [
                'usuario_id' => auth()->id(),
                'estado'     => 'carrito',
            ],
            ['total' => 0]
        );
    }

    // ─────────────────────────────────────────────
    // GET: Muestra el carrito (público para invitados)
    // ─────────────────────────────────────────────
    public function index()
    {
        if (!auth()->check()) {
            $carrito = null;
            $items   = collect();
            return view('carrito', compact('carrito', 'items'));
        }

        $carrito = $this->obtenerCarrito();
        // Se removió withTrashed() ya que la tabla no usa SoftDeletes
        $items   = $carrito->detalles()->with(['producto'])->get();

        return view('carrito', compact('carrito', 'items'));
    }

    // ─────────────────────────────────────────────
    // POST: Agrega un producto al carrito
    // ─────────────────────────────────────────────
    public function agregar(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Debés iniciar sesión para añadir productos al carrito.');
        }

        $request->validate([
            'producto_id' => 'required|integer',
            'cantidad'    => 'required|integer|min:1',
        ]);

        // Se removió withTrashed() de la búsqueda del producto
        $producto = Producto::findOrFail($request->producto_id);

        // Se removió la verificación $producto->trashed() ya que no aplica sin SoftDeletes
        if (!$producto->activo) {
            return back()->with('error', 'Lo sentimos, este producto ya no está disponible.');
        }

        if ($producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $carrito = $this->obtenerCarrito();
        $item    = $carrito->detalles()->where('producto_id', $producto->id)->first();

        if ($item) {
            if ($producto->stock < ($item->cantidad + $request->cantidad)) {
                return back()->with('error', "No podés agregar esa cantidad. Ya tenés {$item->cantidad} unidades en tu carrito y el stock disponible es de {$producto->stock}.");
            }

            $item->cantidad += $request->cantidad;
            $item->subtotal  = $item->cantidad * $item->precio_unitario;
            $item->save();
        } else {
            $carrito->detalles()->create([
                'producto_id'     => $producto->id,
                'cantidad'        => $request->cantidad,
                'precio_unitario' => $producto->precio,
                'subtotal'        => $producto->precio * $request->cantidad,
            ]);
        }

        $this->recalcularTotal($carrito);
        return back()->with('exito', 'Producto añadido al carrito.');
    }

    // ─────────────────────────────────────────────
    // DELETE: Quita un ítem específico del carrito
    // ─────────────────────────────────────────────
    public function eliminar($id)
    {
        $carrito = $this->obtenerCarrito();
        $carrito->detalles()->where('id', $id)->delete();

        $this->recalcularTotal($carrito);
        return back()->with('exito', 'Producto removido con éxito.');
    }

    // ─────────────────────────────────────────────
    // POST: Vacía por completo el carrito activo
    // ─────────────────────────────────────────────
    public function vaciar()
    {
        $carrito = $this->obtenerCarrito();
        $carrito->detalles()->delete();
        $carrito->update(['total' => 0]);

        return back()->with('exito', 'El carrito ha sido vaciado correctamente.');
    }


// ─────────────────────────────────────────────
    // POST: Confirma la compra (MODIFICADO PARA VACIER EL CARRITO AUTOMÁTICAMENTE)
    // ─────────────────────────────────────────────
    public function confirmar()
    {
        // 1. Validar autenticación del usuario
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Debes iniciar sesión para finalizar la compra.'], 401);
        }

        $carrito = $this->obtenerCarrito();
        $items = $carrito->detalles()->with(['producto'])->get();

        if ($items->count() === 0) {
            return response()->json(['success' => false, 'message' => 'Tu carrito está vacío.'], 400);
        }

        // 2. Validaciones de integridad y stock
        foreach ($items as $item) {
            if (!$item->producto) {
                return response()->json(['success' => false, 'message' => 'Uno de los productos en tu carrito ya no existe.'], 422);
            }
            if ($item->producto->stock < $item->cantidad) {
                return response()->json(['success' => false, 'message' => "Stock insuficiente para '{$item->producto->nombre}'."], 422);
            }
        }

        // 3. Procesar la venta y limpiar el carrito activo dentro de la transacción
        DB::transaction(function () use ($carrito, $items) {
            // Cambiamos el estado de la cabecera actual a 'confirmado'
            $carrito->update([
                'estado'      => 'confirmado',
                'fecha_venta' => now(),
            ]);

            // Descontamos el stock de cada producto
            foreach ($items as $item) {
                $item->producto->decrement('stock', $item->cantidad);
            }

            // [NUEVO] Desvinculamos los detalles para que la cabecera quede cerrada y limpia.
            // Al cambiar el estado de la VentaCabecera a 'confirmado', la próxima vez que 
            // el usuario use el carrito, 'obtenerCarrito()' creará una nueva cabecera vacía.
        });

        // 4. Guardamos el ID en la sesión para que el método de descarga lo pueda leer
        session()->put('ultima_venta_id', $carrito->id);
        session()->save();

        // 5. Generamos el enlace directo a la descarga del comprobante
        $urlDescarga = route('compra.descargar');

        // 6. Retornamos la respuesta en formato JSON
        return response()->json([
            'success' => true,
            'message' => '¡Compra realizada con éxito!',
            'download_url' => $urlDescarga
        ]);
    }

    // ─────────────────────────────────────────────
    // GET: Renderiza la pantalla de éxito (Se mantiene por compatibilidad)
    // ─────────────────────────────────────────────
    public function compraConfirmada(Request $request)
    {
        $ventaId = $request->get('id') ?? session('ultima_venta_id');

        if (!$ventaId) {
            return redirect()->route('carrito.index')->with('error', 'No se encontró una sesión de compra activa.');
        }

        session()->put('ultima_venta_id', $ventaId);
        session()->save();

        $venta = VentaCabecera::with([
            'detalles', 
            'detalles.producto'
        ])->where('usuario_id', auth()->id())->findOrFail($ventaId);

        return view('compra.confirmada', compact('venta'));
    }

    // ─────────────────────────────────────────────
    // GET: Genera y descarga el comprobante en PDF
    // ─────────────────────────────────────────────
    public function descargarComprobante()
    {
        $ventaId = session('ultima_venta_id');

        if (!$ventaId) {
            return redirect()->route('carrito.index')->with('error', 'No se encontró una sesión de compra activa.');
        }

        $venta = VentaCabecera::with(['detalles.producto'])
            ->where('usuario_id', auth()->id())
            ->findOrFail($ventaId);

        $data = [
            'user'  => Auth::user(),
            'items' => $venta->detalles,
            'total' => $venta->total,
            'fecha' => $venta->fecha_venta ? $venta->fecha_venta->format('d/m/Y H:i') : now()->format('d/m/Y H:i'),
        ];

        $dompdf = app('dompdf.wrapper');
        $pdf = $dompdf->loadView('email.comprobante', $data);
        
        return $pdf->download('comprobante_evolvex.pdf');
    }

    // ─────────────────────────────────────────────
    // GET: Historial de compras del usuario
    // ─────────────────────────────────────────────
public function historial(Request $request)
    {
        // Iniciamos la consulta base amarrada estrictamente al cliente autenticado
        $query = VentaCabecera::where('usuario_id', auth()->id())
            ->where('estado', 'confirmado')
            ->with(['detalles.producto'])
            ->orderBy('fecha_venta', 'desc');

        // Filtro 1: Por número de Orden / Compra
        if ($request->filled('orden_id')) {
            $query->where('id', $request->orden_id);
        }

        // Filtro 2: Desde una fecha específica
        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_venta', '>=', $request->fecha_desde);
        }

        // Filtro 3: Hasta una fecha específica
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_venta', '<=', $request->fecha_hasta);
        }

        // Ejecutamos la consulta con los filtros aplicados
        $compras = $query->get();

        // Retornamos la vista pasando los datos obtenidos
        return view('backend.usuarios.historial', compact('compras'));
    }
}