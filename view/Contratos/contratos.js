var clientes;
var servicios;
var tabla;

function guardaryeditar(e) {
  e.preventDefault();
  var formData = new FormData($("#contratos_form")[0]);

  $.ajax({
    url: "../../controller/contratos.php?op=insert",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log(datos);
      $("#contratos_form")[0].reset();
      $("#contratos_data").DataTable().ajax.reload();
      $("#cat_serv").select2("val", "");
      $("#contratos_select").select2("val", "");
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
  $("#contratos_form").on("submit", function (e) {
    guardaryeditar(e);
  });

  tabla = $("#contratos_data")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/contratos.php?op=listar",
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

function initClientesSelect() {
  var select = $("#contratos_select");

  select.select2({
    placeholder: "Seleccione un Cliente",
  });
  select.on("change", (e) => {
    $.post(
      "../../controller/clientes.php?op=encontrar",
      { client_id: e.target.value },
      function (data) {
        var cliente = JSON.parse(data);
        console.log(data);
        $("#nom_emp").val(cliente.nom_emp);
        $("#tip_per").val(cliente.tip_per);
        $("#doc_nac").val(cliente.doc_nac);
      }
    );
  });

  return select;
}

function initServiciosSelect() {
  var select = $("#cat_serv");
  select.select2({
    placeholder: "Seleccione un Servicio",
  });
  select.on("change", (e) => {
    $.post(
      "../../controller/servicios.php?op=encontrar",
      { num_serv: e.target.value },
      function (data) {
        var serv = JSON.parse(data);
        $("#cost_serv").val(serv.cost_serv);
      }
    );
  });

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
  var selectClientes = initClientesSelect();
  var selectServicios = initServiciosSelect();

  $.post("../../controller/clientes.php?op=listar", function (data) {
    var response = JSON.parse(data);
    const keys = [
      "client_id",
      "nom_emp",
      "doc_nac",
      "tip_per",
      "boton_editar",
      "boton_eliminar",
    ];
    var dataArr = response.aaData;
    const objects = fromArrayToObjects(keys, dataArr);

    objects.map((cl) => {
      selectClientes.append(
        `<option value=${cl.client_id} >${cl.nom_emp}</option>`
      );
    });
  });

  $.post("../../controller/servicios.php?op=listar", function (data) {
    var response = JSON.parse(data);
    const keys = ["num_serv", "tip_serv"];
    var dataArr = response.aaData;
    const objects = fromArrayToObjects(keys, dataArr);

    objects.map((serv) => {
      selectServicios.append(
        `<option value=${serv.num_serv} >${serv.tip_serv}</option>`
      );
    });
  });
});

init();
