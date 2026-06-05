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