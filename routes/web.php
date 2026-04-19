<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('principal'); // Esto busca resources/views/principal.blade.php
});
Route::get('/quienes_somos', function () {
    return view('quienes_somos');
});