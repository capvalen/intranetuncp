<?php 
include "php/variablesGenerales.php";
if (!isset($_COOKIE['ckPower'])){ header('Location: index.php'); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'php/header.php';
	include "php/conexionInfocat.php";
	?>
</head>
<body>

<style>
.bootstrap-select .dropdown-toggle{
	text-transform: capitalize;
}
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->

		
	<h2 class="d-print-none"><i class="icofont-graduate"></i> Docentes</h2>
	
	<div class="card col-md-6">
		<div class="card-body">
		<p class="card-text m-0"><small class="text-muted"><i class="icofont-filter"></i> Filtro</small></p>
		<label for=""><small>Seleccione un docente:</small></label>
		<select class="selectpicker" id="sltPDocentes" data-live-search="true" data-width="100%">
			<?php include 'php/OPT_docentes.php'; ?>
		</select>
		</div>
	</div>

	<?php if( isset($_GET['cursor'])){ ?>
	<!-- Inicio contenido cuando existe docente -->
	<?php 
		$sqlDocente="SELECT `Emp_Codigo`, lower(trim(`Emp_Nombre`)) as Emp_Nombre, lower( trim(`Emp_Apellido`)) as Emp_Apellido, `Emp_Sexo`,
		IFNULL(date_format(`Emp_FechaNacimiento`, '%d/%m/%Y'), '01/01/1950') as Emp_FechaNacimiento, ifnull(date_format(Emp_FechaNacimiento, '%Y-%m-%d'), '1950-01-01') as FNacimiento,
		 `Emp_Direccion`, `Emp_Nacionalidad`, `Emp_Telefono`, `Emp_TipoDocumento`, `Emp_NroDocumento`, `Emp_email`, `Emp_Estado`, `Emp_Foto`, `Emp_Trato`, `Emp_cuenta`, `Emp_displayWeb` FROM `empleado` WHERE `Emp_Codigo` = '{$_GET['cursor']}'";
		$resultadoDocente=$cadena->query($sqlDocente);
		if($resultadoDocente->num_rows >=1){ 
		$rowDocente=$resultadoDocente->fetch_assoc();  ?> 
		<div class="card mt-3">
			<div class="card-body container-fluid">
				
				<div class="cabecera d-flex justify-content-center">
				<center>
				<?php if($rowDocente['Emp_Sexo']=='1'): ?>
					<img src="images/docente.jpg" alt="" class="img-fluid rounded-circle d-block" width="200px">
				<?php else: ?>
					<img src="images/docente_m.jpg" alt="" class="img-fluid rounded-circle d-block" width="200px">
				<?php endif; ?>
										
					<h3 class="text-muted d-block">Perfil Docente CEID <button class="btn btn-outline-primary btn-sm border-0" id="btnHabilitar" onclick="habilitarEdicion()"><i class="icofont-ui-edit"></i></button>
					<button class="btn btn-outline-success btn-sm border-0 d-none" id="btnActualizar" onclick="guardarEdicion()"><i class="icofont-check"></i></button>
					<button class="btn btn-outline-danger btn-sm border-0 d-none" id="btnCancelar" onclick="cancelarEdicion()"><i class="icofont-close"></i></button>
					</h3>
					</center>
				</div>

				<div class="row row-cols-2" id="divDatosAlumno">
					<div class="col text-center">
						<h5>Apellidos</h5>
							<span class="text-capitalize"><?= $rowDocente['Emp_Apellido']; ?></span>
							<input class="form-control text-capitalize d-none" type="text" id="txtApellido" name="" autocomplete="nope" value="<?= $rowDocente['Emp_Apellido']; ?>">
						<h5>Nombres</h5>
							<span class="text-capitalize"><?= $rowDocente['Emp_Nombre']; ?></span>
							<input class="form-control text-capitalize d-none" type="text" id="txtNombre" name="" autocomplete="nope" value="<?= $rowDocente['Emp_Nombre']; ?>">
						<h5>D.N.I</h5>
							<span><?= $rowDocente['Emp_NroDocumento']; ?></span>
							<input class="form-control d-none" type="text" id="txtDni" name="" autocomplete="nope" value="<?= $rowDocente['Emp_NroDocumento']; ?>">
						<h5>Fecha de nacimiento</h5>
							<span><?php $hoy=new DateTime(); $fNac= new DateTime($rowDocente['FNacimiento']); echo $rowDocente['Emp_FechaNacimiento']. " (" . intval($hoy->format('Y') - $fNac->format('Y') )  ." años)"; ?></span>
							<input class="form-control d-none" type="date" id="txtFechaNacimiento" name="" autocomplete="nope" value="<?= $rowDocente['FNacimiento'];?>">
						<h5>Sexo</h5>
							<span><?php if($rowDocente['Emp_Sexo']=='1'){echo "Masculino";}else{echo 'Femenino';} ?></span>
							<div class="form-group selects d-none">
								<select id="sltSexo" class="form-control" name="">
									<option value="1" <?php if($rowDocente['Emp_Sexo']=='1'){ ?> selected="selected" <?php } ?>>Masculino</option>
									<option value="0" <?php if($rowDocente['Emp_Sexo']!='1'){ ?> selected="selected" <?php } ?>>Femenino</option>
								</select>
							</div>
					</div>
			
					<div class="col text-center">
						<h5>Dirección</h5>
							<span class="text-capitalize"><?= $rowDocente['Emp_Direccion']; ?></span>
							<input class="form-control d-none text-capitalize" type="text" id="txtDireccion" name="" autocomplete="nope" value="<?= $rowDocente['Emp_Direccion']; ?>">
						<h5>Celular</h5>
							<span><?= $rowDocente['Emp_Telefono']; ?></span>
							<input class="form-control d-none" type="text" id="txtCelular" name="" autocomplete="nope" value="<?= $rowDocente['Emp_Telefono']; ?>">
						<h5>Correo electrónico</h5>
							<span><?= $rowDocente['Emp_email']; ?></span>
							<input class="form-control d-none" type="text" id="txtCorreo" name="" autocomplete="nope" value="<?= $rowDocente['Emp_email']; ?>">
					</div>
				</div>
			</div>
		</div>
			
		<div class="card mt-3">
			<div class="card-body">
				<h3 class="text-muted d-block">Historial de cursos del docente </h3>
				<?php $sqlCurso="SELECT s.*, i.Idi_Nombre, n.Niv_Detalle, lower(hc.Hor_HoraInicio) as Hor_HoraInicio, lower(hc.Hor_HoraSalida) as Hor_HoraSalida, lower(su.Suc_Direccion) as Suc_Direccion, lower(sucDescripcion) as sucDescripcion FROM `seccion` s
				inner join idioma i on i.Idi_Codigo = s.Idi_Codigo
				inner join nivel n on n.Niv_Codigo = s.Niv_Codigo
				inner join mesacademico ma on ma.Mes_Codigo = s.Mes_Codigo
				inner join horarioclases hc on hc.Hor_Codigo = s.Hor_Codigo
				inner join sucursal su on su.Suc_Codigo = s.Suc_Codigo
				inner join empleado em on em.Emp_Codigo = s.Emp_Codigo
				where s.Emp_Codigo = '{$_GET['cursor']}'
				order by ma.Mes_Inicio desc, Idi_Nombre, Niv_Detalle, Sec_NroCiclo, Sec_Seccion asc";
				$resultadoCurso=$cadena->query($sqlCurso);
				if($resultadoCurso->num_rows >= 1 ){ ?>
				<table class="table table-hover">
					<thead>
						<th>N°</th>
						<th>Código</th>
						<th>Periodo</th>
						<th>Idioma</th>
						<th>Nivel</th>
						<th>Ciclo</th>
						<th>Horario</th>
						<th>Sucursal</th>
					</thead>
					<tbody> <?php $i=1;
					while($rowCurso=$resultadoCurso->fetch_assoc()){ ?> 
						<tr>
							<td><?= $i; ?></td>
							<td  class="text-capitalize"><a href="cursodocente.php?cursor=<?= $rowCurso['Sec_Codigo']; ?>"><?= $rowCurso['Sec_Codigo']; ?></a></td>
							<td><?= substr($rowCurso['Mes_Codigo'], -4)."-".substr($rowCurso['Mes_Codigo'], 0,-4); ?></td>
							<td><?= $rowCurso['Idi_Nombre']; ?></td>
							<td><?= $rowCurso['Niv_Detalle']; ?></td>
							<td><?= $rowCurso['Sec_NroCiclo'] ." - ". $rowCurso['Sec_Seccion']; ?></td>
							<td class="text-capitalize"><?= $rowCurso['Hor_HoraInicio']  ." - ".$rowCurso['Hor_HoraSalida']; ?></td>
							<td class="text-capitalize"><?= $rowCurso['sucDescripcion']; ?></td>
						</tr>
					<?php $i++; } ?> 
					</tbody>
				</table>
				 <?php }else{
					?> <p>Aún no se le asignaron cursos al docente</p> <?php
				} ?>
				
			</div>
		</div>
		<?php
	}else{
			?> <p>No se encontró ningun docente, revisa el código.</p> <?php
		}
	?>

	<!-- Fin contenido cuando existe docente -->
	<?php } ?>
<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
</div>

<?php include "php/footer.php"; ?>

<script>
$('.selectpicker').selectpicker('val', -1);
$('#sltPDocentes').change(function() {
	window.location.href = 'docente.php?cursor=' + $('#sltPDocentes').val() ;
});
function habilitarEdicion(){
	$('#btnHabilitar').addClass('d-none');
	$('#btnActualizar').removeClass('d-none');
	$('#btnCancelar').removeClass('d-none');
	$('#divDatosAlumno span').addClass('d-none');
	$('#divDatosAlumno input').removeClass('d-none');
	$('#divDatosAlumno .selects').removeClass('d-none');
}
function cancelarEdicion(){
	$('#btnHabilitar').removeClass('d-none');
	$('#btnActualizar').addClass('d-none');
	$('#btnCancelar').addClass('d-none');
	$('#divDatosAlumno span').removeClass('d-none');
	$('#divDatosAlumno input').addClass('d-none');
	$('#divDatosAlumno .selects').addClass('d-none');

}
<?php if(isset($_GET['cursor'])): ?>
function guardarEdicion(){
pantallaOver(true);
$.ajax({url: 'php/updateDataDocenteComplete.php', type: 'POST', data: {idDoc: '<?= $_GET['cursor']; ?>',
	nombre: $.trim($('#txtNombre').val()),
	apellidos: $.trim($('#txtApellido').val()),
	dni: $.trim($('#txtDni').val()),
	sexo: $('#sltSexo').val(),
	fNac: $('#txtFechaNacimiento').val(),
	direccion: $.trim($('#txtDireccion').val()),
	email: $.trim($('#txtCorreo').val()),
	celular: $.trim($('#txtCelular').val()),
 }}).done(function(resp) {
	console.log(resp)
	pantallaOver(false)
	if(resp == 'todo ok'){
		location.reload();
	}
});
}
<?php endif; ?>
</script>
</body>
</html>