<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Aula;

class AulaController extends Controller
{
    public function index()
    {
        $aulas = Aula::all()->sortBy('descripcion'); 
        return view('aulas.index', ['aulas' => $aulas]);
    }

    public function create()
    {
        return view('aulas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion'  => 'required'
        ]);

        $capacidad = null;
        if ($request->capacidad != null) $capacidad = $request->capacidad;

        $aula = new Aula();

        $aula->descripcion = ucwords($request->descripcion);
        $aula->capacidad   = $capacidad;

        $aula->save();
        return redirect()->route('aulas.index')->with('mensaje', 'El Aula se grabó exitosamente!!');
    }

    public function show(Aula $aula)
    {
        $aula = Aula::findOrFail($aula->id);
        return view('aulas.show', ['aula' => $aula]);
    }

    public function edit(Aula $aula)
    {
        $aula = Aula::findOrFail($aula->id);
        return view('aulas.edit', ['aula' => $aula]);
    }

    public function update(Request $request, Aula $aula)
    {
        $request->validate([
            'descripcion'  => 'required'
        ]);

        $capacidad = null;
        if ($request->capacidad != null) $capacidad = $request->capacidad;

        $aula = Aula::find($aula->id);

        $aula->descripcion = ucwords($request->descripcion);
        $aula->capacidad   = $capacidad;

        $aula->save();
        return redirect()->route('aulas.index')->with('mensaje', 'El Aula se modificó exitosamente!!');
    }

    public function destroy(Aula $aula)
    {
        Aula::destroy($aula->id);
        return redirect()->route('aulas.index')->with('mensaje', 'El Aula se eliminó exitosamente!!');
    }
}
