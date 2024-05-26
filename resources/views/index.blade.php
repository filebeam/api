<!DOCTYPE html>
<html>
<head>
	<title>FILEBEAM</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="assets/css/index.css">
	<meta property="og:title" content="FileBeam">
    <meta property="og:description" content="Comparte archivos rapidamente mediante enlaces directos">
    <meta property="og:url" content="filebeam.xyz">
    <meta property="og:type" content="website">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
	<img src="assets/favicon.ico">
	<h1>Subir un archivo</h1>

	<form class="fileForm" method="POST" enctype="multipart/form-data">
		<div id="dragDropArea">
			<svg class="upload-icon secondary" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
				<path
					d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39V392c0 13.3 10.7 24 24 24s24-10.7 24-24V257.9l39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z">
			</svg>
			<svg class="file-icon secondary hidden" xmlns="http://www.w3.org/2000/svg" height="1em"
				viewBox="0 0 384 512">
				<path
					d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z" />
			</svg>
			<span class="secondary">Arrastre y suelte un archivo aquí o haga clic para seleccionar</span>
			<span class="secondary"><strong>Tamaño maximo permitido: 150MB</strong></span>
			<input type="file" id="fileInput" name="file"/>
		</div>
		<div id="output">
		<script src="submit.js"></script>
		</div>
		<button disabled id="uploadBtn" type="button" name="uploadBtn" value="Subir" onClick="uploadFile()">
			<span class="nf-icon">󰅧</span> Subir
		</button>
		<button class="hidden" id="gdpsBtn" name="gdpsBtn">
			<span class="nf-icon">󰌹</span> Copiar y subir al GDPS
		</button>
	</form>
	<div class="disclaimer">
		<p class="secondary">Ahora el limite de subida es de 150 MB</p>
		<p class="secondary">Al usar este sitio web, aceptas haber leido el <a href="/disclaimer">disclaimer</a></p>
		<p class="secondary">FILEBEAM v1.1.1</p>
	</div>

	<script src="index.js"></script>
	<script src="validator.js"></script>

</body>

</html>