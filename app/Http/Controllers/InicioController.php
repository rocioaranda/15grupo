<?php

namespace App\Http\Controllers;

use App\Models\Categoria; 
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        // 1. Buscamos todas las categorías de la base de datos
        $categorias = Categoria::orderByRaw("FIELD(nombre, 'Aumento de masa muscular', 'Definición / Quemar grasa', 'Salud y vitalidad', 'Accesorios')")->get();

        // 2. Se las enviamos a la vista 'principal'
        return view('principal', compact('categorias'));
    }
}