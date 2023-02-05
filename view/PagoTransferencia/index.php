<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
	?>
	<!DOCTYPE html>
	<html>
	<?php require_once("../MainHead/head.php"); ?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<title>Inicio</title>
	</head>

	<body class="with-side-menu">

		<?php require_once("../MainHeader/header.php"); ?>

		<div class="mobile-menu-left-overlay"></div>

		<?php require_once("../MainNav/nav.php"); ?>

		<!-- Contenido -->
		<div class="page-content">
			<div class="container-fluid">
				<div class="box-typical box-typical-padding">

					<h5 class="m-t-lg with-border">Apartado de pagos</h5>

					<form id="reporte_transferencia">
						<div class="form-group row">
							<label class="col-sm-2 form-control-label semibold">Fecha de pago</label>
							<div class="col-sm-5">
								<p class="form-control-static">
									<input type="date" class="form-control" name="fech_trans" id="fech_trans"
										placeholder="Fecha realizada de la transferencia" required>
								</p>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 form-control-label semibold">Numero de referencia</label>
							<div class="col-sm-5">
								<p class="form-control-static"><input type="number" class="form-control" required
										id="numero_referencia" name="numero_referencia"
										placeholder="Numero de recibo de la transferencia"></p>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 form-control-label semibold">Cuenta origen</label>
							<div class="col-sm-5">
								<p class="form-control-static">
									<input type="number" class="form-control" id="origen" required
										placeholder="Numero de 20 digitos de la cuenta" name="origen">
								</p>
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
										required></p>
							</div>
						</div>



						<input type="hidden" id="tip_pag" name="tip_pag" value="Transferencia">

						<button type="submit" class="btn btn-rounded btn-success sign-up">Enviar</button>

					</form>
				</div>
			</div>
			<!-- Contenido -->

			<?php require_once("../MainJs/js.php"); ?>

			<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
			<script type="text/javascript" src="pagotransferencia.js"></script>

	</body>

	</html>
	<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>