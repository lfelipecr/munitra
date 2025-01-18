$(document).ready(function () {
    let bandModif = false;
    let data = JSON.parse($("#data").val());
    $('#activarModif').on('click', function () {
        if (!bandModif){
            $('#modificar').show();
            $('.inputDeshab').prop('disabled', false);
            bandModif = true;
        } else {
            $('#modificar').hide();
            $('.inputDeshab').prop('disabled', true);
            bandModif = false;
        }
    });

    function Renderizar(){
        $('#ticket').html('Ticket: ' + data[0][0]);
        $('#cedula').val(data[0][6]);
        $('#nombre').val(`${data[0][1]} ${data[0][2]} ${data[0][3]}`);
        if (data[0][7] == '1'){
            $('#mensaje').html('Su ticket ha sido <strong>aceptado</strong>, se encuentra en la lista');
        } else {
            $('#mensaje').html('Su ticket <strong>aún no ha sido aceptado</strong>, no se encuentra en la lista aún');
        }
        $('#modificar').hide();
    }
    Renderizar();
})