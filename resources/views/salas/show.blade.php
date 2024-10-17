@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Datos de la Sala</h1>
    <div class="col-md-12 col-sm-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Datos registrados</b></h3>
            </div>
            <div class="card-body" style="display: block;">
                {{-- <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Denominación</label>
                            <input name="nombre" value="{{ $sala->descripcion }}" type="text" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Observaciones</label>
                            <textarea name="comentario" id="" cols="" rows="2" disabled
                                class="form-control">{{ $sala->comentario }}</textarea>                        
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Denominación</label>
                            <input name="descripcion" value="{{ $sala->descripcion }}" type="text" class="form-control" disabled>
                        </div>
                    </div>                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Estado</label>
                            <input name="estado" type="text" 
                            value="{{ $sala->estado == 1 ? 'Activo' : 'Inactivo' }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Comentario</label>
                            <textarea name="comentario" id="" cols="" rows="2" disabled
                                class="form-control">{{ $sala->comentario }}</textarea> 
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ url('salas')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
@endsection