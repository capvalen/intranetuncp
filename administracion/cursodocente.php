<?php 
include "php/variablesGenerales.php";
if (!isset($_COOKIE['ckPower'])){ header('Location: index.php'); }

if( in_array($_COOKIE['ckPower'], $secretaria) || in_Array($_COOKIE['ckPower'], $subBasico) ){
	header('Location: sinPermiso.php'); }
$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'php/header.php';?>
</head>
<body>

<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
}
input[type=number] {
    -moz-appearance:textfield;
}

.editado{
	background-color: #ffffe5!important;
	border-color: #ffc107!important;
	color: #ea7b1b;
}
thead th{
	border-top: none!important;
}
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>
<?php include "php/conexionInfocat.php"; 

$sqldatosCurso= "CALL `datosCursoCompleto`('{$_GET['cursor']}');";
$resultadodatosCurso=$cadena->query($sqldatosCurso);
$rowdatosCurso =$resultadodatosCurso ->fetch_assoc();


	$sqlCursos = "SELECT ra.*, lower(a.Alu_Apellido) as Alu_Apellido, lower(a.Alu_Nombre) as Alu_Nombre, no.* FROM `registroalumno` ra
	inner join alumno a on a.Alu_Codigo = ra.Alu_Codigo
	inner join seccion se on se.Sec_Codigo = ra.Sec_Codigo 
	inner join onota no on no.Reg_Codigo = ra.Reg_Codigo
	WHERE ra.`Sec_Codigo` = '{$_GET['cursor']}' order by Alu_Apellido asc ; ";
	// and se.Emp_Codigo='{$_COOKIE['ckidUsuario']}' 
	
	$resultadoCursos=$esclavo->query($sqlCursos); $i=1; ?>

<div id="content" class="px-5 pt-5">
	<!-- Contenido de la Página  -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#!" onClick="goBack()">Ciclos</a></li>
			<li class="breadcrumb-item active" aria-current="page">Curso</li>
		</ol>
	</nav>
	<h3>Datos del curso</h3>
	
	<div class="card mb-3">
		
		<div class="card-body row">
			<div class="col">
				<p><strong>Idioma:</strong> <span id="p1Curso"><?= $rowdatosCurso['Idi_Nombre']; ?></span> <span><?= $rowdatosCurso['Niv_Detalle']; ?></span></p>
				<p><strong>Ciclo:</strong> <span id="p1Ciclo"><?= $rowdatosCurso['Sec_NroCiclo']; ?></span></p>
				<p><strong>Sección:</strong> <?= $rowdatosCurso['Sec_Seccion']; ?></p>
			</div>
			<div class="col">
				<p><strong>Temporada:</strong> <?= $meses[intval(substr($rowdatosCurso['Mes_Codigo'], 0,2))] ." ". substr($rowdatosCurso['Mes_Codigo'], -4); ?></p>
				<p><strong>Sucursal:</strong> <?= $rowdatosCurso['sucDescripcion']; ?></p>
			</div>
			<div class="col">
				<p><strong>Días:</strong> <span class='text-capitalize'><?= strtolower($rowdatosCurso['horDiaInicial'])." - ". strtolower($rowdatosCurso['horDiaFinal']); ?></span></p>
				<p><strong>Horario:</strong> <span class='text-capitalize'><?= strtolower($rowdatosCurso['Hor_HoraInicio']); ?> - <?= strtolower($rowdatosCurso['Hor_HoraSalida']); ?></span></p>
				<p><strong>Docente:</strong> <span class='text-capitalize'><a href="docente.php?cursor=<?= $rowdatosCurso['Emp_Codigo']; ?>"><?= strtolower($rowdatosCurso['nomDocente']); ?></a></span></p>
			</div>
		</div>
			
	</div>
	

	<?php if(isset($_GET['cursor'])){ ?>
	<div class="card">
		<div class="card-body d-flex justify-content-between">
			<div class="row">
				<button class="btn btn-outline-primary mx-2" id="btnAsignarAlumno"><i class="icofont-badge"></i> Asignar alumno</button>
				<button class="btn btn-outline-warning mx-2" id="btnReubicarAlumno"><i class="icofont-magic"></i> Re/Ubicar alumno</button>
			</div>
			<?php if($resultadoCursos->num_rows >0){ ?>
				<button class="btn btn-outline-primary" id="btnGuardarNotas"><i class="icofont icofont-save"></i> Guardar notas</button>
			<?php } ?>
		</div>
	</div>
	<?php } ?>

	
	<h4 class="mt-3">Registro de alumnos inscritos:</h4>
		
	<div class="container-fluid table-responsive">
		<table class="table table-hover" id="listAlumnosInscritos">
			<thead>
				<tr>
					<th class="text-center">N°</th>
					<th class="text-center">Código</th>
					<th class="text-center">Apellidos</th>
					<th class="text-center">Nombres</th>
					<th class="text-center">Nota 1</th>
					<th class="text-center">Nota 2</th>
					<th class="text-center">Nota 3</th>
					<th class="text-center">Prom.</th>
				</tr>
			</thead>
			<tbody>
				<?php if($resultadoCursos->num_rows >0){
				while($rowCursos =$resultadoCursos ->fetch_assoc()){ ?>
				<tr class="rowAlumno" data-alu="<?= $rowCursos['Reg_Codigo']; ?>">
					<td><?= $i;?></td>
					<td><button class="btn btn-outline-danger btn-sm border-0 btnRemoveStudent"><i class="icofont-close"></i></button> <a href="alumnos.php?cursor=<?= $rowCursos['Alu_Codigo']?>"><?= $rowCursos['Alu_Codigo'];?></a></td>
					<td class="text-capitalize"><?= $rowCursos['Alu_Apellido'];?></td>
					<td class="text-capitalize"><?= $rowCursos['Alu_Nombre'];?></td>
					<td><input type="number" class="form-control text-center txtNotas" id="txtNota1" max="20" min="0" step="1" autocomplete="nope" value="<?php if($rowCursos['not_1']==null){ echo 0;} else {echo $rowCursos['not_1'];} ?>"></td>
					<td><input type="number" class="form-control text-center txtNotas" id="txtNota2" max="20" min="0" step="1" autocomplete="nope" value="<?php if($rowCursos['not_2']==null){ echo 0;} else {echo $rowCursos['not_2'];} ?>"></td>
					<td><input type="number" class="form-control text-center txtNotas" id="txtNota3" max="20" min="0" step="1" autocomplete="nope" value="<?php if($rowCursos['not_3']==null){ echo 0;} else {echo $rowCursos['not_3'];} ?>"></td>
					<td><input type="number" class="form-control text-center" id="txtPromedio" disabled value="<?php if($rowCursos['not_Prom']==null){ echo 0;} else {echo $rowCursos['not_Prom'];} ?>"></td>
				</tr>
				<?php $i++; }
				}else{?>
				<tr>
					<td colspan="7">Actualmente no hay alumnos registrados.</td>
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
	<div class="modal fade" id="modalAsignarAlumno" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
			
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title mb-3"><i class="icofont-mail"></i> Asignar nuevo alumno al curso</h5>
					<div id="primeraParte">
						<p class="mb-1"><small>Primero ubique al alumno por D.N.I o por sus Apellidos:</small></p>
						<input type="text" class="form-control text-center" autocomplete='off' id="txtUbicarAlumno">
						<div class="d-flex justify-content-center mt-2">
							<button class="btn btn-outline-success " id="btnUbicarAlumno"><i class="icofont-search-1"></i> Buscar alumno</button>
						</div>
					</div>
					<div class='d-none ' id="segundaParte">
						<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th>N°</th>
								<th>Apellidos y Nombres</th>
								<th>D.N.I.</th>
								<th>@</th>
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
	<div class="modal fade" id="modalReubicarAlumno" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
			
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title mb-3"><i class="icofont-mail"></i> Ubicación de alumno al curso</h5>
					<div id="primeraParteUbica">
						<p>Primero, ubique al alumno por D.N.I o por sus Apellidos:</p>
						<input type="text" class="form-control text-center" autocomplete='off' id="txtReUbicarAlumno">
						<div class="d-flex justify-content-center mt-2">
							<button class="btn btn-outline-success " id="btnReUbicarBuscaAlumno"><i class="icofont-search-1"></i> Buscar alumno</button>
						</div>
					</div>
					<div class='d-none ' id="segundaParteUbica">
						<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th>N°</th>
								<th>Apellidos y Nombres</th>
								<th>D.N.I.</th>
								<th>@</th>
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
	<div class="modal fade" id="modalChosenAlumno" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title"><i class="icofont-address-book"></i> Asignar nuevo alumno al curso</h5>
					<p>¿Desea realmente matricular al alumno: <strong class="text-capitalize" id="txtNombreChosen"></strong>?</p>
					<button class="btn btn-outline-primary" id="btnInsertChosen"><i class="icofont-contact-add"></i> Sí, matricular</button>
				</div>
				
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalChosenUbicaAlumno" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icofont-address-book"></i> Asignar nuevo alumno al curso</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body container-fluid">
					<p>Alumno: <strong class="text-capitalize" id="txtNombreChosenUbica"></strong> </p>
					<div class="form-inline mt-1">
						<label for="">Tipo de proceso:</label>
						<select class="selectpicker ml-2" id="sltPTipoUbica" data-seach='true' data-width='50%'>
							<option value="1">Ubicación</option>
							<option value="2">Reubicación</option>
						</select>
					</div>
					<div class="form-inline mt-1">
						<label for="">Calificación:</label>
						<input class="form-control col-4 ml-1" type="number" id="txtUbicaCalificacion">
					</div>
					<p class="my-1">¿Es todo correcto para asignandar al nuevo alumno?</p>
					<button class="btn btn-outline-primary " id="btnUbicaChosen"><i class="icofont-contact-add"></i> Sí, <span id="spanBtnUbica">ubicar</span></button>
				</div>
				
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalRemoveAlumno" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-danger">Retirar alumno</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>¿Desea realmente retirar al alumno: <strong class="text-capitalize" id="txtNombreRemove"></strong> del curso?</p>
					<button class="btn btn-outline-danger float-right" id="btnRemoveChosen"><i class="icofont-trash"></i> Sí, retirar</button>
				</div>
				
			</div>
		</div>
	</div>
		
<!-- Fin de #wrapper  -->
</div>

<?php include "php/footer.php"; ?>

<script>
$("table input").click(function () {
   $(this).select();
});
$('.txtNotas').focus(function () {
	$(this).select();
});
$('.txtNotas').focusout(function () {
	var numAnt=parseFloat($(this).val());
	if($.isNumeric($(this).val())){
		if( $(this).val()>20 ){
			$(this).val(20).change();
		}else if($(this).val()<0){
			$(this).val(0).change();
		}else{	
			$(this).val(numAnt.toFixed(0)).change();
		}
	}else{
		$(this).val(0).change();
	}
});
$('.txtNotas').change(function () {
	var padre = $(this).parent().parent();
	var nota1=0, nota2=0, nota3=0, nprom=0;
	nota1=parseFloat(padre.find('#txtNota1').val());
	nota2=parseFloat(padre.find('#txtNota2').val());
	nota3=parseFloat(padre.find('#txtNota3').val());
	nprom= (nota1 + nota2+ nota3)/3;
	padre.find('#txtPromedio').val(n(parseFloat(nprom).toFixed(0)));
	padre.find('#txtPromedio').addClass('editado');
});
$('.txtNotas').keyup(function(e) {
	if( $(this).val()>=3 ){
		if( $(this).attr('id')=='txtNota3'){
			$(this).parent().parent().next().find('#txtNota1').focus();
		}else{
			$(this).parent().next().find('input').focus();
		}
	}
});
function n(n){
    return n > 9 ? "" + n: "0" + n;
}
$('#btnAsignarAlumno').click(function () {
	$('#primeraParte').removeClass('d-none');
	$('#segundaParte').addClass('d-none');
	$('#txtUbicarAlumno').val('')

	$('#modalAsignarAlumno').modal('show');
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
				<td class='text-capitalize tdNombre'> <span class='apellido'>${elem.Alu_Apellido.toLowerCase() + "</span>, <span class='nombre'>" + elem.Alu_Nombre.toLowerCase()}</span></td>
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
<?php if($resultadoCursos->num_rows >0){ ?>
$('#btnGuardarNotas').click(function () {
	pantallaOver(true);
	var alumnoRegistro = [];
	$.each( $('.rowAlumno'), function (index, elem ) {
		alumnoRegistro.push( {'registro': $(elem).attr('data-alu'), n1: $(elem).find('#txtNota1').val(), n2: $(elem).find('#txtNota2').val(), n3: $(elem).find('#txtNota3').val() });
	});
	//console.log(alumnoRegistro);
	$.ajax({url: 'php/insertarPadron.php', type: 'POST', data: {padron: alumnoRegistro }}).done(function (resp) {
		console.log(resp);
		pantallaOver(false);
		if(resp=='ok'){
			$('#toastInfoTitle').text('¡Guardado exitoso!'); $('#toastInfo').text("Acaba de actualizar correctamente su padrón de notas."); $('#tostadaInfo').toast('show');
		}else{
			$('#toastAdverTitle').text('Advertencia'); $('#toastError').text("Hubo un error al actualizar sus notas, es posible que no se hayan guardado los cambios."); $('#tostadaError').toast('show');
		}
	})
});
<?php } ?>

function animateCSS(element, animationName, callback) {
    const node = document.querySelector(element)
    node.classList.add('animated', animationName)

    function handleAnimationEnd() {
        node.classList.remove('animated', animationName)
        node.removeEventListener('animationend', handleAnimationEnd)

        if (typeof callback === 'function') callback()
    }

    node.addEventListener('animationend', handleAnimationEnd)
}
$('tbody').on('click', '.btnElegirAlumno', function () {
	$('#txtNombreChosen').text( $(this).parent().parent().find('.tdNombre').text())
	$('#btnInsertChosen').attr('data-id', $(this).attr('data-id'));
	$('#modalAsignarAlumno').modal('hide');
	$.nombreAlu = $(this).parent().parent().find('.nombre').text();
	$.apellidoAlu = $(this).parent().parent().find('.apellido').text();
	//$('#modalChosenAlumno').modal('show');
	$('#btnInsertChosen').click();
});
function goBack() {
  window.history.back();
}
<?php if (isset($_GET['cursor'])){ ?>
$('#btnInsertChosen').click(function () {
	var codAlu = $('#btnInsertChosen').attr('data-id');
	var codSec = '<?= $_GET['cursor'];?>';
	$.ajax({url: 'php/insertarAlumnoaCurso.php', type: 'POST', data: {codSec: codSec, codAlu: codAlu }}).done(function (resp) { //console.log(resp);
		$('#modalChosenAlumno').modal('hide');
		if(resp=='todo ok'){
			/* $('#h1Bien').text('Alumno registrado al curso');
			$('#modalGuardadoCorrecto').modal('show'); */
			if( $('#listAlumnosInscritos .rowAlumno').length==0 ){
				$('#listAlumnosInscritos tbody').children().remove();
			}
			$('#listAlumnosInscritos tbody').append(`<tr class="rowAlumno" data-alu="${codSec+codAlu}">
					<th>${$('#listAlumnosInscritos tbody .rowAlumno').length+1}</th>
					<td><button class="btn btn-outline-danger btn-sm border-0 btnRemoveStudent"><i class="icofont-close"></i></button> <a href="alumnos.php?cursor=${codAlu}">${codAlu}</a></td>
					<td class="text-capitalize">${$.apellidoAlu}</td>
					<td class="text-capitalize">${$.nombreAlu}</td>
					<td><input type="number" class="form-control text-center txtNotas" id="txtNota1" max="20" min="0" step="1" disabled='' autocomplete="nope" value="0"></td>
					<td><input type="number" class="form-control text-center txtNotas" id="txtNota2" max="20" min="0" step="1" disabled='' autocomplete="nope" value="0"></td>
					<td><input type="number" class="form-control text-center txtNotas" id="txtNota3" max="20" min="0" step="1" disabled='' autocomplete="nope" value="0"></td>
					<td><input type="number" class="form-control text-center" id="txtPromedio" disabled="" value="0"></td>
				</tr>`);
			alertify.notify('<i class="icofont-check-circled"></i> Alumno registrado al curso con éxito', 'success' );
		}else if(resp=='ya registrado'){
			/* $('#h1Advertencia').text('El alumno ya se encontraba registrado en el curso ' + $('#spanCursoConf').text());
			$('#modalAdvertencia').modal('show'); */
			alertify.notify('<i class="icofont-check-circled"></i> El alumno ya se encontraba registrado en este curso', 'success' );
		}else{
		/* 	$('#h1Advertencia').text('Error desconocido, comuníquelo al área de soporte');
			$('#modalAdvertencia').modal('show'); */
			alertify.notify('<i class="icofont-close-circled"></i> Error desconocido, comuníquelo al área de soporte', 'danger' );
		}
		
	})
})
$('#modalGuardadoCorrecto').on('hidden.bs.modal', function (e) {
  location.reload();
});
$('#listAlumnosInscritos').on('click', '.btnRemoveStudent', function (e) {
	$('#btnRemoveChosen').attr( 'data-alu', $(this).parent().parent().attr('data-alu'))
	$('#modalRemoveAlumno').modal('show');
});
$('#btnRemoveChosen').click(function () {
	$.ajax({url: 'php/removeAlumnoDeCurso.php', type: 'POST', data:{rege: $('#btnRemoveChosen').attr('data-alu') }}).done(function (resp) {
		//console.log(resp);
		$('#modalRemoveAlumno').modal('hide');
		if(resp=='todo ok'){
			$('#h1Advertencia').text('Alumno eliminado del curso');
			$('#modalAdvertencia').modal('show');
		}else{
			$('#h1Advertencia').text('Error desconocido, comuníquelo al área de soporte');
			$('#modalAdvertencia').modal('show');
		}
		$('#modalAdvertencia').on('hidden.bs.modal', function (e) {
			location.reload();
		});
	})
});
$('#btnReubicarAlumno').click(function() {
	$('#primeraParteUbica').removeClass('d-none');
	$('#segundaParteUbica').removeClass('animated fadeIn').addClass('d-none');
	$('#modalReubicarAlumno').modal('show');
});
$('#txtReUbicarAlumno').keyup(function (e) {
	if (e.which ==13){ $('#btnReUbicarBuscaAlumno').click(); }
})
$('#btnReUbicarBuscaAlumno').click(function () {
	if($('#txtReUbicarAlumno').val()!=""){
	pantallaOver(true);
	$('#segundaParteUbica tbody').children().remove();
	
	$.ajax({url: 'php/encontrarAlumnosCoincidentes.php', type: 'POST', data:{texto: $('#txtReUbicarAlumno').val() }}).done(function (resp) {
		//console.log(resp)
		pantallaOver(false);
		var datos = JSON.parse(resp); var docDni ='';
		if(datos.length>0){
			$.each(datos, function (index, elem) {
				if(elem.Alu_NroDocumento == null ){ docDni='';}else{docDni = elem.Alu_NroDocumento}
				$('#segundaParteUbica tbody').append(`<tr>
				<td> ${index+1} </td>
				<td class='text-capitalize tdNombre'> <span class='apellido'>${elem.Alu_Apellido.toLowerCase() + "</span>, <span class='nombre'>" + elem.Alu_Nombre.toLowerCase()}</span></td>
				<td>${docDni}</td>
				<td><button class="btn btn-outline-success btn-sm btnUbicaElegirAlumno" data-id="${elem.Alu_Codigo}"><i class="icofont-ui-rate-add"></i></button></td>
			</tr>`)
			});

		}else{
			$('#segundaParteUbica tbody').append(`<tr>
				<td colspan="3"> <i class="icofont-not-allowed"></i> No existen alumnos coincidentes con lo solicitado </td>
			</tr>`)
		}
		$('#primeraParteUbica').addClass('d-none');
		$('#segundaParteUbica').addClass('animated fadeIn').removeClass('d-none');
		pantallaOver(false);
	});
	}
});
$('tbody').on('click', '.btnUbicaElegirAlumno', function () {
	$('#txtNombreChosenUbica').text( $(this).parent().parent().find('.tdNombre').text())
	$('#btnUbicaChosen').attr('data-id', $(this).attr('data-id'));
	$('#modalReubicarAlumno').modal('hide');
	$.nombreAlu = $(this).parent().parent().find('.nombre').text();
	$.apellidoAlu = $(this).parent().parent().find('.apellido').text();
	$('#modalChosenUbicaAlumno').modal('show');
});
$('#sltPTipoUbica').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if($('#sltPTipoUbica').val()==1){ $('#spanBtnUbica').text('ubicar'); }
	else if($('#sltPTipoUbica').val()==2){ $('#spanBtnUbica').text('reubicar'); }
});
$('#btnUbicaChosen').click(function() {
	pantallaOver(true);
	var codAlu = $(this).attr('data-id');
	var codSec = '<?= $_GET['cursor'];?>';
	$.ajax({url: 'php/insertarAlumnoReubicacion.php', type: 'POST', data: {codAlu: codAlu , codSec: codSec, tipoProceso: $(`#sltPTipoUbica option[value="${$('#sltPTipoUbica').val()}"]`).text(), calificacion: $('#txtUbicaCalificacion').val(), idiomaC: $('#p1Curso').text()+ $('#p1Ciclo').text() }}).done(function(resp) {
		console.log(resp) 
		pantallaOver(false);
		$('#modalChosenUbicaAlumno').modal('hide');
		if(resp=='todo ok'){
			/* $('#h1Bien').text('Alumno ha sido ubicado al curso');
			$('#modalGuardadoCorrecto').modal('show'); */
			if( $('#listAlumnosInscritos .rowAlumno').length==0 ){
				$('#listAlumnosInscritos tbody').children().remove();
			}
			$('#listAlumnosInscritos tbody').append(`<tr class="rowAlumno" data-alu="${codSec+codAlu}">
					<th>${$('#listAlumnosInscritos tbody .rowAlumno').length+1}</th>
					<td><button class="btn btn-outline-danger btn-sm border-0 btnRemoveStudent"><i class="icofont-close"></i></button> <a href="alumnos.php?cursor=${codAlu}">${codAlu}</a></td>
					<td class="text-capitalize">${$.apellidoAlu}</td>
					<td class="text-capitalize">${$.nombreAlu}</td>
					<td><input type="number" class="form-control text-center txtNotas" id="txtNota1" max="20" min="0" step="1" disabled='' autocomplete="nope" value="0"></td>
					<td><input type="number" class="form-control text-center txtNotas" id="txtNota2" max="20" min="0" step="1" disabled='' autocomplete="nope" value="0"></td>
					<td><input type="number" class="form-control text-center txtNotas" id="txtNota3" max="20" min="0" step="1" disabled='' autocomplete="nope" value="0"></td>
					<td><input type="number" class="form-control text-center" id="txtPromedio" disabled="" value="0"></td>
				</tr>`);
			alertify.notify('<i class="icofont-check-circled"></i> Alumno registrado al curso con éxito', 'success' );
		}else if(resp=='ya registrado'){
			/* $('#h1Advertencia').text('El alumno ya se encontraba registrado en el curso ' + $('#spanCursoConf').text());
			$('#modalAdvertencia').modal('show'); */
			alertify.notify('<i class="icofont-check-circled"></i> El alumno ya se encontraba registrado en este curso', 'success' );
		}else{
			/* $('#h1Advertencia').text('Error desconocido, comuníquelo al área de soporte');
			$('#modalAdvertencia').modal('show'); */
			alertify.notify('<i class="icofont-close-circled"></i> Error desconocido, comuníquelo al área de soporte', 'danger' );
		}
	});
});

<?php } ?>
</script>
  </body>
</html>
