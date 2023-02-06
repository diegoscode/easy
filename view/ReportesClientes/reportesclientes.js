var tabla;

function init() {
  tabla = $("#reportes_data");
  listarReportes();
}

function imprimir(report_id) {
  $.post(
    "../../controller/reportes.php?op=buscar",
    { report_id },
    function (data) {
      const resp = JSON.parse(data);

      var reciboHTML = `
          <div class="recibo">
          <h1>Recibo</h1>
          <ul>
            <li>
              <span class="label">N°</span>
              <span class="value">${resp.codigo_report}</span>
            </li>
            <li>
              <span class="label">fecha</span>
              <span class="value">${resp.fech_trans}</span>
            </li>
            <li>
              <span class="label">importe total</span>
              <span class="value">${resp.monto}</span>
            </li>
            <li>
              <span class="label w-100">forma de pago</span>
            </li>
            <li>
              <span class="label">${resp.tip_pag}</span>
              <span class="value">${resp.monto}</span>
            </li>
          </ul>
                
          Corporacion Telemic RIF. J-3031413513. Todos los derechos reservados. ${new Date().getFullYear()}
          </div>
      `;

      $.post("../../controller/reportes.php?op=imprimir", { html: reciboHTML });
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
