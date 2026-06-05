<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index()
    {
        // 1. Traemos todas las categorías para armar los botones de filtro
        $categorias = Categoria::all();

        // 2. Traemos todos los productos activos con su categoría vinculada
        $productos = Producto::where('activo', true)->with('categoria')->latest()->get();

        // 3. Enviamos ambas variables a la vista
        return view('catalogo', compact('productos', 'categorias'));
    }
}
