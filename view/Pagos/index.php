<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
	?>
	<!DOCTYPE html>
	<html>
	<?php require_once("../MainHead/head.php"); ?>
	<title>Pagos</title>
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
								<h3>Pagos</h3>
								<ol class="breadcrumb breadcrumb-simple">
									<li><a href="#">Home</a></li>
									<li class="active">Nuevo Pago</li>
								</ol>
							</div>
						</div>
					</div>
				</header>

				<div class="box-typical box-typical-padding">

					<h5 class="m-t-lg with-border">Pago del servicio</h5>

					<div class="row">
						<form method="post" id="pagos_form">



							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="exampleInput">Numero de contrato</label>
									<select name="pagos_select" id="pagos_select" class="form-control">
										<option>Seleccione un contrato</option>

									</select>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="nom_emp">Nombre de cliente o empresa</label>
									<input type="text" class="form-control" id="nom_emp" name="nom_emp" placeholder="Nombre"
										readonly>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="exampleInput">Metodos de pagos</label>
									<select name="cat_pag" id="cat_pag" class="form-control">
										<option>Seleccione el metodo</option>
									</select>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="doc_nac">Documento de identidad o RIF</label>
									<input type="text" class="form-control" id="doc_nac" name="doc_nac"
										placeholder="Documento Nacional" readonly>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold">Servicio contrato</label>
									<select name="servicios_select" id="servicios_select" class="form-control" multiple
										disabled>

									</select>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="cost_serv">Costo del servicio</label>
									<input type="text" class="form-control" id="cost_serv" name="cost_serv"
										placeholder="Importe" readonly>
								</fieldset>
							</div>

							<div class="col-lg-12">
								<button type="submit" name="action" value="add"
									class="btn btn-rounded btn-inline btn-primary">Añadir Concepto</button>
							</div>
						</form>
					</div>

				</div>

				<div class="box-typical box-typical-padding">
					<table id="pagos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
						<thead>
							<tr>
								<th style="width: 1%;">Numero de pago</th>
								<th style="width: 1%;">Numero de contrato</th>
								<th style="width: 5%;">Nombre de cliente o empresa</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Documento de identidad o RIF</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Metodo de pago</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Costo del servicio</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Fecha de pago</th>
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

		<script type="text/javascript" src="pagos.js"></script>

	</body>

	</html>
	<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>