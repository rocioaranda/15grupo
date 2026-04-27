<?php
use App\Http\Controllers\ContactoController;
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

