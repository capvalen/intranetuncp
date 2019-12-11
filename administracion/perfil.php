<?php 
if (!isset($_COOKIE['ckPower'])){ header('Location: index.php'); } ?>
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

	<h2 class="d-print-none text-secondary my-2"><i class="icofont-briefcase"></i> Bienvenido al Centro de Idiomas</h2>
	<h5> Hola, <span class='text-capitalize'><?= $_COOKIE['ckAtiende']; ?></span>, seleccione una opción para empezar</h5>
		

	<div class="my-3">
		<img src="images/banner.png" class="img-fluid" width="1000px">
	</div>

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
					<h5><a class="text-decoration-none" href="mesacademico.php"><i class="icofont-certificate"></i> Mes académico</a></h5>
					<span><small>Si desea crear un ciclo nuevo, debe crear un Mes académico primero.</small></span>
				</div>
			</div>
		</div>
		<?php } ?>

	
		<?php if(in_array($_COOKIE['ckPower'], $subRegistro) || $_COOKIE['ckidSucursal']=='SUC002' ){ ?>
		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="ciclos.php"><i class="icofont-black-board"></i> Ciclos</a></h5>
					<span><small>Sección donde puede crear cursos y editar al alumnado.</small></span>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<?php if(in_array($_COOKIE['ckPower'], $subRegistro) || $_COOKIE['ckidSucursal']=='SUC002' ){ ?>
		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="matricula.php"><i class="icofont-quill-pen"></i> Matrícula de alumno</a></h5>
					<span><small>Sección de matrículas de alumno bajo un proceso normal.</small></span>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if( in_array($_COOKIE['ckPower'], $subAdministracion) || in_array($_COOKIE['ckPower'], $subRegistro) || $_COOKIE['ckidSucursal']=='SUC002' ){ ?>
		<div class="col my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a href="pagos.php"><i class="icofont-paper"></i> Pagos</a></h5>
					<span><small>Sección para registrar pagos del alumnado en sus diferentes ciclos.</small></span>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if(in_array($_COOKIE['ckPower'], $subAcademica) || in_array($_COOKIE['ckPower'], $subRegistro) || $_COOKIE['ckidSucursal']=='SUC002' ){ ?>
		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="reservas.php"><i class="icofont-pen-nib"></i> Reserva de matrícula</a></h5>
					<span><small>Sección de reserva de un mes para el derecho de continuar estudiando.</small></span>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if(in_array($_COOKIE['ckPower'], $secretaria) || in_array($_COOKIE['ckPower'], $subAdministracion) || in_array($_COOKIE['ckPower'], $subAcademica) || in_array($_COOKIE['ckPower'], $subRegistro) || $_COOKIE['ckidSucursal']=='SUC002' ){ ?>
		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="seguimiento.php"><i class="icofont-certificate-alt-2"></i> Seguimiento académico</a></h5>
					<span><small>Sección para poder visualizar un historial académico de un determinado estudiante.</small></span>
				</div>
			</div>
		</div>
		<?php } ?>

		<?php if(in_array($_COOKIE['ckPower'], $secretaria) || in_array($_COOKIE['ckPower'], $subAdministracion) || in_array($_COOKIE['ckPower'], $subAcademica) || in_array($_COOKIE['ckPower'], $subRegistro) || $_COOKIE['ckidSucursal']=='SUC002' ){ ?>
		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="tramite.php"><i class="icofont-paper"></i> Trámite documentario</a></h5>
					<span><small>Área sólo para realizar trámites documentarios y poder hacerles seguimiento.</small></span>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="alumnos.php"><i class="icofont-graduate-alt"></i> Alumnado</a></h5>
					<span><small>Sección para actualizar la data del estudiante CEID.</small></span>
				</div>
			</div>
		</div>

		<div class="col-3 my-3 d-flex align-items-stretch">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h5><a class="text-decoration-none" href="docentes.php"><i class="icofont-graduate"></i> Docentes</a></h5>
					<span><small>Sección para actualizar la data del docente CEID.</small></span>
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