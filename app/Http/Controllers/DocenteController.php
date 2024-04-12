<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Docente;
use Carbon\Carbon;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes = Docente::all()->sortByDesc('id'); 
        return view('docentes.index', ['docentes' => $docentes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('docentes.create');
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

        $docente = new Docente();

        $docente->nombre_apellido  = ucwords($request->nombre_apellido);
        $docente->direccion        = ucwords($request->direccion);
        $docente->telefono         = $request->telefono;
        $docente->fecha_nacimiento = $request->fecha_nacimiento;
        $docente->genero           = $request->genero;
        $docente->estado           = '1';
        $docente->institucion      = $request->institucion;
        $docente->email            = strtolower($request->email);
        if ($request->hasFile('fotografia')) {
            $docente->fotografia = $request->file('fotografia')->store('fotos_alumnos','public');
        }
        $docente->fecha_ingreso = Carbon::now();

        $docente->save();
        return redirect()->route('docentes.index')->with('mensaje', 'El Docente se grabó exitosamente!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        $docente = Docente::findOrFail($docente->id);
        return view('docentes.show', ['docente' => $docente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente $docente)
    {
        $docente = Docente::findOrFail($docente->id);
        return view('docentes.edit', ['docente' => $docente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'nombre_apellido'  => 'required',
            'direccion'        => 'required',
            'telefono'         => 'required',
            'fecha_nacimiento' => 'required',
            'email'            => ['required','email',Rule::unique('docentes')->ignore($docente->id),],
            'institucion'      => 'required'
        ]);

        $docente = Docente::find($docente->id);

        $docente->nombre_apellido  = ucwords($request->nombre_apellido);
        $docente->direccion        = ucwords($request->direccion);
        $docente->telefono         = $request->telefono;
        $docente->fecha_nacimiento = $request->fecha_nacimiento;
        $docente->genero           = $request->genero;
        $docente->institucion      = $request->institucion;
        $docente->email            = strtolower($request->email);
        if ($request->hasFile('fotografia')) {
            Storage::delete('public/'.$docente->fotografia);
            $docente->fotografia = $request->file('fotografia')->store('fotos_alumnos','public');
        }
        $docente->fecha_ingreso = Carbon::now();

        $docente->save();
        return redirect()->route('docentes.index')->with('mensaje', 'El Docente se modificó exitosamente!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {
        Docente::destroy($docente->id);
        return redirect()->route('docentes.index')->with('mensaje', 'El Docente se eliminó exitosamente!!');
    }
}
