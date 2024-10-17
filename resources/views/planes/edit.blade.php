@extends('layouts.template')

@section('content')
<div class="content">
    <h1 class="ml-2">Editar Plan</h1>
    @include('common.messages')    {{--  mensages de session  --}}
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
                <form action="{{ url('/planes', $plan->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH')}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Denominación</label><b>*</b>
                                <input name="descripcion" type="text" value="{{ $plan->descripcion }}" 
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Importe</label>
                                <input name="importe" type="text" value="{{ $plan->importe }}" 
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Hora/s contratadas</label>
                                <input name="horas_plan" type="time" value="{{ $plan->horas_plan }}" 
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Hora/s limite</label>
                                <input name="horas_limite" type="time" value="{{ $plan->horas_limite }}" 
                                    class="form-control">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <textarea name="comentario" id="" cols="" rows="2"
                                    class="form-control" autocomplete="off">{{ $plan->comentario }}</textarea>
                            </div>
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Estado</label><b>*</b>
                                <select name="estado" class="form-control">
                                    <option value="1" {{ $plan->estado == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ $plan->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>                  
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ url('planes')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>
@endsection