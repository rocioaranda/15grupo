<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Importante para el borrado lógico
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importante si usás Factories
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rol extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'roles'; // Sobreescribe la pluralización automática de Laravel

    protected $fillable = [
        'nombre', 
        'descripcion',
    ];

    // LA RELACIÓN DEBE IR ACÁ ADENTRO: un Rol tiene muchos Usuarios
    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'rol_id'); 
    }
} 
