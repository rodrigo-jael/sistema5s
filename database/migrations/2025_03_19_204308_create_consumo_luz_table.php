<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumoLuzTable extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumo_luz', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('mes');
            $table->decimal('kwh_consumidos', 8, 2);
            $table->decimal('kwh_presupuestado', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Deshacer las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumo_luz');
    }
}
