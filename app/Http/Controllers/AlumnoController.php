<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Alumno;
use App\Models\Plan;
use App\Models\Sala;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Alumnos_index')->only('index');
        $this->middleware('can:Alumnos_create')->only('create', 'store');
        $this->middleware('can:Alumnos_edit')->only('edit', 'update');
        $this->middleware('can:Alumnos_destroy')->only('destroy');
    }

    public function index()
    {
        $alumnos = Alumno::join('salas as s', 's.id', 'alumnos.sala_id')
            ->join('planes as p', 'p.id', 'alumnos.plan_id')
            ->select('alumnos.*', 's.descripcion as sala', 'p.descripcion as plan')
            ->orderBy('alumnos.id', 'desc')->get();

        return view('alumnos.index', compact('alumnos'));
    }

    public function create()
    {
        $sala = Sala::count();
        $plan = Plan::count();

        if($sala == 0) {
            return redirect()->route('salas.create')->with('mensaje_info', 'Primero debes agregar alguna Sala a tus registros!!');
        } else $planes = Plan::all();

        if($plan == 0) {
            return redirect()->route('planes.create')->with('mensaje_info', 'Primero debes agregar algún Plan a tus registros!!');
        } else $salas = Sala::all(); 
        
        return view('alumnos.create', compact('planes', 'salas'));
    }

    public function store(Request $request)
    {
        $is_exists = $this->is_exists($request->dni,null);

        if($is_exists == 1 || $is_exists == 3) return redirect()->back()->withInput()->with('mensaje_error', 'La Sala fué eliminada anteriormente.');
        elseif($is_exists == 2 || $is_exists == 4) return redirect()->back()->withInput()->with('mensaje_error', 'La Sala ya existe en la BD.');
        else{
            $request->validate([
                'nombre_alumno'    => 'required',
                'apellido_alumno'  => 'required',
                'dni'              => 'required',
                'fecha_nacimiento' => 'required',
                'direccion'        => 'required',
                'salaId'           => 'not_in:Elegir',
                'planId'           => 'not_in:Elegir',
                'nombre_tutor'     => 'required',
                'apellido_tutor'   => 'required',
                'tel_tutor'        => 'required',
                'email_tutor'      => 'required|email|max:255',
                'fecha_ingreso'    => 'required'
            ]);

            $comentario = null;
            if ($request->comentario != null) $comentario = ucfirst($request->comentario);

            $alumno = new Alumno();

            $alumno->nombre_alumno    = ucwords($request->nombre_alumno);
            $alumno->apellido_alumno  = ucwords($request->apellido_alumno);
            $alumno->dni              = $request->dni;
            $alumno->fecha_nacimiento = $request->fecha_nacimiento;
            $alumno->genero           = $request->genero;
            $alumno->direccion        = ucwords($request->direccion);
            $alumno->sala_id          = $request->salaId;
            $alumno->plan_id          = $request->planId;
            $alumno->nombre_mama      = ucwords($request->nombre_mama);
            $alumno->apellido_mama    = ucwords($request->apellido_mama);
            $alumno->tel_mama         = $request->tel_mama;
            $alumno->nombre_papa      = ucwords($request->nombre_papa);
            $alumno->apellido_papa    = ucwords($request->apellido_papa);
            $alumno->tel_papa         = $request->tel_papa;
            $alumno->nombre_tutor     = ucwords($request->nombre_tutor);
            $alumno->apellido_tutor   = ucwords($request->apellido_tutor);
            $alumno->tel_tutor        = $request->tel_tutor;
            $alumno->email_tutor      = strtolower($request->email_tutor);
            $alumno->fecha_ingreso    = Carbon::now()->format('Y-m-d');
            $alumno->comentario       = $comentario;

            if ($request->file('foto')) {
                $image = $request->file('foto');
                $nombreImagen = time() . '_' . $request->file('foto')->getClientOriginalName();
                // Redimensionar la imagen
                $resizedImage = Image::make($image)->resize(400, 400, function ($constraint) {
                        $constraint->aspectRatio(); // Mantener la relación de aspecto
                    })->encode('jpg', 75); // Opcional: Cambiar a formato jpg y reducir calidad al 75%
                $request->validate([
                    'foto' => 'image|max:2048', // 2048 KB = 2 MB
                ]);
                // Guardar la imagen en la carpeta privada (storage/app/private/alumnos)
                if($resizedImage){
                    $moved = Storage::disk('local')->put('private/alumnos/' . $nombreImagen, $resizedImage);
                    if ($moved) $alumno->foto = $nombreImagen;
                }
            }

            $alumno->save();
            return redirect()->route('alumnos.index')->with('mensaje_ok', 'El Alumno se grabó exitosamente!!');
        }
    }

    public function show($id)
    {
        $alumno = Alumno::join('salas as s', 's.id', 'alumnos.sala_id')
            ->join('planes as p', 'p.id', 'alumnos.plan_id')
            ->where('alumnos.id', $id)
            ->select('alumnos.*', 's.descripcion as sala', 'p.descripcion as plan')
            ->orderBy('alumnos.id', 'desc')->first();
   
        $nacimiento = $alumno->fecha_nacimiento;
        $actual = Carbon::now();
        $meses = $actual->diffInMonths($nacimiento);
        $mes = '';
        if ($meses > 11) {
            $entero = floor($meses / 12);
            $modulo = $meses % 12;

            if ($entero == 1) $años = $entero . ' año ';
            else $años = $entero . ' años ';

            if ($modulo == 1) $mes = 'y ' . $modulo . ' mes';
            elseif ($modulo > 1) $mes = 'y ' . $modulo . ' meses';
            
            $edad = $años . $mes;
        } else $edad = $meses . ' meses'; 

        return view('alumnos.show', compact('alumno', 'edad'));
    }

    public function edit($id)
    {
        $salas = Sala::all();
        $planes = Plan::all();

        $alumno = Alumno::join('salas as s', 's.id', 'alumnos.sala_id')
                    ->join('planes as p', 'p.id', 'alumnos.plan_id')
                    ->where('alumnos.id', $id)
                    ->select('alumnos.*', 's.descripcion as sala', 'p.descripcion as plan')->first(); 

        return view('alumnos.edit', compact('alumno', 'salas', 'planes'));
    }

    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'nombre_alumno'    => 'required',
            'apellido_alumno'  => 'required',
            'dni'              => 'required',
            'fecha_nacimiento' => 'required',
            'direccion'        => 'required',
            'salaId'           => 'not_in:Elegir',
            'planId'           => 'not_in:Elegir',
            'nombre_tutor'     => 'required',
            'apellido_tutor'   => 'required',
            'tel_tutor'        => 'required',
            'email_tutor'      => ['required', 'email', 'max:255'],
            'fecha_ingreso'    => 'required'
        ]); //'email'            => ['required','email',Rule::unique('alumnos')->ignore($alumno->id),] 

        $alumno = Alumno::find($alumno->id);

        $alumno->nombre_alumno    = ucwords($request->nombre_alumno);
        $alumno->apellido_alumno  = ucwords($request->apellido_alumno);
        $alumno->dni              = $request->dni;
        $alumno->fecha_nacimiento = $request->fecha_nacimiento;
        $alumno->genero           = $request->genero;
        $alumno->direccion        = ucwords($request->direccion);
        $alumno->sala_id          = $request->salaId;
        $alumno->plan_id          = $request->planId;
        $alumno->nombre_mama      = ucwords($request->nombre_mama);
        $alumno->apellido_mama    = ucwords($request->apellido_mama);
        $alumno->tel_mama         = $request->tel_mama;
        $alumno->nombre_papa      = ucwords($request->nombre_papa);
        $alumno->apellido_papa    = ucwords($request->apellido_papa);
        $alumno->tel_papa         = $request->tel_papa;
        $alumno->nombre_tutor     = ucwords($request->nombre_tutor);
        $alumno->apellido_tutor   = ucwords($request->apellido_tutor);
        $alumno->tel_tutor        = $request->tel_tutor;
        $alumno->email_tutor      = strtolower($request->email_tutor);
        $alumno->fecha_ingreso    = Carbon::now()->format('Y-m-d');

        if ($request->file('foto')) {
            if (Storage::disk('local')->exists('private/alumnos/' . $alumno->foto)) {
                // Eliminar la imagen anterior
                Storage::disk('local')->delete('private/alumnos/' . $alumno->foto);
            }
            $image = $request->file('foto');
            $nombreImagen = time() . '_' . $request->file('foto')->getClientOriginalName();
            // Redimensionar la imagen
            $resizedImage = Image::make($image)->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio(); // Mantener la relación de aspecto
                })->encode('jpg', 75); // Opcional: Cambiar a formato jpg y reducir calidad al 75%
          
            $request->validate([
                'foto' => 'image|max:2048', // 2048 KB = 2 MB
            ]);
            // Guardar la imagen en la carpeta privada (storage/app/private)
            if($resizedImage){
                $moved = Storage::disk('local')->put('private/alumnos/' . $nombreImagen, $resizedImage);
                if ($moved) $alumno->foto = $nombreImagen;
            }
        }

        $alumno->save();
        return redirect()->route('alumnos.index')->with('mensaje_ok', 'El Alumno se modificó exitosamente!!');
    }

    public function destroy(Alumno $alumno)
    {
        Alumno::destroy($alumno->id);
        return redirect()->route('alumnos.index')->with('mensaje_ok', 'El Alumno se eliminó exitosamente!!');
    }

    public function mostrarImagen($filename)
    {
        $path = storage_path('app/private/alumnos/' . $filename);

        if (!\File::exists($path)) abort(404); // Si no existe, retorna un error 404
                
        return response()->file($path); // Devuelve el archivo como respuesta      
    }

    public function imprimirQr()
    {
        $alumnos = Alumno::all();
                
        return view('alumnos.qr', compact('alumnos') );
    }


    public function is_exists($dni, $id)
    {
        if($id) {
            $existe = Alumno::where('dni', $dni)
                ->where('id', '<>', $id)
                ->withTrashed()->get();
            if($existe->count() && $existe[0]->deleted_at != null) return 1;
            elseif($existe->count()) return 2;
        }else {
            $existe = Alumno::where('dni', $dni)->withTrashed()->get();

            if($existe->count() && $existe[0]->deleted_at != null) return 3;
            elseif($existe->count()) return 4;
        }
        return false;
    }
}

