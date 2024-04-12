<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_apellido','direccion','telefono','fecha_nacimiento','genero',
                            'email','estado','institucion'];
}
