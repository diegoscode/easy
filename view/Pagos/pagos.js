var clientes;
var servicios;
var tabla;

$.post("../../controller/categoria.php?op=combo", function (data, status) {
  $("#cat_pag").html(data);
});

function CambiarEstado(pag_id, estado) {
  $.post(
    "../../controller/pagos.php?op=cambiarestado",
    { pag_id, estado },
    function (data) {
      $("#pagos_data").DataTable().ajax.reload();
    }
  );
}

function guardaryeditar(e) {
  e.preventDefault();
  var formData = new FormData($("#pagos_form")[0]);

  $.ajax({
    url: "../../controller/pagos.php?op=insert",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      $("#pagos_form")[0].reset();
      $("#pagos_data").DataTable().ajax.reload();
      $("#pagos_select").select2("val", "");

      swal({
        title: "Admin",
        text: "Completado",
        type: "success",
        confirmButtonClass: "btn-success",
      });
    },
  });
}

function init() {
  $("#pagos_form").on("submit", function (e) {
    guardaryeditar(e);
  });

  tabla = $("#pagos_data")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/pagos.php?op=listar",
        type: "post",
        dataType: "json",
        error: function (e) {},
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

function initPagosSelect() {
  var select = $("#pagos_select");

  select.select2({
    placeholder: "Seleccione un contrato",
  });
  select.on("change", (e) => {
    $.post(
      "../../controller/contratos.php?op=buscar",
      { contrat_id: e.target.value },
      function (data) {
        var contrato = JSON.parse(data);
        var servicios = JSON.parse(contrato.servicios);
        var num_servs = servicios.map((servicio) => servicio.num_serv);

        $("#nom_emp").val(contrato.nom_emp);
        $("#doc_nac").val(contrato.cedula);
        $("#tip_serv").val(contrato.tip_serv);
        $("#cost_serv").val(contrato.cost_serv);
        $("#servicios_select").val(num_servs).trigger("change");
      }
    );
  });

  return select;
}

function initServiciosSelect() {
  var select = $("#servicios_select");

  select.select2();

  return select;
}

function fromArrayToObjects(keys, array) {
  if (!array || array.lenght === 0) return [];

  const objects = array.map((newArray) =>
    newArray.reduce((a, v, i) => {
      return {
        ...a,
        [keys[i]]: v,
      };
    }, {})
  );

  return objects;
}

$(document).ready(function () {
  var selectClientes = initPagosSelect();
  var selectServicios = initServiciosSelect();

  $.post("../../controller/contratos.php?op=listar", function (data) {
    var response = JSON.parse(data);
    const keys = [
      "contrat_id",
      "nom_emp",
      "doc_nac",
      "tip_per",
      "serv_cat",
      "cost_serv",
    ];
    var dataArr = response.aaData;
    const objects = fromArrayToObjects(keys, dataArr);

    objects.map((c) => {
      selectClientes.append(
        `<option value=${c.contrat_id} > ${c.contrat_id} - ${c.nom_emp} (${c.serv_cat})</option>`
      );
    });
  });

  $.post("../../controller/servicios.php?op=listar", function (data) {
    var response = JSON.parse(data);
    const keys = ["num_serv", "tip_serv"];
    var dataArr = response.aaData;
    const objects = fromArrayToObjects(keys, dataArr);

    objects.map((c) => {
      selectServicios.append(
        `<option value="${c.num_serv}" > ${c.tip_serv})</option>`
      );
    });
  });
});

init();
