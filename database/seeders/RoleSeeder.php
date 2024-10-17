<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
