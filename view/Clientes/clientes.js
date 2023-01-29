var tabla;

function init() {
  $("#clientes_form").on("submit", function (e) {
    guardaryeditar(e);
  });
}

function CambiarEstado(client_id, estado) {
  $.post(
    "../../controller/clientes.php?op=cambiarestado",
    { client_id, estado },
    function (data) {
      $("#clientes_data").DataTable().ajax.reload();
    }
  );
}

function guardaryeditar(e) {
  e.preventDefault();
  var formData = new FormData($("#clientes_form")[0]);
  $.ajax({
    url: "../../controller/clientes.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log(datos);
      $("#clientes_form")[0].reset();
      $("#modalclientes").modal("hide");
      $("#clientes_data").DataTable().ajax.reload();


            swal({
                title: "Admin",
                text: "Completado",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    }); 
}

$(document).ready(function () {
  tabla = $("#clientes_data")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/clientes.php?op=listar",
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
});

function editar(client_id) {
  $("#mdclientes").html("Editar Cliente");

  $.post(
    "../../controller/clientes.php?op=mostrar",
    { client_id: client_id },
    function (data) {
      data = JSON.parse(data);
      $("#client_id").val(data.client_id);
      $("#nom_emp").val(data.nom_emp);
      $("#cedula").val(data.cedula);
      $("#tip_per").val(data.tip_per);
    }
  );

  $("#modalclientes").modal("show");
}


function eliminar(client_id){
    swal({
        title: "Admin",
        text: "Procedes a eliminar el cliente",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function (isConfirm) {
      if (isConfirm) {
        $.post(
          "../../controller/clientes.php?op=eliminar",
          { client_id: client_id },
          function (data) {}
        );

        $("#clientes_data").DataTable().ajax.reload();


            swal({
                title: "Admin",
                text: "cliente Eliminado",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

$(document).on("click", "#btnnuevo", function () {
  $("#mdclientes").html("Nuevo Cliente");
  $("clientes_form")[0].reset();
  $("#modalclientes").modal("show");
});

init();
