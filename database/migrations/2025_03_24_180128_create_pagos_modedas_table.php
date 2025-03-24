<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagos_monedas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo');
            $table->timestamps();
        });

        DB::table("pagos_monedas")
            ->insert([
                "nombre" => "Bolivares",
                "codigo" => "Bs",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);

        DB::table("pagos_monedas")
            ->insert([
                "nombre" => "Dolares",
                "codigo" => "USD",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);

        DB::table("pagos_monedas")
            ->insert([
                "nombre" => "Pesos Colombianos",
                "codigo" => "COP",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_monedas');
    }
};
