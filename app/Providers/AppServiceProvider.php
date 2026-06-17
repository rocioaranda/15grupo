<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categoria;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Usamos el View Composer para compartir datos en todas las vistas ('*')
        View::composer('*', function ($view) {
            
            // 1. COMPARTIR LAS CATEGORÍAS (CON CACHÉ EN MEMORIA POR PETICIÓN)
            if (!app()->runningInConsole()) {
                static $categoriasGlobales = null;
                if ($categoriasGlobales === null) {
                    $categoriasGlobales = Categoria::all();
                }
                $view->with('categoriasGlobales', $categoriasGlobales);
            } else {
                $view->with('categoriasGlobales', collect());
            }

            // 2. COMPARTIR LA CANTIDAD DE ELEMENTOS DEL CARRITO
            if (auth()->check()) {
                $venta = auth()->user()->ventas()
                    ->where('estado', 'carrito')
                    ->withSum('detalles', 'cantidad')
                    ->first();

                $view->with('cantidadCarrito', $venta?->detalles_sum_cantidad ?? 0);
            } else {
                $view->with('cantidadCarrito', 0);
            }
        });
    }
}