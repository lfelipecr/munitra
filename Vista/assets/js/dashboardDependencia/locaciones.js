$("#slCanton").on("change", function () {
  $(".distritos").hide();
  $('option[data-canton="' + $("#slCanton").val() + '"]').show();
});
$("#slProvincia").on("change", function () {
  $(".cantones").hide();
  $(".distritos").hide();
  $('option[data-provinciaCanton="' + $("#slProvincia").val() + '"]').show();
  $('option[data-provinciaDistrito="' + $("#slProvincia").val() + '"]').show();
});
