@if($message = Session::get('mensaje_ok'))
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
@if($message = Session::get('mensaje_info'))
    <script>
        Swal.fire({
            title: "Atención!!",
            text: "{{$message}}",
            icon: "info",
            showConfirmButton: true,
            confirmButtonText: 'Continuar'
        });
    </script>
@endif
@if($message = Session::get('mensaje_error'))
    <script>
        Swal.fire({
            title: "Atención!!",
            text: "{{$message}}",
            icon: "info",
            showConfirmButton: true,
            confirmButtonText: 'Continuar'
        });
    </script>
@endif