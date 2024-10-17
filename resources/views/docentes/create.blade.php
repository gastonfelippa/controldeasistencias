@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Agregar Docente</h1>
    @include('common.messages')    {{--  mensages de session  --}}
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
                <form id="formId" action="{{ url('/docentes')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nombre</label><b>*</b>
                                        <input name="nombre" type="text" value="{{ old('nombre')}}" 
                                            class="form-control text-capitalize" required autofocus autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Apellido</label><b>*</b>
                                        <input name="apellido" type="text" value="{{ old('apellido')}}" 
                                            class="form-control text-capitalize" required autofocus autocomplete="off">
                                    </div>
                                </div>                                                        
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Domicilio</label><b>*</b>
                                        <input name="direccion" type="text" value="{{ old('direccion')}}" 
                                            placeholder="Calle/N°/Piso/Dpto/Localidad" 
                                            class="form-control text-capitalize" autocomplete="off">
                                    </div>
                                </div>
                            </div>                        
                            <div class="row">                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fecha de Nacimiento</label><b>*</b>
                                        <input name="fecha_nacimiento" type="date" value="{{ old('fecha_nacimiento')}}" 
                                            class="form-control" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Teléfono</label><b>*</b>
                                        <input name="telefono" type="number" value="{{ old('telefono')}}" 
                                            class="form-control" required autocomplete="off">
                                    </div>
                                </div>                                 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Email</label><b>*</b>
                                        <input name="email" type="email" value="{{ old('email')}}" 
                                            class="form-control  text-lowercase" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Género</label>
                                        <select name="genero" class="form-control" id="">
                                            <option value="1" {{ old('genero') == '1' ? 'selected' : '' }}>Femenino</option>
                                            <option value="2" {{ old('genero') == '2' ? 'selected' : '' }}>Masculino</option>
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
                            <center><output id="list"></output>
                                <output id="loadingMessage" style="display: none;">
                                    <img height="100px" src="{{ asset('images/spinners/spinner.gif') }}" alt="Cargando...">
                                </output>
                            </center>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ url('docentes')}}" class="btn btn-secondary">Cancelar</a>
                            <button id="boton" type="submit" class="btn btn-primary">Guardar registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>
<script>
    document.getElementById('formId').addEventListener('submit', function() {
        // Deshabilitar el botón para evitar múltiples envíos
        var boton = document.getElementById('boton');
        boton.disabled = true;
    });
    function archivo(evt){
        var files = evt.target.files;
        const image = document.getElementById('list');
        const loadingMessage = document.getElementById('loadingMessage');
        var boton = document.getElementById('boton');
        loadingMessage.style.display = 'block';
        boton.disabled = true;
        image.style.display ="none";
        //obtenemos la imagen del campo "file".
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
                    boton.disabled = false;
                    //insertamos la imagen
                    document.getElementById("list").innerHTML = ['<img class="thumb thumbnail rounded-circle" src="',e.target.result,'"width="80%" title="', escape(theFile.name),'"/>'].join('');
                };
            }) (f);
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('foto').addEventListener('change',archivo, false);
</script>
@endsection

