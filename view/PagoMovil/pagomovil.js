var crearReporteForm = $("#reporte-form");
var permitidos = ["pdf", "gif", "jpg", "png", "jpeg"];

function init() {
  crearReporteForm.on("submit", function (e) {
    crearReporte(e);
  });
}

function crearReporte(e) {
  e.preventDefault();
  var formData = new FormData(crearReporteForm[0]);

  var filename = $("#comprobante")[0].files[0].name;
  var fileExt =
    filename.substring(filename.lastIndexOf(".") + 1, filename.length) ||
    filename;

  if (!permitidos.includes(fileExt)) {
    return swal({
      type: "error",
      title: "Archivo no valido",
    });
  }

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
