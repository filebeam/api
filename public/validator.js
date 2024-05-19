var fileInput = document.getElementById('fileInput');

fileInput.addEventListener('change', function() {
    var files = fileInput.files;
    var maxFileSize = 100 * 1024 * 1024; // Tamaño máximo permitido: 100 MB (100 * 1024 * 1024 bytes)

    for (var i = 0; i < files.length; i++) {
        var fileSize = files[i].size;

        if (fileSize > maxFileSize) {
            alert('El archivo excede el tamaño máximo permitido de 100 MB.');
            fileInput.value = ''; // Limpiar el campo de entrada de archivo
            return false; // Detener el envío del formulario
        }
    }
});
