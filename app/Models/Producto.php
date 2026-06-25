<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

<<<<<<< HEAD
class Producto extends Model 
{ 
    use Filterable;
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
=======
class Producto extends Model
{
    use HasFactory;
    

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

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
>>>>>>> 388e03986d270ae24cf143af413a6cd124379f2b
