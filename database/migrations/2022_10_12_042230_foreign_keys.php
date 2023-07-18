<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        /* CLAVES FORANEAS PARA users*/
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('rol_id')->references('id')->on('rols')->onDelete('cascade');
        });
        /* CLAVES FORANEAS PARA sessions*/
        Schema::table('sessions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        /* CLAVES FORANEAS PARA rols_permisos*/
        Schema::table('rols_permisos', function (Blueprint $table) {
            $table->foreign('rol_id')->references('id')->on('rols')->onDelete('cascade');
            $table->foreign('permiso_id')->references('id')->on('permisos')->onDelete('cascade');
        });

        /* CLAVES FORANEAS PARA contactos*/
        Schema::table('contactos', function (Blueprint $table) {
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });

        /* CLAVES FORANEAS PARA modelos*/
        Schema::table('modelos', function (Blueprint $table) {
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->foreign('tipo_maquina_id')->references('id')->on('tipo_maquinas')->onDelete('cascade');
        });

        /* CLAVES FORANEAS PARA maquinas*/
        Schema::table('maquinas', function (Blueprint $table) {
            $table->foreign('tipo_maquinas_id')->references('id')->on('tipo_maquinas')->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('cascade');
        });

        /* CLAVES FORANEAS PARA rats*/
        Schema::table('rats', function (Blueprint $table) {
            $table->foreign('contacto_id')->references('id')->on('contactos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        /* CLAVES FORANEAS PARA estados_rats*/
        Schema::table('estados_rats', function (Blueprint $table) {
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');
            $table->foreign('rat_id')->references('id')->on('rats')->onDelete('cascade');
        });

        /* CLAVES FORANEAS PARA maquinas_rats*/
        Schema::table('maquinas_rats', function (Blueprint $table) {
            $table->foreign('maquina_id')->references('id')->on('maquinas')->onDelete('cascade');
            $table->foreign('rat_id')->references('id')->on('rats')->onDelete('cascade');
        });
        /* CLAVES FORANEAS PARA modelos_marcas*/
        Schema::table('modelos_marcas', function (Blueprint $table) {
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
        });
        /* CLAVES FORANEAS PARA fechas_rats*/
        Schema::table('fechas_rats', function (Blueprint $table) {
            $table->foreign('fecha_id')->references('id')->on('fechas')->onDelete('cascade');
            $table->foreign('rat_id')->references('id')->on('rats')->onDelete('cascade');
        });
        /* CLAVES FORANEAS PARA horarios_rats*/
        Schema::table('horarios_rats', function (Blueprint $table) {
            $table->foreign('horario_id')->references('id')->on('horarios')->onDelete('cascade');
            $table->foreign('rat_id')->references('id')->on('rats')->onDelete('cascade');
        });
        /* CLAVES FORANEAS PARA users_rats*/
        Schema::table('users_rats', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rat_id')->references('id')->on('rats')->onDelete('cascade');
        });
        /* CLAVES FORANEAS PARA marcas_tipo_maquinas*/
        Schema::table('marcas_tipo_maquinas', function (Blueprint $table) {
            $table->foreign('tipo_maquina_id')->references('id')->on('tipo_maquinas')->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
        });

        /* CLAVES FORANEAS PARA modelos_tipo_maquinas*/
        Schema::table('modelos_tipo_maquinas', function (Blueprint $table) {
            $table->foreign('tipo_maquina_id')->references('id')->on('tipo_maquinas')->onDelete('cascade');
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('cascade');
        });
        
        /* CLAVES FORANEAS PARA fotos*/
        Schema::table('fotos', function (Blueprint $table) {
            $table->foreign('rat_id')->references('id')->on('rats')->onDelete('cascade');
        });
    }
    public function down()
    {
        
    }
};
