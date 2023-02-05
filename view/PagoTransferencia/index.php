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
						<label class="col-sm-2 form-control-label semibold">Fecha de pago</label>
						<div class="col-sm-5">
							<p class="form-control-static"><input type="date" class="form-control" id="inputPassword" placeholder="Fecha realizada de la transferencia"></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Numero de referencia</label>
						<div class="col-sm-5">
							<p class="form-control-static"><input type="number" class="form-control" id="inputPassword" placeholder="Numero de recibo de la transferencia"></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Cuenta origen</label>
						<div class="col-sm-5">
							<p class="form-control-static"><input type="number" class="form-control" id="inputPassword" placeholder="Numero de 20 digitos de la cuenta"></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Documento de identidad o RIF</label>
						<div class="col-sm-5">
							<p class="form-control-static"><input type="number" class="form-control" id="inputPassword" placeholder="Cedula o RIF del titular"></p>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 form-control-label semibold"></label>
						<div class="col-sm-5">
							<select id="exampleSelect" class="form-control">
								<option>Selecciona el tipo de persona</option>
								<option>Natural</option>
								<option>Juridica</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Monto total de la transferencia</label>
						<div class="col-sm-5">
							<p class="form-control-static"><input type="number" class="form-control" id="inputPassword" placeholder="Indica el monto total de su transferencia"></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Comprobante de pago</label>
						<div class="col-sm-5">
							<p class="form-control-static"><input type="file" class="form-control" id="inputPassword" placeholder="Suba aqui el comprobante de la transferencia"></p>
						</div>
					</div>

					<button type="submit" class="btn btn-rounded btn-success sign-up">Enviar</button>
	
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