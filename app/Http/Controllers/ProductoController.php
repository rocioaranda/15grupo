<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductoRequest; 

class ProductoController extends Controller
{
    // VISTA PÚBLICA
    public function catalogo($categoriaId = null)
    {
        $query = Producto::where('activo', true)->where('stock', '>', 0);
        if ($categoriaId) { $query->where('categoria_id', $categoriaId); }
        $productos = $query->get();
        $categorias = Categoria::all();
        return view('catalogo', compact('productos', 'categorias'));
    }

    // LISTADO PARA ADMIN (Gestión)
    public function vistaEliminar(Request $request)
    {
        $categorias = Categoria::all();
        $productos = Producto::query()->filtrar($request)->get();
        return view('backend.admin.productos.eliminar', compact('productos', 'categorias'));
    }

    // ALTA DE PRODUCTO
    public function create()
    {
        $categorias = Categoria::all();
        return view('backend.admin.productos.altaProducto', compact('categorias'));
    }

    public function store(StoreProductoRequest $request)
    {
        $datos = $request->validated();
        if ($request->hasFile('imagen')) {
            $datos['url_imagen'] = $request->file('imagen')->store('productos', 'public');
        }
        $datos['activo'] = $request->has('activo') ? 1 : 0;

        Producto::create($datos);
        return redirect()->route('admin.productos.eliminar')->with('exito', 'Producto agregado correctamente.');
    }

    // EDICIÓN DE PRODUCTO
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('backend.admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->nombre;
        $producto->categoria_id = $request->categoria_id;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->activo = $request->has('activo') ? 1 : 0;

        if ($request->hasFile('imagen')) {
            $producto->url_imagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->save();
        return redirect()->route('admin.productos.eliminar')->with('exito', 'Producto actualizado correctamente.');
    }

    // BAJA LÓGICA
    public function destroy($id)
    {
        Producto::findOrFail($id)->delete();
        return redirect()->route('admin.productos.eliminar')->with('exito', 'Producto eliminado correctamente.');
    }
}