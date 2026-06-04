<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consultas';

    protected $fillable = [
        'nombre',
        'email',
        'asunto',
        'mensaje',
        'estado'
    ];

    // 🔹 Estados posibles
    const ESTADO_PENDIENTE = 'pendiente';
    const ESTADO_VISTA = 'vista';
    const ESTADO_RESPONDIDA = 'respondida';
}