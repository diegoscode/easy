var tabla;
var usu_id =  $('#user_idx').val();
var rol_id =  $('#rol_idx').val();

function init(){
    $("#contrato_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

function CambiarEstado(contrat_id, estado) {
    $.post(
      "../../controller/contrato.php?op=cambiarestado",
      { contrat_id, estado },
      function (data) {
        $("#contrato_data").DataTable().ajax.reload();
      }
    );
  }

$(document).ready(function(){

    tabla=$('#contrato_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [		          
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
                ],
        "ajax":{
            url: '../../controller/contrato.php?op=listar_x_client',
            type : "post",
            dataType : "json",	
            data:{ usu_id : usu_id },						
            error: function(e){
                console.log(e.responseText);	
            }
        },
        "ordering": false,
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }     
        }).DataTable(); 
    });

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#contrato_form")[0]);
        $.ajax({
            url: "../../controller/contrato.php?op=insert",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                $("#contrato_data").DataTable().ajax.reload();

                $('#nom_emp').val('');
                $('#descrip_contrat').val('');
                $('#tip_serv').val('');
                $('#cost_serv').val('');
                swal("Correcto!", "Generado Correctamente", "success");
            }
        });
    }

init();