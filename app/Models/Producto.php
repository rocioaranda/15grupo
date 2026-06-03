<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Producto extends Model 
{ 
protected $fillable = [ 
'nombre', 
'descripcion', 
'precio', 
'stock', 
'url_imagen', 
'activo', 
'categoria_id'
]; 
 
protected $casts = [ 
'precio' => 'decimal:2', 
'stock' => 'integer', 
'activo' => 'boolean', 
]; 
// Un producto PERTENECE A una categoría
public function categoria() {
    return $this->belongsTo(Categoria::class, 'categoria_id');
}
} 
