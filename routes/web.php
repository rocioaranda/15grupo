<?php
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarritoController;

Route::get('/', function () {
    return view('principal'); // Esto busca resources/views/principal.blade.php
});
Route::get('/quienes_somos', function () {
    return view('quienes_somos');
});

Route::get('/terminos_condiciones', function () {
    return view('terminos_condiciones');
});

Route::get('/catalogo', function () {
    return view('catalogo');
});

Route::get('/consulta', function () { 
return view('consulta'); 
});

Route::post('/consulta', [ConsultaController::class, 'enviar'])
    ->name('consulta.enviar');

Route::get('/comercializacion', function () { 
return view('comercializacion'); 
}); 

// páginas por categoría
Route::get('/Masa_aumento', function () { 
return view('Masa_aumento'); 
});

Route::get('/quemar_grasa', function () { 
 return view('quemar_grasa'); 
});

Route::get('/vitalidad_salud', function () { 
  return view('vitalidad_salud'); 
});

Route::get('/acce', function () { 
 return view('acce'); 
});
Route::get('/accesorios', function () { 
    return view('accesorios'); 
});

// ruta para catalogo
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
// Registro de Usuarios
Route::get('/register', [AutenticacionController::class, 'formularioRegistro'])->name('register');
Route::post('/register', [AutenticacionController::class, 'registrar'])->name('register.store');

// ruta para carrito

// ualquier visitante puede ver su carrito y añadir productos
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
// para ver el historial de compras 
Route::get('/mis-compras', [CarritoController::class, 'historial'])->name('compras.historial');

// solo ingresan usuarios logueados
Route::middleware(['auth'])->group(function () {
    // Al presionar "Finalizar Compra", Laravel interceptará la petición y exigirá el Login
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');
    
    Route::get('/compra-confirmada', function () {
        if (!session('total')) {
            return redirect()->route('carrito.index');
        }
        return view('emails.cuerpo_correo');
    })->name('compra.confirmada');
});


// Inicio de Sesión
Route::get('/login', [AutenticacionController::class, 'formularioLogin'])->name('login');
Route::post('/login', [AutenticacionController::class, 'login'])->name('login.store');

// Registro de Usuarios
Route::get('/register', [AutenticacionController::class, 'formularioRegistro'])->name('register');
Route::post('/register', [AutenticacionController::class, 'registrar'])->name('register.store');

// Cierre de Sesión
Route::post('/logout', [AutenticacionController::class, 'logout'])->name('logout');

// Para usuarios autenticados
Route::middleware(['auth'])->group(function () {
    
    // Panel privado del Cliente
    Route::get('/mi-perfil', function () {
        return view('backend.usuarios.cliente'); 
    })->name('perfil.cliente');

    // RUTA DEL ADMINISTRADOR
    Route::get('/admin', function () {
       // Validación limpia antes de llamar al controlador:
        if (Auth::user()->rol_id !== 1) {
            return redirect('/')->with('error', 'No tenés permisos para acceder a esta sección.');
        }
        
        // Si es admin, llamamos manualmente a la función de tu controlador
        return app(AdminController::class)->index();
    })->name('admin.dashboard');
    
});

