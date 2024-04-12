<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Aula;
use App\Models\Nivel;

class NivelController extends Controller
{
    public function index()
    {
        //$niveles = Nivel::all()->sortBy('descripcion'); 
        $niveles = Nivel::join('aulas as a','a.id','niveles.aula_id')
            ->select('niveles.*', 'a.descripcion as aula')->orderBy('niveles.descripcion')->get(); 
        return view('niveles.index', ['niveles' => $niveles]);
    }

    public function create()
    {
        $aulas = Aula::all();
        return view('niveles.create', ['aulas' => $aulas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'aula'     => 'not_in:Elegir'
        ]);

        $comentario = null;
        if ($request->comentario != null) $comentario = ucfirst($request->comentario);

        $nivel = new Nivel();

        $nivel->descripcion = ucwords($request->descripcion);
        $nivel->comentario  = $comentario;
        $nivel->aula_id     = $request->aula;

        $nivel->save();
        return redirect()->route('niveles.index')->with('mensaje', 'El Nivel se grabó exitosamente!!');
    }

    public function show($id)
    {
        $nivel = Nivel::findOrFail($id);
        $aula = Aula::find($nivel->aula_id);
        $aulaDesc = $aula->descripcion;
        return view('niveles.show', ['nivel' => $nivel, 'aula' => $aulaDesc]);
    }

    public function edit($id)
    {
        $aulas = Aula::all();
        $nivel = Nivel::findOrFail($id);
        $aula = Aula::find($nivel->aula_id);
        $aulaDesc = $aula->descripcion;
        return view('niveles.edit', ['nivel' => $nivel,'aula' => $aulaDesc,'aulas' => $aulas]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required',
            'aula'     => 'not_in:Elegir'
        ]);

        $comentario = null;
        if ($request->comentario != null) $comentario = ucfirst($request->comentario);

        $nivel = Nivel::find($id);

        $nivel->descripcion = ucwords($request->descripcion);
        $nivel->comentario  = $comentario;
        $nivel->aula_id     = $request->aula;

        $nivel->save();
        return redirect()->route('niveles.index')->with('mensaje', 'El Nivel se modificó exitosamente!!');
    }

    public function destroy(Nivel $nivel)
    {
        Nivel::destroy($nivel->id);
        return redirect()->route('niveles.index')->with('mensaje', 'El Nivel se eliminó exitosamente!!');
    }
}
