var crearReporteForm = $("#reporte-form");

function init() {
  crearReporteForm.on("submit", function (e) {
    crearReporte(e);
  });
}

function crearReporte(e) {
  e.preventDefault();
  var formData = new FormData(crearReporteForm[0]);

  $.ajax({
    url: "../../controller/reportes.php?op=insert",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log(datos);
      crearReporteForm[0].reset();
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
