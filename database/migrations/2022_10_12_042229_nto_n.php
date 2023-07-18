<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rols_permisos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id');
            $table->foreignId('permiso_id');
            $table->timestamps();
        });
        Schema::create('estados_rats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_id')->nullable();
            $table->foreignId('rat_id')->nullable();
            $table->timestamps();
        });
        Schema::create('maquinas_rats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maquina_id')->nullable();
            $table->foreignId('rat_id')->nullable();
            $table->timestamps();
        });
        Schema::create('fechas_rats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fecha_id')->nullable();
            $table->foreignId('rat_id')->nullable();
            $table->timestamps();
        });
        Schema::create('horarios_rats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('horario_id')->nullable();
            $table->foreignId('rat_id')->nullable();
            $table->timestamps();
        });
        Schema::create('users_rats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('rat_id')->nullable();
            $table->timestamps();
        });
        Schema::create('modelos_marcas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modelo_id')->nullable();
            $table->foreignId('marca_id')->nullable();
            $table->timestamps();
        });
        Schema::create('marcas_tipo_maquinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_maquina_id')->nullable();
            $table->foreignId('marca_id')->nullable();
            $table->timestamps();
        });
        Schema::create('modelos_tipo_maquinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_maquina_id')->nullable();
            $table->foreignId('modelo_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rols_permisos');
        Schema::dropIfExists('estados_rats');
        Schema::dropIfExists('fechas_rats');
        Schema::dropIfExists('horarios_rats');
        Schema::dropIfExists('maquinas_rats');
    }
};
