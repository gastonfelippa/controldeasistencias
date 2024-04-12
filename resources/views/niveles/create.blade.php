@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Agregar Nivel</h1>
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
                <form action="{{ url('/niveles')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Denominación</label><b>*</b>
                                <input name="descripcion" type="text" value="{{ old('descripcion')}}" 
                                    class="form-control" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Aula</label><b>*</b>
                                <select name="aula" id="" class="form-control">
                                    <option value="Elegir">Elegir Aula</option>
                                    @foreach ($aulas as $i)
                                        <option value="{{ $i->id }}">{{ $i->descripcion }}</option>                                        
                                    @endforeach
                                </select>
                                {{-- <input name="aula" type="text" value="{{ old('descripcion')}}" 
                                    class="form-control" required autofocus autocomplete="off"> --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Comentario</label>
                                <textarea name="comentario" id="" cols="" rows="2"
                                    value="{{ old('comentario')}}" class="form-control" autocomplete="off">
                                </textarea>
                                {{-- <script>
                                    CKEDITOR.replace('comentario');
                                </script> --}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ url('niveles')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>
@endsection