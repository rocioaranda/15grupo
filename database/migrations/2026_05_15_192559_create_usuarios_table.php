<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            
            // Datos del usuario (Campos principales)
            $table->string('nombre_apellido', 100);
            $table->string('email')->unique();
            $table->string('telefono', 20)->nullable(); // Agregado por si querés guardar el teléfono que pusiste en el controlador
            $table->string('password'); // Siempre hasheada desde el controlador
            
            // Relación con roles (Ubicada correctamente abajo de los datos estándar)
            $table->foreignId('rol_id')
                  ->constrained('roles') 
                  ->onDelete('restrict'); // Impide borrar un rol si tiene usuarios asignados

            $table->rememberToken(); // Token para la sesión persistente ('remember_token')
            $table->timestamps();    // Crea 'created_at' y 'updated_at' (Única declaración)
            $table->softDeletes();   // Habilita el borrado lógico ('deleted_at')
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};