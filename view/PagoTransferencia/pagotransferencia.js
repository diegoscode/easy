var formulario = $("#reporte_transferencia");

var permitidos = ["pdf", "gif", "jpg", "png", "jpeg"];

function init() {
  formulario.on("submit", function (e) {
    crearComprobante(e);
  });
}

function crearComprobante(e) {
  e.preventDefault();
  var formData = new FormData(formulario[0]);

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
