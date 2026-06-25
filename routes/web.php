<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProductoController;
use App\Models\VentaCabecera;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CatalogoController;


Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::get('/quienes_somos', function () { 
    return view('quienes_somos'); 
})->name('quienes_somos');

Route::get('/terminos_condiciones', function () { 
    return view('terminos_condiciones'); 
})->name('terminos_condiciones');

Route::get('/comercializacion', function () { 
    return view('comercializacion'); 
})->name('comercializacion');

// Catálogo
Route::get('/catalogo/{categoria?}', [CatalogoController::class, 'index'])->name('catalogo.index');

// Consultas públicas
Route::get('/consulta', function () { 
    return view('consulta'); 
})->name('consulta');

Route::post('/consulta/enviar', [ConsultaController::class, 'enviar'])->name('consulta.enviar');

// Rutas Admin - Consultas
Route::get('/admin/consultas', [ConsultaController::class, 'index'])->name('admin.consultas');
Route::patch('/admin/consultas/{consulta}/estado', [ConsultaController::class, 'cambiarEstado'])->name('admin.consultas.estado');
// ruta para alta producto
Route::get('/admin/productos/create', [ProductoController::class, 'create'])->name('admin.productos.create');
Route::post('/admin/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
 //editar un producto
Route::get('/admin/productos/{id}/edit', [ProductoController::class, 'edit'])
    ->name('admin.productos.edit');
Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])
    ->name('admin.productos.update');
    //eliminar un producto
Route::get('/admin/productos/eliminar', [ProductoController::class, 'vistaEliminar'])->name('admin.productos.eliminar');
Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');
