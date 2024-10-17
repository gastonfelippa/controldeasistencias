<div class="content">
    <h1 class="ml-2">@if($selected_id) Editar Plan @else Agregar Plan @endif</h1>    
    @if($recuperar_registro)
        @include('common.recuperarRegistro')
    @else
        <div class="col-md-12 col-sm-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Completar datos</b></h3>
                    @include('common.errors')
                </div>
                <div class="card-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Denominación</label><b>*</b>
                                <input wire:model="descripcion" name="nombre" type="text" 
                                    class="form-control" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Importe</label>
                                <input wire:model="importe" name="importe" type="number" 
                                class="form-control" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Hora/s contratadas</label>
                                <input wire:model="horas_plan" name="horas_plan" type="time" 
                                class="form-control" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Hora/s límite</label>
                                <input wire:model="horas_limite" name="horas_limite" type="time"
                                class="form-control" required autofocus autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if($selected_id)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Estado</label><b>*</b>
                                    <select wire:model="estado" class="form-control">
                                        <option value="0">Inactivo</option>
                                        <option value="1">Activo</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-9">
                        @else
                            <div class="col-md-12">
                        @endif
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <textarea wire:model="comentario" name="comentario" id="" cols="" rows="2"
                                    class="form-control" autocomplete="off">
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ url('planes')}}" class="btn btn-secondary px-4">Volver</a>
                            <button wire:click="save()" type="button" class="btn btn-primary">
                                @if($selected_id) Actualizar registro @else Guardar registro @endif</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    @endif       
</div>