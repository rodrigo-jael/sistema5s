<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del equipo
            $table->string('imagen')->nullable(); // Imagen del equipo
            $table->string('ubicacion'); // Ubicación donde se encuentra
            $table->decimal('consumo_promedio', 8, 2); // Consumo en kWh
            $table->boolean('lunes')->default(false);
            $table->boolean('martes')->default(false);
            $table->boolean('miercoles')->default(false);
            $table->boolean('jueves')->default(false);
            $table->boolean('viernes')->default(false);
            $table->boolean('sabado')->default(false);
            $table->boolean('domingo')->default(false);
            $table->integer('dias_utilizados')->default(0); // Número de días usados
            $table->decimal('consumo_total', 8, 2)->default(0); // Consumo total
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipos');
    }
};

