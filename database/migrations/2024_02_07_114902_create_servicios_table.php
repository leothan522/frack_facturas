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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->bigInteger('clientes_id')->unsigned();
            $table->bigInteger('organizaciones_id')->unsigned();
            $table->bigInteger('planes_id')->unsigned();
            $table->foreign('clientes_id')->references('id')->on('clientes')->cascadeOnDelete();
            $table->foreign('organizaciones_id')->references('id')->on('organizaciones')->cascadeOnDelete();
            $table->foreign('planes_id')->references('id')->on('planes')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
