@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Egreso de Alumnos</h1>   
    <video id="preview" style="display: none;" width="30%"></video>    
    @if($message = Session::get('mensaje'))
        <script>
            Swal.fire({
                title: "{{$message[0]}}",
                html: `{{$message[1]}} <b> {{$message[2]}} </b> <br>
                    {{$message[3]}} <b> {{$message[4]}}</b> `,
                icon: "success",
                showConfirmButton: true
            });
        </script>
    @endif
    <div class="col-md-12 col-sm-6">
        <div class="card card-outline card-success">
            <div class="card-header">
                <div class="row"> 
                    <div class="col-md-8 col-sm-12 mb-2">
                        <form action="{{ route('asistencia.egresoSearch')}}" method="get">
                        @csrf
                            <div class="input-group">
                                <input class="form-control" type="text" name="search" placeholder="Ingrese el Alumno a Buscar...">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <button class="btn btn-primary mr-1" id="startScanner">Egreso QR</button>
                        <a href="{{ url('asistencias')}}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                <div class="row ml-1">
                    @foreach ($fotos as $i)
                        <div class="card mx-3" style="width: 18rem;">   
                            <form action="{{ url('/asistencias')}}" method="POST">
                                @csrf
                                <div class="card-body text-center">
                                    @if ($i->foto == '')
                                        @if ($i->genero == '1') <img class="rounded-circle" src="{{ asset('images/avatar-nena.jpg')}}" height="150px" alt="">                            
                                        @else <img class="rounded-circle" src="{{ asset('images/avatar-nene.jpg')}}" height="150px" alt="">
                                        @endif    
                                    @else <img class="rounded-circle" src="{{ route('alumno.imagen', $i->foto) }}" height="150px" width="150px" alt="...">
                                    @endif 
                                </div>
                                <div class="card-body text-center">                    
                                    <input type="hidden" name="asistencia" value="0">
                                    <input type="hidden" name="alumnoId" value="{{$i->id}}">
                                    <button class="btn btn-outline-dark btn-sm" type="submit">
                                    {{ $i->nombre_alumno}} {{ $i->apellido_alumno}}</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>    
    $('#startScanner').click(function() {
        $.ajax({
            url: '{{ route("asistencia.accion") }}', // Ruta que apuntará al controlador
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // CSRF token para seguridad
                newValue: '0' // El valor que deseas enviar
            },
            success: function(response) {
                console.log('Variable actualizada: ', response);
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });
    
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    let isScanning = false;
    
    scanner.addListener('scan', function (content) {
        console.log(content);
        // Realiza la acción que necesites, como redirigir o grabar asistencia
        window.location.reload = content; // Ejemplo si el QR contiene una URL
    });
    
    document.getElementById('startScanner').addEventListener('click', function () {
        if (!isScanning) {            
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    // Buscar la cámara trasera
                    let backCamera = cameras.find(camera => camera.name.toLowerCase().includes('back'));
                    // Si hay una cámara trasera disponible, usarla, sino usar la primera cámara disponible
                    if (backCamera) {
                        scanner.start(backCamera);
                    } else {
                        scanner.start(cameras[0]);
                    }
                    document.getElementById('preview').style.display = 'block'; // Muestra el video
                    isScanning = true;
                } else {
                    console.log('No cameras found.');
                }
            }).catch(function (e) {
                console.log('error');
            });
        }
    });
</script>

@endsection