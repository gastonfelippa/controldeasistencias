<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $connection = 'admin';

    protected $fillable = [
        'user_id',
        'nombre',
        'email', 
        'comercio',
        'genero'
    ];
}
