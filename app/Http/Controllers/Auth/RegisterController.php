<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\ModelHasRole;

use App\Models\Admin\Cliente;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Spatie\Permission\Models\Permission;
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
            'nombre_institucion' => ['required','unique:users'],
            'genero' => ['not_in:0'],
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
        DB::beginTransaction();
        DB::connection('admin')->beginTransaction();
        try{
            Role::create(['name' => 'admin', 'alias' => 'Administrador']);        
            Role::create(['name' => 'secretaria', 'alias' => 'Secretario/a']);
            Role::create(['name' => 'docente', 'alias' => 'Docente']);
            
            //lista de permisos        
            Permission::create(['name' => 'Auditorias_index', 'alias' => 'Ver Auditorías']);
            Permission::create(['name' => 'Empresa_index', 'alias' => 'Ver Empresa']);
            Permission::create(['name' => 'Permisos_index', 'alias' => 'Ver Permisos']);
       
            Permission::create(['name' => 'Salas_index', 'alias' => 'Ver']);
            Permission::create(['name' => 'Salas_create', 'alias' => 'Agregar']);
            Permission::create(['name' => 'Salas_edit', 'alias' => 'Modificar']);
            Permission::create(['name' => 'Salas_destroy', 'alias' => 'Eliminar']);

            Permission::create(['name' => 'Planes_index', 'alias' => 'Ver']);
            Permission::create(['name' => 'Planes_create', 'alias' => 'Agregar']);
            Permission::create(['name' => 'Planes_edit', 'alias' => 'Modificar']);
            Permission::create(['name' => 'Planes_destroy', 'alias' => 'Eliminar']);

            Permission::create(['name' => 'Alumnos_index', 'alias' => 'Ver']);
            Permission::create(['name' => 'Alumnos_create', 'alias' => 'Agregar']);
            Permission::create(['name' => 'Alumnos_edit', 'alias' => 'Modificar']);
            Permission::create(['name' => 'Alumnos_destroy', 'alias' => 'Eliminar']);

            Permission::create(['name' => 'Docentes_index', 'alias' => 'Ver']);
            Permission::create(['name' => 'Docentes_create', 'alias' => 'Agregar']);
            Permission::create(['name' => 'Docentes_edit', 'alias' => 'Modificar']);
            Permission::create(['name' => 'Docentes_destroy', 'alias' => 'Eliminar']);

            Permission::create(['name' => 'Usuarios_index', 'alias' => 'Ver']);
            Permission::create(['name' => 'Usuarios_create', 'alias' => 'Agregar']);
            Permission::create(['name' => 'Usuarios_edit', 'alias' => 'Modificar']);
            Permission::create(['name' => 'Usuarios_destroy', 'alias' => 'Eliminar']);

            Permission::create(['name' => 'Asistencias_ingreso', 'alias' => 'Ingresos']);
            Permission::create(['name' => 'Asistencias_egreso', 'alias' => 'Egresos']);
            Permission::create(['name' => 'Reportes_asistencias', 'alias' => 'Ver']);

            $cadena = strtolower($data['nombre_institucion']);
            $cadena = utf8_decode($cadena);
            $cadena = strtr($cadena, utf8_decode('áéíóúÁÉÍÓÚñÑ'), 'aeiouAEIOUnN');
            $cadena = utf8_encode($cadena);
            $username = str_replace(' ', '',Str::finish('admin@', $cadena));

            //$password = Hash::make($data['password']);
            $password = Hash::make('12345678');
            //$password = '12345678';
 
            //creo al usuario registrado y le asigno el rol Admin
            $user = User::create([
                'name' => ucwords($data['name']),
                'apellido' => ucwords($data['apellido']),
                'email' => strtolower($data['email']),
                'password' => $password,
                'username' => $username,
                'nombre_institucion' => $data['nombre_institucion'],
                'fecha_ingreso' => Carbon::now(),
                'estado' => '1'
            ])->assignRole('admin');
        
            $rolAdmin = Role::where('name', 'admin')->first();
            $rolSecretaria = Role::where('name', 'secretaria')->first();
            $rolDocente = Role::where('name', 'docente')->first();
              
            //asigno permisos al rol Admin
            $rolAdmin->givePermissionTo([
                'Permisos_index',
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
         
            //CREO AL CLIENTE EN BD FLOKI_ADMIN
            $cliente = Cliente::create([
                'user_id'  => $user->id,
                'nombre'   => ucwords($data['name']) . ' ' . ucwords($data['apellido']),
                'email'    => strtolower($data['email']),
                'comercio' => $data['nombre_institucion'],
                'genero'   => $data['genero'],
            ]);
           
            DB::commit();
            DB::connection('admin')->commit(); 
                          
        }catch (\Exception $e){
            DB::rollback();
            DB::connection('admin')->rollback();
            return 'no se grabó';
        } 
        return $user;
    }
}
