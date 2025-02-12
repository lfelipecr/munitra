$('.form-control').attr('disabled', '');
$('#btnAct').hide();
$('#btnVer').hide();
$('#btnVer').on('click', function (){
    $('.form-control').attr('disabled', '');
    $('embed').show();
    $('#btnAct').hide();
    $('#btnVer').hide();
    $('#btnModi').show();
});
$('#btnModi').on('click', function (){
    $('embed').hide();
    $('.form-control').removeAttr('disabled');
    $('#btnAct').show();
    $('#btnVer').show();
    $('#btnModi').hide();
});