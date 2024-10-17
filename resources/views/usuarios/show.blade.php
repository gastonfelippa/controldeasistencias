@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Datos del Usuario</h1>
    <div class="col-md-12 col-sm-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Datos registrados</b></h3>
            </div>
            <div class="card-body" style="display: block;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input name="name" value="{{ $usuario->name }}" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input name="email" value="{{ $usuario->email }}" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Fecha de Ingreso</label>
                            <input name="fecha" value="{{ $usuario->fecha_ingreso }}" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Estado</label>
                            @if($usuario->estado == '1')
                            <input name="fecha" value="Activo" type="text" class="form-control" disabled>
                            @else
                            <input name="fecha" value="Inactivo" type="text" class="form-control" disabled>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ url('usuarios')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
@endsection