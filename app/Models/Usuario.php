<?php

namespace App\Models;
use App\Models\VentaCabecera;
use Illuminate\Foundation\Auth\User as Authenticatable; // OBLIGATORIO PARA LOGINS
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable // Debe extender de Authenticatable, NO de Model
{
    use Notifiable;

    protected $table = 'usuarios'; // Tu tabla personalizada en MariaDB

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
