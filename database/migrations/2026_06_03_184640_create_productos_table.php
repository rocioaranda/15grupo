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
        Schema::create('productos', function (Blueprint $table) { 
            $table->id(); 
            $table->string('nombre', 150); 
            $table->text('descripcion')->nullable(); 
            $table->decimal('precio', 10, 2); 
            $table->integer('stock')->default(0); 
            $table->string('url_imagen')->nullable(); 
            $table->boolean('activo')->default(true); 

            // Relación con categorías (Se borra en cascada si se elimina la categoría padre)
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
        
            $table->timestamps();

            // 1. IMPORTANTE: Agregamos la columna física deleted_at para habilitar el SoftDeletes nativo
            $table->softDeletes(); 
        }); 
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
