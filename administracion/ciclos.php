<?php 
include "php/variablesGenerales.php";
if (!isset($_COOKIE['ckPower'])){ header('Location: index.php'); }

if( in_array($_COOKIE['ckPower'], $secretaria) || in_Array($_COOKIE['ckPower'], $subBasico) ){
	header('Location: sinPermiso.php'); }
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
.filter-option-inner-inner{
	text-transform: capitalize!important;
}
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->
		
	<h2 class="d-print-none"><i class="icofont-people"></i> Ciclos</h2>
	
	<?php if( isset($_GET['month']) && $_COOKIE['ckidSucursal']!='SUC001'){ $_GET['campus']=$_COOKIE['ckidSucursal']; }
	if(!isset($_GET['nuevo'])): ?>
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
				<?php if($_COOKIE['ckidSucursal']=='SUC001'){ ?>
				<div class="col">
				<label for=""><small>Sede:</small></label>
					<select class="selectpicker text-capitalize" id="sltPSedes" data-live-search="true" data-width="100%">
						<?php if(isset($_GET['month'])){ include 'php/OPT_sedes.php'; }else{ echo "<option value='-1'>Seleccione primero el mes</option>"; } ?>
					</select>
				</div>
				<?php } ?>
				<div class="col">
				<label for=""><small>Idioma:</small></label>
					<select class="selectpicker text-capitalize" id="sltPIdiomas" data-live-search="true" data-width="100%">
						<?php if(isset($_GET['campus'])){ include 'php/OPT_idiomas.php'; }else{ echo "<option value='-1'>Seleccione primero mes</option>"; } ?>
					</select>
				</div>
				<div class="col">
				<label for=""><small>Nivel:</small></label>
					<select class="selectpicker text-capitalize" id="sltPNiveles" data-live-search="true" data-width="100%">
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
				<?php include 'php/OPT_todosDocentes.php'; ?>
				</select>	
			
				<label for="">Mes:</label>
				<select class="text-capitalize selectpicker" id="sltPMeses" data-live-search="true" data-width="100%">
					<?php include 'php/OPT_mesesTodos.php'; ?>
				</select>	
				<label for="">Año:</label>
				<select class="text-capitalize selectpicker" id="sltPAnios" data-live-search="true" data-width="100%">
					<?php include 'php/OPT_AniosCiclos.php'; ?>
				</select>
				<button class="btn btn-outline-primary mt-2 " id="btnCrearCiclo"><i class="icofont-save"></i> Crear ciclo</button>
			</div>
		</div>
	</div>
	<?php endif; ?>
	
	
	<?php 
	if(isset($_GET['campus'])):
	
	$filtroExtra ='';
	if(isset($_GET['campus'])){ $filtroExtra.=" AND  s.Suc_Codigo='{$_GET['campus']}' "; }
	if(isset($_GET['language'])){ $filtroExtra.=" AND  s.Idi_Codigo='{$_GET['language']}' "; }
	if(isset($_GET['level'])){ $filtroExtra.=" AND  s.Niv_Codigo='{$_GET['level']}' "; }
	

	$sqlCursos = "SELECT s.*, i.Idi_Nombre, n.Niv_Detalle, lower(hc.Hor_HoraInicio) as Hor_HoraInicio, lower(hc.Hor_HoraSalida) as Hor_HoraSalida, lower(su.Suc_Direccion) as Suc_Direccion, lower(concat(em.Emp_Apellido, ', ', em.Emp_Nombre)) as docNombre, lower(sucDescripcion) as sucDescripcion FROM `seccion` s
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
					<th>Sede</th>
					<th>Curso</th>
					<th>Nivel</th>
					<th>Ciclo</th>
					<th>Sección</th>
					<th>Docente</th>
					<th>Dia - Hora inicio</th>
					<th>Hora salida</th>
					<th>Mes</th>
					<th>@</th>
				</tr>
			</thead>
			<tbody>
				<?php if($resultadoCursos->num_rows >0){
				while($rowCursos =$resultadoCursos ->fetch_assoc()){ ?>
				<tr>
					<td><?= $i;?></td>
					<td><button class="btn btn-outline-danger border-0 btn-sm btnEliminarSeccion" data-delete='<?= $rowCursos['Sec_Codigo'];?>'> <i class="icofont-close"></i> </button> <span><?= $rowCursos['Sec_Codigo'];?></span></td>
					<td class="text-capitalize"><?= $rowCursos['sucDescripcion'];?></td>
					<td><?= $rowCursos['Idi_Nombre'];?></td>
					<td><?= $rowCursos['Niv_Detalle'];?></td>
					<td><?= $rowCursos['Sec_NroCiclo'];?></td>
					<td><?= $rowCursos['Sec_Seccion'];?></td>
					<td class="text-capitalize"><?= $rowCursos['docNombre'];?></td>
					<td class="text-capitalize"><?= $rowCursos['Hor_HoraInicio'];?></td>
					<td class="text-capitalize"><?= $rowCursos['Hor_HoraSalida'];?></td>
					<td><?= $rowCursos['Mes_Codigo'];?></td>
					<td><a class="text-decoration-none" href="cursodocente.php?cursor=<?= $rowCursos['Sec_Codigo']; ?>"><i class="icofont-dotted-right"></i></a></td>
				</tr>
				<?php $i++; }
				}else{?>
				<tr>
					<td colspan="12">Actualmente no tiene cursos asignados.</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php endif; ?>

	
<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
</div>

<div id="modalEliminarCurso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title text-danger" id="my-modal-title">Eliminar</h5>
				<p>Está seguro que desea eliminar el curso actual?</p>
				<p><strong>Nota: </strong> El curso no debe contener alumnos para poder ser aliminado</p>
				<button class="btn btn-outline-danger"  id="btnRemoveCurso"> <i class="icofont-close"></i> Sí, eliminar definitivamente</button>
			</div>
		</div>
	</div>
</div>

<?php include "php/footer.php"; ?>

<script>
$('.selectpicker').selectpicker();
<?php if(!isset($_GET['nuevo'])): ?>
	$('#sltPAnios').selectpicker('val',-1);
	$('#sltPMeses').selectpicker('val',-1);
	$('#sltPSedes').selectpicker('val',-1);
	$('#sltPIdiomas').selectpicker('val',-1);
	$('#sltPNiveles').selectpicker('val',-1);
	$('#sltPMeses').prop('disabled', true).selectpicker('refresh');
	$('#sltPSedes').prop('disabled', true).selectpicker('refresh');
	$('#sltPIdiomas').prop('disabled', true).selectpicker('refresh');
	$('#sltPNiveles').prop('disabled', true).selectpicker('refresh');

	<?php if( isset($_GET['year'])): ?>
	$('#sltPAnios').selectpicker('val',<?= $_GET['year']?>).selectpicker('refresh');
	$('#sltPMeses').prop('disabled', false).selectpicker('val',-1).selectpicker('refresh');
	<?php endif; if( isset($_GET['month'])): ?>
	$('#sltPMeses').selectpicker('val', <?= $_GET['month']?>).selectpicker('refresh');
	$('#sltPSedes').prop('disabled', false).selectpicker('val',-1).selectpicker('refresh');
	<?php endif; if( isset($_GET['campus']) ): ?>
	$('#sltPSedes').selectpicker('val', '<?= $_GET['campus']?>').selectpicker('refresh');
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
$('#sltPSedes').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "ciclos.php?year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val')+'&campus='+$('#sltPSedes').selectpicker('val');
	}
});
$('#sltPIdiomas').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "ciclos.php?year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val')+'&campus='+$('#sltPSedes').selectpicker('val')+'&language='+$('#sltPIdiomas').selectpicker('val');
	}
});
$('#sltPNiveles').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "ciclos.php?year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val')+'&campus='+$('#sltPSedes').selectpicker('val')+'&language='+$('#sltPIdiomas').selectpicker('val')+'&level='+$('#sltPNiveles').selectpicker('val');
	}
});
$('tbody').on('click', '.btnEliminarSeccion', function (e) {
	$('#btnRemoveCurso').attr('data-remove', $(this).attr('data-delete'))
	$('#modalEliminarCurso').modal('show');
});
$('#btnRemoveCurso').click(function() {
	$.ajax({url: 'php/removeCiclo.php', type: 'POST', data: { registro: $(this).attr('data-remove') }}).done(function(resp) {
		console.log(resp);
		if(resp=='todo ok'){
			location.reload();
		}else{
			$('#h1Advertencia').text('Ocurrió un error al intentar eliminar ciclo, comuníquelo al área de soporte');
			$('#modalAdvertencia').modal('show');
		}
	});
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
/* $('#sltPIdiomas').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
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
}); */
<?php endif; ?>


<?php endif; ?>

</script>
</body>
</html>