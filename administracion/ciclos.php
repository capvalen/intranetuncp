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
		
	<h2 class="d-print-none"><i class="icofont-people"></i> Ciclos</h2>
	
	<?php if(!isset($_GET['nuevo'])): ?>
	<div class="card mb-3 ">
		<div class="card-body pt-1">
		<p class="card-text m-0"><small class="text-muted"><i class="icofont-filter"></i> Filtro</small></p>
			<div class="form-row">
				<div class="col">
					<label for=""><small>Año:</small></label>
					<select class="selectpicker" id="sltPAnios" data-live-search="true" data-width="100%">
						<?php include 'php/returnAniosDocenteCiclaje.php'; ?>
					</select>
				</div>
				<div class="col">
				<label for=""><small>Mes:</small></label>
					<select class="selectpicker" id="sltPMeses" data-live-search="true" data-width="100%">
						<?php if(isset($_GET['year'])){ include 'php/returnMesesDocenteCiclaje.php'; }else{ echo "<option value='-1'>Seleccione primero el año</option>"; } ?>
					</select>
				</div>
				<div class="col">
				<label for=""><small>Sede:</small></label>
					<select class="selectpicker" id="sltPMeses" data-live-search="true" data-width="100%">
						<?php if(isset($_GET['month'])){ include 'php/returnSedesCiclaje.php'; }else{ echo "<option value='-1'>Seleccione primero el mes</option>"; } ?>
					</select>
				</div>
				<div class="col">
				<label for=""><small>Idioma:</small></label>
					<select class="selectpicker" id="sltPIdiomas" data-live-search="true" data-width="100%">
						<?php if(isset($_GET['campus'])){ include 'php/OPT_idiomas.php'; }else{ echo "<option value='-1'>Seleccione primero mes</option>"; } ?>
					</select>
				</div>
				<div class="col">
				<label for=""><small>Nivel:</small></label>
					<select class="selectpicker" id="sltPNiveles" data-live-search="true" data-width="100%">
						<?php if(isset($_GET['language'])){ include 'php/returnNivelesCiclaje.php'; }else{ echo "<option value='-1'>Seleccione primero idioma</option>"; } ?>
					</select>
				</div>
				<div class="col d-flex align-items-end">
					<a class="btn btn-outline-primary" href="ciclos.php?nuevo"><i class="icofont-bulb-alt"></i> Crear ciclo</a>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if(isset($_GET['nuevo'])): ?>
	<div class="container">
		<div class="card col-6">
			<div class="card-body">
				<label for="">Sucursal:</label>
				<select class="text-capitalize selectpicker" id="sltPSucursales" data-live-search="true" data-width="100%">
					<?php include 'php/OPT_sedes.php'; ?>
				</select>
				<label for="">Idioma:</label>
				<select class="text-capitalize selectpicker" id="sltPIdiomas" data-live-search="true" data-width="100%">
					<?php include 'php/OPT_idiomas.php'; ?>
				</select>
				<label for="">Nivel:</label>
				<select class="text-capitalize selectpicker" id="sltPAniosNiveles" data-live-search="true" data-width="100%">
					<?php include 'php/OPT_niveles.php'; ?>
				</select>	
				<label for="">Ciclo:</label>
				<select class="text-capitalize selectpicker" id="sltPCiclos" data-live-search="true" data-width="100%">
					<?php include 'php/OPT_ciclos.php'; ?>
				</select>	
				<label for="">Horario:</label>
				<select class="text-capitalize selectpicker" id="sltPHorario" data-live-search="true" data-width="100%">
					<?php include 'php/OPT_horarios.php'; ?>
				</select>	
				<label for="">Docente:</label>
				<select class="text-capitalize selectpicker" id="sltPDocentes" data-live-search="true" data-width="100%">
				</select>	
			
				<label for="">Mes:</label>
				<select class="text-capitalize selectpicker" id="sltPMeses" data-live-search="true" data-width="100%">
					<?php include 'php/OPT_mesesTodos.php'; ?>
				</select>	
				<label for="">Año:</label>
				<select class="text-capitalize selectpicker" id="sltPAnios" data-live-search="true" data-width="100%">
					<?php include 'php/OPT_AniosCiclos.php'; ?>
				</select>
				<button class="btn btn-outline-primary" id="btnCrearCiclo"><i class="icofont-save"></i> Crear ciclo</button>
			</div>
		</div>
	</div>
	<?php endif; ?>
	
	<?php if(isset($_GET['month'])):
	include "php/conexionInfocat.php"; 
	$filtroExtra ='';
	if(isset($_GET['language'])){ $filtroExtra.=" AND  s.Idi_Codigo='{$_GET['language']}' "; }
	if(isset($_GET['level'])){ $filtroExtra.=" AND  s.Niv_Codigo='{$_GET['level']}' "; }
	if(isset($_GET['campus'])){ $filtroExtra.=" AND  s.Suc_Codigo='{$_GET['campus']}' "; }

	$sqlCursos = "SELECT s.*, i.Idi_Nombre, n.Niv_Detalle, lower(hc.Hor_HoraInicio) as Hor_HoraInicio, lower(hc.Hor_HoraSalida) as Hor_HoraSalida, lower(su.Suc_Direccion) as Suc_Direccion, lower(concat(em.Emp_Apellido, ', ', em.Emp_Nombre)) as docNombre FROM `seccion` s
	inner join idioma i on i.Idi_Codigo = s.Idi_Codigo
	inner join nivel n on n.Niv_Codigo = s.Niv_Codigo
	inner join mesacademico ma on ma.Mes_Codigo = s.Mes_Codigo
	inner join horarioclases hc on hc.Hor_Codigo = s.Hor_Codigo
	inner join sucursal su on su.Suc_Codigo = s.Suc_Codigo
	inner join empleado em on em.Emp_Codigo = s.Emp_Codigo
	where year(ma.Mes_Inicio)= {$_GET['year']} and month(ma.Mes_Inicio)= {$_GET['month']} AND Sec_NroCiclo<>0 {$filtroExtra}
	order by Idi_Nombre, Niv_Detalle, Sec_NroCiclo, Sec_Seccion asc; "; //echo $sqlCursos;
	$resultadoCursos=$cadena->query($sqlCursos); $i=1; ?>
	<div class="container-fluid">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>N°</th>
					<th>Código</th>
					<th>Curso</th>
					<th>Nivel</th>
					<th>Ciclo</th>
					<th>Sección</th>
					<th>Docente</th>
					<th>Dia - Hora inicio</th>
					<th>Hora salida</th>
					<th>Sede</th>
					<th>Mes</th>
					<th>@</th>
				</tr>
			</thead>
			<tbody>
				<?php if($resultadoCursos->num_rows >0){
				while($rowCursos =$resultadoCursos ->fetch_assoc()){ ?>
				<tr>
					<td><?= $i;?></td>
					<td><?= $rowCursos['Sec_Codigo'];?></td>
					<td><?= $rowCursos['Idi_Nombre'];?></td>
					<td><?= $rowCursos['Niv_Detalle'];?></td>
					<td><?= $rowCursos['Sec_NroCiclo'];?></td>
					<td><?= $rowCursos['Sec_Seccion'];?></td>
					<td class="text-capitalize"><?= $rowCursos['docNombre'];?></td>
					<td class="text-capitalize"><?= $rowCursos['Hor_HoraInicio'];?></td>
					<td class="text-capitalize"><?= $rowCursos['Hor_HoraSalida'];?></td>
					<td class="text-capitalize"><?= $rowCursos['Suc_Direccion'];?></td>
					<td><?= $rowCursos['Mes_Codigo'];?></td>
					<td><a class="text-decoration-none" href="cursodocente.php?cursor=<?= $rowCursos['Sec_Codigo']; ?>"><i class="icofont-dotted-right"></i></a></td>
				</tr>
				<?php $i++; }
				}else{?>
				<tr>
					<td colspan="7">Actualmente no tiene cursos asignados.</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php endif; ?>

	
<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
</div>

<?php include "php/footer.php"; ?>

<script>
$('.selectpicker').selectpicker();
<?php if(!isset($_GET['nuevo'])): ?>
	$('#sltPAnios').selectpicker('val',-1);
	$('#sltPMeses').selectpicker('val',-1);
	$('#sltPIdiomas').selectpicker('val',-1);
	$('#sltPNiveles').selectpicker('val',-1);
	$('#sltPMeses').prop('disabled', true).selectpicker('refresh');
	$('#sltPIdiomas').prop('disabled', true).selectpicker('refresh');
	$('#sltPNiveles').prop('disabled', true).selectpicker('refresh');

	<?php if( isset($_GET['year'])): ?>
	$('#sltPAnios').selectpicker('val',<?= $_GET['year']?>).selectpicker('refresh');
	$('#sltPMeses').prop('disabled', false).selectpicker('val',-1).selectpicker('refresh');
	<?php endif; if( isset($_GET['month'])): ?>
	$('#sltPMeses').selectpicker('val', <?= $_GET['month']?>).selectpicker('refresh');
	$('#sltPIdiomas').prop('disabled', false).selectpicker('val',-1).selectpicker('refresh');
	<?php endif; if( isset($_GET['language'])): ?>
	$('#sltPIdiomas').selectpicker('val', '<?= $_GET['language']?>').selectpicker('refresh');	
	$('#sltPNiveles').prop('disabled', false).selectpicker('val',-1).selectpicker('refresh');
	<?php endif; if( isset($_GET['level'])): ?>
	$('#sltPNiveles').selectpicker('val', '<?= $_GET['level']?>').selectpicker('refresh');	
	<?php endif; ?>

$('#sltPAnios').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPAnios').selectpicker('val')!= null ){
		location.href = "ciclos.php?year="+$('#sltPAnios').selectpicker('val');
	}
});
$('#sltPMeses').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "ciclos.php?year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val');
	}
});
$('#sltPIdiomas').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "ciclos.php?year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val')+'&language='+$('#sltPIdiomas').selectpicker('val');
	}
});
$('#sltPNiveles').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "ciclos.php?year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val')+'&language='+$('#sltPIdiomas').selectpicker('val')+'&level='+$('#sltPNiveles').selectpicker('val');
	}
});
<?php else: ?>

<?php if(isset($_GET['nuevo'])): ?>
$('.selectpicker').selectpicker('val', -1).selectpicker('refresh');


$('#btnCrearCiclo').click(function () {
	$.ajax({url: 'php/insertCiclo.php', type: 'POST', data:{
		sucursal: $('#sltPSucursales').val(), idioma: $('#sltPIdiomas').val(), nivel: $('#sltPAniosNiveles').val(), ciclo: $('#sltPCiclos').val(), horario: $('#sltPHorario').val(), mes: $('#sltPMeses').val(), anio: $('#sltPAnios').val(), docente: $('#sltPDocentes').val()
	}}).done(function (resp) {
		console.log(resp)
		if(resp.length == 18){
			location.href = "cursodocente.php?cursor="+resp;
		}else{
			$('#h1Advertencia').text('Ocurrió un error al intentar insertar ciclo nuevo, comuníquelo al área de soporte');
			$('#modalAdvertencia').modal('show');
		}
	})

});
$('#sltPIdiomas').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
  pantallaOver(true);
	if($('#sltPIdiomas').val()!=null){
		$.post('php/OPT_docentes.php', {idioma: $('#sltPIdiomas').val() }).done(function (resp) {
			console.log(resp);
			$('#sltPDocentes').children().remove();
			$('#sltPDocentes').append(resp);
			$('#sltPDocentes').selectpicker('refresh').selectpicker('render').selectpicker('val', -1);
			pantallaOver(false);
		});
	}
});
<?php endif; ?>


<?php endif; ?>

</script>
</body>
</html>