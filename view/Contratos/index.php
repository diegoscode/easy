<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
	?>
	<!DOCTYPE html>
	<html>
	<?php require_once("../MainHead/head.php"); ?>
	<title>Contratos</title>
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
								<h3>Contratos</h3>
								<ol class="breadcrumb breadcrumb-simple">
									<li><a href="#">Home</a></li>
									<li class="active">Nuevo Contrato</li>
								</ol>
							</div>
						</div>
					</div>
				</header>

				<div class="box-typical box-typical-padding">

					<h5 class="m-t-lg with-border">Nuevo Contrato</h5>

					<div class="row">
						<form method="post" id="contratos_form">

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="exampleInput">Asociar cliente</label>
									<select name="contratos_select" id="contratos_select" class="form-control">
									</select>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="tip_per">Tipo de empresa</label>
									<input type="text" class="form-control" id="tip_per" name="tip_per"
										placeholder="Tipo de empresa" readonly>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="exampleInput">Servicio a contratar</label>
									<select id="cat_serv" name="cat_serv" class="form-control">
									</select>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="nom_emp">Nombre de la empresa</label>
									<input type="text" class="form-control" id="nom_emp" name="nom_emp" placeholder="Nombre"
										readonly>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="doc_nac">Documento Nacional</label>
									<input type="text" class="form-control" id="doc_nac" name="doc_nac"
										placeholder="Documento Nacional" readonly>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="cost_serv">Monto</label>
									<input type="text" class="form-control" id="cost_serv" name="cost_serv"
										placeholder="Monto a pagar" readonly>
								</fieldset>
							</div>

							<div class="col-lg-12">
								<button type="submit" name="action" value="add"
									class="btn btn-rounded btn-inline btn-primary">Generar Contrato</button>
							</div>
						</form>
					</div>

				</div>

				<div class="box-typical box-typical-padding">
					<table id="contratos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
						<thead>
							<tr>
								<th style="width: 5%;">Numero de Contrato</th>
								<th style="width: 1%;">Empresa</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Documento Nacional</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Tipo de empresa</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Servicio contratado</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Monto a pagar</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Fecha del contrato</th>
								<th class="d-none d-sm-table-cell" style="width: 1%;">Estado</th>
								<th class="text-center" style="width: 5%;"></th>
								<th class="text-center" style="width: 5%;"></th>
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

		<script type="text/javascript" src="contratos.js"></script>

	</body>

	</html>
	<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>