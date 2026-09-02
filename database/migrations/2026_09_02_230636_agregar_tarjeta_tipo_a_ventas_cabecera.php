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
        Schema::table('ventas_cabecera', function (Blueprint $table) {
            $table->string('tarjeta_tipo', 10)->nullable()->after('metodo_pago');
        });
    }

    public function down(): void
    {
        Schema::table('ventas_cabecera', function (Blueprint $table) {
            $table->dropColumn('tarjeta_tipo');
        });
    }
};
