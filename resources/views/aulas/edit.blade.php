@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Editar Aula</h1>
    <div class="col-md-12 col-sm-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><b>Completar datos</b></h3>
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <li>{{ $error }}</li>
                    </div>
                @endforeach
            </div>
            <div class="card-body" style="display: block;">
                <form action="{{ url('/aulas', $aula->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH')}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Denominación</label><b>*</b>
                                <input name="descripcion" type="text" value="{{ $aula->descripcion }}" 
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="">Capacidad</label>
                                <input name="capacidad" type="number" value="{{ $aula->capacidad }}" 
                                    class="form-control">
                            </div>
                        </div>
                    </div> 
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ url('aulas')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>
@endsection