<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_alumno');
            $table->string('apellido_alumno');
            $table->string('dni',15);
            $table->string('fecha_nacimiento');
            $table->enum('genero',[1,2]);  //1 femenino - 2 masculino
            $table->string('direccion');
            $table->enum('estado',[1,0])->default(1);  //1 activo - 0 inactivo    
            $table->enum('asistencia',[1,0])->default(0);  //1 en clase - 0 afuera del establecimiento    
            $table->string('comentario')->nullable();         
            $table->text('foto')->nullable();
            $table->string('fecha_ingreso');

            $table->unsignedBigInteger('sala_id');
            $table->foreign('sala_id')->references('id')->on('salas');  
            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('planes');

            $table->string('nombre_mama')->nullable();
            $table->string('apellido_mama')->nullable();
            $table->string('tel_mama',15)->nullable();
            $table->string('nombre_papa')->nullable();
            $table->string('apellido_papa')->nullable();
            $table->string('tel_papa',15)->nullable();
            $table->string('nombre_tutor');
            $table->string('apellido_tutor');
            $table->string('tel_tutor',15);
            $table->string('email_tutor');

            $table->softDeletes();
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
        Schema::dropIfExists('alumnos');
    }
}
