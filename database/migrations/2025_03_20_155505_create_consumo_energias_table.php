<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('consumo_energia', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('mes');
            $table->decimal('kwh_consumidos', 8, 2);
            $table->decimal('kwh_presupuestado', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consumo_energia');
    }
};
