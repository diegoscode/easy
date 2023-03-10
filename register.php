<!DOCTYPE html>
<html>
<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Registro</title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.png" rel="icon" type="image/png">
	<link href="img/favicon.ico" rel="shortcut icon">

	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <link rel="stylesheet" href="public/css/lib/bootstrap-sweetalert/sweetalert.css">
    <link rel="stylesheet" href="public/css/separate/vendor/sweet-alert-animations.min.css">
    <link rel="stylesheet" href="public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/main.css">
</head>

<style>
    body {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: lightblue;
        background: url("public/img/support.svg");
        background-repeat: no-repeat;
        background-size: 100% 100%;
        overflow: hidden;
        z-index: -1;
    }

</style>

<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
            <form class="sign-box" action="" method="post" id="register_form">

                <input type="hidden" id="rol_id" name="rol_id" value="1">

                <div class="sign-avatar">
                        <img src="public/img/logoempresa.png" alt="" id="imgtipo">
                </div>

                <input type="hidden" id="usu_id" name="usu_id">

                <div class="form-group">
                    <label class="form-label semibold" for="nom_emp">Nombre</label>
                    <input type="text" id="nom_emp" name="nom_emp" class="form-control" placeholder="Nombre" required/>
                </div>

                <div class="form-group">
                    <label class="form-label semibold" for="doc_nac">Documento de identidad o RIF</label>
                    <input type="number" id="doc_nac" name="doc_nac" class="form-control" placeholder="CI o RIF" required/>
                </div>

                <div class="form-group">
                    <label class="form-label semibold" for="direccion">Direccion</label>
                    <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Direccion" required/>
                </div>

                <div class="form-group">
                    <label class="form-label semibold" for="tip_per">Tipo de cliente</label>
                    <input type="text" id="tip_per" name="tip_per" class="form-control" placeholder="Empresa o particular" required/>
                </div>

                <div class="form-group">
                    <label class="form-label semibold" for="usu_correo">Correo electronico</label>
                    <input type="email" id="usu_correo" name="usu_correo" class="form-control" placeholder="Correo" required/>
                </div>

                <div class="form-group">
                    <label class="form-label semibold" for="usu_pass">Contrase??a</label>
                    <input type="password" id="usu_pass" name="usu_pass" class="form-control" placeholder="Contrase??a" required/>
                </div>

                <button type="submit" class="btn btn-rounded btn-primary sign-up">Registrar</button>
                <p class="sign-note">??Ya tienes una cuenta?<a href="login.php"> Inicia sesion</a></p>

                </form>
            </div>
        </div>
    </div><!--.page-center-->
    
<script src="public/js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
<script src="public/js/lib/jquery/jquery.min.js"></script>
<script src="public/js/lib/tether/tether.min.js"></script>
<script src="public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="public/js/plugins.js"></script>
    <script type="text/javascript" src="public/js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>

<script src="public/js/app.js"></script>

<script type="text/javascript" src="new.js"></script>

</body>
</html>