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
        Schema::create('pagos_metodos', function (Blueprint $table) {
            $table->id();
            $table->string('metodo');
            $table->string('titular')->nullable();
            $table->string('cuenta')->nullable();
            $table->string('tipo')->nullable();
            $table->string('cedula')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('bancos_id')->unsigned()->nullable();
            $table->foreign('bancos_id')->references('id')->on('bancos')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_metodos');
    }
};
