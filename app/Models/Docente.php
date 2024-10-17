<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'direccion',
        'telefono',
        'fecha_nacimiento',
        'genero',                            
        'email',
        'estado',
        'foto',
        'fecha_ingreso'
    ];

    public function getFotografiaUrlAttribute(): string
    {
        return Storage::disk('images')->url($this->fotografia);
    }
}
