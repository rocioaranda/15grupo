<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view) {
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
