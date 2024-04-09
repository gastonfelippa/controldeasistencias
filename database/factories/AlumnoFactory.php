<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Alumno;

class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_apellido' => $this->faker->name(),
            'direccion' => $this->faker->streetAddress(),
            'telefono' => $this->faker->phoneNumber(),
            'fecha_nacimiento' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'estado' => '1',
            'genero' => $this->faker->randomElement(['FEMENINO', 'MASCULINO']),
            'email' => $this->faker->unique()->safeEmail(),
            'institucion' => 'Mi jardincito',
            'fecha_ingreso' => $this->faker->date($format = 'Y-m-d') 
        ];
    }
}
