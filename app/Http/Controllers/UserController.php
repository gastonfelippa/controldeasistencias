<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Usuarios_index')->only('index');
        $this->middleware('can:Usuarios_create')->only('create');
        $this->middleware('can:Usuarios_edit')->only('edit', 'update');
        $this->middleware('can:Usuarios_destroy')->only('destroy');
    }

    public function index()
    {
        $usuarios = User::all()->sortBy('name'); 
        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $nombre = strtolower($request->name);
        $cadena = User::select('nombre_institucion')->first();
        $cadena = strtolower($cadena->nombre_institucion);
        $username = str_replace(' ', '',Str::finish($nombre,'@'. $cadena));




        $request->validate([
            'name'  => 'required',
            'email'  => ['required', 'email', 'max:255','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = User::create([
            'name' => ucwords($request->name),
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'username' => $username,
            'fecha_ingreso' => Carbon::now(),
            'estado' => '1'
        ])->assignRole('docente');

        // $usuario = new User();
        // $usuario->name = ucwords($request->name);
        // $usuario->email = strtolower($request->email);
        // $usuario->password = Hash::make($request->password);
        // $usuario->username = $username;
        // $usuario->fecha_ingreso = Carbon::now();
        // $usuario->estado = '1';
        // $usuario->save()->assignRole('docente');

        return redirect()->route('usuarios.index')->with('mensaje_ok', 'El Usuario se grabó exitosamente!!');
    }

    public function show(User $usuario)
    {
        $usuario = User::findOrFail($usuario->id);
        return view('usuarios.show', ['usuario' => $usuario]);
    }

    public function edit(User $usuario)
    {
        $usuario = User::findOrFail($usuario->id);
        return view('usuarios.edit', ['usuario' => $usuario]);
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name'  => 'required',
            'email'  => 'required', 'email', 'max:255'
        ]);

        $usuario = User::find($usuario->id);
        $usuario->name = ucwords($request->name);
        $usuario->email = $request->email;
        $usuario->estado = '1';
        $usuario->save();

        return redirect()->route('usuarios.index')->with('mensaje_ok', 'El Usuario se modificó exitosamente!!');
    }

    public function destroy(User $usuario)
    {
        dd($usuario->id);
        User::destroy($usuario->id);
        return redirect()->route('usuarios.index')->with('mensaje_ok', 'El Usuario se eliminó exitosamente!!');
    }
}
