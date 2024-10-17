<?php

namespace App\Http\Controllers;

use App\Models\Docente;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class DocenteController extends Controller
{
    public $genero;

    public function __construct()
    {
        $this->middleware('can:Docentes_index')->only('index');
        $this->middleware('can:Docentes_create')->only('create', 'store');
        $this->middleware('can:Docentes_edit')->only('edit', 'update');
        $this->middleware('can:Docentes_destroy')->only('destroy');
    }

    public function index()
    {
        $docentes = Docente::all()->sortByDesc('id'); 
        return view('docentes.index', ['docentes' => $docentes]);
    }

    public function create()
    {
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'           => 'required',
            'apellido'         => 'required',
            'direccion'        => 'required',
            'telefono'         => 'required',
            'fecha_nacimiento' => 'required',
            'email'            => 'required'
        ]);

        $docente = new Docente();

        $docente->nombre           = ucwords($request->nombre);
        $docente->apellido         = ucwords($request->apellido);
        $docente->direccion        = ucwords($request->direccion);
        $docente->telefono         = $request->telefono;
        $docente->fecha_nacimiento = $request->fecha_nacimiento;
        $docente->genero           = $request->genero;
        $docente->estado           = 1;
        $docente->email            = strtolower($request->email);
        $docente->fecha_ingreso    = Carbon::now()->format('Y-m-d');

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
            // Guardar la imagen en la carpeta privada (storage/app/private/docentes)
            if($resizedImage){
                $moved = Storage::disk('local')->put('private/docentes/' . $nombreImagen, $resizedImage);
                if ($moved) $docente->foto = $nombreImagen;
            }
        }        

        $docente->save();
        return redirect()->route('docentes.index')->with('mensaje_ok', 'El Docente se grabó exitosamente!!');
    }

    public function show(Docente $docente)
    {
        $docente = Docente::findOrFail($docente->id);
        $this->genero = $docente->genero;

        return view('docentes.show', compact('docente'));
    }

    public function mostrarImagen($filename)
    {
        $path = storage_path('app/private/docentes/' . $filename);

        if (!\File::exists($path)) abort(404); // Si no existe, retorna un error 404
                
        return response()->file($path); // Devuelve el archivo como respuesta      
    }

    public function edit(Docente $docente)
    {
        $docente = Docente::findOrFail($docente->id);
        return view('docentes.edit', ['docente' => $docente]);
    }

    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'nombre'           => 'required',
            'apellido'         => 'required',
            'direccion'        => 'required',
            'telefono'         => 'required',
            'fecha_nacimiento' => 'required',
            'fecha_ingreso'    => 'required',
            'email'            => ['required','email',Rule::unique('docentes')->ignore($docente->id),]
        ]);

        $docente = Docente::find($docente->id);

        $docente->nombre           = ucwords($request->nombre);
        $docente->apellido         = ucwords($request->apellido);
        $docente->direccion        = ucwords($request->direccion);
        $docente->telefono         = $request->telefono;
        $docente->fecha_nacimiento = $request->fecha_nacimiento;
        $docente->genero           = $request->genero;
        $docente->estado           = $request->estado;
        $docente->email            = strtolower($request->email);
        $docente->fecha_ingreso    = $request->fecha_ingreso;

        if ($request->file('foto')) {
            if (Storage::disk('local')->exists('private/docentes/' . $docente->foto)) {
                // Eliminar la imagen anterior
                Storage::disk('local')->delete('private/docentes/' . $docente->foto);
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
                $moved = Storage::disk('local')->put('private/docentes/' . $nombreImagen, $resizedImage);
                if ($moved) $docente->foto = $nombreImagen;
            }
        }

        $docente->save();
        return redirect()->route('docentes.index')->with('mensaje_ok', 'El Docente se modificó exitosamente!!');
    }

    public function destroy(Docente $docente)
    {
        Docente::destroy($docente->id);
        return redirect()->route('docentes.index')->with('mensaje_ok', 'El Docente se eliminó exitosamente!!');
    }
}
