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
.editado{
	background-color: #ffffe5!important;
	border-color: #ffc107!important;
	color: #ea7b1b;
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
	<div class="row">
		<div class="col">
			<p>Temporada: <?= $rowdatosCurso['Mes_Codigo']; ?></p>
			<p>Curso: <?= $rowdatosCurso['Idi_Nombre']; ?></p>
			<p>Detalle: <?= $rowdatosCurso['Niv_Detalle']; ?></p>
		</div>
		<div class="col">
			<p>Ciclo: <?= $rowdatosCurso['Sec_NroCiclo']; ?></p>
			<p>Sección: <?= $rowdatosCurso['Sec_Seccion']; ?></p>
			<p>Sucursal: <?= $rowdatosCurso['Suc_Direccion']; ?></p>
		</div>
		<div class="col">
			<p>Inicio: <?= $rowdatosCurso['Hor_HoraInicio']; ?></p>
			<p>Final: <?= $rowdatosCurso['Hor_HoraSalida']; ?></p>
		</div>
		
	</div>

	<?php if(isset($_GET['cursor'])){ ?>
	<div class="card">
		<div class="card-body">
			<button class="btn btn-outline-primary" id="btnAsignarAlumno"><i class="icofont-badge"></i> Asignar alumno</button>
		</div>
	</div>
	<?php } ?>


	<p>Listado de alumnos inscritos:</p>
		
	<div class="container">
		<table class="table table-hover">
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
				<tr>
					<td><?= $i;?></td>
					<td><?= $rowCursos['Alu_Codigo'];?></td>
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
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Asignar nuevo alumno al curso</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="primeraParte">
						<p>Primero, ubique al alumno por D.N.I o por sus Apellidos:</p>
						<input type="text" class="form-control text-center" autocomplete='off' id="txtUbicarAlumno">
						<div class="d-flex justify-content-center mt-2">
							<button class="btn btn-outline-success " id="btnUbicarAlumno"><i class="icofont-search-1"></i> Ubicar alumno</button>
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
	<div class="modal fade" id="modalChosenAlumno" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Asignar nuevo alumno al curso</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Desea realmente matricular al alumno: <strong class="text-capitalize" id="txtNombreChosen"></strong></p>
					<button class="btn btn-outline-primary" id="btnInsertChosen"><i class="icofont-contact-add"></i> Sí, matricular</button>
				</div>
				
			</div>
		</div>
	</div>
		
<!-- Fin de #wrapper  -->
</div>

<?php include "php/footer.php"; ?>

<script>
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
})
$('.txtNotas').change(function () {
	var padre = $(this).parent().parent();
	var nota1=0, nota2=0, nota3=0, nprom=0;
	nota1=parseFloat(padre.find('#txtNota1').val());
	nota2=parseFloat(padre.find('#txtNota2').val());
	nota3=parseFloat(padre.find('#txtNota3').val());
	nprom= (nota1 + nota2+ nota3)/3;
	padre.find('#txtPromedio').val(n(parseFloat(nprom).toFixed(0)));
	padre.find('#txtPromedio').addClass('editado');
})
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

	animateCSS('#primeraParte', 'fadeOut', function () {
		$.ajax({url: 'php/encontrarAlumnosCoincidentes.php', type: 'POST', data:{texto: $('#txtUbicarAlumno').val() }}).done(function (resp) {
		//console.log(resp)
		pantallaOver(false);
			var datos = JSON.parse(resp); var docDni ='';
			if(datos.length>1){
				$.each(datos, function (index, elem) {
					if(elem.Alu_NroDocumento == null ){ docDni='';}else{docDni = elem.Alu_NroDocumento}
					$('#segundaParte tbody').append(`<tr>
					<td> ${index+1} </td>
					<td class='text-capitalize tdNombre'> ${elem.Alu_Apellido.toLowerCase() +', '+ elem.Alu_Nombre.toLowerCase()}</td>
					<td>${docDni}</td>
					<td><button class="btn btn-outline-success btn-sm btnElegirAlumno" data-id="${elem.Alu_Codigo}"><i class="icofont-ui-rate-add"></i></button></td>
				</tr>`)
				});

			}
		});
		$('#primeraParte').addClass('d-none');
		$('#segundaParte').addClass('animated fadeIn').removeClass('d-none');
		pantallaOver(false);
	})
	}
});

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
	$('#modalChosenAlumno').modal('show');
});
function goBack() {
  window.history.back();
}
<?php if (isset($_GET['cursor'])){ ?>
$('#btnInsertChosen').click(function () {
	$.ajax({url: 'php/insertarAlumnoaCurso.php', type: 'POST', data: {codSec: '<?= $_GET['cursor'];?>', codAlu: $('#btnInsertChosen').attr('data-id')}}).done(function (resp) { //console.log(resp);
		$('#modalChosenAlumno').modal('show');
		if(resp=='todo ok'){
			$('#h1Bien').text('Alumno registrado al curso');
				$('#modalGuardadoCorrecto').modal('hide');
		}else if(resp=='ya registrado'){
			$('#h1Advertencia').text('El alumno ya se encontraba registrado en el curso ' + $('#spanCursoConf').text());
			$('#modalAdvertencia').modal('show');
		}else{
			$('#h1Advertencia').text('Error desconocido, comuníquelo al área de soporte');
			$('#modalAdvertencia').modal('show');
		}
		
	})
})
$('#modalGuardadoCorrecto').on('hidden.bs.modal', function (e) {
  location.reload();
});
<?php } ?>
</script>
  </body>
</html>
