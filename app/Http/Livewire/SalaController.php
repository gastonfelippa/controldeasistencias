<?php

namespace App\Http\Livewire;

use App\Models\Sala;
use App\Models\Alumno;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SalaController extends Component
{
    public $action = 1, $selected_id;
    public $recuperar_registro, $descripcion_soft_deleted, $id_soft_deleted;
    public $descripcion, $estado, $comentario;

    public function render()
    {
        $salas = Sala::all();

        return view('livewire.salas.component', ['salas' => $salas]);
    }
    protected $listeners = [
        'delete'       
    ];
    public function resetInput()
    {
        $this->selected_id              = null;
        $this->descripcion              = null;
        $this->estado                   = 1;
        $this->comentario               = null;
        $this->recuperar_registro       = null;
        $this->descripcion_soft_deleted = null;
        $this->id_soft_deleted          = null;
    }
    public function action($action)
    {
        $this->action = $action;
    }
    public function edit($id)
    {
        $sala = Sala::findOrFail($id);
        $this->selected_id = $id;
        $this->descripcion = $sala->descripcion;
        $this->comentario  = $sala->comentario;
        $this->estado      = $sala->estado;

        $this->action = 2;
    }
    public function show($id)
    {
        $sala = Sala::findOrFail($id);
        $this->descripcion = $sala->descripcion;
        $this->comentario  = $sala->comentario;
        if($sala->estado == 0) $this->estado = 'Inactivo';
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
        $this->validate(['descripcion' => 'required']);
        
        $is_exists = $this->is_exists();

        if(!$is_exists){
            DB::begintransaction();
            try{
                $this->saveOrUpdate();
        
                if($this->selected_id) toastr()->success('La Sala se actualizó correctamente!!', 'Notificación');            
                else toastr()->success('La Sala se grabó correctamente!!', 'Notificación');    

                DB::commit(); 
            }catch (\Exception $e){
                DB::rollback();              
                session()->flash('mensaje_info', 'El registro no se grabó... Intentalo nuevamente y si vuelve a suceder contactate con tu Administrador de Sistema.');
                return redirect('salas');
            }  
            $this->resetInput();
            return;                 
        } else toastr()->info('La Sala ya existe...', 'Notificación');        

    }
    public function is_exists()
    {
        if($this->selected_id) {
            $existe = Sala::where('descripcion', $this->descripcion)
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
            $existe = Sala::where('descripcion', $this->descripcion)->withTrashed()->get();

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
            $sala = Sala::find($this->selected_id);
            $sala->update([
                'descripcion' => ucwords($this->descripcion),
                'comentario'  => ucfirst($this->comentario),
                'estado'      => $this->estado
            ]);
            $this->action = 1;             
        }else {   
            $sala = Sala::create([
                'descripcion' => ucwords($this->descripcion),
                'comentario'  => ucfirst($this->comentario)         
            ]);       
        }
    }
    public function delete($id)
    {
        if ($id) {
            $sala_alumno = Alumno::where('sala_id', $id)->get();
            if(!$sala_alumno->count()){
                DB::begintransaction();
                try{
                    $sala = Sala::findOrFail($id)->delete();
              
                    DB::commit();  
                    $this->emit('registroEliminado');             
                }catch (\Exception $e){
                    DB::rollback();
                    session()->flash('mensaje_info', 'El registro no se eliminó... Intentalo nuevamente actualizando la página, y si vuelve a suceder contactate con el Administrador del Sistema.');
                    return redirect('salas');
                }    
            }else $this->emit('registroRelacionado');
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
            Sala::onlyTrashed()->find($id)->restore();
            session()->flash('mensaje_ok', 'Registro recuperado');
            $this->volver();
            
            DB::commit();               
        }catch (\Exception $e){
            DB::rollback();
            session()->flash('mensaje_error', 'El registro no pudo ser recuperado... Intentalo nuevamente actualizando la página, y si vuelve a suceder contactate con el Administrador del Sistema.');
        }
        return redirect('salas');
    }
}
