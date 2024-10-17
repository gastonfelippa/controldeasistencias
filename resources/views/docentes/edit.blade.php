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
                <form id="formId" action="{{ url('/docentes', $docente->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH')}}
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nombre</label><b>*</b>
                                        <input name="nombre" type="text" value="{{ $docente->nombre }}" 
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Apellido</label><b>*</b>
                                        <input name="apellido" type="text" value="{{ $docente->apellido }}" 
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Domicilio</label><b>*</b>
                                        <input name="direccion" type="text" value="{{ $docente->direccion }}" 
                                            class="form-control" >
                                    </div>
                                </div>
                            </div>                        
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fecha de Nacimiento</label><b>*</b>
                                        <input name="fecha_nacimiento" type="date" value="{{ $docente->fecha_nacimiento }}" 
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
                                        <label for="">Email</label><b>*</b>
                                        <input name="email" type="email" value="{{ $docente->email }}" 
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Género</label>
                                        <select name="genero" class="form-control" id="">
                                            <option value="1" {{ $docente->genero == '1' ? 'selected' : '' }}>Femenino</option>
                                            <option value="2" {{ $docente->genero == '2' ? 'selected' : '' }}>Masculino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fecha de Ingreso</label><b>*</b>
                                        <input name="fecha_ingreso" type="date" value="{{ $docente->fecha_ingreso }}" 
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Estado</label><b>*</b>
                                        <select name="estado" class="form-control">
                                            <option value="1" {{ $docente->estado == 1 ? 'selected' : '' }}>Activo</option>
                                            <option value="0" {{ $docente->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Fotografía</label>
                                <input name="foto" type="file" id="foto" class="form-control">
                            </div>
                            <br>
                            <center>
                                <output id="list"></output>
                                <output id="image_back">                                
                                    @if ($docente->foto == '')
                                        @if ($docente->genero == '1') <img class="rounded-circle" src="{{ asset('images/avatar-mujer.jpg')}}" width="150px" alt="">                            
                                        @else <img class="rounded-circle" src="{{ asset('images/avatar-hombre.jpg')}}" width="150px" alt="">
                                        @endif    
                                    @else <img class="rounded-circle" src="{{ route('docente.imagen', $docente->foto) }}" width="150px">
                                    @endif 
                                </output>
                                <output id="loadingMessage" style="display: none;">
                                    <img height="100px" src="{{ asset('images/spinners/spinner.gif') }}" alt="Cargando...">
                                </output>
                            </center>                          
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <a href="{{ url('docentes')}}" class="btn btn-secondary">Cancelar</a>
                            <button id="boton" type="submit" class="btn btn-success">Actualizar registro</button>
                            {{-- <img id="loadingMessage2" style="display: none;" height="100px" src="{{ asset('images/spinners/spinner.gif') }}" alt="Cargando..."> --}}
                        </div>                     
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>
<script>
    document.getElementById('formId').addEventListener('submit', function() {
        // Mostrar el mensaje de carga
        //document.getElementById('loadingMessage2').style.display = 'block';

        // Deshabilitar el botón para evitar múltiples envíos
        var boton = document.getElementById('boton');
        boton.disabled = true;
    });
    function archivo(evt){
        var files = evt.target.files;
        const image = document.getElementById('list');
        const image_back = document.getElementById('image_back');
        const loadingMessage = document.getElementById('loadingMessage');
        var boton = document.getElementById('boton');
        loadingMessage.style.display = 'block';
        boton.disabled = true;
        image.style.display ='none';
        image_back.style.display ='block';
        //obtenemos la imagen del campo "file".
        if (this.files.length) {
            for (var i=0, f; f = files[i]; i++){
                //solo admitimos imagenes.
                if (!f.type.match('image.*')){
                    continue;
                }
                var reader = new FileReader();
                reader.onload = (function (theFile){
                    return function (e){
                        loadingMessage.style.display = 'none';
                        image.style.display = 'block';
                        image_back.style.display ='none';
                        boton.disabled = false;
                        //insertamos la imagen
                        document.getElementById("list").innerHTML = ['<img class="thumb thumbnail rounded-circle" src="',e.target.result,'"width="80%" title="', escape(theFile.name),'"/>'].join('');
                    };
                }) (f);
                reader.readAsDataURL(f);
            }
        } else {
            loadingMessage.style.display = 'none';
            image.style.display = 'none';
            image_back.style.display ='block';
            boton.disabled = false;
        }
    }
    document.getElementById('foto').addEventListener('change',archivo, false);
</script>
@endsection