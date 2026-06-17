<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index($categoriaId = null)
    {
        // 1. Traemos todas las categorías obligatoriamente
        $categorias = Categoria::all();

        // 2. Traemos SIEMPRE todos los productos activos vinculados a su categoría
        // Quitamos el filtro 'when' de acá para que Blade tenga todo el mapa de productos disponible
        $productos = Producto::with('categoria')->latest()->get();

        // 3. Enviamos las variables a la vista. 
        // $categoriaId nos servirá únicamente para saber cuál pestaña dejar abierta por defecto
        return view('catalogo', compact('productos', 'categorias', 'categoriaId'));
    }
}
