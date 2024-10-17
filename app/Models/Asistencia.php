<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';
    protected $fillable = ['alumno_id','hora_ingreso','hora_egreso','estado','comentario',
            'ingreso_user_id','egreso_user_id'];
}
