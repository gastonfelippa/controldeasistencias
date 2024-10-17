@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Editar Sala</h1>
    @include('common.messages')
    <div class="col-md-12 col-sm-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Completar datos</b></h3>
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <li>{{ $error }}</li>
                    </div>
                @endforeach
            </div>
            <div class="card-body" style="display: block;">
                <form action="{{ url('/salas', $sala->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH')}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Denominación</label><b>*</b>
                                <input type="text" name="descripcion" value="{{ $sala->descripcion }}"
                                    class="form-control" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Estado</label><b>*</b>
                                <select name="estado" class="form-control">
                                    <option value="1" {{ $sala->estado == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ $sala->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <textarea name="comentario" rows="2" class="form-control" 
                                    autocomplete="off">{{ $sala->comentario }}</textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ url('salas')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>
@endsection