@extends('layouts.pdf')

@section('content')
<div >
	<h3 class="text-center">Lista de Alumnos</h3>
    <div class="card-body" style="display: block;">
        <div class="row">
            @foreach ($alumnos as $i)
                <div class="col-md-2">
                    <div class="form-group">
                        <center> 
                            <div>
                                <img src="data:image/png;base64,{{ $i->code }}" alt="QR Code">
                                {{-- <img src="data:image/png;base64,{{ $qrCodes[$alumno->id] }}" alt="QR Code"> --}}

                                {{-- <img src="data:image/svg+xml;base64,{{ base64_encode($i->code) }}"> --}}
                                {{-- <img src="data:image/svg+xml;utf8, {{ $i->code }}" /> --}}
                                {{-- {{ QrCode::size(150)->generate('www.nigmacode.com') }} --}}
                                {{-- {{ QrCode::size(150)->generate(route('alumno.qr', $i->id)) }} --}}
                                <p><b>{{ $i->nombre_alumno }} {{ $i->apellido_alumno }}</b></p>
                            </div>
                        </center>
                    </div>
                </div>
            @endforeach              
        </div>
    </div>                
</div>
@endsection