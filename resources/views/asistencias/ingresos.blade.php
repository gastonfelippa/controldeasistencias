@extends('layouts.template')

@section('content')
<div class="content">
    <div class="row ml-1">
        @foreach ($fotos as $i)
            <div class="card col-sm-3 col-md-2 mr-1">   
                @if ($i->fotografia == '')
                    @if ($i->genero == 'MASCULINO' || $i->genero == 'masculino')
                        <img src="{{ asset('images/avatar-hombre.jpg')}}" class="card-img" alt="">
                    @else
                        <img src="{{ asset('images/avatar-mujer.jpg')}}" class="card-img" alt="">                            
                    @endif    
                @else
                    <img src="{{ asset('storage'.'/'.$i->fotografia)}}" class="card-img" alt="..."> 
                @endif                 
                <div class="card-body">
                    <p class="card-text"><b>{{ $i->nombre_apellido}}</b></p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection