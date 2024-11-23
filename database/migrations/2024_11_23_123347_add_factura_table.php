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
            $table->text('organizacion_direccion')->nullable()->after('organizacion_moneda');
            $table->string('organizacion_representante')->nullable()->after('organizacion_direccion');
            $table->string('organizacion_rif')->nullable()->after('organizacion_representante');
            $table->text('organizacion_imagen')->nullable()->after('organizacion_rif');
            $table->text('organizacion_mini')->nullable()->after('organizacion_imagen');
            $table->string('cliente_latitud')->nullable()->change();
            $table->string('cliente_longitud')->nullable()->change();
            $table->string('cliente_gps')->nullable()->change();
        });
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
