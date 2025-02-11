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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('referencia');
            $table->date('fecha');
            $table->decimal('monto', 12, 2);
            $table->string('moneda');
            $table->string('metodo');
            $table->string('titular')->nullable();
            $table->string('cuenta')->nullable();
            $table->string('tipo')->nullable();
            $table->string('cedula')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('nombre')->nullable();
            $table->string('codigo')->nullable();
            $table->bigInteger('clientes_id')->unsigned();
            $table->bigInteger('facturas_id')->unsigned()->nullable();
            $table->integer('estatus')->default(0);
            $table->foreign('clientes_id')->references('id')->on('clientes')->cascadeOnDelete();
            $table->foreign('facturas_id')->references('id')->on('facturas')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
