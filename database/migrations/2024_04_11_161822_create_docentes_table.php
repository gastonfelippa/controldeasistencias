<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_apellido');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('fecha_nacimiento');
            $table->string('genero');
            $table->string('email')->unique();
            $table->string('estado');
            $table->string('institucion');
            $table->text('fotografia')->nullable();
            $table->string('fecha_ingreso');
            // $table->unsignedBigInteger('institucion_id');
            // $table->foreign('institucion_id')->references('id')->on('institucion');
            
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
        Schema::dropIfExists('docentes');
    }
}
