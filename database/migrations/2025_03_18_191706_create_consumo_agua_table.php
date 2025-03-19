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
    Schema::create('consumo_agua', function (Blueprint $table) {
        $table->id();
        $table->date('fecha');
        $table->integer('semana');
        $table->decimal('litros_consumidos', 8, 2);
        $table->decimal('litros_maximos', 8, 2)->default(450);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('consumo_agua');
}

};
