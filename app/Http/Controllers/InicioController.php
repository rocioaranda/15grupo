<?php

namespace App\Http\Controllers;

use App\Models\Categoria; 
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        // 1. Buscamos todas las categorías reales de la base de datos
        $categorias = Categoria::all();

        // 2. Se las enviamos a la vista 'principal'
        return view('principal', compact('categorias'));
    }
}