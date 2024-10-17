<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use App\Models\Alumno;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PlanController extends Component
{
    public $action = 1, $selected_id;
    public $recuperar_registro, $descripcion_soft_deleted, $id_soft_deleted;
    public $descripcion, $importe, $horas_plan, $horas_limite, $estado, $comentario;

    public function render()
    {
        $planes = Plan::all();

        return view('livewire.planes.component', ['planes' => $planes]);
    }
    protected $listeners = [
        'delete'       
    ];
    public function resetInput()
    {
        $this->selected_id              = null;
        $this->descripcion              = null;
        $this->importe                  = null;
        $this->horas_plan               = null;
        $this->horas_limite             = null;
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
        $plan = Plan::findOrFail($id);
        $this->selected_id  = $id;
        $this->descripcion  = $plan->descripcion;
        $this->importe      = $plan->importe;
        $this->horas_plan   = $plan->horas_plan;
        $this->horas_limite = $plan->horas_limite;
        $this->estado       = $plan->estado;
        $this->comentario   = $plan->comentario;

        $this->action = 2;
    }
    public function show($id)
    {
        $plan = Plan::findOrFail($id);
        $this->descripcion  = $plan->descripcion;
        $this->importe      = $plan->importe;
        $this->horas_plan   = $plan->horas_plan;
        $this->horas_limite = $plan->horas_limite;
        $this->comentario   = $plan->comentario;
        if($plan->estado == 0) $this->estado = 'Inactivo';
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
        $this->validate([
            'descripcion'  => 'required',
            'importe'      => 'required',
            'horas_plan'   => 'required',
            'horas_limite' => 'required',
        ]);
        
        $is_exists = $this->is_exists();

        if(!$is_exists){
            DB::begintransaction();
            try{
                $this->saveOrUpdate();
        
                if($this->selected_id) toastr()->success('El Plan se actualizó correctamente!!', 'Notificación');            
                else toastr()->success('El Plan se grabó correctamente!!', 'Notificación');    

                DB::commit(); 
            }catch (\Exception $e){
                DB::rollback();              
                session()->flash('mensaje_info', 'El registro no se grabó... Intentalo nuevamente y si vuelve a suceder contactate con tu Administrador de Sistema.');
                return redirect('planes');
            }  
            $this->resetInput();
            return;                 
        } else toastr()->info('El Plan ya existe...', 'Notificación');        

    }
    public function is_exists()
    {
        if($this->selected_id) {
            $existe = Plan::where('descripcion', $this->descripcion)
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
            $existe = Plan::where('descripcion', $this->descripcion)->withTrashed()->get();

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
            $plan = Plan::find($this->selected_id);
            $plan->update([
                'descripcion'  => ucwords($this->descripcion),
                'importe'      => $this->importe,
                'horas_plan'   => $this->horas_plan,
                'horas_limite' => $this->horas_limite,
                'comentario'   => ucfirst($this->comentario),
                'estado'       => $this->estado
            ]);
            $this->action = 1;             
        }else {   
            $plan = Plan::create([
                'descripcion'  => ucwords($this->descripcion),
                'importe'      => $this->importe,
                'horas_plan'   => $this->horas_plan,
                'horas_limite' => $this->horas_limite,
                'comentario'   => ucfirst($this->comentario),        
            ]);       
        }
    }
    public function delete($id)
    {
        if ($id) {
            $plan_alumno = Alumno::where('plan_id', $id)->get();
            if(!$plan_alumno->count()){
                DB::begintransaction();
                try{
                    $plan = Plan::findOrFail($id)->delete();
              
                    DB::commit();  
                    $this->emit('registroEliminado');             
                }catch (\Exception $e){
                    DB::rollback();
                    session()->flash('mensaje_info', 'El registro no se eliminó... Intentalo nuevamente actualizando la página, y si vuelve a suceder contactate con el Administrador del Sistema.');
                    return redirect('planes');
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
            Plan::onlyTrashed()->find($id)->restore();
            session()->flash('mensaje_ok', 'Registro recuperado');
            $this->volver();
            
            DB::commit();               
        }catch (\Exception $e){
            DB::rollback();
            session()->flash('mensaje_error', 'El registro no pudo ser recuperado... Intentalo nuevamente actualizando la página, y si vuelve a suceder contactate con el Administrador del Sistema.');
        }
        return redirect('planes');
    }
}
