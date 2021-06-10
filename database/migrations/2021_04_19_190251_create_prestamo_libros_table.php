<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamoLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamo_libros', function (Blueprint $table) {
            $table->increments();
            $table->integer('libros_id')->unsigned();
            $table->foreign('libros_id')->references('id')->on('libros');
            $table->integer('prestamos_id')->unsigned();
            $table->foreign('prestamos_id')->references('id')->on('prestamos');
            $table->string('estado');
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
        Schema::dropIfExists('prestamo_libros');
    }
}
