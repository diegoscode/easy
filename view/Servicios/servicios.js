var tabla;

function init(){
    $("#servicio_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

function cambiarestado(num_serv,estado){
    $.post("../../controller/servicios.php?op=cambiarestado", {num_serv , estado}, function (data) {
        console.log(data);
    }); 
}

function guardaryeditar(e){
    e.preventDefault();
	var formData = new FormData($("#servicio_form")[0]);
    $.ajax({
        url: "../../controller/servicios.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){    
            console.log(datos);
            $('#servicio_form')[0].reset();
            $("#modalservicios").modal('hide');
            $('#servicio_data').DataTable().ajax.reload();

            swal({
                title: "Admin",
                text: "Completado",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    }); 
}

$(document).ready(function(){
    tabla=$('#servicio_data').dataTable({
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
            url: '../../controller/servicios.php?op=listar',
            type : "post",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },
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

function editar(num_serv){
    $('#mdservicios').html('Editar Servicio');

    $.post("../../controller/servicios.php?op=mostrar", {num_serv : num_serv}, function (data) {
        data = JSON.parse(data);
        $('#num_serv').val(data.num_serv);
        $('#tip_serv').val(data.tip_serv);
        $('#cat_id').val(data.cat_id);
        $('#sub_cat').val(data.sub_cat);
        $('#precio').val(data.precio);
    }); 

    $('#modalservicios').modal('show');
}

function eliminar(num_serv){
    swal({
        title: "Admin",
        text: "Procedes a eliminar el servicio",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/servicios.php?op=eliminar", {num_serv : num_serv}, function (data) {

            }); 

            $('#servicio_data').DataTable().ajax.reload();	

            swal({
                title: "Admin",
                text: "Servicio Eliminado",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

$(document).on("click","#btnnuevo", function(){
    $('#mdservicios').html('Nuevo Servicio');
    $('#servicio_form')[0].reset();
    $('#modalservicios').modal('show');
});

init();