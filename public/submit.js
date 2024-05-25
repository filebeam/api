function uploadFile(event) {

    var formData = new FormData();
    var file = document.getElementById('fileInput').files[0];
    formData.append('file', file);
    $('#output').html("<b>Subiendo...</b>");
    uploadBtn.disabled = true;

    $.ajax({
        url: '/api', // URL del script de servidor que maneja la carga del archivo
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('#output').html('<b>' + 'Archivo subido correctamente: <br/><a href="' + response + '">' + response + '</a>' + '</b>');
            fileInput.value = ''; // Limpia el archivo seleccionado
            uploadIcon.classList.remove('hidden');
            fileIcon.classList.add('hidden');
            icon.classList.remove('spin');
            uploadBtn.disabled = true;
            dragDropArea.querySelector('span').textContent = 'Arrastre y suelte un archivo aquí o haga clic para seleccionar';

        },
        error: function(jqXHR, textStatus, errorMessage) {
            var responseText = jqXHR.responseText
            $('#output').html('<b>' + 'Error al subir el archivo: ' + responseText + '</b>');
            fileInput.value = ''; // Limpia el archivo seleccionado
            uploadIcon.classList.remove('hidden');
            fileIcon.classList.add('hidden');
            icon.classList.remove('spin');
            uploadBtn.disabled = true;
            dragDropArea.querySelector('span').textContent = 'Arrastre y suelte un archivo aquí o haga clic para seleccionar';
        }
    });
}
