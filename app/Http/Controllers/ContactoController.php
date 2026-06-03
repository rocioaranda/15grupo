<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Procesa el formulario de contacto y muestra la pantalla de éxito.
     */
    public function enviar(Request $request)
    {
        // 1. Validamos los datos entrantes del formulario
        $request->validate([
            'nombre'  => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'mensaje' => 'required|string|min:10',
        ]);

        // 2. Insertamos la consulta en la base de datos
        Consulta::create([
            'nombre'  => $request->nombre,
            'email'   => $request->email,
            'mensaje' => $request->mensaje,
        ]);

        // 3. Capturamos los datos para mandarlos a  vista exito.blade.php
        $nombre = $request->nombre;
        $email = $request->email;

        // Redirigimos vista de éxito con sus datos reales
        return view('exito', compact('nombre', 'email'));
    }
}