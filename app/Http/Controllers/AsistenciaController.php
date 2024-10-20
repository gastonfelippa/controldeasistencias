<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sala;
use App\Models\Alumno;

use App\Models\Asistencia;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public $ingreso = 1;

    public function index(Request $request)
    {
        return view('asistencias.index');           
    }

    public function ingreso(Request $request)
    {
        if ($request->hasAny('search')) {
            $texto = trim($request->get('search'));
            $fotos = Alumno::where('nombre_alumno','LIKE', '%'.$texto.'%')
                    ->where('asistencia', '0')->get();
            if ($fotos->count() == 0) $fotos = Alumno::where('asistencia', '0')->get();
        } else $fotos = Alumno::where('asistencia', '0')->get();
              
        return view('asistencias.ingresos', ['fotos' => $fotos]);
    }

    public function egreso(Request $request)
    {
        if ($request->hasAny('search')) {
            $texto = trim($request->get('search'));
            $fotos = Alumno::where('nombre_alumno','LIKE', '%'.$texto.'%')
                        ->where('asistencia', '1')->get();
            if ($fotos->count() == 0) $fotos = Alumno::where('asistencia', '1')->get();
        } else $fotos = Alumno::where('asistencia', '1')->get();
        return view('asistencias.egresos', ['fotos' => $fotos]);       
    }  

    public function store(Request $request)
    {
        $accion = $request->asistencia;   // '1' ingreso - '0' egreso
   
        $hora_ingreso = null;
        $hora_egreso = null;
        if ($accion == '1') $hora_ingreso = Carbon::now();
        else $hora_egreso = Carbon::now();

        if ($accion == '1') {
            $valida = Alumno::find($request->alumnoId);
            if ($valida->asistencia == '0') {
                $asistencia = Asistencia::create([
                    'alumno_id'    => $request->alumnoId,
                    'hora_ingreso' => $hora_ingreso,
                    'ingreso_user_id' => Auth()->user()->id
                ]);
            } else return redirect()->back()->with('mensaje_error', 'El ingreso del Alumno ya se ha realizado.');
            
        } else {
            $valida = Alumno::find($request->alumnoId);
            if ($valida->asistencia == '1') {
                $asistencia = Asistencia::where('alumno_id', $request->alumnoId)
                    ->where('hora_egreso', null)->first();
                $asistencia->update([ 
                    'hora_egreso' => $hora_egreso,
                    'egreso_user_id' => Auth()->user()->id
                ]);
            } else return redirect()->back()->with('mensaje_error', 'La salida del Alumno no se registró.');

        }

        $alumno = Alumno::find($request->alumnoId);
        $alumno->asistencia = $accion;
        $alumno->save();

        $nombreCompleto = $alumno->nombre_alumno . ' ' . $alumno->apellido_alumno;

        $sala = Sala::find($alumno->sala_id);
        $sala = $sala->descripcion;

        if ($accion == '1') {  
            $this->ingreso = 1;      
            if ($alumno->genero == '1') {
                $data = array('Ingreso registrado!','La alumna ',$nombreCompleto,' deberá ser acompañada a la ', $sala);
            } else {
                $data = array('Ingreso registrado!','El alumno ',$nombreCompleto,' deberá ser acompañado a la ', $sala);
            }
        } else {
            $this->ingreso = 0;    
            if ($alumno->genero == '1') {
                $data = array('Salida registrada!','La alumna ',$nombreCompleto,' se retira del establecimiento!','');
            } else {
                $data = array('Salida registrada!','El alumno ',$nombreCompleto,' se retira del establecimiento!','');
            }
        }

        return redirect()->back()->with('mensaje', $data);
    }

    public function storeQr($alumno_id)
    {
        $accion = session('accion');

        $hora_ingreso = null;
        $hora_egreso = null;
       
        if ($accion == '1') $hora_ingreso = Carbon::now();
        else $hora_egreso = Carbon::now();

        if ($accion == '1') {
            $valida = Alumno::find($alumno_id);
            if ($valida->asistencia == '0') {
                $asist = Asistencia::create([
                    'alumno_id'    => $alumno_id,
                    'hora_ingreso' => $hora_ingreso,
                    'ingreso_user_id' => Auth()->user()->id
                ]);
            } else return redirect()->back()->with('mensaje_error', 'El ingreso del Alumno ya se encuentra registrado anteriormente.');
                
        } else {
            $valida = Alumno::find($alumno_id);
            if ($valida->asistencia == '1') {
                $asist = Asistencia::where('alumno_id', $alumno_id)
                    ->where('hora_egreso', null)->first();
                $asist->update([ 
                    'hora_egreso' => $hora_egreso,
                    'egreso_user_id' => Auth()->user()->id
                ]);
            } else return redirect()->back()->with('mensaje_error', 'La salida del Alumno no se registró.');
        }

        $alumno = Alumno::find($alumno_id);
        $alumno->asistencia = $accion;
        $alumno->save();

        $nombreCompleto = $alumno->nombre_alumno . ' ' . $alumno->apellido_alumno;

        $sala = Sala::find($alumno->sala_id);
        $sala = $sala->descripcion;

        if ($accion == '1') { 
            $this->ingreso = 1;        
            if ($alumno->genero == '1') {
                $data = array('Ingreso Qr registrado!','La alumna ',$nombreCompleto,' deberá ser acompañada a la ', $sala);
            } else {
                $data = array('Ingreso Qr registrado!','El alumno ',$nombreCompleto,' deberá ser acompañado a la ', $sala);
            }
        } else {
            $this->ingreso = 0; 
            if ($alumno->genero == '1') {
                $data = array('Salida Qr registrada!','La alumna ',$nombreCompleto,' se retira del establecimiento!','');
            } else {
                $data = array('Salida Qr registrada!','El alumno ',$nombreCompleto,' se retira del establecimiento!','');
            }
        }

        return redirect()->back()->with('mensaje', $data);
    }
    
    public function accion(Request $request)
    {
        // Guardamos el valor en la sesión
        session(['accion' => $request->input('newValue')]);
    }

    public function create()
    {
        //
    }

    public function show(Asistencia $asistencia)
    {
        //
    }

    public function edit(Asistencia $asistencia)
    {
        //
    }

    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    public function destroy(Asistencia $asistencia)
    {
        //
    }
}
