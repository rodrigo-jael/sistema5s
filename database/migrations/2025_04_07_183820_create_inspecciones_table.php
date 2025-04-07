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
        Schema::create('inspecciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
        
            // Información general
            $table->date('fecha')->nullable();
            $table->string('placas')->nullable();
            $table->integer('kilometraje')->nullable();
        
            // Revisión de luces
            $table->boolean('luces_delanteras')->default(false);
            $table->boolean('luces_traseras')->default(false);
            $table->boolean('intermitentes')->default(false);
            $table->boolean('direccionales')->default(false);
        
            // Visión
            $table->boolean('espejos')->default(false);
            $table->boolean('limpia_parabrisas')->default(false);
        
            // Documentos
            $table->boolean('circulacion')->default(false);
            $table->boolean('licencia')->default(false);
            $table->boolean('seguro')->default(false);
        
            // Niveles
            $table->boolean('nivel_aceite')->default(false);
            $table->boolean('nivel_frenos')->default(false);
            $table->boolean('nivel_anticongelante')->default(false);
        
            // Estado general
            $table->boolean('llantas')->default(false);
            $table->boolean('rines')->default(false);
            $table->boolean('cables')->default(false);
            $table->boolean('fugas')->default(false);
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspecciones');
    }
};
