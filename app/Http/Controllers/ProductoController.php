<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    /**
     * VISTA PÚBLICA: Muestra el catálogo de la tienda
     * Puede recibir un ID de categoría opcional desde el Navbar para filtrar
     */
    public function catalogo($categoriaId = null)
    {
        // 1. Iniciamos la consulta base: solo productos activos y con stock disponible
        $query = Producto::where('activo', true)->where('stock', '>', 0);

        // 2. Si se hace click en una categoría del Navbar, filtramos la consulta
        if ($categoriaId) {
            $query->where('categoria_id', $categoriaId);
        }

        // 3. Obtenemos los productos finales de la base de datos
        $productos = $query->get();

        // 4. Traemos todas las categorías para armar las pestañas (Tabs) internas de la vista
        $categorias = Categoria::all();

        return view('catalogo', compact('productos', 'categorias'));
    }

    /**
     * VISTA ADMINISTRADOR: Muestra el panel/tabla de gestión de productos (CRUD)
     */
    public function index()
    {
        // Trae todos los productos
        $productos = Producto::all();
        return view('backend.admin.productos.index', compact('productos'));
    }

    /**
     * ACCIÓN ADMINISTRADOR: Guarda un nuevo producto en la Base de Datos (ALTA)
     */
    public function store(Request $request)
    {
        // 1. Validamos estrictamente los campos del formulario
        $request->validate([
            'nombre'       => 'required|string|max:150',
            'precio'       => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'url_imagen'   => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categoria_id' => 'required|integer|exists:categorias,id',
        ]);

        // 2. Subimos la imagen de forma segura al disco local (storage/app/public/productos)
        $rutaImagen = null;
        if ($request->hasFile('url_imagen')) {
            $rutaImagen = $request->file('url_imagen')->store('productos', 'public');
        }

        // REGLA DE NEGOCIO: Si se crea con stock 0, se guarda como inactivo automáticamente
        $estadoInicial = ($request->stock == 0) ? false : true;

        // 3. Creamos el registro en la tabla 'productos' usando asignación masiva
        Producto::create([
            'nombre'       => $request->nombre,
            'precio'       => $request->precio,
            'stock'        => $request->stock,
            'url_imagen'   => $rutaImagen,
            'categoria_id' => $request->categoria_id,
            'activo'       => $estadoInicial,
            'descripcion'  => null // Al no estar en el formulario, se inicializa limpio en null
        ]);

        return redirect()->route('admin.productos.index')->with('success', '¡Producto añadido exitosamente al catálogo!');
    }

    /**
     * ACCIÓN ADMINISTRADOR: Actualiza los datos editados desde la tabla (MODIFICACIÓN Quick CRUD)
     */
    public function update(Request $request, $id)
    {
        // 1. Validamos los datos modificados inline
        $request->validate([
            'nombre' => 'required|string|max:150',
            'precio' => 'required|numeric|min:0',
            'stock'  => 'required|integer|min:0',
            'activo' => 'required|in:0,1',
        ]);

        $producto = Producto::findOrFail($id);
        
        // REGLA DE NEGOCIO AUTOMÁTICA:
        // Si el stock nuevo es 0, se fuerza a "Inactivo" (false).
        // Si el stock es mayor a 0, respeta la opción manual (Activo/Inactivo) elegida en el select.
        $nuevoEstado = ($request->stock == 0) ? false : (bool)$request->activo;

        // 2. Ejecutamos la actualización de los campos en la BD
        $producto->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock'  => $request->stock,
            'activo' => $nuevoEstado,
        ]);

        return redirect()->route('admin.productos.index')->with('success', '¡Producto actualizado correctamente!');
    }

    /**
     * ACCIÓN ADMINISTRADOR: Aplica la Baja Lógica al producto (ELIMINAR)
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        
        // Gracias al SoftDeletes no se elimina físicamente, se marca con 'deleted_at'
        $producto->delete(); 

        return redirect()->route('admin.productos.index')->with('success', '¡Producto dado de baja en la tienda!');
    }

    /**
     * ACCIÓN ADMINISTRADOR: Revierte la baja lógica (RESTAURAR)
     */
    public function restore($id)
    {
        // Buscamos específicamente entre los registros eliminados lógicamente
        $producto = Producto::withTrashed()->findOrFail($id);
        
        // Remueve la marca de eliminación y vuelve a estar visible
        $producto->restore(); 

        return redirect()->route('admin.productos.index')->with('success', '¡Producto habilitado nuevamente para la venta!');
    }
}