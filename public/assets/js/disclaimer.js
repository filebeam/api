var backBtn = document.getElementById('backBtn');
var mousePos = { x: 0, y: 0 };
var isTrackingMouse = false;

backBtn.addEventListener("click", function (e) {
	history.back();
});

/* --------------- Efecto de glow en el boton de volver atras --------------- */

backBtn.addEventListener("mousemove", function (e) {
	mousePos.x = e.clientX;
	mousePos.y = e.clientY;

	if (!isTrackingMouse) {
		isTrackingMouse = true;
		requestAnimationFrame(trackMouse);
	}
});

function trackMouse() {
	var rect = backBtn.getBoundingClientRect();
	var x = mousePos.x - rect.left;
	var y = mousePos.y - rect.top;

	backBtn.style.setProperty("--x", x + "px");
	backBtn.style.setProperty("--y", y + "px");

	isTrackingMouse = false;
}