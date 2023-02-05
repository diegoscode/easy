<!DOCTYPE html>
<html>
<head lang="en">
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

    <link rel="stylesheet" href="public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/main.css">
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
            <form class="sign-box" action="" method="post" id="register_form">

                <input type="hidden" id="rol_id" name="rol_id" value="1">

                <header class="sign-title semibold" id="registro">Registro</header>

                <input type="hidden" id="usu_id" name="usu_id">

                <div class="form-group">
                    <label class="form-label semibold" for="nom_emp">Nombre</label>
                    <input type="text" id="nom_emp" name="nom_emp" class="form-control" placeholder="Nombre"/>
                </div>

                <div class="form-group">
                    <label class="form-label semibold" for="usu_ape">Nombre</label>
                    <input type="text" id="usu_ape" name="usu_ape" class="form-control" placeholder="Apellido"/>
                </div>

                <div class="form-group">
                    <label class="form-label semibold" for="doc_nac">Documento de identidad o RIF</label>
                    <input type="text" id="doc_nac" name="doc_nac" class="form-control" placeholder="Documento de identidad o RIF"/>
                </div>

                <div class="form-group">
                    <label class="form-label semibold" for="telefono">Telefono</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Numero telefono"/>
                </div>

                <div class="form-group">
                    <label class="form-label semibold" for="direccion">Direccion</label>
                    <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Direccion"/>
                </div>

                <div class="form-group">
                    <label class="form-label semibold" for="tip_per">Tipo de empresa o particular</label>
                    <input type="text" id="tip_per" name="tip_per" class="form-control" placeholder="Tipo"/>
                </div>

                <div class="form-group">
                    <label class="form-label semibold" for="usu_correo">Correo electronico</label>
                    <input type="text" id="usu_correo" name="usu_correo" class="form-control" placeholder="Correo"/>
                </div>

                <div class="form-group">
                    <label class="form-label semibold" for="usu_pass">Contraseña</label>
                    <input type="text" id="usu_pass" name="usu_pass" class="form-control" placeholder="Contraseña"/>
                </div>

                <button type="submit" class="btn btn-rounded btn-success sign-up">Registrar</button>
                <p class="sign-note">¿Ya tienes una cuenta?<a href="login.php"> Inicia sesion</a></p>

                </form>
            </div>
        </div>
    </div><!--.page-center-->

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
</body>
</html>