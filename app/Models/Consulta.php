<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    // Le decimos a Laravel a qué tabla representa este modelo
    protected $table = 'consultas';

    // Definimos qué campos se pueden llenar desde el formulario de contacto
    protected $fillable = [
        'nombre',
        'email',
        'mensaje',
        'respondido'
    ];
}