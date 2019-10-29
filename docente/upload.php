<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'php/header.php';
	include "php/conexionInfocat.php";
	$sqlMaxUpdate = "SELECT `ultAnio`, `ultMes`, date_format(`fechaMaximaUpload`, '%d/%m/%Y') as fechaMaximaUpload FROM `configuraciones` WHERE 1; ";
	$respuestaMaxUpdate = $cadena->query($sqlMaxUpdate);
	$rowMaxUpdate = $respuestaMaxUpdate->fetch_assoc();
	?>
</head>
<body>

<div class="wrapper">
<?php include "php/menu-wrapper.php"; ?>

<div id="content" class="px-5 pt-5">
	<!-- Contenido de la Página  -->
	<h3>Mis asignaturas <small class="text-capitalize"><?= $_COOKIE['cknomCompleto'];?></small></h3>

	<?php 
	include "php/conexionInfocat.php"; 
	$sqlCursos = "SELECT s.*, i.Idi_Nombre, n.Niv_Detalle, lower(hc.Hor_HoraInicio) as Hor_HoraInicio, lower(hc.Hor_HoraSalida) as Hor_HoraSalida, lower(su.Suc_Direccion) as Suc_Direccion FROM `seccion` s
	inner join idioma i on i.Idi_Codigo = s.Idi_Codigo
	inner join nivel n on n.Niv_Codigo = s.Niv_Codigo
	inner join mesacademico ma on ma.Mes_Codigo = s.Mes_Codigo
	inner join horarioclases hc on hc.Hor_Codigo = s.Hor_Codigo
	inner join sucursal su on su.Suc_Codigo = s.Suc_Codigo
	where Emp_Codigo = '{$_COOKIE['ckidUsuario']}' and year(ma.Mes_Inicio)= {$rowMaxUpdate['ultAnio']} and month(ma.Mes_Inicio)= {$rowMaxUpdate['ultMes']}
	order by ma.Mes_Inicio desc; "; //and Sec_Detalle ='Habilitado' echo $sqlCursos;
	$resultadoCursos=$cadena->query($sqlCursos); $i=1; ?>
	<p>Su lista de asignaturas hábiles para subir notas:</p>
	<div class="container">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>N°</th>
					<th>Mes</th>
					<th>Curso</th>
					<th>Nivel</th>
					<th>Ciclo</th>
					<th>Sección</th>
					<th>Dia - Hora inicio</th>
					<th>Hora salida</th>
					<th>Sede</th>
					<th>@</th>
				</tr>
			</thead>
			<tbody>
				<?php if($resultadoCursos->num_rows >0){
				while($rowCursos =$resultadoCursos ->fetch_assoc()){ ?>
				<tr>
					<td><?= $i;?></td>
					<td><?= $rowCursos['Mes_Codigo'];?></td>
					<td><?= $rowCursos['Idi_Nombre'];?></td>
					<td><?= $rowCursos['Niv_Detalle'];?></td>
					<td><?= $rowCursos['Sec_NroCiclo'];?></td>
					<td><?= $rowCursos['Sec_Seccion'];?></td>
					<td class="text-capitalize"><?= $rowCursos['Hor_HoraInicio'];?></td>
					<td class="text-capitalize"><?= $rowCursos['Hor_HoraSalida'];?></td>
					<td class="text-capitalize"><?= $rowCursos['Suc_Direccion'];?></td>
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
	</div>


	
<!-- Fin de Contenido de la Página  -->
</div>

<div class="modal fade" id="modalDocumentoNuevo" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Registro de nuevo documento</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row mb-2">
						<div class="col-4"><label for="">N° de Registro</label></div>
						<div class="col"><input type="text" class="form-control" id="txtDocNumero"></div>
					</div>
					<div class="row mb-2">
						<div class="col-4"><label for="">Tipo de documento</label></div>
						<div class="col">
							<select class="form-control" id="sltTipoDocumento">
								<option value="2">Solicitud</option>
								<option value="1">Oficio</option>
								<option value="3">Memorandum</option>
								<option value="4">Otro</option>
							</select>
						</div>
					</div>
					<div class="row mb-2" id="divComboTramites">
						<div class="col-4"><label for="">Tipo de trámite</label></div>
						<div class="col">
							<select class="form-control" id="sltTipoTramite">
								<option value="1">Solicitud de Certificado</option>
								<option value="2">Media Beca</option>
								<option value="3">Beca completa</option>
								<option value="4">Examen de ubicación</option>
								<option value="5">Examen de re-ubicación</option>
								<option value="6">Examen de suficiencia</option>
							</select>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-4"><label for="">Detalle</label></div>
						<div class="col"><input type="text" class="form-control" id="txtDocAsunto"></div>
					</div>
					<div class="row mb-2" id="divDNIInteresado">
						<div class="col-4"><label for="">D.N.I. Interesado</label></div>
						<div class="col"><input type="text" class="form-control" id="txtDniInteresado"></div>
					</div>
					<div class="row mb-2">
						<div class="col-4"><label for="">Datos interesado</label></div>
						<div class="col"><input type="text" class="form-control" id="txtDocInteresado" readonly></div>
					</div>
					
					<div class="alert alert-danger d-none" role="alert"> <strong>Advertencia: </strong> <span id="spanAlertTramites"></span></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-primary" id="btnInsertDoc"><i class="icofont-save"></i> Insertar documento</button>
				</div>
			</div>
		</div>
	</div>
		
<!-- Fin de #wrapper  -->
</div>

<?php include "php/footer.php"; ?>

<script>
$('.selectpicker').selectpicker();
<?php if(!isset($_GET['year']) && !isset($_GET['month'])): ?>
$('#sltPAnios').selectpicker('val',-1);
$('#sltPMeses').prop('disabled', true).selectpicker('refresh');
<?php elseif( isset($_GET['year']) && !isset($_GET['month'])): ?>
$('#sltPAnios').selectpicker('val',<?= $_GET['year']?>).selectpicker('refresh');
$('#sltPMeses').prop('disabled', false).selectpicker('val',-1).selectpicker('refresh');
<?php else: ?>
$('#sltPAnios').selectpicker('val',<?= $_GET['year']?>).selectpicker('refresh');
$('#sltPMeses').selectpicker('val', <?= $_GET['month']?>).selectpicker('refresh');
<?php endif; ?>


	$('#btnBuscarDocumento').click(function () {
		$('tbody').addClass('d-none');
		if( $('#txtBusquedaDoc').val()=="pariona"){
			$('#tPariona').removeClass('d-none');
		}else{
			$('#tLoque').removeClass('d-none');
		}
	});
	$('#btnNuevoDocumento').click(function () {
		$('#modalDocumentoNuevo').modal('show');
	})
	$('#btnInsertDoc').click(function () {
		if( $('#txtDocNumero').val().length==0 ){
			$('#spanAlertTramites').text('No puede dejar el Código de mesa de Partes Vacío').parent().removeClass('d-none');
		}else if( $('#txtDocAsunto').val().length==0 ){
			$('#spanAlertTramites').text('Ingrese un Detalle por favor.').parent().removeClass('d-none');
		}else if( $('#txtDniInteresado').val().length==0 && $('#sltTipoDocumento').val()==2  ){// Cambiar a la cantidad de numeros exatos de DNI
			$('#spanAlertTramites').html('Ingrese un DNI correcto y presione luego <kbd>Enter</kbd>').parent().removeClass('d-none');
		}else if( $('#txtDocInteresado').val().length==0 && $('#sltTipoDocumento').val()!=2  ){
			$('#spanAlertTramites').text('Debe ingresar los datos del interesado').parent().removeClass('d-none');
		}else{
			if(  $('#sltTipoDocumento').val()==2 ){
				$('tbody').append(`<tr>
					<td>${moment().format('DD/MM/YYYY hh:mm a')}</td>
					<td><a href="tramites.php?idDocumento=r2">${$('#txtDocNumero').val()}</a></td>
					<td>${$('#sltTipoDocumento option:selected').text()}</td>
					<td>${$('#sltTipoTramite option:selected').text()}</td>
					<td>${$('#txtDocAsunto').val()}</td>
					<td>${$('#txtDocInteresado').val()}</td>
					<td>Secretaría</td>
				</tr>`);
				$('#modalDocumentoNuevo').modal('hide');
			}else{
				$('tbody').append(`<tr>
					<td>${moment().format('DD/MM/YYYY hh:mm a')}</td>
					<td><a href="tramites.php?idDocumento=r2">${$('#txtDocNumero').val()}</a></td>
					<td>${$('#sltTipoDocumento option:selected').text()}</td>
					<td>-</td>
					<td>${$('#txtDocAsunto').val()}</td>
					<td>${$('#txtDocInteresado').val()}</td>
					<td>Secretaría</td>
				</tr>`);
				$('#modalDocumentoNuevo').modal('hide');
			}
			
		}
	})
	$('#txtDniInteresado').keyup(function (e) {
		e.preventDefault();
		if( e.keyCode==13){
			$('#txtDocInteresado').val('Pariona Valencia Carlos');
		}
	})
	$('#sltTipoDocumento').change(function () {
		if($(this).val()==2){
			$('#divDNIInteresado').removeClass('d-none')
			$('#txtDocInteresado').attr('readonly',true)
		}else{
			$('#divDNIInteresado').addClass('d-none')
			$('#txtDocInteresado').attr('readonly',false)
		}
	
	})
	$('#sltTipoDocumento').change(function(){
		if($(this).val()==2){
			$('#divComboTramites').removeClass('d-none')
		}else{
			$('#divComboTramites').addClass('d-none')
		}
	});

$('#sltPAnios').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPAnios').selectpicker('val')!= null ){
		location.href = "index.php?year="+$('#sltPAnios').selectpicker('val');
	}
});
$('#sltPMeses').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPMeses').selectpicker('val')!= null ){
		location.href = "index.php?year="+$('#sltPAnios').selectpicker('val')+'&month='+$('#sltPMeses').selectpicker('val');
	}
});

</script>
  </body>
</html>