<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol; 
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::with('rol')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Rol::all(); // Necesario para el <select> del formulario
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_apellido' => 'required|string|max:100',
            'email'           => 'required|email|unique:usuarios,email',
            'telefono'        => 'required|string|max:20', 
            'password'        => 'required|min:8|confirmed',
            'rol_id'          => 'required|exists:roles,id',
        ]);

        
        Usuario::create($request->only(['nombre_apellido', 'email', 'telefono', 'password', 'rol_id']));

        return redirect()->route('usuarios.index')->with('exito', 'Usuario registrado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        $roles = Rol::all(); // Lo necesitamos para que el admin pueda cambiarle el rol en el formulario
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre_apellido' => 'required|string|max:100',
            // unique:usuarios,email,'.$usuario->id evita que rebote por usar su propio correo
            'email'           => 'required|email|unique:usuarios,email,' . $usuario->id,
            'telefono'        => 'required|string|max:20',
            'password'        => 'nullable|min:8|confirmed', // nullable por si el admin no quiere cambiar la contraseña actual
            'rol_id'          => 'required|exists:roles,id',
        ]);

        // Tomamos los datos excepto el password por si vino vacío
        $datos = $request->only(['nombre_apellido', 'email', 'telefono', 'rol_id']);
        
        if ($request->filled('password')) {
            $datos['password'] = $request->password; // El mutador 'casts' del modelo lo hasheará solo
        }

        $usuario->update($datos);

        return redirect()->route('usuarios.index')->with('exito', 'Usuario actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete(); // Borrado lógico (SoftDelete)
        return redirect()->route('usuarios.index')->with('exito', 'Usuario dado de baja.');
    }
}