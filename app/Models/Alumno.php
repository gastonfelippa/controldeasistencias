<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumno extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'alumnos';
    protected $fillable = [
        'nombre_alumno',
        'apellido_alumno',
        'dni',
        'fecha_nacimiento',
        'genero',
        'direccion',
        'sala_id',
        'plan_id',        
        'foto',
        'nombre_mama',
        'apellido_mama',
        'tel_mama',
        'nombre_papa',
        'apellido_papa',
        'tel_papa',
        'nombre_tutor',
        'apellido_tutor',
        'tel_tutor',
        'email_tutor',
        'fecha_ingreso',
        'estado',
        'comentario',
        'asistencia'
    ];
}
