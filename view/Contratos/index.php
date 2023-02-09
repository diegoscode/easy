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
									<li class="active">Registro de Contrato</li>
								</ol>
							</div>
						</div>
					</div>
				</header>

				<div class="box-typical box-typical-padding">

					<div class="row">
						<form method="post" id="contratos_form">

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="exampleInput">Asociar cliente</label>
									<select name="contratos_select" id="contratos_select" class="form-control">
										<option>Seleccione un cliente</option>

									</select>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="tip_per">Tipo de cliente</label>
									<input type="text" class="form-control" id="tip_per" name="tip_per"
										placeholder="Empresa o particular" readonly>
								</fieldset>
							</div>

							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label semibold" for="exampleInput">Servicio a pagar</label>
									<select id="cat_serv" name="cat_serv[]" multiple="multiple" class="form-control">
									</select>
								</fieldset>
							</div>

							<div class="col-lg-3">
								<fieldset class="form-group">
									<label class="form-label semibold" for="nom_emp">Cliente</label>
									<input type="text" class="form-control" id="nom_emp" name="nom_emp" placeholder="Nombre"
										readonly>
								</fieldset>
							</div>

							<div class="col-lg-3">
								<fieldset class="form-group">
									<label class="form-label semibold" for="doc_nac">Documento de identidad o RIF</label>
									<input type="number" class="form-control" id="doc_nac" name="doc_nac" placeholder="CI o RIF"
										readonly>
								</fieldset>
							</div>

							<div class="col-lg-3">
								<fieldset class="form-group">
									<label class="form-label semibold" for="cost_serv">Costo del servicio</label>
									<input type="number" class="form-control" id="cost_serv" name="cost_serv"
										placeholder="Costo" readonly>
								</fieldset>
							</div>

							<div class="col-lg-3">
								<fieldset class="form-group">
									<label class="form-label semibold" for="contrato_plan">Tipos de planes</label>
									<select class="form-control" name="contrato_plan" id="contrato_plan">
										<option value="">Seleccione
										</option>
									</select>
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
								<th style="width: 1%;">Numero de contrato</th>
								<th style="width: 1%;">Cliente</th>
								<th style="width: 1%;">Tipo de contrato</th>
								<th style="width: 1%;">Horario</th>
								<th class="d-none d-sm-table-cell" style="width: 1%;">Documento de identidad o RIF</th>
								<th class="d-none d-sm-table-cell" style="width: 1%;">Tipo de cliente</th>
								<th class="d-none d-sm-table-cell" style="width: 1%;">Servicio contratado</th>
								<th class="d-none d-sm-table-cell" style="width: 1%;">Costo</th>
								<th class="d-none d-sm-table-cell" style="width: 1%;">Fecha del contrato</th>
								<th class="d-none d-sm-table-cell" style="width: 1%;">Estado</th>
								<th class="d-none d-sm-table-cell" style="width: 1%;">Acciones</th>
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
		<?php require_once("modalcontratos.php"); ?>

		<?php require_once("../MainJs/js.php"); ?>

		<script type="text/javascript" src="contratos.js"></script>

	</body>

	</html>
	<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>