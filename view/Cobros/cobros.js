var clientes;

function init() {
  $("#ticket_form").on("submit", function (e) {
    guardaryeditar(e);
  });
}

$(document).ready(function () {
  var select = $("#cobro_select");

  $("#tick_descrip").summernote({
    height: 150,
    lang: "es-ES",
    callbacks: {
      onImageUpload: function (image) {
        console.log("Image detect...");
        myimagetreat(image[0]);
      },
      onPaste: function (e) {
        console.log("Text detect...");
      },
    },
    toolbar: [
      ["style", ["bold", "italic", "underline", "clear"]],
      ["font", ["strikethrough", "superscript", "subscript"]],
      ["fontsize", ["fontsize"]],
      ["color", ["color"]],
      ["para", ["ul", "ol", "paragraph"]],
      ["height", ["height"]],
    ],
  });

  $.post("../../controller/categoria.php?op=combo", function (data, status) {
    $("#cat_id").html(data);
  });

  $.post("../../controller/clientes.php?op=listar", function (data) {
    var response = JSON.parse(data);
    const keys = [
      "client_id",
      "nom_emp",
      "cedula",
      "tip_per",
      "client_est",
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
      "../../controller/clientes.php?op=buscar",
      { client_id: e.target.value },
      function (data) {
        var cliente = JSON.parse(data);
        $("#nom_emp").val(cliente.nom_emp);
        $("#tip_per").val(cliente.tip_per);
        $("#cedula").val(cliente.cedula);
      }
    );
  });
});

function guardaryeditar(e) {
  e.preventDefault();
  var formData = new FormData($("#ticket_form")[0]);
  if (
    $("#tick_descrip").summernote("isEmpty") ||
    $("#tick_titulo").val() == ""
  ) {
    swal("Advertencia!", "Campos Vacios", "warning");
  } else {
    var totalfiles = $("#fileElem").val().length;
    for (var i = 0; i < totalfiles; i++) {
      formData.append("files[]", $("#fileElem")[0].files[i]);
    }

    $.ajax({
      url: "../../controller/ticket.php?op=insert",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        data = JSON.parse(data);
        console.log(data[0].tick_id);

        $.post(
          "../../controller/email.php?op=ticket_abierto",
          { tick_id: data[0].tick_id },
          function (data) {}
        );

        $("#tick_titulo").val("");
        $("#tick_descrip").summernote("reset");
        swal("Correcto!", "Registrado Correctamente", "success");
      },
    });
  }
}

init();
