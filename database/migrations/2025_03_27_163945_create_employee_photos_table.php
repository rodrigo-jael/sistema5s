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
        Schema::create('employee_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // ID del empleado
            $table->string('photo_path'); // Ruta de la foto
            $table->timestamps();

            // Definir la clave foránea y la relación con la tabla employees
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_photos');
    }
};
