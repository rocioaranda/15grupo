<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ventas_cabecera', function (Blueprint $table) {
            // Datos del cliente
            $table->string('checkout_nombre')->nullable();
            $table->string('checkout_dni', 20)->nullable();

            // Tipo de entrega
            $table->enum('tipo_entrega', ['retiro', 'envio'])->nullable();

            // Datos de domicilio (solo si es envío)
            $table->string('envio_calle')->nullable();
            $table->string('envio_numero', 20)->nullable();
            $table->string('envio_departamento')->nullable();
            $table->string('envio_codigo_postal', 20)->nullable();
            $table->string('envio_descripcion')->nullable();

            // Método de pago
            $table->enum('metodo_pago', ['mercadopago', 'tarjeta', 'efectivo'])->nullable();

            // Datos de tarjeta (solo si paga con tarjeta)
            $table->string('tarjeta_numero', 20)->nullable();
            $table->string('tarjeta_titular')->nullable();
            $table->string('tarjeta_vencimiento', 7)->nullable(); // MM/AA
            $table->string('tarjeta_cuotas')->nullable();
            // NUNCA guardar el CVV en la BD — es una práctica de seguridad obligatoria
        });
    }

    public function down(): void
    {
        Schema::table('ventas_cabecera', function (Blueprint $table) {
            $table->dropColumn([
                'checkout_nombre', 'checkout_dni',
                'tipo_entrega',
                'envio_calle', 'envio_numero', 'envio_departamento',
                'envio_codigo_postal', 'envio_descripcion',
                'metodo_pago',
                'tarjeta_numero', 'tarjeta_titular',
                'tarjeta_vencimiento', 'tarjeta_cuotas',
            ]);
        });
    }
};
