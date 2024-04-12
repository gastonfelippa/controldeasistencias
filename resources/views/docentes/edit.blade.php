@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Editar Docente</h1>
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
                <form action="{{ url('/docentes', $docente->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH')}}
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nombres y Apellidos</label><b>*</b>
                                        <input name="nombre_apellido" type="text" value="{{ $docente->nombre_apellido }}" 
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Email</label><b>*</b>
                                        <input name="email" type="email" value="{{ $docente->email }}" 
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Teléfono</label><b>*</b>
                                        <input name="telefono" type="number" value="{{ $docente->telefono }}" 
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fecha de Nacimiento</label><b>*</b>
                                        <input name="fecha_nacimiento" type="date" value="{{ $docente->fecha_nacimiento }}" 
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Género</label>
                                        <select name="genero" class="form-control" id="">
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
                                        <label for="">Institución</label><b>*</b>
                                        <input name="institucion" type="text" value="{{ $docente->institucion }}" 
                                            class="form-control" required>
                                    </div>
                                </div>                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Dirección</label><b>*</b>
                                        <input name="direccion" type="text" value="{{ $docente->direccion }}" 
                                            class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Fotografía</label>
                                <input name="fotografia" type="file" id="file" class="form-control">
                            </div>
                            <center>
                                <output id="list">
                                    @if ($docente->fotografia == '')
                                    @if ($docente->genero == 'MASCULINO' || $docente->genero == 'masculino')
                                            <img src="{{ asset('images/avatar-hombre.jpg')}}" width="150px" alt="">
                                        @else
                                            <img src="{{ asset('images/avatar-mujer.jpg')}}" width="150px" alt="">                            
                                        @endif    
                                    @else
                                        <img src="{{ asset('storage'.'/'.$docente->fotografia)}}" width="150px" alt=""> 
                                    @endif 
                                </output>
                            </center>
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
                            <a href="{{ url('docentes')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>
@endsection