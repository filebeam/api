var dragDropArea = document.getElementById('dragDropArea');
var uploadIcon = document.querySelector('.upload-icon');
var fileInput = document.getElementById('fileInput');
var uploadBtn = document.getElementById("uploadBtn");
var fileIcon = document.querySelector('.file-icon');
var fileForm = document.querySelector('.fileForm');
var icon = document.querySelector('body img');
var mousePos = { x: 0, y: 0 };
var isTrackingMouse = false;
var isTilting = false;
var tiltX = 0;
var tiltY = 0;

/* ------------------------ Efecto de perspectiva 3D ------------------------ */

function updateTilt() {
	var rect = dragDropArea.getBoundingClientRect();
	var centerX = rect.left + rect.width / 2;
	var centerY = rect.top + rect.height / 2;
	var dx = mouseX - centerX;
	var dy = mouseY - centerY;
	tiltX = dy * 0.06; // Sensibilidad en el eje X
	tiltY = -dx * 0.02; // Sensibilidad en el eje Y

	dragDropArea.style.transform = 'perspective(1000px) rotateX(' + tiltX + 'deg) rotateY(' + tiltY + 'deg)';

	if (isTilting) {
		requestAnimationFrame(updateTilt);
	}
}

function handleMouseMove(e) {
	mouseX = e.clientX;
	mouseY = e.clientY;

	if (!isTilting) {
		isTilting = true;
		requestAnimationFrame(updateTilt);
	}
}

function disableTiltEffect() {
	isTilting = false;
	dragDropArea.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
}

fileForm.addEventListener('mousemove', handleMouseMove);

dragDropArea.addEventListener('dragover', function (e) {
	e.preventDefault();
	var rect = dragDropArea.getBoundingClientRect();
	mouseX = e.clientX;
	mouseY = e.clientY;

	if (!isTilting) {
		isTilting = true;
		requestAnimationFrame(updateTilt);
	}
});

fileForm.addEventListener('mouseleave', disableTiltEffect);

// Desactiva el efecto si no cuenta con mouse
if (!window.matchMedia('(pointer: fine)').matches) {
	fileForm.removeEventListener('mousemove', handleMouseMove);
	dragDropArea.removeEventListener('dragover', function (e) {
		e.preventDefault();
	});
	fileForm.removeEventListener('mouseleave', disableTiltEffect);
}

/* ------------------ Efecto de glow en el boton de subida ------------------ */

uploadBtn.addEventListener("mousemove", function (e) {
	mousePos.x = e.clientX;
	mousePos.y = e.clientY;

	if (!isTrackingMouse) {
		isTrackingMouse = true;
		requestAnimationFrame(trackMouse);
	}
});

function trackMouse() {
	var rect = uploadBtn.getBoundingClientRect();
	var x = mousePos.x - rect.left;
	var y = mousePos.y - rect.top;

	uploadBtn.style.setProperty("--x", x + "px");
	uploadBtn.style.setProperty("--y", y + "px");

	isTrackingMouse = false;
}

/* -------------------------------------------------------------------------- */

// Detectar si se esta arrastrando dentro del area de arrastre
dragDropArea.addEventListener('dragenter', function (e) {
	e.preventDefault();
	dragDropArea.classList.add('dragover');
	icon.classList.add('spin');
});

// Aplica los estilos correspondientes al arrastrar
dragDropArea.addEventListener('dragover', function (e) {
	e.preventDefault();
	dragDropArea.classList.add('dragover');
});

// Detectar si el arrastre sale del area de arrastre
dragDropArea.addEventListener('dragleave', function (e) {
	e.preventDefault();
	var rect = dragDropArea.getBoundingClientRect();
	var mouseX = e.clientX;
	var mouseY = e.clientY;

	if (mouseX < rect.left || mouseX > rect.right || mouseY < rect.top || mouseY > rect.bottom) {
		dragDropArea.classList.remove('dragover');
		icon.classList.remove('spin');
	}
});

// Al soltar el archivo
dragDropArea.addEventListener('drop', function (e) {
	e.preventDefault();
	dragDropArea.classList.remove('dragover');
	var files = e.dataTransfer.files;
	fileInput.files = files;
	fileInput.dispatchEvent(new Event('change')); // El archivo cambio, ejecutar el evento 'change' manualmente
});

// Abrir dialogo de archivos al pulsar sobre la caja de arrastre
dragDropArea.addEventListener('click', function () {
	fileInput.click();
});

window.addEventListener('focus', function () {
	if (!fileInput.files.length > 0) {
		uploadIcon.classList.remove('hidden');
		fileIcon.classList.add('hidden');
		icon.classList.remove('spin');
	}
});


// Actualiza los detalles del archivo, iconos y aplica los estilos correspondientes
fileInput.addEventListener('change', function () {
	if (fileInput.files.length > 0) {
		var fileSize = fileInput.files[0].size;
		if (fileSize <= 104857600) { // Limite de tamaño de 100MB
			dragDropArea.querySelector('span').textContent = fileInput.files[0].name;
			fileIcon.classList.remove('hidden');
			uploadIcon.classList.add('hidden');
			icon.classList.add('spin');
			uploadBtn.disabled = false;
		}
	} else {
		dragDropArea.querySelector('span').textContent = 'El archivo excede el límite de tamaño (100MB).';
		fileInput.value = ''; // Limpia el archivo seleccionado
		uploadIcon.classList.remove('hidden');
		fileIcon.classList.add('hidden');
		icon.classList.remove('spin');
		uploadBtn.disabled = true;
		dragDropArea.querySelector('span').textContent = 'Arrastre y suelte un archivo aquí o haga clic para seleccionar';
	}
});

fileForm.addEventListener('submit', function () {
	dragDropArea.classList.add('disabled');
	uploadBtn.classList.add('disabled');
	uploadBtn.tabIndex = -1;
});

// Verificar si ya habia un archivo al cargar la pagina
window.addEventListener('load', function () {
	if (fileInput.files.length > 0) {
		dragDropArea.querySelector('span').textContent = fileInput.files[0].name;
		fileIcon.classList.remove('hidden');
		uploadIcon.classList.add('hidden');
		icon.classList.add('spin');
		uploadBtn.disabled = false;
		
	}
});