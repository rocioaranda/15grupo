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
        $total = $carrito->detalles->sum(fn($d) => $d->cantidad * $d->precio_unitario);
        $carrito->update(['total' => $total]);
    }

    //  Mostrar carrito
    public function index()
    {
        if (!auth()->check()) return view('carrito', ['carrito' => null, 'items' => collect()]);
        
        $carrito = $this->obtenerCarrito();
        $items = $carrito->detalles()->with(['producto'])->get();
        return view('carrito', compact('carrito', 'items'));
    }

    //  Agregar al carrito
    public function agregar(Request $request)
    {
        $request->validate(['producto_id' => 'required|exists:productos,id', 'cantidad' => 'required|integer|min:1']);
        $producto = Producto::findOrFail($request->producto_id);

        if (!$producto->activo || $producto->stock < $request->cantidad) {
            return back()->with('error', 'Producto no disponible o sin stock suficiente.');
        }

        $carrito = $this->obtenerCarrito();
        $item = $carrito->detalles()->where('producto_id', $producto->id)->first();

        if ($item) {
            $item->increment('cantidad', $request->cantidad);
            $item->update(['subtotal' => $item->cantidad * $item->precio_unitario]);
        } else {
            $carrito->detalles()->create([
                'producto_id' => $producto->id,
                'cantidad' => $request->cantidad,
                'precio_unitario' => $producto->precio,
                'subtotal' => $producto->precio * $request->cantidad,
            ]);
        }

        $this->recalcularTotal($carrito);
        return back()->with('exito', 'Producto añadido al carrito.');
    }

    //  Historial con filtros de fecha
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

    //  Confirmar compra 
    public function confirmar()
    {
        $carrito = $this->obtenerCarrito();
        if ($carrito->detalles->isEmpty()) return response()->json(['success' => false, 'message' => 'Carrito vacío'], 400);

        DB::transaction(function () use ($carrito) {
            foreach ($carrito->detalles as $item) {
                $item->producto->decrement('stock', $item->cantidad);
            }
            $carrito->update(['estado' => 'confirmado', 'fecha_venta' => now()]);
        });

        session(['ultima_venta_id' => $carrito->id]);
        return response()->json(['success' => true, 'download_url' => route('compra.descargar')]);
    }

    // Descargar comprobante 
    public function descargarComprobante()
    {
        $ventaId = session('ultima_venta_id');
        if (!$ventaId) return redirect()->route('carrito.index')->with('error', 'Sesión expirada.');

        $venta = VentaCabecera::with(['detalles.producto'])
            ->where('usuario_id', auth()->id())
            ->findOrFail($ventaId);

        $data = [
            'user'  => Auth::user(),
            'items' => $venta->detalles,
            'total' => $venta->total,
            'fecha' => $venta->fecha_venta ? $venta->fecha_venta->format('d/m/Y H:i') : now()->format('d/m/Y H:i'),
        ];

        $pdf = app('dompdf.wrapper')->loadView('email.comprobante', $data);
        return $pdf->download('comprobante_evolvex.pdf');
    }

    public function eliminar($id)
    {
        $carrito = $this->obtenerCarrito();
        $carrito->detalles()->where('id', $id)->delete();
        $this->recalcularTotal($carrito);
        return back()->with('exito', 'Producto eliminado.');
    }

    public function vaciar()
    {
        $carrito = $this->obtenerCarrito();
        $carrito->detalles()->delete();
        $carrito->update(['total' => 0]);
        return back()->with('exito', 'Carrito vaciado.');
    }
}