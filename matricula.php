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
	$sqlAlumno = "SELECT `Alu_Codigo`, lower(`Alu_Nombre`) as Alu_Nombre, lower(`Alu_Apellido`) as Alu_Apellido, `Alu_NroDocumento`, date_format(`Alu_FechaNacimiento`, '%d/%m/%Y') as Alu_FechaNacimiento, date_format(`Alu_FechaNacimiento`, '%Y-%m-%d') as Alu_FechaNacimiento2 FROM `alumno` where Alu_NroDocumento = '{$_GET['cursor']}';";
	$resultadoAlumno= $cadena->query($sqlAlumno);
	
}
?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->
		
	<h2 class="d-print-none"><i class="icofont-people"></i> Matrícula</h2>
	
	<div class="card col-7">
		<div class="card-body pt-1">
		<p class="card-text m-0"><small class="text-muted"><i class="icofont-filter"></i> Filtro alumno antiguo:</small></p>
			<div class="form-inline">
      <label class="mr-3" for=""><small>D.N.I/Apellidos Alumno:</small></label>
      <input type="text ml-3" class="form-control" id="txtAlumnoDni">
      <button class="btn btn-outline-primary ml-3" id="btnBuscarDniAlumno"><i class="icofont-search-1"></i> Buscar</button>
      <button class="btn btn-outline-success ml-3" id="btnCrearAlumno"><i class="icofont-bulb-alt"></i> Crear alumno</button>
			<?php if(isset($_GET['cursor'])){ ?>
      <a href="seguimiento.php?cursor=<?= trim($rowAlumno['Alu_NroDocumento']); ?>" class="btn btn-outline-dark ml-3 d-none" ><i class="icofont-bulb-alt"></i> Ver seguimiento</a>
			<?php } ?>
		</div>
	</div>
  </div>
	<?php if(isset($_GET['cursor'])){ $_POST['idAlumno']=$_GET['cursor'];
		$rowAlumno = $resultadoAlumno->fetch_assoc(); $_POST['idAlumno'] = $rowAlumno['Alu_Codigo']; ?>
  <div class="row mt-3">
    <div class="col-12 my-3">
      <div class="card">
        <div class="card-body">
        <?php if($resultadoAlumno->num_rows>0){ ?>
          <div class="row">
						<small class='text-muted'>Datos del alumno</small>
						<p class="d-none"><strong>Cod. Int.:</strong> <span><?= $rowAlumno['Alu_Codigo']; ?></span></p>
						<div class='col'><strong>D.N.I.:</strong> <span><?= $rowAlumno['Alu_NroDocumento']; ?></span></div>
						<div class='col'><strong>Apellidos:</strong> <span class="text-capitalize"><?= $rowAlumno['Alu_Apellido']; ?></span></div>
						<div class='col'><strong>Nombres:</strong> <span class="text-capitalize"><?= $rowAlumno['Alu_Nombre']; ?></span></div>
						<div class='col-1'><button class="btn btn-outline-primary btn-sm"  id="btnEditStudent"> <i class="icofont-edit"></i> </button> </div>
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
				<div class="mb-3" id="divTipoMatricula">
					<label for="">Tipo de matrícula</label>
					<select name="" id="sltTipoMatricula" class="selectpicker" data-seach='true' data-width='100%'>
						<?php include 'php/OPT_tipoMatricula.php'; ?>
					</select>
					<p>Accede a descuento: <span id="spanCantDscto">0.00</span></p>
				</div>

				
		  	<div class="d-flex justify-content-center blue-text text-darken-1">
          <button class="btn btn-outline-primary" data-dismiss="modal" id="btnRegistrarConfirmado" ><i class="icofont-check-alt"></i> Sí, Registrar</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
<!-- Modal para craer alumno  -->
<div class="modal fade" id="modalCrearAlumno" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<p>Ingrese el D.N.I. que se desea crear:</p>
				<input type="text" class="form-control" id="txtCrearDni">
				<button class="btn btn-outline-warning mt-3" id="btnBuscarDni"> <i class="icofont-search-1"></i> Buscar en Reniec</button>
				<div class="d-none" id="datosEncontrados">
					<label for="">Apellidos</label>
					<input type="text" class="form-control text-capitalize" id="txtCrearApellidos">
					<label for="">Nombres</label>
					<input type="text" class="form-control text-capitalize" id="txtCrearNombres">
					<label for="">Género:</label>
					<select class="selectpicker" id="SltPSexo" data-search='false' data-width='100%'>
						<option value="0">Femenino</option>
						<option value="1">Masculino</option>
					</select>
					<div class="d-none">
						<label for="">Facultad:</label>
						<select class="selectpicker" id="SltPFacultad" data-search='true' data-width='100%'>
							<?php include 'php/OPT_facultades.php'; ?>
						</select>
						<label for="">Fecha de nacimiento:</label>
						<input type="date" class="form-control" id="txtCrearFecha" value="<?= date('Y-m-d'); ?>">
					</div>
					<button class="btn btn-outline-primary mt-3" id="btnSaveAlumno"><i class="icofont-save"></i> Guardar Alumno</button>
				</div>
			
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="modalListadoAlumnos" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title"><i class="icofont-mail"></i> Listado de alumnos coincidentes</h5>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>N°</th>
							<th>Apellidos y Nombres</th>
							<th>D.N.I.</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>	



<?php if (isset($_GET['cursor'])): ?>
<div id="modalEditStudent" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="my-modal-title">Actualización de alumno</h5>
				<p>Rellene cuidadosamente los siguientes campos: </p>
				<label for="">D.N.I.</label>
				<input class="form-control" type="text" id="txtDNIAlumno" value="<?= $rowAlumno['Alu_NroDocumento']; ?>">
				<label for="">Apellidos</label>
				<input class="form-control text-capitalize" type="text" id="txtApellidosAlumno" value="<?= $rowAlumno['Alu_Apellido']; ?>">
				<label for="">Nombres</label>
				<input class="form-control text-capitalize" type="text" id="txtNombresAlumno" value="<?= $rowAlumno['Alu_Nombre']; ?>">
				<label for="">Fecha de nacimiento</label>
				<input class="form-control" type="date" id="txtFechaAlumno" value="<?= $rowAlumno['Alu_FechaNacimiento2']; ?>">
				<div class="alert alert-danger d-none mt-3" id="alertEdit" role="alert"><i class="icofont-warning-alt"></i> <span style="font-size: 0.8rem;"></span> </div>
			</div>
			<div class="modal-footer">
			
				<button class="btn btn-outline-primary"  id="btnGuardarDocente"> <i class="icofont-refresh"></i> Actualizar datos </button>
			</div>
		</div>
	</div>
</div>
<?php endif;?>


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
	$.ajax({url: 'php/registrarAlumnoCurso.php', type: 'POST', data:{ codAlu: '<?= $rowAlumno['Alu_Codigo']; ?>', codSec: $('#btnRegistrarConfirmado').attr('data-seccion'), idIdioma: $('#btnRegistrarConfirmado').attr('data-idIdioma'), idNivel: $('#btnRegistrarConfirmado').attr('data-idNivel'), idDscto: $.idDscto  }}).done(function (resp) { console.log(resp)
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
	pantallaOver(true);
	if($('#txtAlumnoDni').val()!=''){
		if( $.isNumeric($('#txtAlumnoDni').val()) &&  $('#txtAlumnoDni').val().length==8 ){
  	window.location="matricula.php?cursor="+$('#txtAlumnoDni').val();
	}else{
		$('#modalListadoAlumnos tbody').children().remove();
		$.ajax({url: 'php/encontrarAlumnosCoincidentes.php', type: 'POST', data:{texto: $('#txtAlumnoDni').val() }}).done(function (resp) {
		//console.log(resp)
		
		var datos = JSON.parse(resp); var docDni ='';
		if(datos.length>0){
			$.each(datos, function (index, elem) {
				if(elem.Alu_NroDocumento == null ){ docDni='';}else{docDni = elem.Alu_NroDocumento}
				$('#modalListadoAlumnos tbody').append(`<tr>
				<td> ${index+1} </td>
				<td class='text-capitalize tdNombre'> ${elem.Alu_Apellido.toLowerCase() +', '+ elem.Alu_Nombre.toLowerCase()}</td>
				<td>${docDni}</td>
				<td><button class="btn btn-outline-success btn-sm btnElegirAlumno" data-id="${elem.Alu_NroDocumento}"><i class="icofont-ui-rate-add"></i></button></td>
			</tr>`)
			});

		}else{
			$('#modalListadoAlumnos tbody').append(`<tr>
				<td colspan="3"> <i class="icofont-not-allowed"></i> No existen alumnos coincidentes con lo solicitado </td>
			</tr>`)
		}
		pantallaOver(false);
		$('#modalListadoAlumnos').modal('show');
	});
	
	}}
});
$('tbody').on('click', '.btnElegirAlumno', function () {
	window.location="matricula.php?cursor="+$(this).attr('data-id');
})
$('.btnRegistrarAlumno').click(function () {
	$('#spanCursoConf').text($(this).parent().parent().find('.tdCursoDetalle').text());
	$('#btnRegistrarConfirmado').attr('data-seccion', $(this).attr('data-seccion') );
	$('#btnRegistrarConfirmado').attr('data-idIdioma', $(this).attr('data-idIdioma') );
	$('#btnRegistrarConfirmado').attr('data-idNivel', $(this).attr('data-idNivel') );
	$('#sltTipoMatricula').selectpicker('val', 'Normal' ).selectpicker('refresh');
	$('#modalConfirmarRegistro').modal('show');
});

$('#modalGuardadoCorrecto').on('hidden.bs.modal', function (e) {
  location.reload();
});
$('#btnCrearAlumno').click(function () {
	$('#modalCrearAlumno').modal('show');
});
$('#txtCrearDni').keyup(function (e) {
	e.preventDefault();
	if($('#txtCrearDni').val().length==8){if (e.which ==13){ $('#btnBuscarDni').click(); }}else if($('#txtCrearDni').val().length<8){
		$('#btnBuscarDni').removeClass('d-none');
		$('#datosEncontrados').addClass('d-none');
	}
})
$('#btnBuscarDni').click(function () {
	pantallaOver(true);
	 $.ajax({url: 'php/apiReniec.php', type: 'POST', data: {dni: $('#txtCrearDni').val() }}).done(function (resp) {
	 	console.log(resp);
	 	if(resp =='ya registrado'){
	 		//ya fue
	 	}else{
	 		var datos = JSON.parse(resp);
	 		console.log(datos)
	 		$('#txtCrearApellidos').val($.trim(datos[0]+ ' '+ datos[1]) );
	 		$('#txtCrearNombres').val(datos[2]);
	 		$('#btnBuscarDni').addClass('d-none');
	 		$('#datosEncontrados').removeClass('d-none');
	 		$('#txtCrearApellidos').focus();

	 	}
	 	$('#btnBuscarDni').addClass('d-none');
	 		$('#datosEncontrados').removeClass('d-none');
	 		$('#txtCrearApellidos').focus();
	 	pantallaOver(false);
	 })
//	$('#btnBuscarDni').addClass('d-none');
//	$('#datosEncontrados').removeClass('d-none');
//	$('#txtCrearApellidos').focus();
	pantallaOver(false);
});
$('#btnSaveAlumno').click(function () {
	pantallaOver(true);
	$.ajax({url: 'php/insertarAlumnoNuevo.php', type: 'POST', data: {
		dni: $('#txtCrearDni').val(), nombre: $('#txtCrearNombres').val(), apellido: $('#txtCrearApellidos').val(), sexo: $('#SltPSexo').val(), facultad: $('#SltPFacultad').val(), fechanac: $('#txtCrearFecha').val()
	}}).done(function (resp) {
		console.log(resp)
		pantallaOver(false);
		if(resp=='todo ok'){
			window.location='matricula.php?cursor='+$('#txtCrearDni').val();
		}else{
			$('#h1Advertencia').text('Ocurrió un error al intentar insertar al alumno, comuníquelo al área de soporte');
			$('#modalAdvertencia').modal('show');
		}
	})
});

$('#sltTipoMatricula').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltTipoMatricula').selectpicker('val')!= null ){
    var buscar = $('#sltTipoMatricula').selectpicker('val');
		var padre = $('#divTipoMatricula').find(`option[value='${buscar}']`);
    $.idDscto= padre.attr('data-id');
    var tipo = padre.attr('data-tipoDscto');
		var dscto = padre.attr('data-cantDscto');
		if(tipo=='PORCENTAJE'){
			$('#spanCantDscto').text(parseFloat(dscto).toFixed(0)+'%');
		}else{
			$('#spanCantDscto').text('S/ ' + parseFloat(dscto).toFixed(2));
		}

	}
});
$('#btnEditStudent').click(function() {
	$('#modalEditStudent').modal('show');
});
<?php if(isset($_GET['cursor'])):?>
$('#btnGuardarDocente').click(function() {
	$('#alertPagos').addClass('d-none');
	if( $('#txtDNIAlumno').val()=='' || $('#txtApellidosAlumno').val()=='' || $('#txtNombresAlumno').val()=='' ){
		$('#alertPagos span').text('Los campos DNI y Nombres no pueden quedar vacíos.').parent().removeClass('d-none')
	}else{
		$.ajax({url: 'php/updateDataAlumno.php', type: 'POST', data: {idAlu: '<?= $rowAlumno['Alu_Codigo']; ?>',
			dni: $('#txtDNIAlumno').val(), apellidos: $('#txtApellidosAlumno').val(), nombre: $('#txtNombresAlumno').val(), fNac: $('#txtFechaAlumno').val() }}).done(function(resp) {
			console.log(resp)
			if(resp=='todo ok'){
				$('#h1Bien').text('Datos de alumno actualizado correctamente');
				$('#modalGuardadoCorrecto').modal('show');
			}else{
				$('#h1Advertencia').text('Error desconocido, comuníquelo al área de soporte');
				$('#modalAdvertencia').modal('show');
			}
			$('#modalGuardadoCorrecto').on('hidden.bs.modal', function (e) {
				location.reload();
			});
			$('#modalAdvertencia').on('hidden.bs.modal', function (e) {
				location.reload();
			});
		});
	}
});
<?php endif; ?>

</script>
</body>
</html>