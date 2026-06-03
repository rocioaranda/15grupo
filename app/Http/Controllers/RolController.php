<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Rol::all(); // SoftDelete filtra deleted_at automáticamente
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Te devuelve la vista con el formulario para crear un rol
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:50|unique:roles,nombre',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Rol::create($request->only(['nombre', 'descripcion'])); // usa el $fillable del Model
        
        return redirect()->route('roles.index')->with('exito', 'Rol creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        return view('roles.show', compact('rol'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rol $rol)
    {
        // Te lleva a la vista de edición pasándole el rol que elegiste
        return view('roles.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            // unique:roles,nombre,'.$rol->id le dice a Laravel que ignore este rol actual para que no rebote al guardar
            'nombre'      => 'required|string|max:50|unique:roles,nombre,' . $rol->id,
            'descripcion' => 'nullable|string|max:255',
        ]);

        $rol->update($request->only(['nombre', 'descripcion']));

        return redirect()->route('roles.index')->with('exito', 'Rol actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rol $rol)
    {
        $rol->delete(); // SoftDelete: setea deleted_at, no borra la fila físicamente
        
        return redirect()->route('roles.index')->with('exito', 'Rol eliminado con éxito.');
    }
}
