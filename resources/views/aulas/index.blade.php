@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Listado de Aulas</h1>
        @if($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Buen trabajo!",
                    text: "{{$message}}",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Aulas registrados</b></h3>
                <div class="card-tools">
                    <a href="{{ url('/aulas/create')}}" class="btn btn-primary">
                        <i class="bi bi-file-plus"></i>
                        Agregar Nueva Aula
                    </a>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                <?php $contador = 0;?>
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Denominación</th>
                            <th>Capacidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aulas as $i)
                        <tr>
                            <td><?php echo $contador = $contador + 1; ?></td>
                            <td>{{ $i->descripcion}}</td>
                            <td>{{ $i->capacidad}}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('aulas/'.$i->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ url('aulas/'.$i->id.'/edit')}}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ url('aulas/'.$i->id)}}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>  
            </div>
        </div>
    </div>        
</div>
@endsection