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
        Schema::table('servicios', function (Blueprint $table) {
            $table->text('rowquid')->nullable()->after('planes_id');
        });

        $servicios = \App\Models\Servicio::all();
        foreach ($servicios as $servicio) {
            $row = \App\Models\Servicio::find($servicio->id);
            $row->rowquid = generarStringAleatorio(16);
            $row->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicios', function (Blueprint $table) {
            //
        });
    }
};
