<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Alumno;
use App\Models\Aula;
use App\Models\Nivel;


class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aula::create([ 
            'descripcion' => 'Aula N° 1',
            'capacidad'   => 10 
        ]);
        Nivel::create([ 
            'descripcion' => 'Sala De Bebés',
            'comentario' => 'De 3 a 6 meses',
            'aula_id' => 1
        ]);
        Alumno::factory()->count(30)->create();
    }

}
