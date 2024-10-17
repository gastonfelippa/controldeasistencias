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
                {{-- alumno --}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Nombre Alumno</label>
                            <input value="{{ $alumno->nombre_alumno }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Apellido Alumno</label>
                            <input value="{{ $alumno->apellido_alumno }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">DNI Alumno</label>
                            <input value="{{ $alumno->dni }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-2"> 
                        <div class="form-group">
                            <label for="">Fecha de Nacimiento</label>
                            <input value="{{ $alumno->fecha_nacimiento }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Género</label>
                            <input value="{{ $alumno->genero == 1 ? 'Femenino' : 'Masculino' }}" 
                                class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- dirección --}}
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Dirección</label>
                                    <input value="{{ $alumno->direccion }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">                                    
                                <div class="form-group">
                                    <label for="fecha_ingreso">Fecha Ingreso</label>
                                    <input value="{{ $alumno->fecha_ingreso }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="salaId">Sala</label>
                                    <input value="{{ $alumno->sala }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="planId">Plan</label>
                                    <input value="{{ $alumno->plan }}" class="form-control" disabled>
                                </div>
                            </div>                        
                        </div>    
                    </div>
                    {{-- foto --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Fotografía</label>
                            <center>                            
                                @if ($alumno->foto == '')
                                    @if ($alumno->genero == '1') <img class="rounded-circle" src="{{ asset('images/avatar-niña.jpg')}}" width="150px" alt="">                            
                                    @else <img class="rounded-circle" src="{{ asset('images/avatar-niño.jpg')}}" width="150px" alt="">
                                    @endif    
                                @else <img class="rounded-circle" src="{{ route('alumno.imagen', $alumno->foto) }}" width="150px">
                                @endif 
                            </center> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Código QR</label>
                            <center> 
                                <div>
                                    {{-- {{ QrCode::size(150)->generate('www.nigmacode.com') }} --}}
                                    {{ QrCode::size(150)->generate(route('alumno.qr', $alumno->id)) }}
                                </div>
                            </center>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Observaciones</label>
                            <textarea class="form-control" disabled>{{ $alumno->comentario }}</textarea>
                        </div>
                    </div>
                </div>                 
                <hr>
                {{-- mamá --}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nombre_mama">Nombre Mamá</label>
                            <input value="{{ $alumno->nombre_mama }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="apellido_mama">Apellido Mamá</label>
                            <input value="{{ $alumno->apellido_mama }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tel_mama">Teléfono Mamá</label>
                            <input value="{{ $alumno->tel_mama }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <hr>
                {{-- papá --}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nombre_papa">Nombre Papá</label>
                            <input value="{{ $alumno->nombre_papa }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="apellido_papa">Apellido Papá</label>
                            <input value="{{ $alumno->apellido_papa }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tel_mama">Teléfono Papá</label>
                            <input value="{{ $alumno->tel_papa }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <hr>
                {{-- tutor --}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nombre_tutor">Nombre Tutor/a</label>
                            <input value="{{ $alumno->nombre_tutor }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="apellido_tutor">Apellido Tutor/a</label>
                            <input value="{{ $alumno->apellido_tutor }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tel_tutor">Teléfono Tutor/a</label>
                            <input value="{{ $alumno->tel_tutor }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email_tutor">Email Tutor/a</label>
                            <input value="{{ $alumno->email_tutor }}" class="form-control" disabled>
                        </div>
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

