@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Agregar Plan</h1>
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
                <form action="{{ url('/planes')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Denominación</label><b>*</b>
                                <input name="descripcion" type="text" value="{{ old('descripcion')}}" 
                                    class="form-control text-capitalize" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Importe</label>
                                <input name="importe" type="text" value="{{ old('importe')}}" 
                                class="form-control" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Hora/s contratadas</label>
                                <input name="horas_plan" type="time" value="{{ old('horas_plan')}}" 
                                class="form-control" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Hora/s límite</label>
                                <input name="horas_limite" type="time" value="{{ old('horas_limite')}}" 
                                class="form-control" required autofocus autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <textarea name="comentario" id="" cols="" rows="2"
                                    class="form-control" autocomplete="off">{{ old('comentario')}}</textarea>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ url('planes')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>
@endsection