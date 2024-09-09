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
        Schema::table('clientes', function (Blueprint $table) {
            $table->text('rowquid')->nullable()->after('direccion');
        });

        $clientes = \App\Models\Cliente::all();
        foreach ($clientes as $cliente) {
            $row = \App\Models\Cliente::find($cliente->id);
            $row->rowquid = generarStringAleatorio(16);
            $row->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            //
        });
    }
};
