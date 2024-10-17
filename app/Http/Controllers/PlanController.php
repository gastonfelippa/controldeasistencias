<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Planes_index')->only('index');
        $this->middleware('can:Planes_create')->only('create', 'store');
        $this->middleware('can:Planes_edit')->only('edit', 'update');
        $this->middleware('can:Planes_destroy')->only('destroy');
    }
    public function index()
    {
        $planes = Plan::all();
        return view('planes.index', ['planes' => $planes]);
    }

    public function create()
    {
        return view('planes.create');
    }

    public function store(Request $request)
    {
        $is_exists = $this->is_exists($request->descripcion,null);

        if($is_exists == 1 || $is_exists == 3) return redirect()->back()->withInput()->with('mensaje_error', 'El Plan fué eliminado anteriormente.');
        elseif($is_exists == 2 || $is_exists == 4) return redirect()->back()->withInput()->with('mensaje_error', 'El Plan ya existe en la BD.');
        else{
            $request->validate([
                'descripcion'  => 'required',
                'importe'      => 'required',
                'horas_plan'   => 'required',
                'horas_limite' => 'required'
            ]);

            $comentario = null;
            if ($request->comentario != null) $comentario = ucfirst($request->comentario);

            $plan = Plan::create([
                'descripcion'  => ucwords($request->descripcion),
                'importe'      => $request->importe,
                'comentario'   => $comentario,
                'horas_plan'   => $request->horas_plan,
                'horas_limite' => $request->horas_limite,
                'estado'       => 1
            ]);

            return redirect()->route('planes.index')->with('mensaje_ok', 'El Plan se grabó exitosamente!!');
        }
    }

    public function show($id)
    {
        $plan = Plan::findOrFail($id);
        return view('planes.show', ['plan' => $plan]);
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('planes.edit', ['plan' => $plan]);
    }

    public function update(Request $request, $id)
    {        
        $is_exists = $this->is_exists($request->descripcion,$id);

        if($is_exists == 1 || $is_exists == 3) return redirect()->back()->withInput()->with('mensaje_error', 'El Plan fué eliminado anteriormente.');
        elseif($is_exists == 2 || $is_exists == 4) return redirect()->back()->withInput()->with('mensaje_error', 'El Plan ya existe en la BD.');
        else{
            $request->validate([
                'descripcion'  => 'required',
                'importe'      => 'required',
                'horas_plan'   => 'required',
                'horas_limite' => 'required'
            ]);

            $comentario = null;
            if ($request->comentario != null) $comentario = ucfirst($request->comentario);

            $plan = Plan::find($id);
            $plan->update([
                'descripcion'  => ucwords($request->descripcion),
                'importe'      => $request->importe,
                'comentario'   => $comentario,
                'horas_plan'   => $request->horas_plan,
                'horas_limite' => $request->horas_limite,
                'estado'       => $request->estado
            ]);

            return redirect()->route('planes.index')->with('mensaje_ok', 'El Plan se modificó exitosamente!!');         //
        }
    }

    public function destroy(Plan $plan)
    {
        $is_assigned = $this->is_assigned($sala_id);
        if (!$is_assigned) {
            Plan::destroy($plan->id);
            return redirect()->route('planes.index')->with('mensaje_ok', 'El Plan se eliminó exitosamente!!');
        } else return redirect()->back()->with('mensaje_error', 'El Plan está asignado a uno o varios alumnos.');
    }

    public function is_exists($descripcion, $id)
    {
        if($id) {
            $existe = Plan::where('descripcion', $descripcion)
                ->where('id', '<>', $id)
                ->withTrashed()->get();
            if($existe->count() && $existe[0]->deleted_at != null) return 1;
            elseif($existe->count()) return 2;
        }else {
            $existe = Plan::where('descripcion', $descripcion)->withTrashed()->get();

            if($existe->count() && $existe[0]->deleted_at != null) return 3;
            elseif($existe->count()) return 4;
        }
        return false;
    }

    public function is_assigned($id)
    {
        $alumno_sala = Alumno::where('plan_id', $id)->get();
        if($existe->count()) return true;
        return false;
    }
}
