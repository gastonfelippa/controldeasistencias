@extends('layouts.template')

@section('content')
<div class="content ml-2">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">        
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Ingresos</h3>
                    <p>Alumnos</p>
                </div>
                <div class="icon" style="display: block">
                    <i class="bi bi-people"></i>
                </div>
                <a href="{{ route('asistencia.ingreso') }}" class="small-box-footer mt-2">
                    Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">        
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Egresos</h3>
                    <p>Alumnos</p>
                </div>
                <div class="icon" style="display: block">
                    <i class="bi bi-people"></i>
                </div>
                <a href="{{ route('asistencia.egreso') }}" class="small-box-footer mt-2">
                    Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>   
</div> 
@endsection