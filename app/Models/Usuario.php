<?php

namespace App\Models;
use App\Models\VentaCabecera;
use Illuminate\Foundation\Auth\User as Authenticatable; // OBLIGATORIO PARA LOGINS
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable 
{
    use Notifiable;

    protected $table = 'usuarios'; //  tabla en MariaDB

    protected $fillable = [
        'nombre_apellido',
        'email',
        'telefono',
        'password',
        'rol_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    // cast para evitar problema de comparacion estricta, convierte el string 1 a entero 1
    protected $casts = [
    'rol_id' => 'integer',
    ];

    //  PARA QUE NO SE ENCRIPTE DOS VECES:
    /*
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    */
    public function ventas()
{
    return $this->hasMany(VentaCabecera::class);
}
}
