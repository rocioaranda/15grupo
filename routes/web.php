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


// Autenticación
Route::get('/register', [AutenticacionController::class, 'formularioRegistro'])->name('register');
Route::post('/register', [AutenticacionController::class, 'registrar'])->name('register.store');

Route::get('/login', [AutenticacionController::class, 'formularioLogin'])->name('login');
Route::post('/login', [AutenticacionController::class, 'login'])->name('login.store');

Route::post('/logout', [AutenticacionController::class, 'logout'])->name('logout');


// Gestión del carrito (operaciones públicas básicas)
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');


// ZONA PROTEGIDA (Solo Clientes Registrados y Autenticados)
Route::middleware(['auth'])->group(function () {

    // Finalizar y vaciar carritos
    Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

    // Historial de compras 
    Route::get('/mis-compras', [CarritoController::class, 'historial'])->name('compras.historial');
    
    // compras
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');
    Route::get('/compra-confirmada', [CarritoController::class, 'compraConfirmada'])->name('compra.confirmada');
    Route::get('/compra/descargar', [CarritoController::class, 'descargarComprobante'])->name('compra.descargar');
    Route::post('/compra/enviar-comprobante', [CarritoController::class, 'enviarComprobante'])->name('compra.enviar');

    // Panel de Gestión de Perfil
    Route::get('/mi-perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::put('/mi-perfil/actualizar', [PerfilController::class, 'actualizar'])->name('perfil.actualizar');


    // CONTROL DE ACCESO ADMINISTRADOR
    Route::middleware(['admin'])->group(function () {
        
        // Dashboard general
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
        // CRUD de Productos
        Route::get('/admin/productos', [ProductoController::class, 'index'])->name('admin.productos.index');
        Route::post('/admin/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
        Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update');
        Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');
        Route::patch('/admin/productos/{id}/restore', [ProductoController::class, 'restore'])->name('admin.productos.restore');
        
        //  Visualizar y Eliminar Usuarios
        Route::get('/admin/usuarios', [AdminController::class, 'usuariosIndex'])->name('admin.usuarios.index');
        // Usamos el nombre 'admin.usuarios.eliminar' para que coincida perfectamente con tu formulario de la vista
        Route::delete('/admin/usuarios/{id}', [AdminController::class, 'eliminarUsuario'])->name('admin.usuarios.eliminar');

        // Ventas Realizadas
        Route::get('/admin/ventas', [AdminController::class, 'ventasIndex'])->name('admin.ventas.index');

        // Rutas Admin - Consultas recibidas
        Route::get('/admin/consultas', [ConsultaController::class, 'index'])->name('admin.consultas');
        Route::patch('/admin/consultas/{consulta}/estado', [ConsultaController::class, 'cambiarEstado'])->name('admin.consultas.estado');
    });

});