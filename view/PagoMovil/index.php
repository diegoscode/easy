<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<title>Inicio</title>
</head>
<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php");?>

    <div class="mobile-menu-left-overlay"></div>
    
    <?php require_once("../MainNav/nav.php");?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
        <div class="box-typical box-typical-padding">
				
				<h5 class="m-t-lg with-border">Apartado de pagos</h5>

				<form>

				<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 form-control-label semibold">Banco Origen</label>
						<div class="col-sm-5">
							<select id="exampleSelect" class="form-control">
								<option>Seleccione Banco</option>
								<option>Venezuela</option>
								<option>Banesco</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Numero de telefono asociado</label>
						<div class="col-sm-5">
							<p class="form-control-static"><input type="number" class="form-control" id="inputPassword" placeholder="Numero celular"></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Fecha del pago movil</label>
						<div class="col-sm-5">
							<p class="form-control-static"><input type="date" class="form-control" id="inputPassword" placeholder="Ingresa fecha de pago movil"></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Numero de referencia</label>
						<div class="col-sm-5">
							<p class="form-control-static"><input type="number" class="form-control" id="inputPassword" placeholder="Referencia"></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Monto</label>
						<div class="col-sm-5">
							<p class="form-control-static"><input type="number" class="form-control" id="inputPassword" placeholder="0,00"></p>
						</div>
					</div>

					<button type="submit" class="btn btn-rounded btn-success sign-up">Reportar</button>
	
				</form>
		</div>
	</div>
	<!-- Contenido -->

	<?php require_once("../MainJs/js.php");?>

	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script type="text/javascript" src="subirpagos.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>