<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'php/header.php';
	include "php/conexionInfocat.php";
	?>
</head>
<body>

<style>

</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->

		
	<h2 class="d-print-none"><i class="icofont-briefcase"></i> Bienvendo a CEID UNCP</h2>
	
	<p>Actualmente estamos trabajando para añadir más funcionalidades. Sea paciente.</p>
	<?php $sqlResumen = "select totalCursosMes() as cursos, totalReservaMes() as reservas, totalAlumnosMes() as alumnos; ";
	$respuestaResumen = $cadena->query($sqlResumen);
	$rowResumen = $respuestaResumen->fetch_assoc();
	 ?>

	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title"><i class="icofont-people"></i> <?= $rowResumen['alumnos']; ?></h3>
					<p class="card-text">Total alumnos matriculados</p>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title"><i class="icofont-id-card"></i> <?= $rowResumen['reservas']; ?></h3>
					<p class="card-text">Total Reservas Matrícula</p>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title"><i class="icofont-notebook"></i> <?= $rowResumen['cursos']; ?></h3>
					<p class="card-text">Total de cursos dictando</p>
				</div>
			</div>
		</div>
	</div>
<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
</div>

<?php include "php/footer.php"; ?>

<script>

</script>
</body>
</html>