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
        $items   = $carrito->detalles()->with(['producto' => function ($query) {
            $query->withTrashed();
        }])->get();

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

        $producto = Producto::withTrashed()->findOrFail($request->producto_id);

        if ($producto->trashed()) {
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
    // POST: Confirma la compra (MODIFICADO PARA PASAR PARÁMETRO DIRECTO)
    // ─────────────────────────────────────────────
    public function confirmar()
    {
        $carrito = $this->obtenerCarrito();
        $items = $carrito->detalles()->with(['producto' => function ($query) {
            $query->withTrashed();
        }])->get();

        if ($items->count() === 0) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        foreach ($items as $item) {
            if ($item->producto->trashed()) {
                return redirect()->route('carrito.index')
                    ->with('error', "El producto '{$item->producto->nombre}' ya no está disponible.");
            }
            if ($item->producto->stock < $item->cantidad) {
                return redirect()->route('carrito.index')
                    ->with('error', "Stock insuficiente para '{$item->producto->nombre}'.");
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

        // Guardamos en sesión 
        session()->put('ultima_venta_id', $carrito->id);
        session()->save();

        //  Pasamos el ID por la URL para evitar que el "carrito vacío" rebote
        return redirect()->route('compra.confirmada', ['id' => $carrito->id])
            ->with('exito', '¡Compra realizada con éxito!');
    }

    // ─────────────────────────────────────────────
    // GET: Renderiza la pantalla de éxito (MODIFICADO)
    // ─────────────────────────────────────────────
    public function compraConfirmada(Request $request)
    {
        // Primero intentamos leer el ID desde la URL, si no, lo busca en la sesión
        $ventaId = $request->get('id') ?? session('ultima_venta_id');

        if (!$ventaId) {
            return redirect()->route('carrito.index')->with('error', 'No se encontró una sesión de compra activa.');
        }

        // Volvemos a asegurar que el ID quede en sesión para que los botones de PDF y Correo lo puedan usar
        session()->put('ultima_venta_id', $ventaId);
        session()->save();

        $venta = VentaCabecera::with([
            'detalles', 
            'detalles.producto' => function ($query) {
                $query->withTrashed();
            }
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

        $venta = VentaCabecera::with(['detalles.producto' => function ($query) {
            $query->withTrashed();
        }])
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
    // HISTORIAL e INFORME PRIVADO
    // ─────────────────────────────────────────────
    public function historial()
    {
        $compras = VentaCabecera::where('usuario_id', auth()->id())
            ->where('estado', 'confirmado')
            ->orderBy('fecha_venta', 'desc')
            ->with(['detalles.producto' => function ($query) {
                $query->withTrashed();
            }])
            ->get();

        return view('backend.usuarios.historial', compact('compras'));
    }

    private function recalcularTotal(VentaCabecera $carrito)
    {
        $total = $carrito->detalles()->sum('subtotal');
        $carrito->update(['total' => $total]);
    }
}