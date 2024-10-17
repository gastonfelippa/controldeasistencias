@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Datos del Docente</h1>
    <div class="col-md-12 col-sm-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Datos registrados</b></h3>
            </div>
            <div class="card-body" style="display: block;">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input value="{{ $docente->nombre }}" 
                                        type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Apellido</label>
                                    <input value="{{ $docente->apellido }}" 
                                        type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Domicilio</label>
                                    <input value="{{ $docente->direccion }}" type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha de Nacimiento</label>
                                    <input value="{{ $docente->fecha_nacimiento }}" type="date" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Teléfono</label>
                                    <input value="{{ $docente->telefono }}" type="number" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input value="{{ $docente->email }}" type="email" class="form-control" disabled>
                                </div>
                            </div>
                           <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Género</label>
                                    <input value="{{ $docente->genero == 1 ? 'Femenino' : 'Masculino' }}"
                                     type="text" class="form-control" disabled>
                                </div>
                            </div> 
                        </div>                    
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha de Ingreso</label>
                                    <input value="{{ $docente->fecha_ingreso }}" type="date" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <input value="{{ $docente->estado == 1 ? 'Activo' : 'Inactivo' }}"
                                     type="text" class="form-control" disabled>
                                </div>
                            </div>                        
                        
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Fotografía</label>
                        </div>
                        <center>
                            @if ($docente->foto == '')
                                @if ($docente->genero == '1') <img class="rounded-circle" src="{{ asset('images/avatar-mujer.jpg')}}" width="150px" alt="">                            
                                @else <img class="rounded-circle" src="{{ asset('images/avatar-hombre.jpg')}}" width="150px" alt="">
                                @endif   
                            @else
                                <img class="rounded-circle" src="{{ route('docente.imagen', $docente->foto) }}" width="150px">
                            @endif                            
                        </center>           
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ url('docentes')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
@endsection