<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Alumno;
use App\Models\Docente;

class AdminController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::count();
        $docentes = Docente::count();
        return view('index', [
            'alumnos'  => $alumnos,
            'docentes' => $docentes
        ]);
    }
}
