<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('inspecciones', function (Blueprint $table) {
            $table->string('sede')->nullable();
            $table->string('chofer')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('nivel_gasolina')->nullable(); // puede ser texto tipo "Lleno", "1/2", etc.
        });
    }
    
    public function down()
    {
        Schema::table('inspecciones', function (Blueprint $table) {
            $table->dropColumn(['sede', 'chofer', 'supervisor', 'nivel_gasolina']);
        });
    }
    
};
