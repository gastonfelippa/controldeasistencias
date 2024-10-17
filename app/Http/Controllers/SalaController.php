<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Salas_index')->only('index');
        $this->middleware('can:Salas_create')->only('create', 'store');
        $this->middleware('can:Salas_edit')->only('edit', 'update');
        $this->middleware('can:Salas_destroy')->only('destroy');
    }

    public function index()
    {
        $salas = Sala::all();
        return view('salas.index', ['salas' => $salas]);
    }

    public function create()
    {
        return view('salas.create');
    }

    public function store(Request $request)
    {
        $is_exists = $this->is_exists($request->descripcion,null);

        if($is_exists == 1 || $is_exists == 3) return redirect()->back()->withInput()->with('mensaje_error', 'La Sala fué eliminada anteriormente.');
        elseif($is_exists == 2 || $is_exists == 4) return redirect()->back()->withInput()->with('mensaje_error', 'La Sala ya existe en la BD.');
        else{ 
            $request->validate([
                'descripcion' => 'required'
            ]);

            $comentario = null;
            if ($request->comentario != null) $comentario = ucfirst($request->comentario);

            $sala = Sala::create([
                'descripcion' => ucwords($request->descripcion),
                'comentario'  => $comentario,
                'estado'      => 1
            ]);

            return redirect()->route('salas.index')->with('mensaje_ok', 'La Sala se grabó exitosamente!!');
        }
    }

    public function show($id)
    {
        $sala = Sala::findOrFail($id);
        return view('salas.show', ['sala' => $sala]);
    }

    public function edit($id)
    {
        $sala = Sala::findOrFail($id);
        return view('salas.edit', ['sala' => $sala]);
    }

    public function update(Request $request, $id)
    {      
        $is_exists = $this->is_exists($request->descripcion,$id);

        if($is_exists == 1 || $is_exists == 3) return redirect()->back()->withInput()->with('mensaje_error', 'La Sala fué eliminada anteriormente.');
        elseif($is_exists == 2 || $is_exists == 4) return redirect()->back()->withInput()->with('mensaje_error', 'La Sala ya existe en la BD.');
        else{
            $request->validate([ 'descripcion' => 'required' ]);

            $comentario = null;
            if ($request->comentario != null) $comentario = ucfirst($request->comentario);

            $sala = Sala::find($id);
            $sala->update([
                'descripcion' => ucwords($request->descripcion),
                'comentario'  => $comentario,
                'estado'      => $request->estado
            ]);

            return redirect()->route('salas.index')->with('mensaje_ok', 'La Sala se modificó exitosamente!!');
        }
    }

    public function destroy(Sala $sala)
    {
        $is_assigned = $this->is_assigned($sala_id);
        if (!$is_assigned) {
            Sala::destroy($sala->id);
            return redirect()->route('salas.index')->with('mensaje_ok', 'La Sala se eliminó exitosamente!!');
        } else return redirect()->back()->with('mensaje_error', 'La Sala está asignada a uno o varios alumnos.');
    }

    public function is_exists($descripcion, $id)
    {
        if($id) {
            $existe = Sala::where('descripcion', $descripcion)
                ->where('id', '<>', $id)
                ->withTrashed()->get();
            if($existe->count() && $existe[0]->deleted_at != null) return 1;
            elseif($existe->count()) return 2;
        }else {
            $existe = Sala::where('descripcion', $descripcion)->withTrashed()->get();

            if($existe->count() && $existe[0]->deleted_at != null) return 3;
            elseif($existe->count()) return 4;
        }
        return false;
    }

    public function is_assigned($id)
    {
        $alumno_sala = Alumno::where('sala_id', $id)->get();
        if($existe->count()) return true;
        return false;
    }
}
