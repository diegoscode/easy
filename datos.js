function init(){
}

$(document).ready(function() {

});

$(document).on("click", "#btnsoporte", function () {
    if ($('#rol_id').val()==1){
        $('#lbltitulo').html("Administrador");
        $('#btnsoporte').html("Cliente");
        $('#rol_id').val(2);
        $("#imgtipo").attr("src","public/img/logoempresa.png");
    }else{
        $('#lbltitulo').html("Cliente");
        $('#btnsoporte').html("Administrador");
        $('#rol_id').val(1);
        $("#imgtipo").attr("src","public/img/logoempresa.png");
    }
});

init();