var tabla;

function init() {
  tabla = $("#reportes_data");
  var ifr = document.createElement("iframe");
  ifr.src = "../../controller/reportes.php?op=imprimir";
  ifr.id = "PDF";

  ifr.style.width = "0px";
  ifr.style.height = "0px";
  ifr.style.border = "none";

  document.body.appendChild(ifr);

  listarReportes();
}

function imprimir(report_id) {
  $.post(
    "../../controller/reportes.php?op=buscar",
    { report_id },
    function (data) {
      const resp = JSON.parse(data);

      $.post(
        "../../controller/reportes.php?op=imprimir",
        { reporte: resp },
        function (data) {
          var data = JSON.parse(data);

          var link = document.createElement("a");
          link.href = window.URL = "../../controller/recibo.pdf";
          link.download = data.nombre_archivo;
          link.click();
        }
      );
    }
  );
}

function abrirModalImagen(imagen) {
  var fileExt =
    imagen.substring(imagen.lastIndexOf(".") + 1, imagen.length) || imagen;

  if (
    fileExt.includes("png") ||
    fileExt.includes("jpg") ||
    fileExt.includes("jpeg") ||
    fileExt.includes("svg") ||
    fileExt.includes("gif")
  ) {
    $("#modal-imagen").attr("src", imagen);
    $("#modalclientes").modal("show");
  } else {
    window.open(imagen);
  }
}

function listarReportes() {
  tabla
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/reportes.php?op=listar",
        type: "post",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      bDestroy: true,
      responsive: true,
      bInfo: true,
      iDisplayLength: 10,
      autoWidth: false,
      language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando un total de _TOTAL_ registros",
        sInfoEmpty: "Mostrando un total de 0 registros",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        oAria: {
          sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
          sSortDescending:
            ": Activar para ordenar la columna de manera descendente",
        },
      },
    })
    .DataTable();
}

$(document).ready(function () {
  init();
});
