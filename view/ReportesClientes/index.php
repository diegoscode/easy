<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
	?>
	<!DOCTYPE html>
	<html>
	<?php require_once("../MainHead/head.php"); ?>
	<title>Reporte</title>
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
								<h3>Reportes</h3>
								<ol class="breadcrumb breadcrumb-simple">
									<li><a href="#">Home</a></li>
									<li class="active">Crear reporte</li>
								</ol>
							</div>
						</div>
					</div>
				</header>

				<div class="box-typical box-typical-padding">
					<table id="reportes_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
						<thead>
							<tr>
								<th style="width: 1%;">Numero de recibo</th>
								<?php
								if ($_SESSION['rol_id'] == 2) {
									echo '<th style="width: 5%;">Nombre</th>
									<th style="width: 5%;">Cedula</th>
									<th style="width: 5%;">Telefono</th>';
								}
								?>
								<th style="width: 5%;">Tipo de pago</th>

								<th class="d-none d-sm-table-cell" style="width: 5%;">Origen</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Fecha de la transaccion</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Importe</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Comprobante</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Imprimir </th>
								<?php
								if ($_SESSION['rol_id'] == 2) {
									echo '<th class="d-none d-sm-table-cell" style="width: 5%;">Acciones</th>';
								}
								?>
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
		<?php require_once("modalimagen.php"); ?>
		<script type="text/javascript" src="reportesclientes.js"></script>

	</body>

	</html>
	<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>