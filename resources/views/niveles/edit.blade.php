@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Editar Nivel</h1>
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
                <form action="{{ url('/niveles', $nivel->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH')}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Denominación</label><b>*</b>
                                <input name="descripcion" type="text" value="{{ $nivel->descripcion }}" 
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Aula</label><b>*</b>
                                <select name="aula" id="" class="form-control">
                                    <option value="{{ $nivel->aula_id }}">{{ $aula }}</option>
                                    @foreach ($aulas as $i)
                                        <option value="{{ $i->id }}">{{ $i->descripcion }}</option>                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Comentario</label>
                                <input name="comentario" type="text" value="{{ $nivel->comentario }}" class="form-control">
                            </div>
                        </div>
                    </div> 
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ url('niveles')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>
@endsection