var clientes;
var servicios;
var tabla;

function CambiarEstado(contrat_id, estado) {
  $.post(
    "../../controller/contratos.php?op=cambiarestado",
    { contrat_id, estado },
    function (data) {
      $("#contratos_data").DataTable().ajax.reload();
    }
  );
}

function guardar(e) {
  e.preventDefault();
  var formData = new FormData($("#contratos_form")[0]);

  $.ajax({
    url: "../../controller/contratos.php?op=insert",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      $("#contratos_form")[0].reset();
      $("#contratos_data").DataTable().ajax.reload();
      $("#cat_serv").select2("");
      $("#contratos_select").select2("");
      swal({
        title: "Admin",
        text: "Completado",
        type: "success",
        confirmButtonClass: "btn-success",
      });
    },
  });
}

function editarSubmit(e) {
  e.preventDefault();
  var formData = new FormData($("#contratos_form_modal")[0]);

  var servicios = formData.getAll("servicios[]");

  if (servicios.length === 0) {
    $(".mensaje").removeClass("d-none");
    return;
  }

  $.ajax({
    url: "../../controller/contratos.php?op=editar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      $("#modalcontratos").modal("hide");
      $("#contratos_form_modal")[0].reset();
      $("#modalcontratos #client_id").select2("");
      $("#modalcontratos #servicios").select2("");
      $(".mensaje").addClass("d-none");

      $("#contratos_data").DataTable().ajax.reload();

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
    guardar(e);
  });

  $("#contratos_form_modal").on("submit", function (e) {
    editarSubmit(e);
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
  var selectModal = $("#contratos_form_modal #client_id");

  select.select2({
    placeholder: "Seleccione un cliente",
  });

  selectModal.select2({
    placeholder: "Seleccione un cliente",
  });

  select.on("change", (e) => {
    $.post(
      "../../controller/clientes.php?op=encontrar",
      { client_id: e.target.value },
      function (data) {
        var cliente = JSON.parse(data);
        $("#nom_emp").val(cliente.nom_emp);
        $("#tip_per").val(cliente.tip_per);
        $("#doc_nac").val(cliente.doc_nac);
      }
    );
  });

  return { select, selectModal };
}

function initServiciosSelect() {
  var select = $("#cat_serv");
  var selectModal = $("#contratos_form_modal #servicios");

  select.select2({
    placeholder: "Seleccione un servicio",
  });

  selectModal.select2();

  selectModal.on("change", function (e) {
    var servicios = $(this).val();
    var costoTotal = 0;

    if (!servicios) {
      $("#cost_serv").val("");
      return;
    }

    $.post(
      "../../controller/servicios.php?op=encontrar_varios",
      {
        servicios,
      },
      function (data) {
        var datos = JSON.parse(data);

        var costos = datos.map((servicio) => parseInt(servicio.cost_serv));
        const totalCosto = costos.reduce((prev, sum) => prev + sum, 0);

        $("#contratos_form_modal #cost_serv").val(totalCosto);
      }
    );
  });

  select.on("change", function (e) {
    var servicios = $(this).val();
    var costoTotal = 0;
    if (!servicios) {
      $("#cost_serv").val("");
      return;
    }

    $.post(
      "../../controller/servicios.php?op=encontrar_varios",
      {
        servicios,
      },
      function (data) {
        var datos = JSON.parse(data);

        var costos = datos.map((servicio) => parseInt(servicio.cost_serv));
        const totalCosto = costos.reduce((prev, sum) => prev + sum, 0);

        $("#cost_serv").val(totalCosto);
      }
    );
  });

  return { select, selectModal };
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

function eliminar(contrat_id) {
  swal(
    {
      title: "Admin",
      text: "Procedes a eliminar el contrato",
      type: "error",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Si",
      cancelButtonText: "No",
      closeOnConfirm: false,
    },
    function (isConfirm) {
      if (isConfirm) {
        $.post(
          "../../controller/contratos.php?op=borrar_contrato",
          { contrat_id },
          function (data) {}
        );

        $("#contratos_data").DataTable().ajax.reload();

        swal({
          title: "Admin",
          text: "Contrato Eliminado",
          type: "success",
          confirmButtonClass: "btn-success",
        });
      }
    }
  );
}

function editar(contrat_id) {
  var servicios;
  var plan;
  var num_servs = [];
  var costos;
  var totalCosto = 0;
  $.post(
    "../../controller/contratos.php?op=buscar",
    { contrat_id },
    function (data) {
      data = JSON.parse(data);
      servicios = JSON.parse(data.servicios);
      plan = JSON.parse(data.contrato_plan);
      num_servs = servicios.map((servicio) => servicio.num_serv);

      costos = servicios.map((servicio) => parseInt(servicio.cost_serv));
      totalCosto = costos.reduce((prev, sum) => prev + sum, 0);

      $("#modalcontratos #contrat_id").val(data.contrat_id);
      $("#modalcontratos #tip_per").val(data.tip_per);
      $("#modalcontratos #nom_emp").val(data.nom_emp);
      $("#modalcontratos #doc_nac").val(data.cedula);
      $("#modalcontratos #contrato_plan").val(plan.id);
      $("#modalcontratos #cost_serv").val(totalCosto);

      $("#modalcontratos #client_id").select2("val", data.client_id);
      $("#modalcontratos #servicios").val(num_servs).trigger("change");
    }
  );

  $("#modalcontratos").modal("show");
}

function cambiarEstado(contrat_id, estado) {
  $.post(
    "../../controller/contratos.php?op=cambiarestado",
    { contrat_id, estado },
    function (data) {
      $("#contratos_data").DataTable().ajax.reload();
    }
  );
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
      selectClientes.selectModal.append(
        `<option value=${cl.client_id} >${cl.nom_emp}</option>`
      );
      selectClientes.select.append(
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
      selectServicios.select.append(
        `<option value=${serv.num_serv} >${serv.tip_serv}</option>`
      );
      selectServicios.selectModal.append(
        `<option value=${serv.num_serv} >${serv.tip_serv}</option>`
      );
    });
  });

  $.post("../../controller/contratos.php?op=get_contratos", function (data) {
    var response = JSON.parse(data);
    var tipoSelect = $("#contrato_plan");
    var tipoSelectModal = $("#contratos_form_modal #contrato_plan");

    response.forEach((tipo) => {
      tipoSelect.append(`<option value="${tipo.id}" >${tipo.tipo}</option>`);
      tipoSelectModal.append(
        `<option value="${tipo.id}" >${tipo.tipo}</option>`
      );
    });
  });
});

init();
