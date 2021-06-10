<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('titulo');
            $table->string('numeroEdicion');
            $table->string('imagen');
            $table->string('archivo')->nullable();
            $table->string('lugarEdicion')->nullable();
            $table->string('anioEdicion')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('autor_id')->unsigned();
            $table->foreign('autor_id')->references('id')->on('autors');
            $table->integer('coleccion_id')->unsigned()->nullable();
            $table->foreign('coleccion_id')->references('id')->on('coleccions');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->string('enabled');
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
        Schema::dropIfExists('libros');
    }
}
