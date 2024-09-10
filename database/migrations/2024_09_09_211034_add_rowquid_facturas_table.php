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
        Schema::table('facturas', function (Blueprint $table) {
            $table->text('rowquid')->nullable()->after('send');
        });

        $facturas = \App\Models\Factura::all();
        foreach ($facturas as $factura){
            $row = \App\Models\Factura::find($factura->id);
            $row->rowquid = generarStringAleatorio(16);
            $row->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facturas', function (Blueprint $table) {
            //
        });
    }
};
