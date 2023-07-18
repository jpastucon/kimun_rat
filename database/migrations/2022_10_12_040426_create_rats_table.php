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
        Schema::create('rats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contacto_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('name')->nullable();
            $table->enum('tipo_rat', ['Correctivo', 'Preventivo', 'Instalación', 'Capacitación', 'Cotizado', 'Inspección'])->nullable();
            $table->string('sintoma')->nullable();
            $table->string('desarrollo')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('pendientes')->nullable();
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
        Schema::dropIfExists('rats');
    }
};
