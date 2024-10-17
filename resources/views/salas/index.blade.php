@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Listado de Salas</h1>
    @include('common.messages')
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Salas registrados</b></h3>
                <div class="card-tools">
                    <a href="{{ url('/salas/create')}}" class="btn btn-primary">
                        <i class="bi bi-file-plus"></i>
                        Agregar Nueva Sala
                    </a>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                <?php $contador = 0;?>
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
                                    <a href="{{ url('salas/'.$i->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ url('salas/'.$i->id.'/edit')}}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ url('salas/'.$i->id)}}" method="post">
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