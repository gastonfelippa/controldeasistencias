@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Listado de Usuarios</h1>
    @include('common.messages')
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Usuarios registrados</b></h3>
                <div class="card-tools">
                    <a href="{{ url('/usuarios/create')}}" class="btn btn-primary">
                        <i class="bi bi-file-plus"></i>
                        Agregar Nuevo Usuario
                    </a>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                <?php $contador = 0;?>
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $i)
                        <tr>
                            <td>{{ $i->name}}</td>
                            <td>{{ $i->email}}</td>
                            <td class="text-center">
                                @if ($i->estado == '1')
                                    <span class="badge badge-pill badge-success">Activo</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('usuarios/'.$i->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                    <a href="{{ url('usuarios/'.$i->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ url('usuarios/'.$i->id)}}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
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