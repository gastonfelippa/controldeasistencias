<div class="content">
    @include('common.messages')     {{--  mensages de session  --}}
    @if($action == 1)
        <h1 class="ml-2">Listado de Alumnos</h1>
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Alumnos registrados</b></h3>
                    <div class="card-tools">
                        <a href="#" wire:click.prevent="create()" class="btn btn-primary">
                            <i class="bi bi-file-plus"></i>
                            Agregar Nuevo Alumno
                        </a>
                    </div>
                </div>
                @if($recuperar_registro)
                    @include('common.recuperarRegistro')
                @else
                    <div class="card-body" style="display: block;">             
                        <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Apellido y Nombre</th>
                                    <th>Sala</th>
                                    <th>Plan</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alumnos as $i)
                                <tr>
                                    <td>{{ $i->apellido_alumno}} {{ $i->nombre_alumno}}</td>
                                    <td>{{ $i->sala}}</td>
                                    <td>{{ $i->plan}}</td>
                                    <td class="text-center">
                                        @if ($i->estado == '1')
                                            <button class="btn btn-success btn-sm" style="border-radius: 20px;">Activo</button>
                                        @else
                                            <button class="btn btn-danger btn-sm" style="border-radius: 20px;">Inactivo</button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button wire:click="show({{$i->id}})" type="button" class="btn btn-info btn-sm" title="Ver"><i class="bi bi-eye"></i></button>
                                            <button wire:click="edit({{$i->id}})" type="button" class="btn btn-success btn-sm" title="Editar"><i class="bi bi-pencil"></i></button>
                                            <button onclick="Confirm({{$i->id}})" type="button" class="btn btn-danger btn-sm" title="Eliminar"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>  
                    </div>
                @endif
            </div>
        </div>
    @elseif($action == 2)
        @include('livewire.alumnos.create')
    @elseif($action == 3)
        @include('livewire.alumnos.show')
    @endif   
    @include('scripts.alumnos')     
</div>

