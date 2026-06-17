<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- 1. IMPORTANTE: Agregar esta línea

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes; 

    // Tu configuración actual de la tabla y campos habilitados
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'url_imagen',
        'activo',
        'categoria_id'
    ];

    /**
     * Relación con el modelo Categoria
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}