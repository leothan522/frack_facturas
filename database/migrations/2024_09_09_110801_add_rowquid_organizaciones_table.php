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
        Schema::table('organizaciones', function (Blueprint $table) {
            $table->text('rowquid')->nullable()->after('direccion');
        });

        $organizaciones = \App\Models\Organizacion::all();
        foreach ($organizaciones as $organizacion) {
            $row = \App\Models\Organizacion::find($organizacion->id);
            $row->rowquid = generarStringAleatorio(16);
            $row->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organizaciones', function (Blueprint $table) {
            //
        });
    }
};
