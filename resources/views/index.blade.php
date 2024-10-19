@extends('layouts.template')

@section('content')
@can('Permisos_index')
<div class="content ml-2">
    <div class="row">
        <div class="col-lg-3 col-6">        
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $alumnos }}</h3>
                    <p>Alumnos</p>
                </div>
                <div class="icon">
                    <i class="bi bi-people"></i>
                </div>
                <a href="{{ url('alumnos') }}" class="small-box-footer mt-2">
                Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">        
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $docentes }}</h3>
                    <p>Docentes</p>
                </div>
                <div class="icon">
                    <i class="bi bi-people"></i>
                </div>
                <a href="{{ url('docentes') }}" class="small-box-footer mt-2">
                Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">        
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $usuarios }}</h3>
                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="bi bi-people"></i>
                </div>
                <a href="{{ url('usuarios') }}" class="small-box-footer mt-2">
                Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>   
</div> 
@endcan
@endsection