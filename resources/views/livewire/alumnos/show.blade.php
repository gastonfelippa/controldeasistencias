@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Datos del Alumno</h1>
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
                                    <label for="">Nombres y Apellidos</label>
                                    <input name="nombre_apellido" value="{{ $alumno->nombre_apellido }}" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input name="email" value="{{ $alumno->email }}" type="email" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Teléfono</label>
                                    <input name="telefono" value="{{ $alumno->telefono }}" type="number" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha de Nacimiento</label>
                                    <input name="fecha_nacimiento" value="{{ $alumno->fecha_nacimiento }}" type="date" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <input name="edad" value="{{ $edad }}" type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Género</label>
                                    <select name="genero" class="form-control" id="" disabled>
                                        @if ($alumno->genero == 'MASCULINO' || $alumno->genero == 'masculino')
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="FEMENINO">FEMENINO</option>                                                
                                        @else
                                            <option value="FEMENINO">FEMENINO</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Dirección</label>
                                    <input name="direccion" value="{{ $alumno->direccion }}" type="text" class="form-control" disabled>
                                </div>
                            </div> 
                        </div> 
                        <div class="row">                              
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Sala</label>
                                    <input name="nivel" value="{{ $alumno->sala }}" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Plan</label>
                                    <input name="plan" value="{{ $alumno->plan }}" type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Fotografía</label>
                        </div>
                        <center>
                            @if ($alumno->fotografia == '')
                                @if ($alumno->genero == 'MASCULINO' || $alumno->genero == 'masculino')
                                    <img src="{{ asset('images/avatar-hombre.jpg')}}" width="150px" alt="">
                                @else
                                    <img src="{{ asset('images/avatar-mujer.jpg')}}" width="150px" alt="">                            
                                @endif    
                            @else
                                <img src="{{ asset('storage'.'/'.$alumno->fotografia)}}" width="150px" alt=""> 
                            @endif                            
                        </center>           
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ url('alumnos')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
@endsection