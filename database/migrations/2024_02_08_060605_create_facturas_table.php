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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->string('factura_numero');
            $table->date('factura_fecha');
            $table->decimal('factura_subtotal', 12, 2)->nullable();
            $table->decimal('factura_iva', 12, 2)->nullable();
            $table->decimal('factura_total', 12, 2)->nullable();
            $table->string('servicios_codigo');
            $table->string('organizacion_nombre');
            $table->string('organizacion_email');
            $table->string('organizacion_telefono');
            $table->string('organizacion_web');
            $table->string('organizacion_moneda');
            $table->string('cliente_cedula', '12');
            $table->string('cliente_nombre');
            $table->string('cliente_apellido');
            $table->string('cliente_email');
            $table->string('cliente_telefono');
            $table->string('cliente_latitud');
            $table->string('cliente_longitud');
            $table->string('cliente_gps');
            $table->date('cliente_fecha_instalacion');
            $table->date('cliente_fecha_pago');
            $table->text('cliente_direccion');
            $table->string('plan_nombre');
            $table->string('plan_etiqueta');
            $table->integer('plan_bajada');
            $table->integer('plan_subida');
            $table->decimal('plan_precio', 12, 2);
            $table->bigInteger('servicios_id')->unsigned();
            $table->bigInteger('clientes_id')->unsigned();
            $table->bigInteger('organizaciones_id')->unsigned();
            $table->bigInteger('planes_id')->unsigned()->nullable();
            $table->boolean('send')->default(false);
            $table->foreign('servicios_id')->references('id')->on('servicios')->cascadeOnDelete();
            $table->foreign('clientes_id')->references('id')->on('clientes')->cascadeOnDelete();
            $table->foreign('organizaciones_id')->references('id')->on('organizaciones')->cascadeOnDelete();
            $table->foreign('planes_id')->references('id')->on('planes')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
