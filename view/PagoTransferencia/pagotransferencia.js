var formulario = $("#reporte_transferencia");

function init() {
  formulario.on("submit", function (e) {
    crearComprobante(e);
  });
}

function crearComprobante(e) {
  e.preventDefault();
  var formData = new FormData(formulario[0]);

  formData.append("comprobante", $("#comprobante")[0].files[0]);

  $.ajax({
    url: "../../controller/reportes.php?op=insert",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log(datos);
      formulario[0].reset();
      swal({
        title: "Admin",
        text: "Completado",
        type: "success",
        confirmButtonClass: "btn-success",
      });
    },
  });
}

$(document).ready(function () {
  init();
});
