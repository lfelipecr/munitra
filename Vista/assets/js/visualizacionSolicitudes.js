$('.form-control').attr('disabled', '');
$('.canvas').hide();
$('#btnAct').hide();
$('#btnVer').hide();
$('#btnVer').on('click', function (){
    $('.form-control').attr('disabled', '');
    $('embed').show();
    $('#firmaCredenciales').show();
    $('.canvas').hide();
    $('#btnAct').hide();
    $('#btnVer').hide();
    $('#btnModi').show();
});
$('#btnModi').on('click', function (){
    $('embed').hide();
    $('#firmaCredenciales').hide();
    $('.canvas').show();
    $('.form-control').removeAttr('disabled');
    $('#btnAct').show();
    $('#btnVer').show();
    $('#btnModi').hide();
});