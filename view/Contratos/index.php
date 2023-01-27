<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
	<title>Contratos</title>
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
					<form method="post" id="contrato_form">

						<input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">

						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label semibold" for="nom_emp">Empresa</label>
								<input type="text" class="form-control" id="nom_emp" name="nom_emp" placeholder="Nombre">
							</fieldset>
						</div>

						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label semibold" for="descrip_contrat">Descripcion</label>
								<input type="text" class="form-control" id="descrip_contrat" name="descrip_contrat" placeholder="Contrato">
							</fieldset>
						</div>

						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label semibold" for="tip_serv">Tipo de servicio</label>
								<input type="text" class="form-control" id="tip_serv" name="tip_serv" placeholder="Servicio">
							</fieldset>
						</div>

						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label semibold" for="cost_serv">Costo del Servicio</label>
								<input type="number" class="form-control" id="cost_serv" name="cost_serv" placeholder="0">
							</fieldset>
						</div>

						<div class="col-lg-12">
							<button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-primary">Generar</button>
						</div>
					</form>
				</div>

			</div>

			<div class="box-typical box-typical-padding">
				<table id="contrato_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
					<thead>
						<tr>
							<th style="width: 5%;">Numero de Contrato</th>
							<th style="width: 5%;">Empresa</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Descripcion</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Tipo</th>
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

	<?php require_once("../MainJs/js.php");?>

	<script type="text/javascript" src="contratos.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>