@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Datos del Aula</h1>
    <div class="col-md-12 col-sm-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Datos registrados</b></h3>
            </div>
            <div class="card-body" style="display: block;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Denominación</label>
                            <input name="descripcion" value="{{ $aula->descripcion }}" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Capacidad</label>
                            <input name="capacidad" value="{{ $aula->capacidad }}" type="number" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ url('aulas')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
@endsection