@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Alumnos Registrados</h1>
    <div class="col-md-12 col-sm-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Qr registrados</b></h3>              
                <a href="{{route('pdf.qr.all')}}" target="_blank"
                    class="btn btn-outline-danger" title="Imprimir">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" color="black" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16"><path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/><path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/></svg>
                </a>              
            </div>
            <div class="card-body" style="display: block;">
                <div class="row">
                    @foreach ($alumnos as $i)
                        <div class="col-md-2">
                            <div class="form-group">
                                <center> 
                                    <div>
                                        {{-- {{ QrCode::size(150)->generate('www.nigmacode.com') }} --}}
                                        {{ QrCode::size(150)->generate(route('alumno.qr', $i->id)) }}
                                        <p><b>{{ $i->nombre_alumno }} {{ $i->apellido_alumno }}</b></p>
                                    </div>
                                </center>
                            </div>
                        </div>
                    @endforeach              
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

