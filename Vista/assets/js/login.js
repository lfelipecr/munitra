$(document).ready(function () {
  $("#frmIngresar").on("submit", function () {
    $("#alerta").show();
    if ($("#txtCorreo").val().trim() == "") {
      $("#alerta").html("Complete todos los datos");
      return false;
    }
    return true;
  });
});
