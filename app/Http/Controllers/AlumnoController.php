<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Alumno;
use Carbon\Carbon;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumno::all()->sortByDesc('id'); 
        return view('alumnos.index', ['alumnos' => $alumnos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_apellido'  => 'required',
            'direccion'        => 'required',
            'telefono'         => 'required',
            'fecha_nacimiento' => 'required',
            'email'            => 'required',
            'institucion'      => 'required'
        ]);

        $alumno = new Alumno();

        $alumno->nombre_apellido  = ucwords($request->nombre_apellido);
        $alumno->direccion        = ucwords($request->direccion);
        $alumno->telefono         = $request->telefono;
        $alumno->fecha_nacimiento = $request->fecha_nacimiento;
        $alumno->genero           = $request->genero;
        $alumno->estado           = '1';
        $alumno->institucion      = $request->institucion;
        $alumno->email            = strtolower($request->email);
        if ($request->hasFile('fotografia')) {
            $alumno->fotografia = $request->file('fotografia')->store('fotos_alumnos','public');
        }
        $alumno->fecha_ingreso = Carbon::now();

        $alumno->save();
        return redirect()->route('alumnos.index')->with('mensaje', 'El Alumno se grabó exitosamente!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        $alumno = Alumno::findOrFail($alumno->id);
        return view('alumnos.show', ['alumno' => $alumno]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        $alumno = Alumno::findOrFail($alumno->id);
        return view('alumnos.edit', ['alumno' => $alumno]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'nombre_apellido'  => 'required',
            'direccion'        => 'required',
            'telefono'         => 'required',
            'fecha_nacimiento' => 'required',
            'email'            => ['required','email',Rule::unique('alumnos')->ignore($alumno->id),],
            'institucion'      => 'required'
        ]);

        $alumno = Alumno::find($alumno->id);

        $alumno->nombre_apellido  = ucwords($request->nombre_apellido);
        $alumno->direccion        = ucwords($request->direccion);
        $alumno->telefono         = $request->telefono;
        $alumno->fecha_nacimiento = $request->fecha_nacimiento;
        $alumno->genero           = $request->genero;
        $alumno->institucion      = $request->institucion;
        $alumno->email            = strtolower($request->email);
        if ($request->hasFile('fotografia')) {
            Storage::delete('public/'.$alumno->fotografia);
            $alumno->fotografia = $request->file('fotografia')->store('fotos_alumnos','public');
        }
        $alumno->fecha_ingreso = Carbon::now();

        $alumno->save();
        return redirect()->route('alumnos.index')->with('mensaje', 'El Alumno se modificó exitosamente!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        Alumno::destroy($alumno->id);
        return redirect()->route('alumnos.index')->with('mensaje', 'El Alumno se eliminó exitosamente!!');
    }
}
