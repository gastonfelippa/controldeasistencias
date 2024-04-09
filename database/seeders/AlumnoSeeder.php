<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Alumno;


class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Alumno::factory()->count(85)->create();
        // Alumno::create([
        //     'nombre_apellido' => 'Joaquín Pérez',
        //     'direccion' => 'Sarmiento 125',
        //     'fecha_nacimiento' => '2021-03-15',
        //     'estado' => '1',
        //     'genero' => 'masculino',
        //     'telefono' => '12554555',
        //     'email' => Str::random(10).'@gmail.com',
        //     'institucion' => 'Mi jardincito',
        //     'fecha_ingreso' => '2024-02-02' 
        // ]);
        // Alumno::create([
        //     'nombre_apellido' => 'Sabrina Galoppo',
        //     'direccion' => 'Mitre 2125',
        //     'fecha_nacimiento' => '2021-08-25',
        //     'estado' => '1',
        //     'genero' => 'femenino',
        //     'telefono' => '1578455',
        //     'email' => Str::random(10).'@gmail.com',
        //     'institucion' => 'Mi jardincito',
        //     'fecha_ingreso' => '2024-02-10' 
        // ]);
        // Alumno::create([
        //     'nombre_apellido' => 'Mateo Gonzales',
        //     'direccion' => 'Córdoba 1258',
        //     'fecha_nacimiento' => '2020-01-15',
        //     'estado' => '1',
        //     'genero' => 'masculino',
        //     'telefono' => '65878878',
        //     'email' => Str::random(10).'@gmail.com',
        //     'institucion' => 'Mi jardincito',
        //     'fecha_ingreso' => '2024-02-10' 
        // ]);
        // Alumno::create([
        //     'nombre_apellido' => 'Lucas Funes',
        //     'direccion' => 'Alvear 205',
        //     'fecha_nacimiento' => '2020-11-17',
        //     'estado' => '1',
        //     'genero' => 'masculino',
        //     'telefono' => '559999',
        //     'email' => Str::random(10).'@gmail.com',
        //     'institucion' => 'Mi casita',
        //     'fecha_ingreso' => '2024-02-10' 
        // ]);
        // Alumno::create([
        //     'nombre_apellido' => 'Julia Ríos',
        //     'direccion' => 'Avellaneda 15',
        //     'fecha_nacimiento' => '2020-12-13',
        //     'estado' => '1',
        //     'genero' => 'femenino',
        //     'telefono' => '87878545',
        //     'email' => Str::random(10).'@gmail.com',
        //     'institucion' => 'Mi casita',
        //     'fecha_ingreso' => '2024-02-15' 
        // ]);
    }
}
