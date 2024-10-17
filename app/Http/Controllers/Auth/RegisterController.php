<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ModelHasRole;
use Spatie\Permission\Models\Role;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nombre_institucion' => ['required','unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    
    protected function create(array $data)
    {
        $cadena = strtolower($data['nombre_institucion']);
        $username = str_replace(' ', '',Str::finish('admin@', $cadena));

        //creo al usuario registrado y le asigno el rol Admin
        $user = User::create([
            'name' => ucwords($data['name']),
            'email' => strtolower($data['email']),
            'password' => Hash::make($data['password']),
            'username' => $username,
            'nombre_institucion' => $data['nombre_institucion'],
            'fecha_ingreso' => Carbon::now(),
            'estado' => '1'
        ])->assignRole('admin');

        $rolAdmin = Role::find(1);
        $rolSecretaria = Role::find(2);
        $rolDocente = Role::find(3);
        
        //asigno permisos al rol Admin
        $rolAdmin->givePermissionTo([
            'Salas_index','Salas_create','Salas_edit','Salas_destroy',
            'Planes_index','Planes_create','Planes_edit','Planes_destroy',
            'Alumnos_index','Alumnos_create','Alumnos_edit','Alumnos_destroy', 
            'Docentes_index','Docentes_create','Docentes_edit','Docentes_destroy',
            'Usuarios_index','Usuarios_create','Usuarios_edit','Usuarios_destroy',
            'Asistencias_ingreso','Asistencias_egreso',
            'Reportes_asistencias',
        ]);  
        //asigno permisos al rol Secretario
        $rolSecretaria->givePermissionTo([
            'Salas_index','Salas_create','Salas_edit',
            'Planes_index','Planes_create','Planes_edit',
            'Alumnos_index','Alumnos_create','Alumnos_edit', 
            'Docentes_index','Docentes_create','Docentes_edit',
            'Reportes_asistencias',
        ]);  
        //asigno permisos al rol Docente
        $rolDocente->givePermissionTo([
            'Asistencias_ingreso','Asistencias_egreso',
        ]);  


        return $user;
    }
}
