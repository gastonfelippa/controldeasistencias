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
                                    <label for="">Nombres y Apellidos</label>
                                    <input name="nombre_apellido" value="{{ $docente->nombre_apellido }}" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input name="email" value="{{ $docente->email }}" type="email" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Teléfono</label>
                                    <input name="telefono" value="{{ $docente->telefono }}" type="number" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha de Nacimiento</label>
                                    <input name="fecha_nacimiento" value="{{ $docente->fecha_nacimiento }}" type="date" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Género</label>
                                    <select name="genero" class="form-control" id="" disabled>
                                        @if ($docente->genero == 'MASCULINO' || $docente->genero == 'masculino')
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="FEMENINO">FEMENINO</option>                                                
                                        @else
                                            <option value="FEMENINO">FEMENINO</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Institución</label>
                                    <input name="institucion" value="{{ $docente->institucion }}" type="text" class="form-control" disabled>
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Dirección</label>
                                    <input name="direccion" value="{{ $docente->direccion }}" type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Fotografía</label>
                        </div>
                        <center>
                            @if ($docente->fotografia == '')
                                @if ($docente->genero == 'MASCULINO' || $docente->genero == 'masculino')
                                    <img src="{{ asset('images/avatar-hombre.jpg')}}" width="150px" alt="">
                                @else
                                    <img src="{{ asset('images/avatar-mujer.jpg')}}" width="150px" alt="">                            
                                @endif    
                            @else
                                <img src="{{ asset('storage'.'/'.$docente->fotografia)}}" width="150px" alt=""> 
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