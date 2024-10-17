@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Editar Usuario</h1>
    <div class="col-md-12 col-sm-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Completar datos</b></h3>
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <li>{{ $error }}</li>
                    </div>
                @endforeach
            </div>
            <div class="card-body" style="display: block;">
                <form action="{{ url('/usuarios', $usuario->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH')}}
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Nombre</label><b>*</b>
                                <input name="name" type="text" value="{{ $usuario->name }}" 
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email</label><b>*</b>
                                <input name="email" type="text" value="{{ $usuario->email }}" 
                                    class="form-control" required>
                            </div>
                        </div>
                        {{-- <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Estado</label><b>*</b>
                                <select name="estado" class="form-control">
                                    <option value="{{ $alumno->plan_id }}">{{ $alumno->plan }}</option>
                                    @foreach ($planes as $i)
                                        <option value="{{ $i->id }}">{{ $i->nombre }}</option>
                                    @endforeach
                                </select>
                                <select value="{{ $usuario->estado}}" name="estado" id="" class="form-control" >
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ url('usuarios')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>
@endsection