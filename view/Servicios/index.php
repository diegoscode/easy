<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
	<title>Servicios</title>
</head>
<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php");?>

    <div class="mobile-menu-left-overlay"></div>
    
    <?php require_once("../MainNav/nav.php");?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Crear Servicio</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Nuevo Servicio</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<button type="button" id="btnnuevo" class="btn btn-inline btn-primary">Nuevo Servicio</button>
				<table id="servicio_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
					<thead>
						<tr>
							<th style="width: 10%;">Numero de Servicio</th>
							<th style="width: 10%;">Codigo</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Servicio</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Categoria</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Sub Categoria</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Precio</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>
							<th class="text-center" style="width: 5%;">Accion</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>

		</div>
	</div>
	<!-- Contenido -->

	<?php require_once("modalservicios.php");?>

	<?php require_once("../MainJs/js.php");?>
	
	<script type="text/javascript" src="servicios.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>