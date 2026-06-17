<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use App\Models\Usuario; 
use App\Models\Consulta; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; 

class AdminController extends Controller
{
    // 1. DASHBOARD PRINCIPAL Y ESTADÍSTICAS
    public function index()
    {
        $totalVentas = \App\Models\VentaCabecera::where('estado', 'confirmado')->sum('total') ?? 0;
        $cantidadPedidos = \App\Models\VentaCabecera::where('estado', 'confirmado')->count();
        $cantidadUsuarios = \App\Models\Usuario::count();
        
        //  Usamos withTrashed() al contar por si la base de datos se está actualizando
        $cantidadProductos = \App\Models\Producto::withTrashed()->count(); 

        // Añadimos withTrashed() en la relación del producto estrella.
        // Si el artículo más vendido fue pausado o dado de baja, la métrica no colapsará.
        $productoEstrella = \App\Models\VentaDetalle::select('producto_id', \DB::raw('SUM(cantidad) as total_vendido'))
            ->groupBy('producto_id')
            ->orderBy('total_vendido', 'desc')
            ->with(['producto' => function($q) {
                $q->withTrashed();
            }]) 
            ->first();

        // si no hay registros de ventas, evitamos que colapse pasándolo como null
        if (!$productoEstrella || !$productoEstrella->producto) {
            $productoEstrella = null;
        }

        return view('backend.admin.dashboard', compact(
            'totalVentas', 
            'cantidadPedidos', 
            'cantidadUsuarios', 
            'cantidadProductos', 
            'productoEstrella'
        ));
    }
    
    // Listar productos (Incluye los dados de baja lógica para que el admin los vea)
    public function productosIndex()
    {
        // WithTrashed() trae los productos normales + los eliminados lógicamente
        $productos = Producto::withTrashed()->orderBy('id', 'desc')->get();
        return view('backend.admin.productos.index', compact('productos'));
    }

    // Procesar el Alta (Guardar producto nuevo con Imagen)
    public function productosStore(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'precio'       => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'url_imagen'   => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categoria_id' => 'required|integer',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('url_imagen')) {
            $rutaImagen = $request->file('url_imagen')->store('productos', 'public');
        }

        \App\Models\Producto::create([
            'nombre'       => $request->nombre,
            'descripcion'  => null, 
            'precio'       => $request->precio,
            'stock'        => $request->stock,
            'url_imagen'   => $rutaImagen,
            'activo'       => true,
            'categoria_id' => $request->categoria_id
        ]);

        return back()->with('exito', 'Producto y su imagen cargados correctamente en el catálogo.');
    }

    // Procesar la Modificación (Actualizar datos e imagen de manera opcional)
    public function productosUpdate(Request $request, $id)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'precio'       => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'url_imagen'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
            'descripcion'  => 'nullable|string',
            'categoria_id' => 'nullable|integer'
        ]);

        $producto = Producto::withTrashed()->findOrFail($id);
        
        $datos = $request->only(['nombre', 'descripcion', 'precio', 'stock', 'categoria_id']);

        if ($request->hasFile('url_imagen')) {
            if ($producto->url_imagen) {
                Storage::disk('public')->delete($producto->url_imagen);
            }
            $datos['url_imagen'] = $request->file('url_imagen')->store('productos', 'public');
        }

        $producto->update($datos);

        return back()->with('exito', 'Producto actualizado correctamente.');
    }

    // BAJA LÓGICA (Eliminación usando SoftDeletes)
    public function productosDestroy($id)
    {
        $producto = Producto::findOrFail($id);
        
        $producto->update(['activo' => false]); 
        $producto->delete(); 

        return back()->with('exito', 'Producto dado de baja lógica correctamente.');
    }

    // ALTA DE NUEVO (Restaurar un producto dado de baja)
    public function productosRestore($id)
    {
        $producto = Producto::onlyTrashed()->findOrFail($id);
        $producto->update(['activo' => true]);
        $producto->restore(); 

        return back()->with('exito', 'Producto reactivado en el catálogo.');
    }


    // Visualizar Usuarios
    public function usuariosIndex()
    {
        $usuarios = Usuario::orderBy('id', 'desc')->get();
        return view('backend.admin.usuarios', compact('usuarios'));
    }

    // Visualizar Consultas y Contactos
    public function consultasIndex()
    {
        $consultas = Consulta::orderBy('created_at', 'desc')->get();
        return view('backend.admin.consultas', compact('consultas'));
    }

    // Marcar consultas como leídas
    public function consultasMarcarLeida($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->update(['leida' => 1]);

        return back()->with('exito', 'La consulta ha sido marcada como leída.');
    }

    // Visualizar Ventas Realizadas con filtros opcionales
    public function ventasIndex(Request $request)
    {
        $query = VentaCabecera::where('estado', 'confirmado')
            ->with(['usuario', 'detalles.producto' => function($q) {
                $q->withTrashed();
            }])
            ->orderBy('fecha_venta', 'desc');

        if ($request->filled('orden_id')) {
            $query->where('id', $request->orden_id);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_venta', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_venta', '<=', $request->fecha_hasta);
        }

        if ($request->filled('cliente')) {
            $buscar = $request->cliente;
            $query->whereHas('usuario', function ($q) use ($buscar) {
                $q->where('nombre_apellido', 'LIKE', "%{$buscar}%")
                  ->orWhere('email', 'LIKE', "%{$buscar}%");
            });
        }

        $ventas = $query->get();
            
        return view('backend.admin.ventas', compact('ventas'));
    }

    /**
     * Eliminar un usuario del sistema.
     */
    public function eliminarUsuario($id)
    {
        // 1. Evitamos que el admin se suicide borrando su propia cuenta
        if (auth()->id() == $id) {
            return back()->with('error', 'No podés eliminar tu propia cuenta de administrador en uso.');
        }

        // 2. Buscamos al usuario por su ID
        $usuario = Usuario::findOrFail($id); 
        
        // 3. Lo eliminamos
        $usuario->delete();

        // 4. Redireccionamos con el mensaje de éxito que lee la vista
        return back()->with('exito', 'Usuario eliminado correctamente del sistema.');
    }
}