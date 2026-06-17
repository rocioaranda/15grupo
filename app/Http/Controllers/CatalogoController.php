<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    
    public function index(Request $request, $categoriaId = null)
    {
        // 1. Traemos las categorías ordenadas por su ID natural o el orden que prefieras
        $categorias = Categoria::orderBy('id', 'asc')->get();

        // Capturamos lo que el usuario escribió en el navbar
        $textoBuscar = $request->input('buscar');

        // 2. Armamos la consulta de productos activos
        $query = Producto::with('categoria')->where('activo', true);

        //  FILTRO DEL BUSCADOR: Si el usuario escribió algo, filtramos por nombre
        if (!empty($textoBuscar)) {
            $query->where('nombre', 'LIKE', '%' . $textoBuscar . '%');
        }

        // Ejecutamos la consulta trayendo los últimos registros
        $productos = $query->latest()->get();

        // 3. Enviamos las variables a la vista
        return view('catalogo', compact('productos', 'categorias', 'categoriaId'));
    }
}
