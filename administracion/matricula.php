<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'php/header.php';
	include "php/conexionInfocat.php";
	?>
</head>
<body>

<style>
.cardAcordeon{
  cursor:pointer;
}
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";
if(isset($_GET['cursor'])){
	$sqlAlumno = "SELECT `Alu_Codigo`, lower(`Alu_Nombre`) as Alu_Nombre, lower(`Alu_Apellido`) as Alu_Apellido, `Alu_NroDocumento`, date_format(`Alu_FechaNacimiento`, '%d/%m/%Y') as Alu_FechaNacimiento FROM `alumno` where Alu_NroDocumento = '{$_GET['cursor']}';";
	$resultadoAlumno= $cadena->query($sqlAlumno);
}
?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->
		
	<h2 class="d-print-none"><i class="icofont-people"></i> Matrícula</h2>
	
	<div class="card col-6">
		<div class="card-body pt-1">
		<p class="card-text m-0"><small class="text-muted"><i class="icofont-filter"></i> Filtro alumno antiguo:</small></p>
			<div class="form-inline">
      <label class="mr-3" for=""><small>D.N.I Alumno:</small></label>
      <input type="text ml-3" class="form-control" id="txtAlumnoDni">
      <button class="btn btn-outline-primary ml-3" id="btnBuscarDniAlumno"><i class="icofont-search-1"></i> Buscar</button>
      <button class="btn btn-outline-success ml-3" id="btnCrearAlumno"><i class="icofont-bulb-alt"></i> Crear alumno</button>
		</div>
	</div>
  </div>
	<?php if(isset($_GET['cursor'])){ $_POST['idAlumno']=$_GET['cursor']; ?>
  <div class="row mt-3">
    <div class="col-12 my-3">
      <div class="card">
        <div class="card-body">
        <?php if($resultadoAlumno->num_rows>0){$rowAlumno = $resultadoAlumno->fetch_assoc(); $_POST['idAlumno'] = $rowAlumno['Alu_Codigo']; ?>
          <div class="row">
						<h5>Datos del alumno</h5>
						<p class="d-none"><strong>Cod. Int.:</strong> <span><?= $rowAlumno['Alu_Codigo']; ?></span></p>
						<div class='col'><strong>D.N.I.:</strong> <span><?= $rowAlumno['Alu_NroDocumento']; ?></span></div>
						<div class='col'><strong>Apellidos:</strong> <span class="text-capitalize"><?= $rowAlumno['Alu_Apellido']; ?></span></div>
						<div class='col'><strong>Nombres:</strong> <span class="text-capitalize"><?= $rowAlumno['Alu_Nombre']; ?></span></div>
						<p class="d-none"><strong>Fecha de Nacimiento:</strong> <span><?= $rowAlumno['Alu_FechaNacimiento']; ?></span></p>
					</div>
        </div>
        <?php }else{ ?>
          <p>No se encontraron registros de alumnos con el DNI proporcionado</p>
        <?php } ?>
      </div>
    </div>
    <div class="col">
		<div class="card">
		<div class="card-body">
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
				<label for=""><small>Idioma:</small></label>
				<select class="selectpicker" id="sltIdiomas" data-live-search="true" data-width="100%">
					<?php if(isset($_GET['year']) && isset($_GET['month']) ){ include 'php/returnIdiomasCiclaje.php'; }else{ echo "<option value='-1'>Seleccione primero meses</option>"; } ?>
				</select>
				</div>
				<div class="col">
				<label for=""><small>Nivel:</small></label>
				<select class="selectpicker" id="sltNiveles" data-live-search="true" data-width="100%">
					<?php if(isset($_GET['year']) && isset($_GET['month']) ){ include 'php/returnNivelesCiclaje.php'; }else{ echo "<option value='-1'>Seleccione primero Idioma</option>"; } ?>
				</select>
				</div>
				
			</div>
			
			<?php if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['language']) && isset($_GET['level']) ){?>
			<table class="table table-hover mt-3">
				<thead>
					<tr>
						<th>Ciclo</th>
						<th>Docente</th>
						<th>Hora Ini.</th>
						<th>Hora Fin.</th>
						<th>Sede</th>
						<th>Mes</th>
					</tr>
				</thead>
				<tbody>
				<?php $sqlCiclosHab = "SELECT s.Sec_Codigo, s.Mes_Codigo, i.Idi_Nombre, n.Niv_Detalle, Sec_NroCiclo, Sec_Seccion, lower(hc.Hor_HoraInicio) as Hor_HoraInicio , lower(Hor_HoraSalida) as Hor_HoraSalida, lower(Suc_Direccion) as Suc_Direccion, lower( concat(e.Emp_apellido, ', ', e.Emp_nombre)) as nomDocente, s.Idi_Codigo, s.Niv_Codigo
				FROM `seccion` s
				inner join idioma i on i.Idi_Codigo = s.Idi_Codigo
				inner join nivel n on n.Niv_Codigo = s.Niv_Codigo
				inner join mesacademico ma on ma.Mes_Codigo = s.Mes_Codigo
				inner join horarioclases hc on hc.Hor_Codigo = s.Hor_Codigo
				inner join sucursal su on su.Suc_Codigo = s.Suc_Codigo
				inner join empleado e on e.Emp_Codigo = s.Emp_Codigo
				where s.Mes_Codigo='". str_pad($_GET['month'],2, '0', STR_PAD_LEFT).$_GET['year']. "' and i.Idi_Codigo='{$_GET['language']}' and s.Niv_Codigo='{$_GET['level']}' and Sec_NroCiclo<>0 
				order by Sec_nrociclo, sec_seccion asc; ";
				$resultadoCiclosHab = $esclavo->query($sqlCiclosHab);
				if($resultadoCiclosHab->num_rows>0){
					while($rowCiclosHab = $resultadoCiclosHab->fetch_assoc()){
				 ?>
					<tr>
						<td class="tdCursoDetalle"><?= $rowCiclosHab['Niv_Detalle']. ' ' . $rowCiclosHab['Sec_NroCiclo']. ' - ' . $rowCiclosHab['Sec_Seccion']; ?></td>
						<td class="text-capitalize"><?= $rowCiclosHab['nomDocente']; ?></td>
						<td class="text-capitalize tdHoras"><?= $rowCiclosHab['Hor_HoraInicio']; ?></td>
						<td class="text-capitalize tdHoras"><?= $rowCiclosHab['Hor_HoraSalida']; ?></td>
						<td class="text-capitalize"><?= $rowCiclosHab['Suc_Direccion']; ?></td>
						<td><?= $rowCiclosHab['Mes_Codigo']; ?></td>
						<td><button class="btn btn-outline-primary btn-sm btnRegistrarAlumno" data-seccion='<?= $rowCiclosHab['Sec_Codigo'];?>' data-idIdioma='<?= $rowCiclosHab['Idi_Codigo'];?>' data-idNivel='<?= $rowCiclosHab['Niv_Codigo'];?>' ><i class="icofont-plus"></i></button></td>
					</tr>
				<?php } } ?>
				</tbody>
			</table>
			<?php }?>
		</div>
		</div>
		</div>
					<?php /* include "php/mostrarNuevosCursosActivos.php"; */?>
				</div>
			</div>
		</div>

  </div>
	<?php } ?>

<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
</div>

<!-- Modal para decir que todo guardo bien  -->
<div class="modal fade" id="modalConfirmarRegistro" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<p>¿Desea matricular al alumno en este ciclo?</p>
				<p><strong>Alumno: </strong> <span class="text-capitalize" ><?= $rowAlumno['Alu_Apellido'].', '. $rowAlumno['Alu_Nombre']; ?></span> </p>
				<p><strong>Curso:</strong> <span class="text-capitalize" id="spanCursoConf">Inglés Básico 1 C</span> </p>
				
		  	<div class="d-flex justify-content-center blue-text text-darken-1">
          <button class="btn btn-outline-primary" data-dismiss="modal" id="btnRegistrarConfirmado" ><i class="icofont-check-alt"></i> Sí, Registrar</button>
        </div>
      </div>
      
    </div>
  </div>
</div>

<?php include "php/footer.php"; ?>

<script>

$('.selectpicker').selectpicker();

$('#sltPAnios').selectpicker('val',-1);
$('#sltPMeses').selectpicker('val',-1); $('#sltPMeses').prop('disabled', true).selectpicker('refresh');
$('#sltIdiomas').selectpicker('val',-1); $('#sltIdiomas').prop('disabled', true).selectpicker('refresh');
$('#sltNiveles').selectpicker('val',-1); $('#sltNiveles').prop('disabled', true).selectpicker('refresh');

<?php if(isset($_GET['year']) ): ?>
$('#sltPAnios').selectpicker('val',<?= $_GET['year']?>).selectpicker('refresh');
$('#sltPMeses').prop('disabled', false).selectpicker('val',-1).selectpicker('refresh');
<?php endif; ?>
<?php if(isset($_GET['month']) ): ?>
$('#sltPMeses').selectpicker('val', <?= $_GET['month']?>).selectpicker('refresh');
$('#sltIdiomas').prop('disabled', false).selectpicker('val',-1).selectpicker('refresh');
<?php endif; ?>
<?php if(isset($_GET['language']) ): ?>
$('#sltIdiomas').selectpicker('val', '<?= $_GET['language']?>').selectpicker('refresh');
$('#sltNiveles').prop('disabled', false).selectpicker('val',-1).selectpicker('refresh');
<?php endif; ?>
<?php if(isset($_GET['level']) ): ?>
$('#sltNiveles').selectpicker('val', '<?= $_GET['level']?>').selectpicker('refresh');
<?php endif; ?>

$.each($('.tdHoras'), function (index, elem) { 
	var ant= $(elem).text(); 
	ant = ant.replace( /\am/g, 'A.M.');
	ant = ant.replace( /\pm/g, 'P.M.');
	$(elem).text(ant);
})



<?php if(isset($_GET['cursor'])){ ?>
$('#sltPAnios').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPAnios').selectpicker('val')!= null ){
		location.href = "matricula.php?cursor=<?= $_GET['cursor'];?>&year="+$('#sltPAnios').selectpicker('val');
	}
});
$('#sltPMeses').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "matricula.php?cursor=<?= $_GET['cursor'];?>&year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val');
	}
});
$('#sltIdiomas').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "matricula.php?cursor=<?= $_GET['cursor'];?>&year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val')+'&language='+$('#sltIdiomas').selectpicker('val');
	}
});
$('#sltNiveles').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "matricula.php?cursor=<?= $_GET['cursor'];?>&year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val')+'&language='+$('#sltIdiomas').selectpicker('val')+'&level	='+$('#sltNiveles').selectpicker('val');
	}
});
$('#btnRegistrarConfirmado').click(function () {
	$.ajax({url: 'php/registrarAlumnoCurso.php', type: 'POST', data:{ codAlu: '<?= $rowAlumno['Alu_Codigo']; ?>', codSec: $('#btnRegistrarConfirmado').attr('data-seccion'), idIdioma: $('#btnRegistrarConfirmado').attr('data-idIdioma'), idNivel: $('#btnRegistrarConfirmado').attr('data-idNivel')  }}).done(function (resp) { console.log(resp)
		$('#modalConfirmarRegistro').modal('hide');
		if(resp=='todo ok'){
			$('#h1Bien').text('Alumno registrado al curso');
			$('#modalGuardadoCorrecto').modal('show');
		}else if(resp=='ya registrado'){
			$('#h1Advertencia').text('El alumno ya se encontraba registrado en el curso ' + $('#spanCursoConf').text());
			$('#modalAdvertencia').modal('show');
		}else{
			$('#h1Advertencia').text('Error desconocido, comuníquelo al área de soporte');
			$('#modalAdvertencia').modal('show');
		}
	})
})
<?php } ?>

$('#txtAlumnoDni').keyup(function (e) {
  if (e.which ==13){ $('#btnBuscarDniAlumno').click(); }
})
$('#btnBuscarDniAlumno').click(function () {
  window.location="matricula.php?cursor="+$('#txtAlumnoDni').val();
});
$('.btnRegistrarAlumno').click(function () {
	$('#spanCursoConf').text($(this).parent().parent().find('.tdCursoDetalle').text());
	$('#btnRegistrarConfirmado').attr('data-seccion', $(this).attr('data-seccion') );
	$('#btnRegistrarConfirmado').attr('data-idIdioma', $(this).attr('data-idIdioma') );
	$('#btnRegistrarConfirmado').attr('data-idNivel', $(this).attr('data-idNivel') );
	$('#modalConfirmarRegistro').modal('show');
});

$('#modalGuardadoCorrecto').on('hidden.bs.modal', function (e) {
  location.reload();
});

</script>
</body>
</html>