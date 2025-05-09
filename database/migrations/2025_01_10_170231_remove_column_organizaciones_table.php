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
            $table->string('web')->nullable()->change();
            $table->dropColumn(['imagen', 'mini']);
        });
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
