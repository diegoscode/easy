function init(){
    $("#register_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

function guardaryeditar(e){
    e.preventDefault();
	var formData = new FormData($("#register_form")[0]);
    $.ajax({
        url: "controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){    
            console.log(datos);
            $('#register_form')[0].reset();
            
            swal({
                title: "Admin",
                text: "Registro Completado",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    }); 
}

init();