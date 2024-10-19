@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Listado de Alumnos</h1>
    @include('common.messages')
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Alumnos registrados</b></h3>
                <div class="card-tools">
                    @can('Alumnos_create')
                        <a href="{{ url('/alumnos/create')}}" class="btn btn-primary">
                            <i class="bi bi-file-plus"></i>
                            Agregar Nuevo Alumno
                        </a> 
                    @endcan             
                    <a href="{{ route('alumno.imprimir-qr')}}" class="btn btn-warning">
                        <i class="bi bi-file-plus"></i>
                        Imprimir Qr
                    </a>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Apellido y Nombre</th>
                            <th>Sala</th>
                            <th>Plan</th>
                            <th>Estado</th>
                            <th>Foto</th>
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
                                @if ($i->estado == '1') <span class="badge badge-pill badge-success">Activo</span>
                                @else <span class="badge badge-pill badge-danger">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($i->foto == '')
                                    @if ($i->genero == '1') <img class="rounded-circle" src="{{ asset('images/avatar-nena.jpg')}}" height="30px" alt="">                            
                                    @else <img class="rounded-circle" src="{{ asset('images/avatar-nene.jpg')}}" height="30px" alt="">
                                    @endif    
                                @else <img class="rounded-circle" src="{{ route('alumno.imagen', $i->foto) }}" height="30px">
                                @endif 
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('alumnos/'.$i->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                    <a href="{{ url('alumnos/'.$i->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                    @can('Alumnos_destroy')
                                        <form action="{{ url('alumnos/'.$i->id)}}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                        </form>
                                    @endcan
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