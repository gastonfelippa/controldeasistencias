<div class="content">
    <h1 class="ml-2">Datos del Plan</h1>
    <div class="col-md-12 col-sm-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Datos registrados</b></h3>
            </div>
            <div class="card-body" style="display: block;">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="">Denominación</label>
                            <input name="descripcion" value="{{ $descripcion }}" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Estado</label>
                            <input name="estado" type="text" value="{{ $estado }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Importe</label>
                            <input name="importe" type="text" value="{{number_format($importe,2,',','.')}}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Hora/s contratadas</label>
                            <input name="horas_plan" type="time" value="{{ $horas_plan }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Hora/s límite</label>
                            <input name="horas_limite" type="time" value="{{ $horas_limite }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Observaciones</label>
                            <textarea name="comentario" id="" cols="" rows="2" disabled
                                class="form-control">{{ $comentario }}</textarea>                        
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ url('planes')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>