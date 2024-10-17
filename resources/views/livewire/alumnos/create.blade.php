<div class="content">
    <h1 class="ml-2">@if($selected_id) Editar Alumno @else Agregar Alumno @endif</h1>    
    @if($recuperar_registro)
        @include('common.recuperarRegistro')
    @else
        <div class="col-md-12 col-sm-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Completar datos</b></h3>
                    @include('common.errors')
                </div>
                <div class="card-body" style="display: block;">
                {{-- <form wire:submit.prevent="save" enctype="multipart/form-data"> --}}
                    {{-- alumno --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombre Alumno</label><b>*</b>
                                <input wire:model="nombre_alumno"  name="nombre_alumno" type="text"
                                    placeholder="Nombre" class="form-control text-capitalize" 
                                    required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Apellido Alumno</label><b>*</b>
                                <input wire:model="apellido_alumno" name="apellido_alumno" type="text"
                                    placeholder="Apellido" class="form-control text-capitalize" 
                                    required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">DNI Alumno</label><b>*</b>
                                <input wire:model="dni" name="dni" type="number" placeholder="DNI Alumno"
                                    class="form-control" 
                                    required autofocus autocomplete="off" maxlength="8">
                            </div>
                        </div>
                        <div class="col-md-2">                                    
                            <div class="form-group">
                                <label for="">Fecha Nacimiento</label><b>*</b>
                                <input wire:model="fecha_nacimiento" name="fecha_nacimiento" type="date"
                                class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Género</label><b>*</b>
                                <select wire:model="genero" class="form-control">
                                    <option value="1">Femenino</option>
                                    <option value="2">Masculino</option>
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
                                        <label for="">Dirección</label><b>*</b>
                                        <input wire:model="direccion" name="direccion" type="text"
                                            placeholder="Calle/N°/Piso/Dpto/Localidad" class="form-control text-capitalize">
                                    </div>
                                </div>
                                <div class="col-md-4">                                    
                                    <div class="form-group">
                                        <label for="fecha_ingreso">Fecha Ingreso</label><b>*</b>
                                        <input wire:model="fecha_ingreso" name="fecha_ingreso" type="date"
                                        class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="salaId">Sala</label><b>*</b>
                                        <select wire:model="sala_id" name="salaId" class="form-control">
                                            <option value="Elegir">Elegir Sala</option>
                                            @foreach ($salas as $i)
                                                <option value="{{ $i->id }}">{{ $i->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="planId">Plan</label><b>*</b>
                                        <select wire:model="plan_id" name="planId" class="form-control">
                                            <option value="Elegir">Elegir Plan</option>
                                            @foreach ($planes as $i)
                                                <option value="{{ $i->id }}">{{ $i->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>                        
                            </div>    
                        </div>
                        {{-- foto --}}
                        <div class="col-md-6">
                            <div class="row">
                                <div>
                                    <input type="file" id="image" class="form-control" wire:model="image" accept="image/x-png, image/gif, image/jpeg">
                                    
                                    @error('image') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                @if ($logo_nuevo)
                                    <div class="form-group col-sm-12 col-md-4 text-center">
                                        <img class="rounded-circle" src="{{$logo_nuevo}}" height="100px">
                                    </div>    
                                @endif
                            </div> 
                        </div>
                    </div>                  
                    <hr>
                    {{-- mamá --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre_mama">Nombre Mamá</label>
                                <input wire:model="nombre_mama" id="nombre_mama" type="text"
                                    id="tutor_nombre_mama" placeholder="Nombre"
                                    class="form-control text-capitalize" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apellido_mama">Apellido Mamá</label>
                                <input wire:model="apellido_mama" id="apellido_mama" type="text"
                                    id="tutor_apellido_mama" placeholder="Apellido"
                                    class="form-control text-capitalize" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tel_mama">Teléfono Mamá</label>
                                <input wire:model="tel_mama" id="tel_mama" type="number"
                                    id="tel_mama" class="form-control" placeholder="8888-888888" required>
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
                                <input wire:model="nombre_papa" id="nombre_papa" type="text"
                                    id="tutor_nombre_papa" placeholder="Nombre"
                                    class="form-control text-capitalize" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apellido_papa">Apellido Papá</label>
                                <input wire:model="apellido_papa" id="apellido_papa" type="text"
                                    id="tutor_apellido_papa" placeholder="Apellido"
                                    class="form-control text-capitalize" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tel_mama">Teléfono Papá</label>
                                <input wire:model="tel_papa" id="tel_papa" type="number"
                                    id="tel_papa" class="form-control" placeholder="8888-888888" required>
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
                                <input wire:model="nombre_tutor" id="nombre_tutor" type="text"
                                    id="tutor_nombre_id" placeholder="Nombre"
                                    onchange="disableCheckbox()"
                                    class="form-control text-capitalize" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apellido_tutor">Apellido Tutor/a</label><b>*</b>
                                <input wire:model="apellido_tutor" id="apellido_tutor" type="text"
                                    id="tutor_apellido_id" placeholder="Apellido"
                                    onchange="disableCheckbox()"
                                    class="form-control text-capitalize" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tel_tutor">Teléfono Tutor/a</label><b>*</b>
                                <input wire:model="tel_tutor" id="tel_tutor" type="number"
                                    id="tel_tutor" class="form-control" placeholder="8888-888888" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email_tutor">Email Tutor/a</label><b>*</b>
                                <input wire:model="email_tutor" id="email_tutor" type="email"
                                    id="tel_tutor" class="form-control" placeholder="algo@mail..." required>
                            </div>
                        </div>
                    </div>
                    <hr>
                   
                    {{-- botones --}}
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ url('alumnos') }}" class="btn btn-secondary">Cancelar</a>
                            <button wire:click.prevent="save()" type="button" class="btn btn-primary">
                                Guardar registro</button>
                            {{-- <button type="submit" class="btn btn-primary">
                                Guardar registro</button> --}}
                        </div>
                    </div>
                {{-- </form> --}}
                </div>
            </div>
        </div>
    @endif  
    @include('scripts.alumnos-image')     
</div>

<style type="text/css" scoped>
    /*Primero la vista por defecto*/
    .w100 {
        width: 110px;
        padding-left: 7.5px;
        padding-right: 7.5px;

    }

    .w300 {
        width: 300px;
        padding-left: 7.5px;
        padding-right: 7.5px;

    }

    /*Una vez alcance los 768px se realiza el cambio por defecto*/
    @media screen and (max-width: 767px) {
        .w100 {
            width: 100%;
            padding-left: 7.5px;
            padding-right: 7.5px;
        }

        .w300 {
            width: 100%;
            padding-left: 7.5px;
            padding-right: 7.5px;
        }
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
 
</script>
