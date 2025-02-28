$(document).ready(function () {
  function RenderizarDatosJSON() {
    let datos = $("#jsonData").val();
    if (datos != "") {
      datos = JSON.parse(datos);
      for (let i = 0; i < datos.length; i++) {
        switch (datos[i][4]) {
          case "1":
            $("#idRequisitos").val(datos[i][0]);
            let adjuntos = JSON.parse(datos[i][1]);
            for (let i = 0; i < adjuntos.length; i++) {
              let listado = $("#requisitosEmbed").html();
              let html = `<embed src="${adjuntos[i]}" type="application/pdf" width="100%" height="500px">`;
              listado += html;
              $("#requisitosEmbed").html(listado);
            }
            break;
          case "2":
            $("#idUsoPatentes").val(datos[i][0]);
            let html = "";
            if (datos[i][1] == "Transporte") {
              html =
                '<option value="Transporte" selected>Transporte</option><option value="Comercial">Comercial</option>';
            } else {
              html =
                '<option value="Transporte">Transporte</option><option selected value="Comercial">Comercial</option>';
            }
            $("#slUsoPatente").html(html);
            break;
          case "3":
            $("#idNombreFantasia").val(datos[i][0]);
            $("#txtNombreFantasia").val(datos[i][1]);
            break;
          case "4":
            $("#idActividadComercial").val(datos[i][0]);
            $("#txtActvidadComercial").val(datos[i][1]);
            break;
          case "5":
            $("#idNumeroUsoSuelo").val(datos[i][0]);
            $("#txtUsoSuelo").val(datos[i][1]);
            $("#cbxUsoSuelo").attr("checked", "");
            $("#usoSuelo").show();
            break;
          case "6":
            $("#idDistrito").val(datos[i][0]);
            $("#distrito" + datos[i][0]).attr("selected", "");
            break;
          case "7":
            $("#idDireccionExacta").val(datos[i][0]);
            $("#txtDireccionExacta").val(datos[i][1]);
            break;
          case "8":
            $("#idArea").val(datos[i][0]);
            $("#txtArea").val(datos[i][1]);
            break;
          case "9":
            $("#idDimensiones").val(datos[i][0]);
            $("#txtDimensiones").val(datos[i][1]);
            break;
        }
      }
    }
  }
  function CheckboxUsoSuelo() {
    if ($("#cbxUsoSuelo").prop("checked")) {
      $("#usoSuelo").show();
    } else {
      $("#usoSuelo").hide();
    }
  }
  CheckboxUsoSuelo();
  RenderizarDatosJSON();
  $("#cbxUsoSuelo").on("change", function () {
    CheckboxUsoSuelo();
  });
  $("#frmPatente").on("submit", function () {
    $("#alerta").show();
    if ($("#txtNombre").length) {
      //Datos obligatorios de persona
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
    }
    if (
      $("#txtNombreFantasia").val().trim() == "" ||
      $("#txtActvidadComercial").val().trim() == "" ||
      $("#txtDireccionExacta").val().trim() == "" ||
      $("#txtArea").val().trim() == "" ||
      $("#txtDimensiones").val().trim() == ""
    ) {
      $("#alerta").html(
        "Debe proporcionar todos los datos obligatorios, marcados con (*)"
      );
      return false;
    }
    if ($("#cbxUsoSuelo").prop("checked")) {
      if ($("#txtUsoSuelo").val().trim() == "") {
        $("#alerta").html(
          "Debe proporcionar todos los datos obligatorios, marcados con (*)"
        );
        return false;
      }
    }
    return true;
  });
  $("#slPersonas").select2();
  $("#slDistrito").select2();
  let estado = $("#idEstado").val();
  $("#estado" + estado).attr("selected", "");
});
