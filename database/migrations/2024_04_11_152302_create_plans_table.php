<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->id();

            $table->string('descripcion');
            $table->string('comentario')->nullable();
            $table->decimal('importe',10,2);
            $table->time('horas_plan');
            $table->time('horas_limite');
            $table->enum('estado',[1,0])->default(1);  //1 activo - 0 inactivo            

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
        Schema::dropIfExists('planes');
    }
}
