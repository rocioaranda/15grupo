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
            'producto_id' => 'required|numeric|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

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
    // POST: Confirma la compra y retorna JSON
    // ─────────────────────────────────────────────
    public function confirmar()
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Debés iniciar sesión para finalizar la compra.'], 401);
        }

        $carrito = $this->obtenerCarrito();
        $items   = $carrito->detalles()->with(['producto'])->get();

        if ($items->count() === 0) {
            return response()->json(['success' => false, 'message' => 'Tu carrito está vacío.'], 400);
        }

        foreach ($items as $item) {
            if (!$item->producto) {
                return response()->json(['success' => false, 'message' => 'Uno de los productos ya no existe.'], 422);
            }
            if ($item->producto->stock < $item->cantidad) {
                return response()->json(['success' => false, 'message' => "Stock insuficiente para '{$item->producto->nombre}'."], 422);
            }
        }

        DB::transaction(function () use ($carrito, $items) {
            $carrito->update([
                'estado'      => 'confirmado',
                'fecha_venta' => now(),
            ]);

            foreach ($items as $item) {
                $item->producto->decrement('stock', $item->cantidad);
            }
        });

        // Sesión permanente para que persista entre requests
        session()->put('ultima_venta_id', $carrito->id);
        session()->save();

        return response()->json([
            'success'      => true,
            'message'      => '¡Compra realizada con éxito!',
            'download_url' => route('compra.descargar'),
        ]);
    }

    // ─────────────────────────────────────────────
    // GET: Vista de compra confirmada
    // ─────────────────────────────────────────────
    public function compraConfirmada(Request $request)
    {
        $ventaId = $request->get('id') ?? session('ultima_venta_id');

        if (!$ventaId) {
            return redirect()->route('carrito.index')->with('error', 'No se encontró una sesión de compra activa.');
        }

        session()->put('ultima_venta_id', $ventaId);
        session()->save();

        $venta = VentaCabecera::with(['detalles.producto'])
            ->where('usuario_id', auth()->id())
            ->findOrFail($ventaId);

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
            'fecha' => $venta->fecha_venta
                        ? $venta->fecha_venta->format('d/m/Y H:i')
                        : now()->format('d/m/Y H:i'),
        ];

        $pdf = app('dompdf.wrapper')->loadView('emails.comprobante', $data);

        return $pdf->download('comprobante_evolvex.pdf');
    }

    // ─────────────────────────────────────────────
    // POST: Envía el comprobante PDF al correo del usuario
    // ─────────────────────────────────────────────
    public function enviarComprobante()
    {
        $ventaId = session('ultima_venta_id');

        if (!$ventaId) {
            return redirect()->route('carrito.index')->with('error', 'No se encontró una sesión de compra activa.');
        }

        $venta = VentaCabecera::with(['detalles.producto'])
            ->where('usuario_id', auth()->id())
            ->findOrFail($ventaId);

        $user = Auth::user();
        $data = [
            'user'  => $user,
            'items' => $venta->detalles,
            'total' => $venta->total,
            'fecha' => $venta->fecha_venta
                        ? $venta->fecha_venta->format('d/m/Y H:i')
                        : now()->format('d/m/Y H:i'),
        ];

        $pdf = app('dompdf.wrapper')->loadView('emails.comprobante', $data);

        try {
            Mail::send('emails.cuerpo_correo', $data, function ($message) use ($user, $pdf) {
                $message->to($user->email, $user->nombre_apellido)
                        ->subject('Comprobante de Compra - Evolvex')
                        ->attachData($pdf->output(), 'comprobante_evolvex.pdf');
            });

            return back()->with('exito', "Comprobante enviado a {$user->email}");
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo enviar el email. Podés descargarlo manualmente.');
        }
    }

    // ─────────────────────────────────────────────
    // GET: Historial de compras del usuario
    // ─────────────────────────────────────────────
 public function historial(Request $request)
    {
        $query = VentaCabecera::where('usuario_id', auth()->id())
            ->where('estado', 'confirmado')
            ->with(['detalles.producto'])
            ->orderBy('fecha_venta', 'desc');

        if ($request->filled('fecha_desde')) $query->whereDate('fecha_venta', '>=', $request->fecha_desde);
        if ($request->filled('fecha_hasta')) $query->whereDate('fecha_venta', '<=', $request->fecha_hasta);

        $compras = $query->get();
        return view('backend.usuarios.historial', compact('compras'));
    }

    // ─────────────────────────────────────────────
    // HELPER PRIVADO: Recalcula el total del carrito
    // ─────────────────────────────────────────────
    private function recalcularTotal(VentaCabecera $carrito)
    {
        $total = $carrito->detalles()->sum('subtotal');
        $carrito->update(['total' => $total]);
    }
}