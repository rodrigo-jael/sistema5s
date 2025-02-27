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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade'); // Relaciona con la tabla employees
            $table->string('evaluation_5s'); // Almacena la evaluación (cumplio/no_cumplio)
            $table->date('evaluation_date'); // Fecha específica de la evaluación
            $table->timestamps(); // Registra la fecha de creación y actualización
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
};

