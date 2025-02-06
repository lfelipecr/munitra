$(document).ready(function () {
    let canvas = $("#canvas")[0];
    let ctx = canvas.getContext("2d");
    let dibujando = false;

    function comenzarDibujo(x, y) {
        dibujando = true;
        ctx.beginPath();
        ctx.moveTo(x, y);
    }

    function dibujar(x, y) {
        if (!dibujando) return;

        ctx.lineWidth = 2;
        ctx.lineCap = "round";
        ctx.strokeStyle = "black";

        ctx.lineTo(x, y);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(x, y);
    }

    function detenerDibujo() {
        dibujando = false;
        ctx.beginPath();
    }

    $("#canvas").on("mousedown", function (event) {
        comenzarDibujo(event.offsetX, event.offsetY);
    });

    $("#canvas").on("mousemove", function (event) {
        dibujar(event.offsetX, event.offsetY);
    });

    $(document).on("mouseup", detenerDibujo);

    $("#canvas").on("touchstart", function (event) {
        let touch = event.originalEvent.touches[0];
        let rect = canvas.getBoundingClientRect();
        comenzarDibujo(touch.clientX - rect.left, touch.clientY - rect.top);
    });

    $("#canvas").on("touchmove", function (event) {
        let touch = event.originalEvent.touches[0];
        let rect = canvas.getBoundingClientRect();
        dibujar(touch.clientX - rect.left, touch.clientY - rect.top);
        event.preventDefault();
    });

    $("#canvas").on("touchend", detenerDibujo);

    $("#clear").on("click", function () {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        $("#firma").val("");
        return false;
    });
});
