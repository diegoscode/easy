<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
	?>
	<!DOCTYPE html>
	<html>
	<?php require_once("../MainHead/head.php"); ?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<title>Pago movil</title>
	</head>

	<body class="with-side-menu">

		<?php require_once("../MainHeader/header.php"); ?>

		<div class="mobile-menu-left-overlay"></div>

		<?php require_once("../MainNav/nav.php"); ?>

		<!-- Contenido -->
		<div class="page-content">
			<div class="container-fluid">
				<div class="box-typical box-typical-padding">

					<h5 class="m-t-lg with-border">Pago movil</h5>

					<form id="reporte-form">

						<div class="form-group row">
							<label for="inputPassword" class="col-sm-2 form-control-label semibold">Banco Origen</label>
							<div class="col-sm-5">
								<select id="exampleSelect" id="origen" name="origen" class="form-control">
									<option value="">Seleccione Banco</option>
									<option>Banco de Venezuela</option>
									<option>Banesco</option>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 form-control-label semibold">Numero de telefono asociado</label>
							<div class="col-sm-5">
								<p class="form-control-static"><input type="tel" class="form-control" id="telefono"
										name="telefono" placeholder="Numero celular"></p>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 form-control-label semibold">Fecha del pago movil</label>
							<div class="col-sm-5">
								<p class="form-control-static"><input type="date" class="form-control" id="fech_trans"
										name="fech_trans" placeholder="Ingresa fecha de pago movil"></p>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 form-control-label semibold">Numero de referencia</label>
							<div class="col-sm-5">
								<p class="form-control-static"><input type="number" class="form-control"
										id="numero_referencia" name="numero_referencia" placeholder="Referencia"></p>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 form-control-label semibold">Monto</label>
							<div class="col-sm-5">
								<p class="form-control-static"><input type="number" class="form-control" id="monto"
										name="monto" placeholder="0,00" step="0.01"></p>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 form-control-label semibold">Comprobante de pago</label>
							<div class="col-sm-5">
								<p class="form-control-static"><input type="file" class="form-control" id="comprobante"
										placeholder="Suba aqui el comprobante de la transferencia" name="comprobante"
										accept="image/png, image/jpeg, image/jpg, image/gif,application/pdf" required></p>
							</div>
						</div>

						<input type="hidden" id="tip_pag" name="tip_pag" value="Pago Movil">

						<button type="submit" class="btn btn-rounded btn-success sign-up">Reportar</button>

					</form>
				</div>
			</div>
			<!-- Contenido -->

			<?php require_once("../MainJs/js.php"); ?>

			<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
			<script type="text/javascript" src="pagomovil.js"></script>

	</body>

	</html>
	<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>