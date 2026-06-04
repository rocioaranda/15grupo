<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function enviar(Request $request)
    {
        // 1. Validación
        $request->validate([
            'nombre'  => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'asunto'  => 'required|string|max:100', 
            'mensaje' => 'required|string|min:10',
        ]);

        // 2. Guardar en base de datos (con estado)
        Consulta::create([
            'nombre'  => $request->nombre,
            'email'   => $request->email,
            'asunto'  => $request->asunto,
            'mensaje' => $request->mensaje,
            'estado' => Consulta::ESTADO_PENDIENTE
        ]);

        // 3. Redirigir con mensaje 
        return redirect('/consulta')->with('success', 'Consulta enviada correctamente');
    }
}