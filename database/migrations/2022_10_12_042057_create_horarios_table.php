<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->time('hora_ini_traslado')->nullable();
            $table->time('hora_fin_traslado')->nullable();
            $table->time('hora_ini_trabajo')->nullable();
            $table->time('hora_fin_trabajo')->nullable();
            $table->time('hora_ini_salida')->nullable();
            $table->time('hora_fin_salida')->nullable();
            $table->time('tiempoTraslado')->nullable();
            $table->time('tiempoTrabajo')->nullable();
            $table->time('tiempoSalida')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios');
    }
};
