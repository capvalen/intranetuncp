<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'php/header.php'; ?>
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
#overlay {
    position: fixed; /* Sit on top of the page content */
    display: none; /* Hidden by default */
    width: 100%; /* Full width (cover the whole page) */
    height: 100%; /* Full height (cover the whole page) */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.75); /* Black background with opacity */
    z-index: 1051; /* Specify a stack order in case you're using a different order for other elements */
   /* Add a pointer on hover */
}
#overlay .text{position: absolute;
    top: 50%;
    left: 50%;
    font-size: 18px;
    color: white;
    user-select: none;
    transform: translate(-50%,-50%);
}
#hojita{font-size: 36px; display: inline; animation: cargaData 6s ease infinite;}
#pFrase{ display: inline; color: #ffffff; }
#pFrase span{ font-size: 13px;}
@keyframes cargaData {
    0%  {color: #96f368;}
    25%  {color: #f3dd68;}
    50% {color: #f54239;}
    75% {color: #c173ce;}
    100% {color: #33dbdb;}
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
	WHERE ra.`Sec_Codigo` = '{$_GET['cursor']}' and se.Emp_Codigo='{$_COOKIE['ckidUsuario']}' order by Alu_Apellido asc ; ";
	//
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
	<p>Listado de alumnos inscritos:</p>
	<?php if($resultadoCursos->num_rows >0){ ?>
	<div class="card">
		<div class="card-body d-flex justify-content-between">
			<a href="#!" class="btn btn-outline-primary" onClick='goBack();'><i class="icofont-swoosh-left"></i> Volver a Mis cursos</a>
			<button class="btn btn-outline-primary" id="btnGuardarNotas"><i class="icofont icofont-save"></i> Guardar cambios</button>
		</div>
	</div>
	<?php }else{ ?>
		<div class="card">
		<div class="card-body d-flex justify-content-between">
			<a href="#!" class="btn btn-outline-primary" onClick='goBack();'><i class="icofont-swoosh-left"></i> Volver a Mis cursos</a>
		</div>
	</div>
	<?php } ?>
	
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
				<tr class="rowAlumno" data-alu="<?= $rowCursos['Reg_Codigo']; ?>">
					<td><?= $i;?></td>
					<td><?= $rowCursos['Alu_Codigo'];?></td>
					<td class="text-capitalize"><?= $rowCursos['Alu_Apellido'];?></td>
					<td class="text-capitalize"><?= $rowCursos['Alu_Nombre'];?></td>
					<td><input type="text" class="form-control text-center txtNotas" id="txtNota1" max="20" min="0" step="1" autocomplete="nope" value="<?php if($rowCursos['not_1']==null){ echo '00';} else {echo str_pad($rowCursos['not_1'], 2, 0, STR_PAD_LEFT);} ?>"></td>
					<td><input type="text" class="form-control text-center txtNotas" id="txtNota2" max="20" min="0" step="1" autocomplete="nope" value="<?php if($rowCursos['not_2']==null){ echo '00';} else {echo str_pad($rowCursos['not_2'], 2, 0, STR_PAD_LEFT);} ?>"></td>
					<td><input type="text" class="form-control text-center txtNotas" id="txtNota3" max="20" min="0" step="1" autocomplete="nope" value="<?php if($rowCursos['not_3']==null){ echo '00';} else {echo str_pad($rowCursos['not_3'], 2, 0, STR_PAD_LEFT);} ?>"></td>
					<td><input type="text" class="form-control text-center" id="txtPromedio" disabled value="<?php if($rowCursos['not_Prom']==null){ echo '00';} else {echo str_pad($rowCursos['not_Prom'], 2, 0, STR_PAD_LEFT);} ?>"></td>
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
		
<!-- Fin de #wrapper  -->
</div>
<div id="overlay">
	  <div class="text"><span id="hojita"><i class="icofont icofont-leaf"></i></span> <p id="pFrase"> Guardado notas... <br> <span>«Pregúntate si lo que estás haciendo hoy <br> te acerca al lugar en el que quieres estar mañana» <br> Walt Disney</span></p>
  </div>
</div>
<?php include "php/footer.php"; ?>

<script>
$('.txtNotas').focusout(function () {
	var numAnt=parseFloat($(this).val());
	if($.isNumeric($(this).val())){
		if( $(this).val()>20 ){
			$(this).val(20).change();
		}else if($(this).val()<0){
			$(this).val(n(0)).change();
		}else{	
			$(this).val(n(numAnt.toFixed(0))).change();
		}
	}else{
		$(this).val(n(0)).change();
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
});
$('.txtNotas').keyup( function (e) {
	if(e.which ==13){ $(this).change(); $(this).parent().next().find('input').focus(); }
});
function n(n){
    return n > 9 ? "" + n: "0" + n;
}
$(".txtNotas").focus(function() {
   $(this).select();
});
$('#btnGuardarNotas').click(function () {
	pantallaOver(true);
	var alumnoRegistro = [];
	$.each( $('.rowAlumno'), function (index, elem ) {
		alumnoRegistro.push( {'registro': $(elem).attr('data-alu'), n1: $(elem).find('#txtNota1').val(), n2: $(elem).find('#txtNota2').val(), n3: $(elem).find('#txtNota3').val() });
	});
	//console.log(alumnoRegistro);
	$.ajax({url: 'php/insertarPadron.php', type: 'POST', data: {padron: alumnoRegistro }}).done(function (resp) {
		//console.log(resp);
		pantallaOver(false);
		if(resp=='ok'){
			$('#toastInfoTitle').text('¡Guardado exitoso!'); $('#toastInfo').text("Acaba de actualizar correctamente su padrón de notas."); $('#tostadaInfo').toast('show');
		}else{
			$('#toastAdverTitle').text('Advertencia'); $('#toastError').text("Hubo un error al actualizar sus notas, es posible que no se hayan guardado los cambios."); $('#tostadaError').toast('show');
		}
	})
});
function pantallaOver(tipo) {
	if(tipo){$('#overlay').css('display', 'initial');}
	else{ $('#overlay').css('display', 'none'); }
}
function goBack() {
  window.history.back();
}
</script>
  </body>
</html>