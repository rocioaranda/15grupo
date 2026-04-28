<?php
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

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

Route::post('/contacto', [ContactoController::class, 'procesar']);

Route::get('/comercializacion', function () { 
return view('comercializacion'); 
});

Route::get('/carrito', function () { 
    return view('construccion'); 
});

Route::get('/catalogo', [ProductoController::class, 'catalogo']);

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

// Ruta para Iniciar Sesión
Route::get('/login', function () {
    return view('construccion');
});

// Ruta para Registro
Route::get('/register', function () {
    return view('construccion');
});
