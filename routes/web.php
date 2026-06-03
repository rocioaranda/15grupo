<?php
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\AdminController;

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

Route::get('/contacto', function () { 
return view('contacto'); 
});

Route::post('/contacto', [ContactoController::class, 'enviar'])->name('contacto.enviar');

Route::get('/comercializacion', function () { 
return view('comercializacion'); 
});

Route::get('/carrito', function () { 
    return view('construccion'); 
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
Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('catalogo');

// Registro de Usuarios
Route::get('/register', [AutenticacionController::class, 'formularioRegistro'])->name('register');
Route::post('/register', [AutenticacionController::class, 'registrar'])->name('register.store');

// Inicio de Sesión
Route::get('/login', [AutenticacionController::class, 'formularioLogin'])->name('login');
Route::post('/login', [AutenticacionController::class, 'login'])->name('login.store');

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

