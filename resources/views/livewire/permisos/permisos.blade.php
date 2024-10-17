<div class="tab-pane fade {{$tab == 'permisos' ? 'show active' : ''}}" id="permisos_content" role="tabpanel">
    <div class="row mt-2">
        <div class="col-sm-12 col-md-8">
            <h6 class="text-center"><b>PERMISOS DE SISTEMA</b></h6>
            <div class="table-responsive scroll">
                <div id="tblPermisos" class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col"> 
                        <div class="card border-dark text-dark bg-light mb-3">
                            <div class="card-header">Salas</div>
                            <div class="card-body">
                            @foreach($pSalas as $p)
                            <tr>
                                <td class="text-center">
                                    <div class="n-check" id="divSalas">
                                        <label class="new-control new-checkbox checkbox-primary">
                                            <input data-name="{{$p->name}}" 
                                            {{$p->checked == 1 ? 'checked' : ''}}
                                            type="checkbox" class="new-control-input checkbox-rol">
                                            <span class="new-control-indicator"></span>
                                            {{$p->alias}}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-dark text-dark bg-light mb-3">
                            <div class="card-header">Planes</div>
                            <div class="card-body">
                            @foreach($pPlanes as $p)
                            <tr>
                                <td class="text-center">
                                    <div class="n-check" id="divPlanes">
                                        <label class="new-control new-checkbox checkbox-primary">
                                            <input data-name="{{$p->name}}" 
                                            {{$p->checked == 1 ? 'checked' : ''}}
                                            type="checkbox" class="new-control-input checkbox-rol">
                                            <span class="new-control-indicator"></span>
                                            {{$p->alias}}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </div>
                        </div>
                    </div>                    
                    <div class="col">
                        <div class="card border-dark text-dark bg-light mb-3">
                            <div class="card-header">Alumnos</div>
                            <div class="card-body">
                            @foreach($pAlumnos as $p)
                            <tr>
                                <td class="text-center">
                                    <div class="n-check" id="divAlumnos">
                                        <label class="new-control new-checkbox checkbox-primary">
                                            <input data-name="{{$p->name}}" 
                                            {{$p->checked == 1 ? 'checked' : ''}}
                                            type="checkbox" class="new-control-input checkbox-rol">
                                            <span class="new-control-indicator"></span>
                                            {{$p->alias}}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-dark text-dark bg-light mb-3">
                            <div class="card-header">Docentes</div>
                            <div class="card-body">
                            @foreach($pDocentes as $p)
                            <tr>
                                <td class="text-center">
                                    <div class="n-check" id="divDocentes">
                                        <label class="new-control new-checkbox checkbox-primary">
                                            <input data-name="{{$p->name}}" 
                                            {{$p->checked == 1 ? 'checked' : ''}}
                                            type="checkbox" class="new-control-input checkbox-rol">
                                            <span class="new-control-indicator"></span>
                                            {{$p->alias}}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-dark text-dark bg-light mb-3">
                            <div class="card-header">Usuarios</div>
                            <div class="card-body">
                            @foreach($pUsuarios as $p)
                            <tr>
                                <td class="text-center">
                                    <div class="n-check" id="divUsuarios">
                                        <label class="new-control new-checkbox checkbox-primary">
                                            <input data-name="{{$p->name}}" 
                                            {{$p->checked == 1 ? 'checked' : ''}}
                                            type="checkbox" class="new-control-input checkbox-rol">
                                            <span class="new-control-indicator"></span>
                                            {{$p->alias}}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-dark text-dark bg-light mb-3" >
                            <div class="card-header">Asistencias</div>
                            <div class="card-body">
                            @foreach($pAsistencias as $p)
                            <tr>
                                <td class="text-center">
                                    <div class="n-check" id="divAsistencias">
                                        <label class="new-control new-checkbox checkbox-primary">
                                            <input data-name="{{$p->name}}" 
                                            {{$p->checked == 1 ? 'checked' : ''}}
                                            type="checkbox" class="new-control-input checkbox-rol">
                                            <span class="new-control-indicator"></span>
                                            {{$p->alias}}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-dark text-dark bg-light mb-3">
                            <div class="card-header">Reportes</div>
                            <div class="card-body">
                            @foreach($pReportes as $p)
                            <tr>
                                <td class="text-center">
                                    <div class="n-check" id="divReportes">
                                        <label class="new-control new-checkbox checkbox-primary">
                                            <input data-name="{{$p->name}}" 
                                            {{$p->checked == 1 ? 'checked' : ''}}
                                            type="checkbox" class="new-control-input checkbox-rol">
                                            <span class="new-control-indicator"></span>
                                            {{$p->alias}}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-dark text-dark bg-light mb-3">
                            <div class="card-header">Permisos</div>
                            <div class="card-body">
                            @foreach($pPermisos as $p)
                            <tr>
                                <td class="text-center">
                                    <div class="n-check" id="divPermisos">
                                        <label class="new-control new-checkbox checkbox-primary">
                                            <input data-name="{{$p->name}}" 
                                            {{$p->checked == 1 ? 'checked' : ''}}
                                            type="checkbox" class="new-control-input checkbox-rol">
                                            <span class="new-control-indicator"></span>
                                            {{$p->alias}}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <h6 class="text-left"><b>Elegir Rol</b></h6>   
            <div class="input-group">
                <select wire:model="roleSelected" id="roleSelected" class="form-control">
                    <option value="Seleccionar">Seleccionar</option>
                    @foreach($roles as $r)
                    <option value="{{$r->id}}">{{$r->alias}}</option>
                    @endforeach
                </select>
            </div> 
            <button type="button" onclick="AsignarPermisos()" class="btn btn-primary mt-4"
                {{ $habilitar_permisos ? 'enabled' : 'disabled' }}>Asignar Permisos</button>      
        </div>
    </div>
</div>

<style type="text/css" scoped>
.scroll{
    position: relative;
    height: 295px;
    margin-top: .5rem;
    overflow: auto;
}
</style>
