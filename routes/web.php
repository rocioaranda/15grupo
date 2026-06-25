<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductoController;

// Rutas públicas
Route::get('/', [InicioController::class, 'index'])->name('inicio');
Route::get('/quienes_somos', fn() => view('quienes_somos'))->name('quienes_somos');
Route::get('/terminos_condiciones', fn() => view('terminos_condiciones'))->name('terminos_condiciones');
Route::get('/comercializacion', fn() => view('comercializacion'))->name('comercializacion');

// Catálogo
Route::get('/catalogo/{categoria?}', [CatalogoController::class, 'index'])->name('catalogo.index');

// Consultas
Route::get('/consulta', fn() => view('consulta'))->name('consulta');
Route::post('/consulta/enviar', [ConsultaController::class, 'enviar'])->name('consulta.enviar');

// Autenticación
Route::get('/register', [AutenticacionController::class, 'formularioRegistro'])->name('register');
Route::post('/register', [AutenticacionController::class, 'registrar'])->name('register.store');
Route::get('/login', [AutenticacionController::class, 'formularioLogin'])->name('login');
Route::post('/login', [AutenticacionController::class, 'login'])->name('login.store');
Route::post('/logout', [AutenticacionController::class, 'logout'])->name('logout');

// Carrito (Público)
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

// --- ZONA PROTEGIDA (Auth) ---
Route::middleware(['auth'])->group(function () {
    Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
    Route::get('/mis-compras', [CarritoController::class, 'historial'])->name('compras.historial');
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');
    Route::get('/compra-confirmada', [CarritoController::class, 'compraConfirmada'])->name('compra.confirmada');
    Route::get('/compra/descargar', [CarritoController::class, 'descargarComprobante'])->name('compra.descargar');
    Route::post('/compra/enviar-comprobante', [CarritoController::class, 'enviarComprobante'])->name('compra.enviar');

    Route::get('/mi-perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::put('/mi-perfil/actualizar', [PerfilController::class, 'actualizar'])->name('perfil.actualizar');

    // --- ZONA ADMINISTRADOR ---
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        
        //  Visualizar y Eliminar Usuarios
        Route::get('/admin/usuarios', [AdminController::class, 'usuariosIndex'])->name('admin.usuarios.index');
        // Usamos el nombre 'admin.usuarios.eliminar' para que coincida perfectamente con tu formulario de la vista
        Route::delete('/admin/usuarios/{id}', [AdminController::class, 'eliminarUsuario'])->name('admin.usuarios.eliminar');

        // Ventas Realizadas
        Route::get('/admin/ventas', [AdminController::class, 'ventasIndex'])->name('admin.ventas.index');
        
        // Consultas Admin
        Route::get('/consultas', [ConsultaController::class, 'index'])->name('admin.consultas');
        Route::patch('/consultas/{consulta}/estado', [ConsultaController::class, 'cambiarEstado'])->name('admin.consultas.estado');
        
        // Productos Admin
        Route::get('/productos', [ProductoController::class, 'index'])->name('admin.productos.index');
        Route::get('/productos/create', [ProductoController::class, 'create'])->name('admin.productos.create');
        Route::post('/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
        Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('admin.productos.edit');
        Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update');
        Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');
        Route::patch('/productos/{id}/restore', [ProductoController::class, 'restore'])->name('admin.productos.restore');
    });
});
