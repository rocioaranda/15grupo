<?php

namespace App\Http\Controllers;

// Importamos el modelo Categoria para poder consultar la tabla 'categorias'
use App\Models\Categoria;

// Importamos el modelo Producto para poder consultar la tabla 'productos'
// (Sin este 'use', PHP no encuentra la clase y tira error)
use App\Models\Producto;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    /**
     * Muestra la página principal (home) del sitio.
     * Se encarga de traer las categorías y los productos destacados
     * que se van a mostrar en la vista 'principal'.
     */
    public function index()
    {
         // 1. Categorías (sin cambios)
        $categorias = Categoria::orderByRaw("FIELD(nombre, 'Aumento de masa muscular', 'Definición / Quemar grasa', 'Salud y vitalidad', 'Accesorios')")->get();

        // 2. Últimos productos cargados (sin cambios)
        $destacados = Producto::with('categoria')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $masVendidos = \App\Models\VentaDetalle::select('ventas_detalle.producto_id', \DB::raw('SUM(ventas_detalle.cantidad) as total_vendido'))
        ->join('ventas_cabecera', 'ventas_detalle.venta_id', '=', 'ventas_cabecera.id')
        ->where('ventas_cabecera.estado', 'confirmado')
        ->groupBy('ventas_detalle.producto_id')
        ->orderBy('total_vendido', 'desc')
        ->with('producto')
        ->take(3)
        ->get();

      return view('principal', compact('categorias', 'destacados', 'masVendidos'));
    }
}