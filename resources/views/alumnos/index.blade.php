@extends('layouts.template')

@section('content')
<div class="content ml-2">
    <h1>Listado de Alumnos</h1>
        @if($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Good job!",
                    text: "{{$message}}",
                    icon: "success"
                });
            </script>
        @endif
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Alumnos registrados</b></h3>
                <div class="card-tools">
                    <a href="{{ url('/alumnos/create')}}" class="btn btn-primary">
                        <i class="bi bi-file-plus"></i>
                        Agregar nuevo alumno
                    </a>
                </div>
                {{-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div> --}}
            </div>
            <div class="card-body" style="display: block;">
                <?php $contador = 0;?>
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Institución</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnos as $i)
                        <tr>
                            <td><?php echo $contador = $contador + 1; ?></td>
                            <td>{{ $i->nombre_apellido}}</td>
                            <td>{{ $i->telefono}}</td>
                            <td>{{ $i->email}}</td>
                            <td class="text-center">
                                @if ($i->estado == '1')
                                    <button class="btn btn-success btn-sm" style="border-radius: 20px;">Activo</button>
                                @else
                                    <button class="btn btn-danger btn-sm" style="border-radius: 20px;">Inactivo</button>
                                @endif
                            </td>
                            <td>{{ $i->institucion}}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('alumnos/'.$i->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ url('alumnos/'.$i->id.'/edit')}}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                    {{-- <a href="{{ url('alumnos/'.$i->id)}}" type="button" class="btn btn-danger"><i class="bi bi-trash"></i></a> --}}
                                    <form action="{{ url('alumnos/'.$i->id)}}" method="post">
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