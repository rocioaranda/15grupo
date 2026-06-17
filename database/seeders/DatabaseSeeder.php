<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Insertamos primero los Roles obligatorios (Evita el error de la captura c1d329)
        DB::table('roles')->insert([
            ['id' => 1, 'nombre' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nombre' => 'Cliente', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 2. Insertamos las 4 Categorías reales que me pediste para tu tienda
        DB::table('categorias')->insert([
            ['id' => 1, 'nombre' => 'Aumento de masa muscular', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nombre' => 'Definición / Quemar grasa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nombre' => 'Salud y vitalidad', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nombre' => 'Accesorios', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 3. Ahora que existen los roles y categorías, ejecutamos el Seeder del Admin
        $this->call([
            AdminSeeder::class,
        ]);
    }
}

