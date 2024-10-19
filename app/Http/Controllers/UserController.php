<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Mail\WelcomeUser;
use Illuminate\Support\Facades\Mail;

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
        $cadena = User::select('name', 'nombre_institucion')->first();
        $nombre_comercio = $cadena->nombre_institucion;
        $nombre_admin = $cadena->name;
        $password = $request->password;

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

        $this->sendEmail($user, $nombre_comercio, $nombre_admin, $password);

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

    public function sendEmail($user, $comercio, $admin, $password)
    {
        // $objDemo = new \stdClass();
        // $objDemo->demo_one = $user->username;
        // $objDemo->demo_two = $password;
        // $objDemo->sender = 'El equipo de FlokI';
        // $objDemo->receiver = $user->name;
 
        Mail::to($user->email)->send(new WelcomeUser($user, $comercio, $admin, $password));
    }
}
