<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductoRequest;
use App\Http\Requests\StoreProductoRequest; 

class ProductoController extends Controller
{
    // VISTA PÚBLICA: CATÁLOGO
    public function catalogo(Request $request, $categoriaId = null)
    {
        $query = Producto::where('activo', true)->where('stock', '>', 0);
        
        if ($categoriaId) { 
            $query->where('categoria_id', $categoriaId); 
        }
        
        $productos = $query->paginate(12)->appends($request->query());
        $categorias = Categoria::all();
        
        return view('catalogo', compact('productos', 'categorias', 'categoriaId'));
    }

    // VISTA PÚBLICA: DETALLE DE UN PRODUCTO
    public function show($id)
    {
        $producto = Producto::where('id', $id)->where('activo', true)->firstOrFail();
        return view('producto.show', compact('producto'));
    }

    // LISTADO PARA ADMIN (Gestión)
    public function vistaEliminar(Request $request)
    {
        $categorias = Categoria::all();
        $productos = Producto::query()->filtrar($request)->paginate(10)->appends($request->query());
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
        return redirect()->route('admin.productos.create')->with('exito', 'Producto agregado correctamente.');
    }

    // EDICIÓN DE PRODUCTO
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('backend.admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(UpdateProductoRequest $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $datos = $request->validated();

        $producto->nombre = $datos['nombre'];
        $producto->categoria_id = $datos['categoria_id'];
        $producto->descripcion = $datos['descripcion'];
        $producto->precio = $datos['precio'];
        $producto->stock = $datos['stock'];
        $producto->activo = $request->has('activo') ? 1 : 0;

        if ($request->hasFile('imagen')) {
            $producto->url_imagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->save();
        return redirect()->route('admin.productos.buscarEditar')->with('exito', 'Producto actualizado correctamente.');
    }

    public function buscarEditar(Request $request)
    {
        $categorias = Categoria::all();

        $productos = Producto::query()
            ->filtrar($request)
            ->paginate(10)
            ->appends($request->query());

        return view('backend.admin.productos.buscarEditar', compact('productos', 'categorias'));
    }

    // BAJA LÓGICA
    public function destroy($id)
    {
        Producto::findOrFail($id)->delete();
        return redirect()->route('admin.productos.eliminar')->with('exito', 'Producto eliminado correctamente.');
    }

    public function buscarEliminar(Request $request)
    {
        $categorias = Categoria::all();
        $productos = null;

        if ($request->anyFilled(['id', 'nombre', 'categoria_id'])) {
            $productos = Producto::query()
                ->filtrar($request)
                ->paginate(10)
                ->appends($request->query());
        }

        return view('backend.admin.productos.eliminar', compact('productos', 'categorias'));
    }
}