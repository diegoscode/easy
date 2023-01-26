function init(){
    $("#contrato_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

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
                console.log(datos);
            }
        });
    }

init();