<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use App\Models\Sala;
use App\Models\Alumno;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class AlumnoController extends Component
{
    use WithFileUploads;

    public $action = 1, $selected_id;
    public $recuperar_registro, $descripcion_soft_deleted, $id_soft_deleted;
    public $nombre_alumno, $apellido_alumno, $dni, $fecha_nacimiento, $genero = '1', $direccion;
    public $sala_id = 'Elegir', $plan_id = 'Elegir';
    public $nombre_mama, $apellido_mama, $tel_mama;
    public $nombre_papa, $apellido_papa, $tel_papa;
    public $nombre_tutor, $apellido_tutor, $tel_tutor, $email_tutor;
    public $foto, $fecha_ingreso, $estado, $comentario;
    public $event, $logo_nuevo, $imagePreview, $image;

    public function render()
    {
        $salas = Sala::all();
        $planes = Plan::all();
        $alumnos = Alumno::join('salas as s', 's.id', 'alumnos.sala_id')
                ->join('planes as p', 'p.id', 'alumnos.plan_id')
                ->select('alumnos.*', 's.descripcion as sala', 'p.descripcion as plan')
                ->orderBy('alumnos.apellido_alumno')->get();

        return view('livewire.alumnos.component', [
            'salas' => $salas,
            'planes' => $planes,
            'alumnos' => $alumnos,
        ]);
    }
    protected $listeners = [
        'delete',
        'logoUpload'     
    ];
    public function updatedImage()
    {
        // Valida y sube la imagen
        $this->validate([
            'image' => 'image|max:1024', // 1MB Max
        ]);
dd($this->image);
        $path = $this->image->store('uploads', 'public'); // Guarda la imagen en storage/app/public/uploads
        // Puedes emitir el evento o hacer cualquier otra acción aquí
        // Por ejemplo, emitir el path al frontend si es necesario
    }
    public function logoUpload($imageData, $nombreLogo)
    {
        $this->foto = $imageData;
        $this->logo_nuevo = $imageData;
       // $this->nombre_logo = $nombreLogo;
        $this->event = true;
    }
    public function resetInput()
    {
        $this->selected_id              = null;
        $this->recuperar_registro       = null;
        $this->descripcion_soft_deleted = null;
        $this->id_soft_deleted          = null;
        $this->nombre_alumno            = null;
        $this->apellido_alumno          = null;
        $this->dni                      = null;
        $this->fecha_nacimiento         = null;
        $this->genero                   = '1';
        $this->direccion                = null;
        $this->sala_id                  = 'Elegir';
        $this->plan_id                  = 'Elegir';
        $this->nombre_mama              = null;
        $this->apellido_mama            = null;
        $this->tel_mama                 = null;
        $this->nombre_papa              = null;
        $this->apellido_papa            = null;
        $this->tel_papa                 = null;
        $this->nombre_tutor             = null;
        $this->apellido_tutor           = null;
        $this->tel_tutor                = null;
        $this->email_tutor              = null;
        $this->foto                     = null;
        $this->fecha_ingreso            = null;        
        $this->estado                   = 1;
        $this->comentario               = null;
        $this->event                    = null;
    }
    public function action($action)
    {
        $this->action = $action;
    }
    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        $this->selected_id = $id;
        $this->nombre_alumno    = $alumno->nombre_alumno;
        $this->apellido_alumno  = $alumno->apellido_alumno;
        $this->dni              = $alumno->dni;
        $this->fecha_nacimiento = $alumno->fecha_nacimiento;
        $this->genero           = $alumno->genero;
        $this->direccion        = $alumno->direccion;
        $this->sala_id          = $alumno->sala_id;
        $this->plan_id          = $alumno->plan_id;
        $this->nombre_mama      = $alumno->nombre_mama;
        $this->apellido_mama    = $alumno->apellido_mama;
        $this->tel_mama         = $alumno->tel_mama;
        $this->nombre_papa      = $alumno->nombre_papa;
        $this->apellido_papa    = $alumno->apellido_papa;
        $this->tel_papa         = $alumno->tel_papa;
        $this->nombre_tutor     = $alumno->nombre_tutor;
        $this->apellido_tutor   = $alumno->apellido_tutor;
        $this->tel_tutor        = $alumno->tel_tutor;
        $this->email_tutor      = $alumno->email_tutor;
        $this->foto             = $alumno->foto;
        $this->fecha_ingreso    = $alumno->fecha_ingreso;        
        $this->estado           = $alumno->estado;
        $this->comentario       = $alumno->comentario;

        $this->action           = 2;
    }
    public function show($id)
    {
        $alumno = Alumno::findOrFail($id);
        $this->nombre_alumno    = $alumno->nombre_alumno;
        $this->apellido_alumno  = $alumno->apellido_alumno;
        $this->dni              = $alumno->dni;
        $this->fecha_nacimiento = $alumno->fecha_nacimiento;
        $this->genero           = $alumno->genero;
        $this->direccion        = $alumno->direccion;
        $this->sala_id          = $alumno->sala_id;
        $this->plan_id          = $alumno->plan_id;
        $this->nombre_mama      = $alumno->nombre_mama;
        $this->apellido_mama    = $alumno->apellido_mama;
        $this->tel_mama         = $alumno->tel_mama;
        $this->nombre_papa      = $alumno->nombre_papa;
        $this->apellido_papa    = $alumno->apellido_papa;
        $this->tel_papa         = $alumno->tel_papa;
        $this->nombre_tutor     = $alumno->nombre_tutor;
        $this->apellido_tutor   = $alumno->apellido_tutor;
        $this->tel_tutor        = $alumno->tel_tutor;
        $this->email_tutor      = $alumno->email_tutor;
        $this->foto             = $alumno->foto;
        $this->fecha_ingreso    = $alumno->fecha_ingreso;   
        $this->comentario       = $alumno->comentario;
        if($alumno->estado == 0) $this->estado = 'Inactivo';
        else $this->estado = 'Activo';
        
        $this->action = 3;
    }
    public function create()
    {
        $this->resetInput();
        $this->action = 2;
    }
    public function save()
    {
        // if($this->foto) {
        //      $this->validate([
        //         'foto' => 'image|max:1024', // 1MB Max
        //     ]);
        // }
       
        $this->validate([
            'nombre_alumno'    => 'required',
            'apellido_alumno'  => 'required',
            'dni'              => 'required',
            'fecha_nacimiento' => 'required',
            'direccion'        => 'required',
            'sala_id'          => 'not_in:Elegir',
            'plan_id'          => 'not_in:Elegir',
            'nombre_tutor'     => 'required',
            'apellido_tutor'   => 'required',
            'tel_tutor'        => 'required',
            'email_tutor'      => ['required', 'email'],
            'fecha_ingreso'    => 'required'            
        ]);
        
        $is_exists = $this->is_exists();

        if(!$is_exists){
            DB::begintransaction();
            try{
                $this->saveOrUpdate();
        
                if($this->selected_id) toastr()->success('Alumno/a actualizado correctamente!!', 'Notificación');            
                else toastr()->success('Alumno/a grabado correctamente!!', 'Notificación');    

                DB::commit(); 
            }catch (Exception $e){
                DB::rollback();              
                session()->flash('mensaje_info', 'El registro no se grabó... Intentalo nuevamente y si vuelve a suceder contactate con tu Administrador de Sistema.');
                return redirect('alumnos');
            }  
            $this->resetInput();
            return;                 
        } else toastr()->info('Alumno/a existente en los registros...', 'Notificación');        

    }
    public function is_exists()
    {
        if($this->selected_id) {
            $existe = Alumno::where('dni', $this->dni)
                ->where('id', '<>', $this->selected_id)
                ->withTrashed()->get();
            if($existe->count() && $existe[0]->deleted_at != null) {
                $this->action = 1;
                $this->recuperar_registro = 1;
                $this->descripcion_soft_deleted = $existe[0]->descripcion;
                $this->id_soft_deleted = $existe[0]->id;
                return true;
            }elseif($existe->count()) return true;
        }else {
            $existe = Alumno::where('dni', $this->dni)->withTrashed()->get();

            if($existe->count() && $existe[0]->deleted_at != null) {
                $this->action = 1;
                $this->recuperar_registro = 1;
                $this->descripcion_soft_deleted = $existe[0]->descripcion;
                $this->id_soft_deleted = $existe[0]->id;
                return true;
            }elseif($existe->count()) return true;
        }
        return false;
    }
    public function saveOrUpdate()
    {
        if($this->selected_id) {
            $alumno = Alumno::find($this->selected_id);
            $alumno->update([
                'nombre_alumno'    => ucwords($this->nombre_alumno),
                'apellido_alumno'  => ucwords($this->apellido_alumno),
                'dni'              => $this->dni,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'genero'           => $this->genero,
                'direccion'        => ucwords($this->direccion),
                'sala_id'          => $this->sala_id,
                'plan_id'          => $this->plan_id,
                'nombre_mama'      => ucwords($this->nombre_mama),
                'apellido_mama'    => ucwords($this->apellido_mama),
                'tel_mama'         => $this->tel_mama,
                'nombre_papa'      => ucwords($this->nombre_papa),
                'apellido_papa'    => ucwords($this->apellido_papa),
                'tel_papa'         => $this->tel_papa,
                'nombre_tutor'      => ucwords($this->nombre_tutor),
                'apellido_tutor'    => ucwords($this->apellido_tutor),
                'tel_tutor'        => $this->tel_tutor,
                'email_tutor'      => $this->email_tutor,
                'fecha_ingreso'    => $this->fecha_ingreso,
                'estado'           => $this->estado,
                'comentario'       => ucfirst($this->comentario),
            ]);
            if ($this->foto) {
                $alumno->foto = $this->foto->store('fotos_alumnos','public');
                $alumno->update();       
            }
            $this->action = 1;             
        }else {  
            dd($this->foto, $this->event);
            if($this->foto != null && $this->event)
            {
                //carga cualquier imagen y la guarda en la carpeta public/images/logo       
                $image = $this->foto;   //decodificamos la data de la imagen en Base 64 
                $fileName = time(). '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                $moved = Image::make($image)->save('images/alumnos/'. $fileName);
                if($moved)
                {
                    $this->foto = $fileName;
                }
                //carga solo imágenes precargadas en el sistema desde carpeta public/images/logo
                // $comercio->logo = $this->logo;
                // $comercio->save();
            } 
            $alumno = Alumno::create([
                'nombre_alumno'    => ucwords($this->nombre_alumno),
                'apellido_alumno'  => ucwords($this->apellido_alumno),
                'dni'              => $this->dni,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'genero'           => $this->genero,
                'direccion'        => ucwords($this->direccion),
                'sala_id'          => $this->sala_id,
                'plan_id'          => $this->plan_id,
                'nombre_mama'      => ucwords($this->nombre_mama),
                'apellido_mama'    => ucwords($this->apellido_mama),
                'tel_mama'         => $this->tel_mama,
                'nombre_papa'      => ucwords($this->nombre_papa),
                'apellido_papa'    => ucwords($this->apellido_papa),
                'tel_papa'         => $this->tel_papa,
                'nombre_tutor'      => ucwords($this->nombre_tutor),
                'apellido_tutor'    => ucwords($this->apellido_tutor),
                'tel_tutor'        => $this->tel_tutor,
                'email_tutor'      => $this->email_tutor,
                'fecha_ingreso'    => $this->fecha_ingreso,
                'estado'           => $this->estado,
                'comentario'       => ucfirst($this->comentario), 
                'foto'             => $this->foto,       
            ]);

            // if ($this->foto) {
            //     $alumno->foto = $this->foto->store('fotos_alumnos');
            //     $alumno->save();       
            // }    
        }
    }
    public function delete($id)
    {
        if ($id) {
            // $sala_alumno = Alumno::where('sala_id', $id)->get();
            // if(!$sala_alumno->count()){
                DB::begintransaction();
                try{
                    $alumno = Alumno::findOrFail($id)->delete();
              
                    DB::commit();  
                    $this->emit('registroEliminado');             
                }catch (\Exception $e){
                    DB::rollback();
                    session()->flash('mensaje_info', 'El registro no se eliminó... Intentalo nuevamente actualizando la página, y si vuelve a suceder contactate con el Administrador del Sistema.');
                    return redirect('alumnos');
                }    
            //}else $this->emit('registroRelacionado');
        }
        return;
    }
    public function volver()
    {
        $this->recuperar_registro = null;
        $this->resetInput();
        return; 
    }
    public function RecuperarRegistro($id)
    {
        DB::begintransaction();
        try{
            Alumno::onlyTrashed()->find($id)->restore();
            session()->flash('mensaje_ok', 'Registro recuperado');
            $this->volver();
            
            DB::commit();               
        }catch (\Exception $e){
            DB::rollback();
            session()->flash('mensaje_error', 'El registro no pudo ser recuperado... Intentalo nuevamente actualizando la página, y si vuelve a suceder contactate con el Administrador del Sistema.');
        }
        return redirect('alumnos');
    }
}
