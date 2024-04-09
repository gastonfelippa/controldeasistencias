@extends('layouts.template')

@section('content')
<div class="content ml-2">
    <h1>Agregar Alumnos</h1>
    <div class="col-md-12 col-sm-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Completar datos</b></h3>
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <li>{{ $error }}</li>
                    </div>
                @endforeach
                <div class="card-tools">
                    <a href="{{ url('/alumnos/create')}}" class="btn btn-primary">
                        <i class="bi bi-file-plus"></i>
                        Agregar nuevo alumno
                    </a>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                <form action="{{ url('/alumnos')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nombres y Apellidos</label><b>*</b>
                                        <input name="nombre_apellido" type="text" value="{{ old('nombre_apellido')}}" 
                                            class="form-control" required>
                                        {{-- @error('nombre_apellido')
                                            <small style="color: red;">* Este campo no puede ser nulo</small>                                    
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Email</label><b>*</b>
                                        <input name="email" type="email" value="{{ old('email')}}" 
                                            class="form-control" required>
                                        {{-- @error('email')
                                            <small style="color: red;">* Este campo no puede ser nulo</small>                                    
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Teléfono</label><b>*</b>
                                        <input name="telefono" type="number" value="{{ old('telefono')}}" 
                                            class="form-control" required>
                                        {{-- @error('telefono')
                                            <small style="color: red;">* Este campo no puede ser nulo</small>                                    
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fecha de Nacimiento</label><b>*</b>
                                        <input name="fecha_nacimiento" type="date" value="{{ old('fecha_nacimiento')}}" 
                                            class="form-control" required>
                                        {{-- @error('fecha_nacimiento')
                                            <small style="color: red;">* Este campo no puede ser nulo</small>                                    
                                        @enderror --}}
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Género</label>
                                        <select name="genero" class="form-control" id="">
                                            <option value="FEMENINO">FEMENINO</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Institución</label><b>*</b>
                                        <input name="institucion" type="text" value="{{ old('institucion')}}" 
                                            class="form-control" required>
                                        {{-- @error('institucion')
                                            <small style="color: red;">* Este campo no puede ser nulo</small>                                    
                                        @enderror --}}
                                    </div>
                                </div>                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Dirección</label><b>*</b>
                                        <input name="direccion" type="text" value="{{ old('direccion')}}" 
                                            class="form-control" >
                                        {{-- @error('direccion')
                                            <small style="color: red;">* Este campo no puede ser nulo</small>                                    
                                        @enderror --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Fotografía</label>
                                <input name="fotografia" type="file" id="file" class="form-control">
                            </div>
                            <br>
                            <center><output id="list"></output></center>
                            <script>
                                function archivo(evt){
                                    var files = evt.target.files;
                                    //obtenemos la imagen del campo "file".
                                    for (var i=0, f; f = files[i]; i++){
                                        //solo admitimos imagenes.
                                        if (!f.type.match('image.*')){
                                            continue;
                                        }
                                        var reader = new FileReader();
                                        reader.onload = (function (theFile){
                                            return function (e){
                                                //insertamos la imagen
                                                document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result,'"width="50%" title="', escape(theFile.name),'"/>'].join('');
                                            };
                                        }) (f);
                                        reader.readAsDataURL(f);
                                    }

                                }
                                document.getElementById('file').addEventListener('change',archivo, false);
                            </script>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>
@endsection