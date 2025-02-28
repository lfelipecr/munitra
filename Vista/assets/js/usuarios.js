$(document).ready(function () {
  //Formulario de creacion de cuenta en plataforma
  function CheckboxUsuario() {
    if ($("#cbxGenerarUsuario").prop("checked")) {
      $(".formUsuario").show();
    } else {
      $(".formUsuario").hide();
    }
  }
  //Dato booleano de consentimiento
  function CheckboxConsentimiento() {
    if ($("#cbxConsentimiento").prop("checked")) {
      $("#valorConsentimiento").val("1");
    } else {
      $("#valorConsentimiento").val("0");
    }
  }
  function CheckboxResponsable() {
    if ($("#cbxResponsable").prop("checked")) {
      $("#valorResponsable").val("1");
    } else {
      $("#valorResponsable").val("0");
    }
  }
  CheckboxUsuario();
  CheckboxConsentimiento();
  CheckboxResponsable();
  //Evento
  $("#cbxGenerarUsuario").on("change", function () {
    CheckboxUsuario();
  });
  //Evento consentimiento: setea el input oculto con 1 o 0
  $("#cbxConsentimiento").on("change", function () {
    CheckboxConsentimiento();
  });
  //Evento responsable: setea el input oculto con 1 o 0
  $("#cbxResponsable").on("change", function () {
    CheckboxResponsable();
  });
  //Validacion del formulario
  $("#frmPersona").on("submit", function () {
    $("#alerta").show();
    //Datos obligatorios
    if (
      $("#txtNombre").val().trim() == "" ||
      $("#txtApellido1").val().trim() == "" ||
      $("#txtDireccion").val().trim() == "" ||
      $("#txtIdentificacion").val() == ""
    ) {
      $("#alerta").html(
        "Debe proporcionar todos los datos marcados con asterisco (*)"
      );
      return false;
    }
    //Info de contacto
    //Debe llenar al menos un teléfono
    if (
      $("#txtTelefono").val().trim() == "" &&
      $("#txtWhatsapp").val().trim() == ""
    ) {
      $("#alerta").html("Debe llenar al menos uno de los dos teléfonos");
      return false;
    }
    //Correo
    if (
      !$("#txtCorreo").val().trim().includes("@") ||
      !$("#txtCorreo").val().trim().includes(".")
    ) {
      $("#alerta").html("Debe verificar el correo");
      return false;
    }
    //Si se está generando un usuario en plataforma, lo valida
    if ($("#cbxGenerarUsuario").prop("checked")) {
      if ($("#txtNombreUsuario").val() == "" || $("#txtPass1").val() == "") {
        $("#alerta").html(
          "Debe proporcionar todos los datos marcados con asterisco"
        );
        return false;
      } else {
        if ($("#txtPass1").val() != $("#txtPass2").val()) {
          $("#alerta").html("Las contraseñas no coinciden");
          return false;
        }
      }
    }
    return true;
  });
});
