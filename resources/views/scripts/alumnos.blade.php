<script>
    function Confirm(id)
    {
        Swal.fire({
            title: 'CONFIRMAR',
            html: '¿Deseas de Eliminar el registro?' + '<br>' + 'No podrás deshacer esta acción.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('delete', id);
            }else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire('Cancelado', 'Tu registro está a salvo :)', 'error')
            }
        })
    }   

    window.onload = function() {
		Livewire.on('registroEliminado',()=>{
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Registro Eliminado!',
                text: 'Tu registro se eliminó correctamente...',
                showConfirmButton: false,
                timer: 1500
            })
		}) 
    }
</script>