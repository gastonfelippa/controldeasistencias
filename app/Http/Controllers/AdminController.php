<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Alumno;
use App\Models\Docente;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::count();
        $docentes = Docente::count();
        $usuarios = User::count();
        
        return view('index', [
            'alumnos'  => $alumnos,
            'docentes' => $docentes,
            'usuarios' => $usuarios
        ]);
    }
}
