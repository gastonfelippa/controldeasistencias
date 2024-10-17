<div class="content">
    @include('common.messages')     {{--  mensages de session  --}}
    @if($action == 1)
        <h1 class="ml-2">Listado de Salas</h1>
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Salas registradas</b></h3>
                    <div class="card-tools">
                        <a href="#" wire:click.prevent="create()" class="btn btn-primary">
                            <i class="bi bi-file-plus"></i>
                            Agregar Nueva Sala
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
                                    <th>Denominación</th>
                                    <th>Estado</th>
                                    <th>Comentario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salas as $i)
                                <tr>
                                    <td>{{ $i->descripcion}}</td>
                                    <td class="text-center">
                                        @if ($i->estado == '1') <span class="badge badge-pill badge-success">Activo</span>
                                        @else <span class="badge badge-pill badge-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>{{ $i->comentario}}</td>
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
        @include('livewire.salas.create')
    @elseif($action == 3)
        @include('livewire.salas.show')
    @endif        
</div>

<script>

    function Confirm(id)
    {
        Swal.fire({
            title: 'CONFIRMAR',
            html: '¿Deseas de Eliminar el registro?' + '<br>' + 'No podrás deshacer esta acción.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('delete', id);
            }else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire('Cancelado', 'Tu registro está a salvo :)', 'error')
            }
        })
    }   

    window.onload = function() {
		Livewire.on('registroRelacionado',()=>{
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'Tu registro no se puede eliminar!',
                text: 'Existen Alumnos relacionados a esta Sala...',
                showConfirmButton: false,
                timer: 3500
            })
		}) 
		Livewire.on('registroEliminado',()=>{
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Registro Eliminado!',
                text: 'Tu registro se eliminó correctamente...',
                showConfirmButton: false,
                timer: 1500
            })
		}) 
    }
</script>
