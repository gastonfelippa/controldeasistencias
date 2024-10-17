<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Alumno;
use App\Models\Asistencia;

use Carbon\Carbon;
use DB;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Reportes_asistencias')->only('index', 'reporte_por_fechas');
    }

    public function index()
    {
        $alumnos = Asistencia::join('alumnos as a', 'a.id', 'asistencias.alumno_id')
            ->select('asistencias.*', 'a.nombre_alumno', 'a.apellido_alumno')->get();
        
        return view('reportes.asistencias', ['alumnos' => $alumnos]);
    }

    public function reporte_por_fechas(Request $request)
    {
        $fecha_hora_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d') . ' 00:00:00';
        $fecha_hora_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d') . ' 23:59:59';
        //dd($fecha_hora_inicio,$fecha_hora_fin);

        // ->whereBetween('asistencias.hora_ingreso', [$request->fecha_inicio, $request->fecha_fin])
        $alumno = Alumno::where('id', $request->alumno)->select('id', 'nombre_alumno', 'apellido_alumno')->first();
        $total_minutos = 0;
        $reporte = Asistencia::join('alumnos as a', 'a.id', 'asistencias.alumno_id')
            ->join('planes as p', 'p.id', 'a.plan_id')
            ->where('asistencias.alumno_id', $request->alumno)
            ->where('asistencias.estado', '0')
            ->where('asistencias.hora_ingreso', '>=', $fecha_hora_inicio)
            ->where('asistencias.hora_ingreso', '<=', $fecha_hora_fin)
            ->select('asistencias.*', 'a.nombre_alumno', 'a.apellido_alumno', 'p.horas_limite', 
            DB::RAW("'0' as hora_entrada"), DB::RAW("'0' as hora_salida"), DB::RAW("'' as limite_superado"), 
            DB::RAW("'0' as fecha"), DB::RAW("'0' as permanencia"))->get(); 
        foreach ($reporte as $i) {
            $date = Carbon::parse($i->hora_ingreso, 'UTC')->locale('es');
            $dia = $date->isoFormat('dddd');
            $fecha = Carbon::parse($i->hora_ingreso)->format('d-m-Y');
            $i->fecha = $dia . '  ' . $fecha;

            $i->hora_entrada = Carbon::parse($i->hora_ingreso)->format('H:i:s');
            if($i->hora_egreso) $i->hora_salida = Carbon::parse($i->hora_egreso)->format('H:i:s');
            else $i->hora_salida = 'Sin datos...';
        
            $diferencia_en_minutos = Carbon::parse($i->hora_egreso)->diffInMinutes(Carbon::parse($i->hora_ingreso), true);
            $diferencia_en_horas = Carbon::parse($i->hora_egreso)->diffInHours(Carbon::parse($i->hora_ingreso), true);
         
            $dif_hora_minuto = $diferencia_en_minutos - ($diferencia_en_horas * 60);

            if ($i->hora_egreso) {
                if ($dif_hora_minuto < 10) $dif_hora_minuto = '0' . $dif_hora_minuto;
                if ($dif_hora_minuto > 0) $i->permanencia = $diferencia_en_horas . ':' . $dif_hora_minuto . ' h';
                else $i->permanencia = $diferencia_en_horas . ' h';
            } else $i->permanencia = '0:00 h';

            //calculo los minutos que contiene la hora_limite
            $horas = Carbon::parse($i->horas_limite)->format('H');
            $minutos = Carbon::parse($i->horas_limite)->format('i');
            $minutos_hora_limite = ($horas * 60) + $minutos;
            
            if ($diferencia_en_minutos > $minutos_hora_limite) $i->limite_superado = true;
            else $i->limite_superado = false;

            if ($i->hora_egreso) $total_minutos += $diferencia_en_minutos;  
            else $total_minutos += 0;       
        }

        $horas = floor($total_minutos / 60);
        $minutos = $total_minutos % 60;
        $total = $horas . ':' . $minutos . ' h';
            
        return view('reportes.asistencias_por_fechas', [
                        'alumno'       => $alumno, 
                        'reporte'      => $reporte,
                        'fecha_inicio' => $request->fecha_inicio, 
                        'fecha_fin'    => $request->fecha_fin,
                        'total'        => $total
                    ]); 
    }
}
