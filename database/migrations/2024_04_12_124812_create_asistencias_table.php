<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('alumno_id');
            $table->foreign('alumno_id')->references('id')->on('alumnos');

            $table->datetime('hora_ingreso')->nullable();
            $table->datetime('hora_egreso')->nullable();
            $table->enum('estado', ['0','1']);  //0=>afuera, 1=>adentro
            $table->string('comentario')->nullable();

            $table->unsignedBigInteger('ingreso_user_id')->nullable();
            $table->foreign('ingreso_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('egreso_user_id')->nullable();
            $table->foreign('egreso_user_id')->references('id')->on('users');

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
        Schema::dropIfExists('asistencias');
    }
}
