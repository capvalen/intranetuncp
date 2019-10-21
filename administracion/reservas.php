<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'php/header.php';
	include "php/conexionInfocat.php";
	?>
</head>
<body>

<style>
.filter-option-inner-inner{ text-transform: capitalize!important;}
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->

		
	<h2 class="d-print-none"><i class="icofont-contacts"></i> Reservas de matrículas</h2>
	
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
					<select class="selectpicker text-capitalize" id="sltPSedes" data-live-search="true" data-width="100%">
						<?php if(isset($_GET['month'])){ include 'php/OPT_sedes.php'; }else{ echo "<option value='-1'>Seleccione primero el mes</option>"; } ?>
					</select>
				</div>
				<div class="col">
				<label for=""><small>Idioma:</small></label>
					<select class="selectpicker text-capitalize" id="sltPIdiomas" data-live-search="true" data-width="100%">
						<?php if(isset($_GET['month'])){ include 'php/OPT_idiomas.php'; }else{ echo "<option value='-1'>Seleccione primero mes</option>"; } ?>
					</select>
				</div>
				<div class="col d-flex align-items-end">
					
					<button class="btn btn-outline-primary <?php if(!isset($_GET['year']) || !isset($_GET['month']) || !isset($_GET['campus']) || !isset($_GET['language'])){ echo 'disabled';} ?>"  id='btnCrearReserva' ><i class="icofont-bulb-alt"></i> Crear reserva</button>
				</div>
			</div>
		</div>
	</div>

	<table class="table table-hover">
	<thead>
		<tr>
			<th>Cod. Registro</th>
			<!--<td>Cod. Sección</td> -->
			<th>Alumno</th>
			<th>Situación</th>
			<th>Documento</th>
		</tr>
	</thead>
		<tbody>
		<?php if( isset($_GET['campus']) ){ $sqlExtras ='';
		if( isset($_GET['language']) ){$sqlExtras =" AND s.Idi_Codigo='{$_GET['language']}' ";}
		$sqlReservas ="SELECT ra.*, lower(concat( a.Alu_Apellido, ' ', a.Alu_Nombre)) as aluNombre FROM `registroalumno` ra
		inner join alumno a on a.Alu_Codigo = ra.Alu_Codigo
		inner join seccion s on s.Sec_Codigo = ra.Sec_Codigo
		where ra.Reg_Codigo like 'RESERVA%' and s.Mes_Codigo = '". str_pad($_GET['month'], 2, 0, STR_PAD_LEFT) ."{$_GET['year']}' and s.Suc_Codigo= '{$_GET['campus']}' {$sqlExtras} ; ";

		$respuestaReserva= $cadena->query($sqlReservas);

		if($respuestaReserva->num_rows>=1){
		while($rowReserva = $respuestaReserva->fetch_assoc()){
		?>
			<tr>
				<td><button class="btn btn-outline-danger btn-sm border-0 btnEliminarReserva" data-reg='<?=$rowReserva['Reg_Codigo']; ?>'> <i class="icofont-close"></i> </button> <?=$rowReserva['Reg_Codigo']; ?></td>
				<!-- <td><?=$rowReserva['Sec_Codigo']; ?></td> -->
				<td class="text-capitalize tdNombre"><?=$rowReserva['aluNombre']; ?></td>
				<td><?=$rowReserva['AlSe_Condicion']; ?></td>
				<td><?=$rowReserva['Reg_EstadoFinal']; ?></td>
			</tr>
		<?php }}else{ ?>
		<tr><td colspan="5">No hay reservas en lo seleccionado</td>
		</tr>
		<?php }
			} ?>
		</tbody>
	</table>
	<?php endif; ?>
<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
</div>

<div class="modal fade" id="modalReservarAlumno" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title"><i class="icofont-mail"></i> Búsqueda de alumno</h5>
				<div id="primeraParte">
					<p class="mb-1"><small>Primero ubique al alumno por D.N.I o por sus Apellidos:</small></p>
					<input type="text" class="form-control text-center" autocomplete='off' id="txtUbicarAlumno">
					<div class="d-flex justify-content-center mt-2">
						<button class="btn btn-outline-success my-2" id="btnUbicarAlumno"><i class="icofont-search-1"></i> Buscar alumno</button>
					</div>
				</div>
				<div class='d-none ' id="segundaParte">
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
</div>
<div class="modal fade" id="modalAlumnoVsReserva" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title"><i class="icofont-mail"></i> Reserva de matrícula</h5>
				<p class='mb-2'>Proceso para: </p>
				<p class='mb-2'><strong class="text-uppercase" id="txtNombreChosen"></strong></p>
				<label for="">N° de Registro</label>
				<input class="form-control" type="text" id="txtReservaRegistro">
				<label for="">Fecha de Registro</label>
				<input class="form-control" type="date" id="txtReservaFecha">
				<label for="">Situación</label>
				<select class="selectpicker" id="sltPSituaciones"  data-seach='true' data-width='100%'>
					<?php include 'php/OPT_situaciones.php'; ?>
				</select>
				<div class="alert alert-danger d-none" role="alert"><i class="icofont-warning-alt"></i> <small id="spanAlert"></small></div>
				<button class="btn btn-outline-primary mt-1"  id="btnInsertChosenReserva"> <i class="icofont-save"></i> Guardar </button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalRemoveReserva" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-danger">Retirar reserva</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>¿Desea realmente retirar la reserva del alumno: <strong class="text-capitalize" id="txtNombreRemove"></strong>?</p>
					<button class="btn btn-outline-danger float-right" id="btnRemoveChosen"><i class="icofont-trash"></i> Sí, retirar</button>
				</div>
				
			</div>
		</div>
	</div>

<?php include "php/footer.php"; ?>

<script>
$('.selectpicker').selectpicker();
$('#txtReservaFecha').val(moment().format('YYYY-MM-DD'));
<?php if(!isset($_GET['nuevo'])): ?>
	$('#sltPAnios').selectpicker('val',-1);
	$('#sltPMeses').selectpicker('val',-1);
	$('#sltPSedes').selectpicker('val',-1);
	$('#sltPIdiomas').selectpicker('val',-1);
	$('#sltPMeses').prop('disabled', true).selectpicker('refresh');
	$('#sltPSedes').prop('disabled', true).selectpicker('refresh');
	$('#sltPIdiomas').prop('disabled', true).selectpicker('refresh');
	
	<?php if( isset($_GET['year'])): ?>
	$('#sltPAnios').selectpicker('val',<?= $_GET['year']?>).selectpicker('refresh');
	$('#sltPMeses').prop('disabled', false).selectpicker('val',-1).selectpicker('refresh');
	<?php endif; if( isset($_GET['month'])): ?>
	$('#sltPMeses').selectpicker('val', <?= $_GET['month']?>).selectpicker('refresh');
	$('#sltPSedes').prop('disabled', false).selectpicker('val',-1).selectpicker('refresh');
	<?php endif; if( isset($_GET['campus'])): ?>
	$('#sltPSedes').selectpicker('val', '<?= $_GET['campus']?>').selectpicker('refresh');
	$('#sltPIdiomas').prop('disabled', false).selectpicker('val',-1).selectpicker('refresh');
	<?php endif; if( isset($_GET['language'])): ?>
	$('#sltPIdiomas').selectpicker('val', '<?= $_GET['language']?>').selectpicker('refresh');	
	<?php endif; ?>

$('#sltPAnios').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPAnios').selectpicker('val')!= null ){
		location.href = "reservas.php?year="+$('#sltPAnios').selectpicker('val');
	}
});
$('#sltPMeses').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "reservas.php?year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val');
	}
});
$('#sltPSedes').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "reservas.php?year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val')+'&campus='+$('#sltPSedes').selectpicker('val');
	}
});
$('#sltPIdiomas').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "reservas.php?year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val')+'&campus='+$('#sltPSedes').selectpicker('val')+'&language='+$('#sltPIdiomas').selectpicker('val');
	}
});

$('#txtUbicarAlumno').keyup(function (e) {
	if (e.which ==13){ $('#btnUbicarAlumno').click(); }
})
$('#btnUbicarAlumno').click(function () {
	if($('#txtUbicarAlumno').val()!=""){
	pantallaOver(true);
	$('#segundaParte tbody').children().remove();
		
	/* animateCSS('#primeraParte', 'fadeOut', function () {
		
	}) */
	$.ajax({url: 'php/encontrarAlumnosCoincidentes.php', type: 'POST', data:{texto: $('#txtUbicarAlumno').val() }}).done(function (resp) {
		//console.log(resp)
		pantallaOver(false);
		var datos = JSON.parse(resp); var docDni ='';
		if(datos.length>0){
			$.each(datos, function (index, elem) {
				if(elem.Alu_NroDocumento == null ){ docDni='';}else{docDni = elem.Alu_NroDocumento}
				$('#segundaParte tbody').append(`<tr>
				<td> ${index+1} </td>
				<td class='text-capitalize tdNombre'> ${elem.Alu_Apellido.toLowerCase() +', '+ elem.Alu_Nombre.toLowerCase()}</td>
				<td>${docDni}</td>
				<td><button class="btn btn-outline-success btn-sm btnElegirAlumno" data-id="${elem.Alu_Codigo}"><i class="icofont-ui-rate-add"></i></button></td>
			</tr>`)
			});

		}else{
			$('#segundaParte tbody').append(`<tr>
				<td colspan="3"> <i class="icofont-not-allowed"></i> No existen alumnos coincidentes con lo solicitado </td>
			</tr>`)
		}
		$('#primeraParte').addClass('d-none');
		$('#segundaParte').addClass('animated fadeIn').removeClass('d-none');
		pantallaOver(false);
	});
	}
});
$('tbody').on('click', '.btnElegirAlumno', function () {
	$('#txtNombreChosen').text( $(this).parent().parent().find('.tdNombre').text())
	$('#btnInsertChosenReserva').attr('data-id', $(this).attr('data-id'));
	$('#modalReservarAlumno').modal('hide');
	$('#sltPSituaciones').selectpicker('val', 'En trámite' ).selectpicker('refresh');
	$('#modalAlumnoVsReserva').modal('show');
});
$('#btnCrearReserva').click(function() { 
	if(!$(this).hasClass('disabled')){
		$('#primeraParte').removeClass('d-none');
		$('#segundaParte').removeClass('animated fadeIn').addClass('d-none');
		$('#modalReservarAlumno').modal('show');
	}
});
<?php if (isset($_GET['year']) && isset($_GET['month']) && isset($_GET['campus']) && isset($_GET['language'])): ?>
$('#btnInsertChosenReserva').click(function() {
	if($('#txtReservaRegistro').val()=='' || $('#txtReservaFecha').val()== null ){
		$('#spanAlert').text('Hay campos vacíos, todos deben ser rellenados obligatoriamente').parent().removeClass('d-none')
	}else{
		$('#spanAlert').parent().addClass('d-none')
		$.ajax({url: 'php/insertarReserva.php', type: 'POST', data: { anio: '<?= $_GET['year'] ?>', mes: '<?=str_pad($_GET['month'], 2, 0, STR_PAD_LEFT) ?>', idioma: '<?= $_GET['language'] ?>', sucursal: '<?= $_GET['campus'] ?>', idAlu: $(this).attr('data-id'), tramite: $('#sltPSituaciones').val(), numSolicitud: $('#txtReservaRegistro').val() }}).done(function(resp) {
			console.log(resp)
			if(resp.length==18){
				console.log( 'grabo' );
				location.reload();
			}
		});
	}
});
<?php endif; ?>
$('tbody').on('click', '.btnEliminarReserva', function (e) {
	var padre = $(this).parent().parent();
	$('#txtNombreRemove').text( padre.find('.tdNombre').text());
	$('#modalRemoveReserva').modal('show');
	$('#btnRemoveChosen').attr('data-id', $(this).attr('data-reg'));
});
$('#btnRemoveChosen').click(function() {
	$.ajax({url: 'php/removeReserva.php', type: 'POST', data: { reg: $('#btnRemoveChosen').attr('data-id') }}).done(function(resp) {
		console.log(resp)
		if(resp =='todo ok'){
			location.reload();
		}
	});
});
<?php endif; ?>

</script>
</body>
</html>