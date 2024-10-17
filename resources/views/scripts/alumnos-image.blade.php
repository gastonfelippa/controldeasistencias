<script>
// Aseguramos que el script se ejecute cuando toda la página esté cargada
window.addEventListener('load', function() {
    console.log("Página cargada");

    // Seleccionamos el input por su id
    const inputField = document.getElementById('image');

    // Verificamos que el elemento exista antes de intentar agregar el evento
    if (inputField) {
        inputField.addEventListener('change', function(event) {
            console.log("Cambio en el input detectado");

            let file = event.target.files[0];

            if(file) {
                let reader = new FileReader();
                let nombreLogo = file.name; // Capturar el nombre de la imagen

                reader.onloadend = function() {
                    console.log("Archivo leído, emitiendo evento logoUpload");
                    window.livewire.emit('logoUpload', reader.result, nombreLogo);
                };

                reader.readAsDataURL(file);  // Leer el archivo como base64
            }
        });
    } else {
        console.log("No se encontró el input con id 'image'");
    }
});
</script>