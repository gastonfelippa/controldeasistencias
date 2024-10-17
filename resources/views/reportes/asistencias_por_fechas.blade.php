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
                            <div class="row">
                                <div class="col-sm-3 col-md-3 form-group">
                                    <label for="">Alumno</label>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{$alumno->nombre_alumno}} {{$alumno->apellido_alumno}}" disabled>
                                </div>                        
                                <div class="col-sm-2 col-md-2">
                                    <label for="">Fecha Inicio</label>
                                    <input type="date" value="{{ $fecha_inicio}}" class="form-control form-control-sm" disabled>
                                </div>
                                <div class="col-sm-2 col-md-2">
                                    <label for="">Fecha Fin</label>
                                    <input type="date" value="{{ $fecha_fin}}" class="form-control form-control-sm" disabled>
                                </div>
                                <div class="col-sm-3 col-md-3 form-group">
                                    <label for="">Total Horas</label>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{$total}}" disabled>
                                </div> 
                                <div class="col-sm-2 col-md-2">
                                    <div style="height: 35px;"></div>
                                    <a href="{{ url('reportes')}}" class="btn btn-primary btn-sm">Nueva búsqueda</a>
                                </div>
                            </div>
                    </div>            
                </div> 
            </div>               
            <div class="card-body" style="display: block;">                
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Día</th>
                            <th class="text-center">Hora Entrada</th>
                            <th class="text-center">Hora Salida</th>
                            <th class="text-center">Permanencia</th>
                            <th class="text-center">Notas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reporte as $i)
                        <tr>
                            <td class="text-center">{{ $i->fecha}}</td>
                            <td class="text-center">{{ $i->hora_entrada}}</td>
                            <td class="text-center">{{ $i->hora_salida}}</td>
                            @if ($i->limite_superado)
                                <td class="text-center" style="font-weight: bold; color:red;">{{ $i->permanencia}}</td>
                            @else
                                <td class="text-center">{{ $i->permanencia}}</td>
                            @endif 
                            @if ($i->comentario)
                                <td class="text-center">
                                    <i class="bi bi-chat-text icono" data-toggle="tooltip" data-placement="top"
                                        title="{{ $i->comentario }}"></i>
                                </td> 
                            @else
                                <td class="text-center">
                                    <i class="bi bi-chat" data-toggle="tooltip" data-placement="top"
                                        title="Sin comentarios"></i>
                                </td> 
                            @endif                                                  
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>        
        </div>          
    </div>          
</div>
<style type="text/css" scoped>
    .icono {
        color: red;
        cursor: pointer;
        font-weight: bold;
    }
</style>
@endsection