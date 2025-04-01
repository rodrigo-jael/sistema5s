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
        Schema::table('consumo_energia', function (Blueprint $table) {
            //
            $table->string('pdf_recibo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consumo_energia', function (Blueprint $table) {
            //
            $table->dropColumn('pdf_recibo');
        });
    }
};
