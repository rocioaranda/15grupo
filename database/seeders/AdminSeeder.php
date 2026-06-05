<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{

    public function run(): void
{
    DB::table('usuarios')->insert([
        'nombre_apellido' => 'solangeBeni',
        'email'          => 'beniwen0@gmail.com',
        'telefono'       => '37945586',
        'password'       => bcrypt('admin123'),
        'rol_id'         => 1,
        'created_at'     => now(),
        'updated_at'     => now(),
    ]);
}
}
