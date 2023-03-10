<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
	?>
	<!DOCTYPE html>
	<html>
	<?php require_once("../MainHead/head.php"); ?>
	<title>Clientes</title>
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
								<h3>Clientes</h3>
								<ol class="breadcrumb breadcrumb-simple">
									<li><a href="#">Home</a></li>
									<li class="active">Nuevo Cliente</li>
								</ol>
							</div>
						</div>
					</div>
				</header>

				<div class="box-typical box-typical-padding">
					<button type="button" id="btnnuevo" class="btn btn-inline btn-primary">Nuevo Cliente</button>
					<table id="clientes_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
						<thead>
							<tr>
								<th style="width: 1%;">Codigo</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Cliente</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Documento de identidad o RIF</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Tipo de cliente</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Direccion</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>
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
		<!-- Contenido -->

		<?php require_once("modalclientes.php"); ?>

		<?php require_once("../MainJs/js.php"); ?>

		<script type="text/javascript" src="clientes.js"></script>

	</body>

	</html>
	<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>