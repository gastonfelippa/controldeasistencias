@extends('layouts.template')

@section('content')
<div class="content">
    @if($message = Session::get('mensaje'))
        <script>
            Swal.fire({
                title: "Buen trabajo!",
                text: "{{$message}}",
                icon: "success",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="bi bi-printer"></i></span>
                    <div class="info-box-content">
                        <form action="{{ url('reportes/asistencias')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3 col-md-3 form-group">
                                    <label for="">Alumnos</label>
                                    <select name="alumno" id="" class="form-control form-control-sm">
                                        @foreach ($alumnos as $i)
                                            <option value="{{$i->alumno_id}}">{{$i->nombre_alumno}} {{$i->apellido_alumno}}</option>
                                        @endforeach
                                    </select>
                                </div>                        
                                <div class="col-sm-3 col-md-3">
                                    <label for="">Fecha Inicio</label>
                                    <input id="fecha_inicio" type="date" name="fecha_inicio" class="form-control form-control-sm">
                                </div>
                                <div class="col-sm-3 col-md-3">
                                    <label for="">Fecha Fin</label>
                                    <input id="fecha_fin" type="date" name="fecha_fin" class="form-control form-control-sm">
                                </div>
                                <div class="col-sm-3 col-md-3">
                                    <div style="height: 35px;"></div>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        Generar Reporte
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>            
                </div> 
            </div> 
            {{-- <div class="card-body"></div> --}}
        </div>          
    </div>          
</div>

<script>
    // Obtener la fecha actual
    const hoy = new Date();

    // Formatear la fecha en formato YYYY-MM-DD
    const fechaFormateada = hoy.toISOString().split('T')[0];

    // Asignar la fecha al input
    document.getElementById('fecha_inicio').value = fechaFormateada;
    document.getElementById('fecha_fin').value = fechaFormateada;
</script>
@endsection