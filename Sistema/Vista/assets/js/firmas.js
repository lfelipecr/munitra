$(document).ready(function () {
    let canvas = $("#canvas")[0];
    let ctx = canvas.getContext("2d");
    let dibujando = false;

    $("#canvas").on("mousedown", function () {
        dibujando = true;
    });

    $(document).on("mouseup", function () {
        dibujando = false;
        ctx.beginPath();
    });

    $("#canvas").on("mousemove", function (event) {
        if (!dibujando) return;

        let x = event.offsetX;
        let y = event.offsetY;

        ctx.lineWidth = 2;
        ctx.lineCap = "round";
        ctx.strokeStyle = "black";

        ctx.lineTo(x, y);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(x, y);
    });

    $("#clear").on("click", function () {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        $("#firma").val("");
        return false;
    });
});