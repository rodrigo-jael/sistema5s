<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('consumo_energia', function (Blueprint $table) {
            $table->dropColumn(['fecha', 'mes', 'kwh_presupuestado']);
        });
    }
    
    public function down()
    {
        Schema::table('consumo_energia', function (Blueprint $table) {
            $table->date('fecha')->nullable();
            $table->string('mes')->nullable();
            $table->decimal('kwh_presupuestado', 8, 2)->nullable();
        });
    }
    
};
