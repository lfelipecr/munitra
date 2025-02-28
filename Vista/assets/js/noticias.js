$(document).ready(function () {
  const quill = new Quill("#txtDescripcion", {
    modules: {
      toolbar: [
        [{ header: [1, 2, false] }],
        ["bold", "italic", "underline"],
        ["image", "code-block"],
      ],
    },
    placeholder: "Compose an epic...",
    theme: "snow",
  });
  $("#frmNoticia").on("submit", function () {
    $("#alerta").show();
    let titulo = $("#txtTitulo").val().trim();
    let descripcion = quill.container.firstChild.innerHTML;
    if (titulo == "" || descripcion == "") {
      $("#alerta").html(
        "Debe proporcionar todos los datos marcados con asterisco (*)"
      );
      return false;
    }
    $("#valDescripcion").val(descripcion);
    return true;
  });
});
