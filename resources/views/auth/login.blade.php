@extends('layouts.app')

@section('content')
<div class="container-fluid" >
    <div class="row" id="div2">
        <div class="col-md-6 col-sm-12 left" id="div1">      
            <img src="{{ asset('images/login.png')}}" height="200px" alt="">      
        </div>
        <div class="col-md-6 col-sm-12 right" id="div1">
            <div class="col-md-8 col-sm-12">
                <h1 class="text-center my-4"><b>{{ config('app.name', 'Floki|Control')}}</b></h1>
                <!-- <p class="centrado"><img src="images/logo_floki_rojo.png" height="130" alt="image"></p> -->
                <div class="card">
                    <div class="card-header">Ingreso</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" 
                                        name="username" value="{{ old('username') }}" required autofocus placeholder="USUARIO">
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                            name="password" required autocomplete="current-password" placeholder="CONTRASEÑA">             
                                        <div class="input-group-append">
                                            <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> 
                                                <span class="fa fa-eye-slash icon"></span> 
                                            </button>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{('INGRESAR') }}
                                    </button>    
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Olvidaste tu contraseña?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection

<style type="text/css" scoped>
    .left {
        background-color: brown !important;
    }
    .right {
        background-color: rgb(141, 189, 178) !important;
    }

    body h1 {
         color: white;
    }
    #div1{
        display:flex;
        justify-content: center;
        align-items: center;
    }
    #div2{
        height:100%;
        width: 100%;
    }

</style>

<script type="text/javascript">
    function mostrarPassword(){
        var cambio = document.getElementById("password");
        if(cambio.type == "password"){
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }else{
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }  

    $(document).ready(function(){
        var height = $(window).height();
        $('#div2').height(height);
    });
</script>

