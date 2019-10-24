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

		
	<h2 class="d-print-none"><i class="icofont-briefcase"></i> Bienvenido al Centro de Idiomas</h2>
	
	<p>Seleccione una opción para empezar</p>
	<?php if(in_array($_COOKIE['ckPower'], $subRegistro)){
	$sqlResumen = "select totalCursosMes() as cursos, totalReservaMes() as reservas, totalAlumnosMes() as alumnos; ";
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
	<?php } ?>
	<div class="row">
	
		<?php if(in_array($_COOKIE['ckPower'], $subRegistro) || $_COOKIE['ckidSucursal']=='SUC002' ){ ?>
		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="ciclos.php"><i class="icofont-black-board"></i> Ciclos</a></h5>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if(in_array($_COOKIE['ckPower'], $subRegistro) ){ ?>
		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="mesacademico.php"><i class="icofont-certificate"></i> Mes académico</a></h5>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if(in_array($_COOKIE['ckPower'], $subRegistro) || $_COOKIE['ckidSucursal']=='SUC002' ){ ?>
		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="matricula.php"><i class="icofont-quill-pen"></i> Matrícula de alumno</a></h5>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if( in_array($_COOKIE['ckPower'], $subAdministracion) || in_array($_COOKIE['ckPower'], $subRegistro) || $_COOKIE['ckidSucursal']=='SUC002' ){ ?>
		<div class="col my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a href="pagos.php"><i class="icofont-paper"></i> Pagos</a></h5>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if(in_array($_COOKIE['ckPower'], $subAcademica) || in_array($_COOKIE['ckPower'], $subRegistro) ){ ?>
		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="reservas.php"><i class="icofont-pen-nib"></i> Reserva de matrícula</a></h5>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if(in_array($_COOKIE['ckPower'], $secretaria) || in_array($_COOKIE['ckPower'], $subAdministracion) || in_array($_COOKIE['ckPower'], $subAcademica) || in_array($_COOKIE['ckPower'], $subRegistro) || $_COOKIE['ckidSucursal']=='SUC002' ){ ?>
		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="seguimiento.php"><i class="icofont-certificate-alt-2"></i> Seguimiento académico</a></h5>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if(in_array($_COOKIE['ckPower'], $secretaria) || in_array($_COOKIE['ckPower'], $subAdministracion) || in_array($_COOKIE['ckPower'], $subAcademica) || in_array($_COOKIE['ckPower'], $subRegistro) ){ ?>
		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="tramite.php"><i class="icofont-paper"></i> Trámite documentario</a></h5>
				</div>
			</div>
		</div>
		<?php } ?>
	
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