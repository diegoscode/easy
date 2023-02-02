var clientes;
var servicios;

function init() {
  $("#contratos_form").on("submit", function (e) {
    guardaryeditar(e);
  });
}

$(document).ready(function () {
  var select = $("#contratos_select");

  $.post("../../controller/clientes.php?op=listar", function (data) {
    console.log(data);
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
    const objects = dataArr.map((array) =>
      array.reduce((a, v, i) => {
        return {
          ...a,
          [keys[i]]: v,
        };
      }, {})
    );

    objects.map((cl) => {
      select.append(`<option value=${cl.client_id} >${cl.nom_emp}</option>`);
    });
  });

  select.select2();
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
});

  function init() {
    $("#servicios_form").on("submit", function (e) {
      guardaryeditar(e);
    });
  }

  $(document).ready(function () {
  var select = $("#servicios_select");

  $.post("../../controller/servicios.php?op=listar", function (data) {
    console.log(data);
    var response = JSON.parse(data);
    const keys = [
      "num_serv",
      "cost_serv",
    ];
    var dataArr = response.aaData;
    const objects = dataArr.map((array) =>
      array.reduce((a, v, i) => {
        return {
          ...a,
          [keys[i]]: v,
        };
      }, {})
    );

    objects.map((cl) => {
      select.append(`<option value=${cl.num_serv} >${cl.cost_serv}</option>`);
    });
  });

  select.select2();
  select.on("change", (e) => {
    $.post(
      "../../controller/servicios.php?op=encontrar",
      { num_serv: e.target.value },
      function (data) {
        var servicio = JSON.parse(data);
        console.log(data);
        $("#cost_serv").val(servicio.cost_serv);
      }
    );
  });
  });

init();
