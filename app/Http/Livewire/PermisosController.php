<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\ModelHasRole;
use App\Models\User;
use DB;

class PermisosController extends Component
{
    public $agregarRol, $userSelected = 'Seleccionar';
    public $tab = 'roles', $roleSelected = 'Seleccionar', $habilitar_roles, $habilitar_permisos;
    public $adminId, $noUsuarioId;

    public function render()
    { 
        
        $usuarios = User::all();

        $roles = Role::select('*', DB::RAW("0 as checked"))->get();

        $pSalas = Permission::where('name', 'Salas_index')
            ->orWhere('name', 'Salas_create')
            ->orWhere('name', 'Salas_edit')
            ->orWhere('name', 'Salas_destroy')
            ->select('*', DB::RAW("0 as checked"))->get();

        $pPlanes = Permission::where('name', 'Planes_index')
            ->orWhere('name', 'Planes_create')
            ->orWhere('name', 'Planes_edit')
            ->orWhere('name', 'Planes_destroy')
            ->select('*', DB::RAW("0 as checked"))->get();

        $pAlumnos = Permission::where('name', 'Alumnos_index')
            ->orWhere('name', 'Alumnos_create')
            ->orWhere('name', 'Alumnos_edit')
            ->orWhere('name', 'Alumnos_destroy')
            ->select('*', DB::RAW("0 as checked"))->get();

        $pDocentes = Permission::where('name', 'Docentes_index')
            ->orWhere('name', 'Docentes_create')
            ->orWhere('name', 'Docentes_edit')
            ->orWhere('name', 'Docentes_destroy')
            ->select('*', DB::RAW("0 as checked"))->get();

        $pUsuarios = Permission::where('name', 'Usuarios_index')
            ->orWhere('name', 'Usuarios_create')
            ->orWhere('name', 'Usuarios_edit')
            ->orWhere('name', 'Usuarios_destroy')
            ->select('*', DB::RAW("0 as checked"))->get();

        $pPermisos = Permission::where('name', 'Permisos_index')
            ->select('*', DB::RAW("0 as checked"))->get();

        $pAsistencias = Permission::where('name', 'Asistencias_ingreso')
            ->orWhere('name', 'Asistencias_egreso')
            ->select('*', DB::RAW("0 as checked"))->get();

        $pReportes = Permission::where('name', 'Reportes_asistencias')
            ->select('*', DB::RAW("0 as checked"))->get();

        if($this->userSelected != 'Seleccionar')
        {
            //habilita o deshabilita el botón 'Asignar Roles'
            //para que no se pueda modificar el rol del usuario Administrador
            $userRol = ModelHasRole::join('roles as r', 'r.id', 'model_has_roles.role_id')
                ->where('model_has_roles.model_id', $this->userSelected)
                ->where('r.alias', 'Administrador')->select('r.id')->get();
            if($userRol->count()) $this->habilitar_roles = false;
            else $this->habilitar_roles = true;
                    
            foreach($roles as $r){
                $r->checked = '';
                $user = User::find($this->userSelected);
                $tieneRole = $user->hasRole($r->name);
                if($tieneRole) $r->checked = 1;
            }
        } //else $habilitar_ = true;     
        
        if($this->roleSelected != 'Seleccionar')
        {
            //habilita o deshabilita el botón 'Asignar Permisos'
            //para que no se puedan modificar los permisos de los usuarios Administrador y No Usuario
            foreach($roles as $r){            
                if($r->alias == 'Administrador') $this->adminId = $r->id;
                //if($r->alias == 'No Usuario') $this->noUsuarioId = $r->id;
            }
            if($this->userSelected == $this->adminId) $this->habilitar_permisos = false;
            else $this->habilitar_permisos = true;  

            //////
            foreach($pSalas as $p){
                $role = Role::find($this->roleSelected);
                $tienePermiso = $role->hasPermissionTo($p->name);
                if($tienePermiso){
                        $p->checked = 1;
                }
            }
            foreach($pPlanes as $p){
                $role = Role::find($this->roleSelected);
                $tienePermiso = $role->hasPermissionTo($p->name);
                if($tienePermiso){
                        $p->checked = 1;
                }
            }            
            foreach($pAlumnos as $p){
                $role = Role::find($this->roleSelected);
                $tienePermiso = $role->hasPermissionTo($p->name);
                if($tienePermiso){
                        $p->checked = 1;
                }
            }
            foreach($pDocentes as $p){
                $role = Role::find($this->roleSelected);
                $tienePermiso = $role->hasPermissionTo($p->name);
                if($tienePermiso){
                        $p->checked = 1;
                }
            }
            foreach($pUsuarios as $p){
                $role = Role::find($this->roleSelected);
                $tienePermiso = $role->hasPermissionTo($p->name);
                if($tienePermiso){
                        $p->checked = 1;
                }
            }  
            foreach($pPermisos as $p){
                $role = Role::find($this->roleSelected);
                $tienePermiso = $role->hasPermissionTo($p->name);
                if($tienePermiso){
                        $p->checked = 1;
                }
            }  
            foreach($pAsistencias as $p){
                $role = Role::find($this->roleSelected);
                $tienePermiso = $role->hasPermissionTo($p->name);
                if($tienePermiso){
                        $p->checked = 1;
                }
            }
            foreach($pReportes as $p){
                $role = Role::find($this->roleSelected);
                $tienePermiso = $role->hasPermissionTo($p->name);
                if($tienePermiso){
                        $p->checked = 1;
                }
            } 
        } else $this->habilitar_permisos = false;

        return view('livewire.permisos.component',[
            'roles'        => $roles,
            'pSalas'       => $pSalas,
            'pPlanes'      => $pPlanes,
            'pAlumnos'     => $pAlumnos,
            'pDocentes'    => $pDocentes,
            'pUsuarios'    => $pUsuarios,
            'pPermisos'    => $pPermisos,
            'pAsistencias' => $pAsistencias,
            'pReportes'    => $pReportes,
            'usuarios'     => $usuarios
            ]);        
    }    
        //sección de roles
    public function resetInput()
    {
        $this->agregarRol   = '';
        $this->userSelected = 'Seleccionar';
        $this->roleSelected = 'Seleccionar';
        $this->habilitar_roles;
        $this->habilitar_permisos;
    }
        
    protected $listeners = [
        'destroyRole',
        'destroyPermiso' ,
        'CrearRole',
        'CrearPermiso',
        'AsignarRoles',
        'AsignarPermisos'
    ];        

    public function CrearRole($roleName, $roleId, $admiteCaja)
    {
        if($roleId) $this->UpdateRole($roleName, $roleId, $admiteCaja);
        else $this->SaveRole($roleName, $admiteCaja);
    }

    public function SaveRole($roleName, $admiteCaja)
    {
        $role = Role::where('name', $roleName)->select('name')->get();
        if($role->count() > 0){
            toastr()->warning('El rol que intentas registrar ya existe en el sistema', 'Notificación');
            $this->resetInput();
            return;
        }else {
            Role::create([
                'name'  => ucwords($roleName),
                'alias' => ucwords($roleName)
            ]);
            toastr()->success('El Rol se registró correctamente', 'Notificación');
        }
        $this->resetInput();
        return;
    }

    public function UpdateRole($roleName, $roleId)
    {
        $role = Role::where('name', $roleName)
            ->where('id', '<>', $roleId)->first();
        if($role){
            toastr()->warning('El rol que intentas registrar ya existe en el sistema!!!', 'Notificación');
            return;
        }

        $role = Role::find($roleId);
        $role->name  = ucwords($roleName);
        $role->alias = ucwords($roleName);
        $role->save();

        toastr()->success('Rol actualizado correctamente', 'Notificación');
        $this->resetInput();
    }

    public function destroyRole($roleId)
    {
        Role::find($roleId)->delete();
        toastr()->success('El Rol se eliminó correctamente', 'Notificación');
    }

    public function AsignarRoles($rolesList)
    {
        if(count($rolesList,1) > 1){
            toastr()->info('Solo puede haber un Rol seleccionado', 'Notificación');
            return;
        }

        if($this->userSelected != 'Seleccionar'){
            $user = User::find($this->userSelected);
            if($user)
            {
                $user->syncRoles($rolesList);
                toastr()->success('Roles asignados correctamente', 'Notificación');
                $this->resetInput();
            }
        } else toastr()->info('Debe seleccionar un Usuario...', 'Notificación');
    }

    //permisos
    public function CrearPermiso($permisoName, $permisoId)
    {
        if($permisoId)
            $this->UpdatePermiso($permisoName, $permisoId);
        else
            $this->SavePermiso($permisoName);
    }

    public function SavePermiso($permisoName)
    {
        $permiso = Permission::where('name', $permisoName)->first();
        if($permiso){
            session()->flash('msg-ops', 'El permiso que intentas registrar ya existe en el sistema');
            return;
        }

        Permission::create([
            'name' => $permisoName
        ]);
        session()->flash('msg-ok', 'El permiso se registró correctamente');
        $this->resetInput();
    }

    public function UpdatePermiso($permisoName, $permisoId)
    {
        $permiso = Permission::where('name', $permisoName)->where('id', '<>', $permisoId)->first();
        if($permiso){
            session()->flash('msg-ops', 'El permiso que intentas registrar ya existe en el sistema');
            return;
        }

        $permiso = Permission::find($permisoId);
        $permiso->name = $permisoName;
        $permiso->save();

        session()->flash('msg-ok', 'Permiso actualizado correctamente');
        $this->resetInput();
    }

    public function destroyPermiso($permisoId)
    {
        Permission::find($permisoId)->delete();

        session()->flash('msg-ok', 'Se eliminó el permiso correctamente');
    }

    public function AsignarPermisos($permisosList, $roleId)
    {
        if($roleId > 0){
            $role = Role::find($roleId);
            if($role)
            {
                $role->syncPermissions($permisosList);
                session()->flash('msg-ok', 'Permisos asignados correctamente');
                $this->resetInput();
            }
        }
    }

}


