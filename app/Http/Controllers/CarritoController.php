<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    // Helper privado: Mantiene la lógica oficial de la cátedra
    private function obtenerCarrito()
    {
        return VentaCabecera::firstOrCreate(
            [
                'usuario_id' => auth()->id(),
                'estado'  => 'carrito',
            ],
            ['total' => 0]
        );
    }

    // GET: Muestra el carrito (Ahora es público y amigable para invitados)
    public function index()
    {
        // Si el usuario NO inició sesión, mandamos la vista limpia con datos vacíos
        if (!auth()->check()) {
            $carrito = null;
            $items = collect(); // Colección vacía para que la vista no rompa
            return view('carrito', compact('carrito', 'items'));
        }

        // Si SÍ inició sesión, cargamos su carrito real desde la base de datos
        $carrito = $this->obtenerCarrito();
        $items = $carrito->detalles()->with('producto')->get();
        
        return view('carrito', compact('carrito', 'items'));
    }

    // POST: Agrega un producto (Redirige al login si es invitado)
    public function agregar(Request $request)
    {
        // El requisito clave: Si no está logueado, lo mandamos a iniciar sesión
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debés iniciar sesión para añadir productos al carrito.');
        }

        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $carrito = $this->obtenerCarrito();
        $item = $carrito->detalles()->where('producto_id', $producto->id)->first();

        if ($item) {
            $item->cantidad += $request->cantidad;
            $item->subtotal = $item->cantidad * $item->precio_unitario;
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

    // DELETE: Quita una fila específica del carrito del usuario
    public function eliminar($id)
    {
        $carrito = $this->obtenerCarrito();
        
        // Filtramos por el id del ítem asegurando que pertenezca a la cabecera activa
        $carrito->detalles()->where('id', $id)->delete();
        
        $this->recalcularTotal($carrito);
        return back()->with('exito', 'Producto removido con éxito.');
    }

    // POST: Cierra la compra, descuenta stock, envía email con PDF y lo descarga
    public function confirmar()
    {
        $carrito = $this->obtenerCarrito();

        if ($carrito->detalles()->count() === 0) {
            return back()->with('error', 'Tu carrito está vacío.');
        }

        $items = $carrito->detalles()->with('producto')->get();
        $total = $carrito->total;
        $user = Auth::user();

        // 1. Modificamos estado a 'confirmado' y guardamos la fecha exacta de venta
        $carrito->update([
            'estado'      => 'confirmado',
            'fecha_venta' => now(),
        ]);

        // 2. Descontamos el stock real de los productos del catálogo
        foreach ($items as $item) {
            $prod = $item->producto;
            $prod->stock -= $item->cantidad;
            $prod->save();
        }

        // Estructura de datos que usará el PDF y el Mail
        $data = [
            'user'  => $user,
            'items' => $items,
            'total' => $total,
            'fecha' => now()->format('d/m/Y H:i')
        ];

        // 3. Compilar el HTML de la vista en un archivo PDF binario usando DomPDF
        $pdf = Pdf::loadView('emails.comprobante', $data);

        // 4. Despachar el correo adjuntando el PDF generado
        Mail::send('emails.cuerpo_correo', $data, function($message) use ($user, $pdf) {
            $message->to($user->email, $user->nombre_apellido)
                    ->subject('Comprobante de Compra - Evolvex')
                    ->attachData($pdf->output(), "comprobante_evolvex.pdf");
        });

        // 5. Forzar la descarga del PDF en el navegador del usuario
        return $pdf->download('comprobante_evolvex.pdf');
    }

    // Helper privado: Recalcula dinámicamente el valor total acumulado
    private function recalcularTotal(VentaCabecera $carrito)
    {
        $total = $carrito->detalles()->sum('subtotal');
        $carrito->update(['total' => $total]);
    }

    // para ver lo q el usuario compró
    public function historial()
    {
        // Traemos las compras confirmadas ordenadas desde la más reciente
        // Usamos with('detalles.producto') para traer todos los suplementos comprados sin saturar la BD
        $compras = VentaCabecera::where('usuario_id', auth()->id())
            ->where('estado', 'confirmado')
            ->orderBy('fecha_venta', 'desc')
            ->with('detalles.producto')
            ->get();

        return view('historial', compact('compras'));
    }
}


