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
        Schema::table('planes', function (Blueprint $table) {
            $table->text('rowquid')->nullable()->after('organizaciones_id');
        });

        $planes = \App\Models\Plan::all();
        foreach ($planes as $plan) {
            $row = \App\Models\Plan::find($plan->id);
            $row->rowquid = generarStringAleatorio(16);
            $row->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('planes', function (Blueprint $table) {
            //
        });
    }
};
