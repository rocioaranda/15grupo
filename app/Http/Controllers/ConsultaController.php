<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index(Request $request)
    {
        $consultas = Consulta::when($request->estado, function($query, $estado) {
                return $query->where('estado', $estado);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.admin.consultas', compact('consultas'));
    }

    public function enviar(Request $request)
    {
        $request->validate([
            'nombre'  => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'asunto'  => 'required|string|max:100',
            'mensaje' => 'required|string|min:10',
        ], [
            'nombre.required'  => 'campo obligatorio.',
            'nombre.string'    => 'El nombre debe ser un texto válido.',
            'nombre.max'       => 'El nombre no puede superar los 255 caracteres.',

            'email.required'   => 'El correo electrónico es obligatorio.',
            'email.email'      => 'Ingresá un correo electrónico válido.',
            'email.max'        => 'El correo no puede superar los 255 caracteres.',

            'asunto.required'  => 'Debes seleccionar un asunto.',
            'asunto.string'    => 'El asunto debe ser un texto válido.',
            'asunto.max'       => 'El asunto no puede superar los 100 caracteres.',

            'mensaje.required' => 'El mensaje es obligatorio.',
            'mensaje.string'   => 'El mensaje debe ser un texto válido.',
            'mensaje.min'      => 'El mensaje debe tener al menos 10 caracteres.',
        ]);

        Consulta::create([
            'nombre'  => $request->nombre,
            'email'   => $request->email,
            'asunto'  => $request->asunto,
            'mensaje' => $request->mensaje,
            'estado'  => Consulta::ESTADO_PENDIENTE
        ]);

        return redirect('/consulta')->with('success', 'Consulta enviada correctamente');
    }

    public function cambiarEstado(Consulta $consulta, Request $request)
    {
        $consulta->update(['estado' => $request->estado]);
        return back()->with('exito', 'Estado actualizado');
    }
}