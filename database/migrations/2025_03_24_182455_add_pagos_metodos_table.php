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
        Schema::table('pagos_metodos', function (Blueprint $table) {
            $table->boolean('is_efectivo')->default(false)->nullable()->after('bancos_id');
        });

        DB::table("pagos_metodos")
            ->insert([
                "metodo" => "efectivo",
                "is_efectivo" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagos_metodos', function (Blueprint $table) {
            //
        });
    }
};
