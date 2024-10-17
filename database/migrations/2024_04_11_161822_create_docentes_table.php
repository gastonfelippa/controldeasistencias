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

            $table->string('nombre');
            $table->string('apellido');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('fecha_nacimiento');
            $table->enum('genero',[1,2]);  //1 femenino - 2 masculino
            $table->string('email')->unique();
            $table->enum('estado',[1,0])->default(1);  //1 activo - 0 inactivo   
            $table->text('foto')->nullable();
            $table->string('fecha_ingreso');
            
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
