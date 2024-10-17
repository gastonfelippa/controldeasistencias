@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Listado de Planes</h1>
    @include('common.messages')
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Planes registrados</b></h3>
                <div class="card-tools">
                    <a href="{{ url('/planes/create')}}" class="btn btn-primary">
                        <i class="bi bi-file-plus"></i>
                        Agregar Nuevo Plan
                    </a>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                <?php $contador = 0;?>
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Denominación</th>
                            <th>Importe</th>
                            <th>Horas contratadas</th>
                            <th>Horas límite</th>
                            <th>Estado</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($planes as $i)
                        <tr>
                            <td>{{ $i->descripcion}}</td>
                            <td>{{ $i->importe}}</td>
                            <td>{{ $i->horas_plan}}</td>
                            <td>{{ $i->horas_limite}}</td>
                            <td class="text-center">
                                @if ($i->estado == '1') <span class="badge badge-pill badge-success">Activo</span>
                                @else <span class="badge badge-pill badge-danger">Inactivo</span>
                                @endif
                            </td>
                            <td>{{ $i->comentario}}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('planes/'.$i->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ url('planes/'.$i->id.'/edit')}}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ url('planes/'.$i->id)}}" method="post">
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