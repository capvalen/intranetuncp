<?php 
include "php/variablesGenerales.php";
if (!isset($_COOKIE['ckPower'])){ header('Location: index.php'); }

if( in_Array($_COOKIE['ckPower'], $subBasico) ){
	header('Location: sinPermiso.php'); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'php/header.php';?>
</head>
<body>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>

<div id="content" class="px-5 pt-5">
	<!-- Contenido de la Página  -->

	<?php if(isset($_GET['idDocumento'])){ ?> 
		<h3>Certificado de estudios</h3>
		
		<div class="row">
			<div class="col-6">
				<p><strong>Interesado:</strong> <span>Pariona Valencia, Carlos Alex</span></p>
				<p><strong>Código Mesa de partes:</strong> <span>32279</span></p>
				<p><strong>Tipo:</strong> <span>Solicitud</span></p>
			</div>
			<div class="col-6">
				<p><strong>Asunto:</strong> <span>Media Beca</span></p>
				<p><strong>Referencia:</strong> <span>Reg N° 34468 - Solicitud S/N</span></p>
			</div>
		</div>
		

		<div class="row">
			<div class="col d-flex justify-content-end">
				<button class="btn btn-outline-warning mr-2"><i class="icofont-share-alt"></i> Derivar a nueva área</button> <button class="btn btn-outline-danger"><i class="icofont-arrow-down"></i> Finalizar trámite</button>
			</div>
		</div>

		<p><strong>Historial de movimientos del documento:</strong></p>
		<table class="table table-hover">
			<thead>
				<th>N°</th>
				<th>Fecha y Hora</th>
				<th>Área</th>
				<th>Responsable</th>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>16/09/2019 6:32 pm</td>
					<td>Secretaría
					<td>Marta</td>
				</tr>
				<tr>
					<td>2</td>
					<td>16/09/2019 8:29 pm</td>
					<td>Sub dirección</td>
					<td>Roberto</td>
				</tr>
				<tr>
					<td>3</td>
					<td>17/09/2019 2:32 pm</td>
					<td>Administración</td>
					<td>Pilar</td>
				</tr>
			</tbody>
		</table>

	<?php } ?>
	<?php if(!isset($_GET['idDocumento'])){ ?> 
		
	<h2><i class="icofont-battery-empty"></i> Registro y seguimiento de trámite documentario</h2>
	
	<div class="card mb-3">
		<div class="card-body">
			<h6 class="card-subtitle mb-2 text-muted">Filtro de búsqueda:</h6>
			<div class="row">
					<div class="col-4">
						<input type="text" class="form-control" id="txtBusquedaDoc">
					</div>
					<div class="col-2">
						<button class="btn btn-outline-primary" id="btnBuscarDocumento"><i class="icofont-search-1"></i> Buscar</button>
					</div>
					<div class="col-3">
							<button class="btn btn-outline-success" id="btnNuevoDocumento"><i class="icofont-files-stack"></i> Registrar nuevo documento</button>
						</div>
			</div>

		</div>
	</div>

	<div class="card mt-3">
		<div class="card-body">
			<h6 class="card-subtitle mb-2 text-muted">Últimos registros:</h6>
			<div class="divTablaRegistros">
				<table class="table table-hover">
					<thead>
							<tr>
								<th>Fecha y yHora</th>
								<th>N° Mesa Partes</th>
								<th>Tipo Doc.</th>
								<th>Tipo Tramite</th>
								<th>Detalle</th>
								<th>Interesado</th>
								<th>Ubicación</th>
							</tr>
					</thead>
					<tbody class="">
						<tr>
							<td>17/09/2019 11:00 am</td>
							<td><a href="tramites.php?idDocumento=r2">34282</a></td>
							<td>Solicitud</td>
							<td>Solicitud</td>
							<td>Media Beca</td>
							<td>Vargas V.</td>
							<td>Secretaría</td>
						</tr>
						<tr>
								<td>17/09/2019 5:00 pm</td>
								<td><a href="tramites.php?idDocumento=r2">34281</a></td>
								<td>Solicitud</td>
								<td>Media Beca</td>
								<td>Beca del Estado</td>
								<td>Romani V.</td>
								<td>Administración</td>
							</tr>
							<tr>
								<td>17/09/2019 6:32 pm</td>
								<td><a href="tramites.php?idDocumento=r2">32279</a></td>
								<td>Entrega de documentos</td>
								<td>Certificado de estudios</td>
								<td>Ciclo 2018</td>
								<td>Pariona V.</td>
								<td>Secretaría</td>
							</tr>
					</tbody>
					<tbody class="d-none" id="tPariona">
						<tr>
							<td>11/09/2019 11:00 am</td>
							<td><a href="tramites.php?idDocumento=r2">34282</a></td>
							<td>Solicitud</td>
							<td>Media Beca</td>
							<td>Por 2 hermanos</td>
							<td>Pariona V.</td>
							<td>Finalizado</td>
						</tr>
						<tr>
							<td>12/09/2019 6:32 pm</td>
							<td><a href="#">32298</a></td>
							<td>Entrega de documentos</td>
							<td>Certificado de estudios</td>
							<td>Ciclo 2019</td>
							<td>Pariona V.</td>
							<td>Informática</td>
						</tr>
					</tbody>
					<tbody class="d-none" id="tLoque">
						<tr>
							<td colspan="6">No se encontraron resultados</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php } ?>
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
	})
</script>
  </body>
</html>