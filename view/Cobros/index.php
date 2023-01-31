<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
	?>
	<!DOCTYPE html>
	<html>
	<?php require_once("../MainHead/head.php"); ?>
	<title>Cobros</title>
	</head>

	<body class="with-side-menu">

		<?php require_once("../MainHeader/header.php"); ?>

		<div class="mobile-menu-left-overlay"></div>

		<?php require_once("../MainNav/nav.php"); ?>

		<!-- Contenido -->
		<div class="page-content">
			<div class="container-fluid">

				<header class="section-header">
					<div class="tbl">
						<div class="tbl-row">
							<div class="tbl-cell">
								<h3>Cobros</h3>
								<ol class="breadcrumb breadcrumb-simple">
									<li><a href="#">Home</a></li>
									<li class="active">Nuevo Cobro</li>
								</ol>
							</div>
						</div>
					</div>
				</header>

				<div class="box-typical box-typical-padding">

					<h5 class="m-t-lg with-border">Nuevo Cobro</h5>

					<div class="row">
						<form method="post" id="cobro_form">

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="exampleInput">Servicio Contratado</label>
									<select id="cat_id" name="cat_id" class="form-control">

									</select>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="exampleInput">Mes a pagar</label>
									<select id="cat_id" name="cat_id" class="form-control">

									</select>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="exampleInput">Cliente a Cobrar</label>
									<select name="cobro_select" id="cobro_select">
										<option>Seleccione un cliente</option>
									</select>
								</fieldset>

							</div>



							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="nom_emp">Cliente</label>
									<input type="text" class="form-control" id="nom_emp" name="nom_emp" placeholder="Nombre"
										readonly>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="tip_per">Tipo de persona</label>
									<input type="text" class="form-control" id="tip_per" name="tip_per"
										placeholder="Tipo de persona" readonly>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="cedula">Documento Nacional</label>
									<input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula"
										readonly>
								</fieldset>
							</div>

							<div class="col-lg-12">
								<button type="submit" name="action" value="add"
									class="btn btn-rounded btn-inline btn-primary">Añadir concepto</button>
							</div>
						</form>
					</div>

				</div>

				<div class="box-typical box-typical-padding">
					<table id="contrato_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
						<thead>
							<tr>
								<th style="width: 5%;">Codigo de Cliente</th>
								<th style="width: 5%;">Empresa</th>
								<th style="width: 5%;">Servicio</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Documento</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Mes de pago</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Fecha</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Monto Mensual</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>

			</div>
		</div>

		</div>
		</div>
		<!-- Contenido -->

		<?php require_once("../MainJs/js.php"); ?>

		<script type="text/javascript" src="cobros.js"></script>

	</body>

	</html>
	<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>