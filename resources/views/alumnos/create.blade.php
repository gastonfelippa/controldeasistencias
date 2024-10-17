@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Agregar Alumno</h1>
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
                <form id="formId" action="{{ url('/alumnos')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- alumno --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombre Alumno</label><b>*</b>
                                <input value="{{ old('nombre_alumno') }}"  name="nombre_alumno" type="text"
                                    placeholder="Nombre" class="form-control text-capitalize" 
                                    required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Apellido Alumno</label><b>*</b>
                                <input value="{{ old('apellido_alumno') }}" name="apellido_alumno" type="text"
                                    placeholder="Apellido" class="form-control text-capitalize" 
                                    required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">DNI Alumno</label><b>*</b>
                                <input value="{{ old('dni') }}" name="dni" type="number" placeholder="DNI Alumno"
                                    class="form-control" 
                                    required autofocus autocomplete="off" maxlength="8">
                            </div>
                        </div>
                        <div class="col-md-2">                                    
                            <div class="form-group">
                                <label for="">Fecha Nacimiento</label><b>*</b>
                                <input value="{{ old('fecha_nacimiento') }}" name="fecha_nacimiento" type="date"
                                class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Género</label><b>*</b>
                                <select name="genero" class="form-control" id="">
                                    <option value="1" {{ old('genero') == '1' ? 'selected' : '' }}>Femenino</option>
                                    <option value="2" {{ old('genero') == '2' ? 'selected' : '' }}>Masculino</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- dirección --}}
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Domicilio</label><b>*</b>
                                        <input value="{{ old('direccion') }}" name="direccion" type="text"
                                            placeholder="Calle/N°/Piso/Dpto/Localidad" class="form-control text-capitalize">
                                    </div>
                                </div>
                                <div class="col-md-4">                                    
                                    <div class="form-group">
                                        <label for="fecha_ingreso">Fecha Ingreso</label><b>*</b>
                                        <input value="{{ old('fecha_ingreso') }}" name="fecha_ingreso" type="date"
                                        class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="salaId">Sala</label><b>*</b>
                                        <select name="salaId" class="form-control">
                                            <option value="Elegir">Elegir Sala</option>
                                            @foreach ($salas as $i)
                                                <option value="{{ $i->id }}" 
                                                    {{ old('salaId') == $i->id ? 'selected' : '' }}>
                                                    {{ $i->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="planId">Plan</label><b>*</b>
                                        <select name="planId" class="form-control">
                                            <option value="Elegir">Elegir Plan</option>
                                            @foreach ($planes as $i)
                                                <option value="{{ $i->id }}" 
                                                    {{ old('planId') == $i->id ? 'selected' : '' }}>
                                                    {{ $i->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>                        
                            </div>    
                        </div>
                        {{-- foto --}}
                        <div class="col-md-6">
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
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <textarea name="comentario" rows="2"
                                    class="form-control" autocomplete="off">{{ old('comentario')}}</textarea>
                            </div>
                        </div>
                    </div>                 
                    <hr>
                    {{-- mamá --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre_mama">Nombre Mamá</label>
                                <input value="{{ old('nombre_mama') }}" name="nombre_mama" type="text"
                                    id="nombre_mama" placeholder="Nombre"
                                    class="form-control text-capitalize" autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apellido_mama">Apellido Mamá</label>
                                <input value="{{ old('apellido_mama') }}" name="apellido_mama" type="text"
                                    id="apellido_mama" placeholder="Apellido"
                                    class="form-control text-capitalize" autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tel_mama">Teléfono Mamá</label>
                                <input value="{{ old('tel_mama') }}" name="tel_mama" type="number"
                                    id="tel_mama" class="form-control" placeholder="8888-888888">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="switchMama">Asignar a Mamá como Tutora</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="switchMama">
                                    <label class="custom-control-label" for="switchMama"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- papá --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre_papa">Nombre Papá</label>
                                <input value="{{ old('nombre_papa') }}" name="nombre_papa" type="text"
                                    id="nombre_papa" placeholder="Nombre"
                                    class="form-control text-capitalize" autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apellido_papa">Apellido Papá</label>
                                <input value="{{ old('apellido_papa') }}" name="apellido_papa" type="text"
                                    id="apellido_papa" placeholder="Apellido"
                                    class="form-control text-capitalize" autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tel_mama">Teléfono Papá</label>
                                <input value="{{ old('tel_papa') }}" name="tel_papa" type="number"
                                    id="tel_papa" class="form-control" placeholder="8888-888888">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="switchPapa">Asignar a Papá como Tutor</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="switchPapa">
                                    <label class="custom-control-label" for="switchPapa"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- tutor --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre_tutor">Nombre Tutor/a</label><b>*</b>
                                <input value="{{ old('nombre_tutor') }}" id="nombre_tutor" type="text"
                                    id="tutor_nombre_id" placeholder="Nombre" name="nombre_tutor"
                                    onchange="disableCheckbox()"
                                    class="form-control text-capitalize" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apellido_tutor">Apellido Tutor/a</label><b>*</b>
                                <input value="{{ old('apellido_tutor') }}" id="apellido_tutor" type="text"
                                    id="tutor_apellido_id" placeholder="Apellido" name="apellido_tutor"
                                    onchange="disableCheckbox()"
                                    class="form-control text-capitalize" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tel_tutor">Teléfono Tutor/a</label><b>*</b>
                                <input value="{{ old('tel_tutor') }}" id="tel_tutor" type="number"
                                    id="tel_tutor" class="form-control" name="tel_tutor"
                                    placeholder="8888-888888" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email_tutor">Email Tutor/a</label><b>*</b>
                                <input value="{{ old('email_tutor') }}" id="email_tutor" type="email"
                                    id="tel_tutor" class="form-control" name="email_tutor"
                                    placeholder="algo@mail..." required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ url('alumnos')}}" class="btn btn-secondary">Cancelar</a>
                            <button id="boton" type="submit" class="btn btn-primary">Guardar registro</button>
                        </div>                        
                        <div class="col-md-3" id="spinner" style="display: none;">
                            <img height="100px" src="{{ asset('images/spinners/spinner.gif') }}" alt="Guardando..." />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>

<script>    
    var switchMama = document.getElementById('switchMama');
    var switchPapa = document.getElementById('switchPapa');
    var image = document.getElementById('image');

    switchMama.addEventListener("change", validaCheckboxM, false);
    switchPapa.addEventListener("change", validaCheckboxP, false);
    //image.addEventListener("change", fileChoosen, false);

    function validaCheckboxM() {
        var checkedM = switchMama.checked;
        if (checkedM) {
            $('#nombre_tutor').val($('#nombre_mama').val())
            $('#apellido_tutor').val($('#apellido_mama').val())
            $('#tel_tutor').val($('#tel_mama').val())
            switchPapa.checked = false
        } else {
            $('#nombre_tutor').val('')
            $('#apellido_tutor').val('')
            $('#tel_tutor').val('')
        }
    }

    function validaCheckboxP() {
        var checkedP = switchPapa.checked;
        if (checkedP) {
            $('#nombre_tutor').val($('#nombre_papa').val())
            $('#apellido_tutor').val($('#apellido_papa').val())
            $('#tel_tutor').val($('#tel_papa').val())
            switchMama.checked = false
        } else {
            $('#nombre_tutor').val('')
            $('#apellido_tutor').val('')
            $('#tel_tutor').val('')
        }
    }

    function disableCheckbox() {
        switchMama.checked = false;
        switchPapa.checked = false;
    }

    document.getElementById('formId').addEventListener('submit', function() {
        // Mostrar el mensaje de carga
        document.getElementById('spinner').style.display = 'block';
        
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
                    document.getElementById("list").innerHTML = ['<img class="thumb thumbnail rounded-circle" src="',e.target.result,'"width="50%" title="', escape(theFile.name),'"/>'].join('');
                };
            }) (f);
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('foto').addEventListener('change',archivo, false);
</script>
@endsection

