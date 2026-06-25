<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'Aumento de masa muscular',
            'Definición / Quemar grasa',
            'Salud y vitalidad',
            'Accesorios',
        ];

        foreach ($categorias as $nombre) {
            DB::table('categorias')->insert([
                'nombre'     => $nombre,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}