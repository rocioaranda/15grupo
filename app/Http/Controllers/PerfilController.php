<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    // Muestra el panel "Mi Perfil" del cliente
    public function index()
    {
        $usuario = Auth::user();
        return view('backend.usuarios.cliente', compact('usuario'));
    }

    // Procesa y valida la actualización de los datos del cliente
    public function actualizar(Request $request)
    {
        $usuario = Auth::user();

        // Validación estricta de los campos
        $request->validate([
            'nombre_apellido' => 'required|string|max:255',
            'telefono'        => 'required|string|max:20',
            'email'           => 'required|email|unique:usuarios,email,' . $usuario->id,
            'password'        => 'nullable|min:8|confirmed', // Contraseña opcional
        ]);

        $usuario->nombre_apellido = $request->nombre_apellido;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;

        // Si el usuario ingresó una nueva contraseña, la encriptamos
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return back()->with('exito', '¡Tus datos de perfil se actualizaron con éxito!');
    }
}
