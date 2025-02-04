$(document).ready(function() {
    let video = document.getElementById('video');
    let canvasFoto = document.getElementById('canvasFoto');
    let photo = document.getElementById('photo');
    let captureButton = $('#capture');
    $('#new').hide();
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(err => {
            console.error("Error al acceder a la cámara:", err);
        });
    //tomar de nuevo
    $('#new').on('click', function (){
        photo.classList.add('d-none');
        video.classList.remove('d-none');
        $('#capture').show();
        $('#new').hide();
        return false;
    });
    captureButton.click(function() {
        let context = canvasFoto.getContext('2d');
        canvasFoto.width = video.videoWidth;
        canvasFoto.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvasFoto.width, canvasFoto.height);

        // Convertir a imagen y mostrar
        let imageData = canvasFoto.toDataURL('image/png');
        $('#fotoUrl').val(imageData);
        photo.src = imageData;
        photo.classList.remove('d-none');
        video.classList.add('d-none');
        $('#capture').hide();
        $('#new').show();
        return false;
    });
});