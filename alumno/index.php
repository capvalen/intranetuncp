<?php 
include "php/fechasPreMatricula.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>CEID UNCP - Visualizador de record académico</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="css/icofont.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/bootstrap-select.min.css" >
	<link rel="shortcut icon" href="images/favicon.png" >

</head>
<body>
<style>
#labelDNI{font-size: 1rem;}
#txtDNI{font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
	font-size: 1.5rem;font-weight: 300; color: #097bd4;}
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
.bootstrap-select .dropdown-toggle{
	text-transform: capitalize;
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
#pFrase{ display: inline; }
#pFrase span{ font-size: 13px;}
@keyframes cargaData {
		0%  {color: #96f368;}
		25%  {color: #f3dd68;}
		50% {color: #f54239;}
		75% {color: #c173ce;}
		100% {color: #33dbdb;}
}
#divMatricula .card-body{
	min-height: 250px;
}
#divMatricula .card-footer{
	background-color: rgb(255, 255, 255);
}
.colSeleccion{
	height: 300px;
}
#colMatricula{
	cursor: pointer;
	color: #fff;
	font-weight: 700;
	background-image: url('images/ceidestudiante.jpg?v=1');
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
}
#colVerNotas{
	cursor: pointer;
	color: #fff;
	font-weight: 700;
	background-image: url('images/vuestudiante.png?v=1');
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
}
#colTramite{
	cursor: pointer;
	color: #fff;
	font-weight: 700;
	background-image: url('images/cuaderno.jpg?v=1.1');
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
}
#colTotMatriculas{
	cursor: pointer;
	color: #fff;
	font-weight: 700;
	background-image: url('images/matriculas.jpg?v=1.1');
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
}
#colCertificado{
	cursor: pointer;
	color: #fff;
	font-weight: 700;
	background-image: url('images/certificado.jpg?v=1.1');
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
}
.colBlack{
	background-color: black;
	opacity: 0.8;
	width: 100%;
	border-radius:
	
}
.contenedor{
	width: 100%;
	z-index: 1;
}
.progressbar{
	list-style: none;
	counter-reset: step;
}
.progressbar li{
	float: left;
	width: 20%;
	position: relative;
	text-align: center;
}
.progressbar li:before{
  content:counter(step);
  counter-increment: step;
  width: 30px;
  height: 30px;
  border: 2px solid #bebebe;
  display: block;
  margin: 0 auto 10px auto;
  border-radius: 50%;
  line-height: 27px;
  background: white;
  color: #bebebe;
  text-align: center;
  font-weight: bold;
}
.progressbar li:after{
  content: '';
  position: absolute;
  width:100%;
  height: 3px;
  background: #979797;
  top: 15px;
  left: -50%;
  z-index: -1;
}
.progressbar li:first-child:after{
	content: none;
}
.progressbar li.active:before{
	background-color: #097bd4;
	border: 2px solid #097bd4;
	color: white;
}
.progressbar li.active:after{
	background: #097bd4;
}
/* .progressbar li.active + li:after{
 background: #3aac5d;
}
.progressbar li.active + li:before{
border-color: #3aac5d;
background: #3aac5d;
color: white
} */

</style>
<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #fff;">
	<a href="#!" class="navbar-brand">
		<img src="https://alumno.ceiduncp.edu.pe/images/logoceid.png" width="auto" height="70px" alt="CEID centro de Idiomas UNCP">
	</a>
	<ul class="navbar-nav">
		<li class="nav-item active">
			<a class="nav-link" href="https://ceiduncp.edu.pe" style="color:#3d88c3"><i class="icofont-rounded-left"></i> Volver al portal</a>
		</li>
	</ul>
</nav>
	<div class="container">
		
		<div class="mb-5" id="rowOpciones">
			<h4>¿Qué deseas hacer?</h4>
			<div class="row" >
				<div class="col-6 mt-3">
						<div class="colSeleccion d-flex align-items-end rounded" id="colMatricula">
					<div class="colBlack rounded-bottom" id="">
							<div class="card-body d-flex justify-content-center align-items-end">
								<h5 class="lead">Generar Pre-Matrícula</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 mt-3">
					<div class="colSeleccion d-flex align-items-end rounded" id="colVerNotas">
						<div class="colBlack rounded-bottom">
							<div class="card-body d-flex justify-content-center align-items-center">
								<h5 class="lead">Ver Notas</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 mt-3">
						<div class="colSeleccion d-flex align-items-end rounded" id="colTramite">
					<div class="colBlack rounded-bottom" id="">
							<div class="card-body d-flex justify-content-center align-items-end">
								<h5 class="lead">Trámite Documentario</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 mt-3">
						<div class="colSeleccion d-flex align-items-end rounded" id="colTotMatriculas">
					<div class="colBlack rounded-bottom" id="">
							<div class="card-body d-flex justify-content-center align-items-end">
								<h5 class="lead">Mis Reservas de Matrícula</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 mt-3">
						<div class="colSeleccion d-flex align-items-end rounded" id="colCertificado">
					<div class="colBlack rounded-bottom" id="">
							<div class="card-body d-flex justify-content-center align-items-end">
								<h5 class="lead">Descargar certificado</h5>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class='d-none' id="divNotas">
			<h1 class="display-3 text-center" style="color: #097bd4;">Record de notas CEID-UNCP</h1>
			<p class="lead">Bienvenido alumno de CEID,  complete el campo para poner visualizar <strong>Record de notas</strong>: </p>
			<label class="lead text-muted" id="labelDNI" for="">Mi D.N.I. es:</label>
			<div class="row">
			<div class="col-md-4 col-sm-12 d-flex justify-content-center">
				<input type="text" class="text-center form-control" id="txtDNI" autocomplete="off">
			</div>
				<button class="btn btn-outline-primary" id="txtBuscarInfo"><i class="icofont-search-1"></i> Consultar</button>
			</div>
			<div class="row">
				<a href="#!" class='btnVolverMenu text-decoration-none text-secondary mt-3'><i class="icofont-rounded-left"></i> Ver menú principal</a>
			</div>
	
			<div id="divResultados">
			
			</div>
		</div>

		<div class='d-none' id="divReservas">
		<h1 class="display-3 text-center" style="color: #097bd4;">Record de reservas de matrícula CEID-UNCP</h1>
			<p class="lead">Bienvenido alumno de CEID, complete el campo para poner visualizar sus <strong>Record de reservas de matrícula</strong>: </p>
			<label class="lead text-muted" id="" for="">Mi D.N.I. es:</label>
			<div class="row">
			<div class="col-md-4 col-sm-12 d-flex justify-content-center">
				<input type="text" class="text-center form-control" id="txtDNIReserva" autocomplete="off">
			</div>
				<button class="btn btn-outline-primary" id="txtBuscarReserva"><i class="icofont-search-1"></i> Consultar</button>
			</div>
			<div class="row">
				<a href="#!" class='btnVolverMenu text-decoration-none text-secondary mt-3'><i class="icofont-rounded-left"></i> Ver menú principal</a>
			</div>
	
			<div id="divResultadosReservas">
			</div>
		</div>

		<div class="d-none" id="divMatricula">
		<?php if(1==1): ?>
		<!-- inicio de divMatricula -->
		 <h1 class="display-3 text-center" style="color: #097bd4;">Pre-Matrícula </h1>
		 <div class="root" style="display: flex;">
				<div class="contenedor">
					<ul class="progressbar">
						<li data-tag="1" class="active">Reconocimiento</li>
						<li data-tag="2" >Datos</li>
						<li data-tag="3" >Curso</li>
						<li data-tag="4">Horario</li>
						<li data-tag="5">Resumen</li>
						<!-- <li data-tag="6">Paso 5</li> -->
					</ul>
				</div>
				</div>
				<div class="mt-4" id="subProcesos">
					<div class="row col" id="subPro1">
						<div class="card w-100">
							<div class="card-body">
								<h4>Hola alumno CEID</h4>
								<p>Comencemos el proceso de Pre-Matrícula, Ingrese su D.N.I.: </p>
								<input class="form-control col-md-6" type="text" id="txtDniMatriculante">
								<div class="alert alert-light d-none text-danger" role="alert" id="alertaDNI"><i class="icofont-warning-alt"></i> Tu Dni no es correcto </div>
								<div class="alert alert-success col-md-6 mt-3" role="alert" id="alertaDNI"><i class="icofont-warning-alt"></i> Pre matrícula abierta para el <strong>periodo <?= $periodoAmigable; ?></strong>, si es correcto continua. </div>
							</div>
							<div class="card-footer">
								<div class="row d-flex d-flex flex-row-reverse px-4">
									<button class="btn btn-outline-secondary border-0 btnSiguiente" queProceso="buscarDNI" data-tag='1'>Siguiente <i class="icofont-caret-right"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="row d-none" id="subPro3">
						<div class="card w-100">
							<div class="card-body">
								<h4 class='pb-3'>¿Qué proceso deseas hacer?</h4>
								<div class="list-group col-6" id="listaCursos">
									
								</div>
							</div>
							<div class="card-footer">
								<div class="row d-flex flex-row-reverse px-4">
									<!-- <button class="btn btn-outline-secondary border-0 btnAtras" data-tag='1'><i class="icofont-caret-left"></i> Atrás </button> -->
									<button class="btn btn-outline-secondary border-0 btnSiguiente" queProceso="elegirCurso" data-tag='3'>Siguiente <i class="icofont-caret-right"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="row d-none" id="subPro61">
						<div class="card w-100">
							<div class="card-body">
								<h4 class='pb-3'>Nuevo alumno</h4>
								<p>Al parecer eres nuevo en el Centro de idiomas, ingresa tus datos antes de tu matrícula.</p>
								<div class="alert alert-warning d-none" role="alert"><i class="icofont-warning"></i> Si consideras que es un error, revisa tu D.N.I. y luego apersonate a nuestras oficinas para solucionarlo. </div>
								<div class="alert alert-danger d-none" role="alert"><i class="icofont-warning"></i> <span id="spanMensajeNu"></span> </div>
								<label for=""><small>D.N.I:</small></label>
								<input class="form-control text-capitalize" type="text" id="txtNueDNI" readonly>
								<label for=""><small>Nombres:</small></label>
								<input class="form-control text-capitalize" type="text" id="txtNueNombre">
								<label for=""><small>Apellidos:</small></label>
								<input class="form-control text-capitalize" type="text" id="txtNueApellido">
								<label for=""><small>Fecha de nacimiento:</small></label>
								<input class="form-control" type="date" id="txtNueFechaNacimiento">
								<label for=""><small>Celular de contacto:</small></label>
								<input class="form-control" type="text" id="txtNueCelular">
								<label for=""><small>Procedencia:</small></label>
								<select class="selectpicker form-control" id="sltPNueProcedencia" data-live-search="true" data-width="100%">
									<?php include 'php/OPT_procedencias.php'; ?>
								</select>
								<label for=""><small>Carrera:</small></label>
								<select class="selectpicker form-control" id="sltPNueCarrera" data-live-search="true" data-width="100%">
									<?php include 'php/OPT_facultadesMax.php'; ?>
								</select>
								<label for=""><small>Sexo:</small></label>
								<select class="selectpicker form-control" id="sltPNueSexo" data-live-search="true" data-width="100%">
									<option value="1">Masculino</option>
									<option value="0">Femenino</option>
								</select>
							</div>
							<div class="card-footer">
								<div class="row d-flex flex-row-reverse px-4">
									<!-- <button class="btn btn-outline-secondary border-0 btnAtras" data-tag='1'><i class="icofont-caret-left"></i> Atrás </button> -->
									<button class="btn btn-outline-secondary border-0 btnSiguiente" queProceso="crearData" data-tag='2'>Siguiente <i class="icofont-caret-right"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="row d-none" id="subPro60">
						<div class="card w-100">
							<div class="card-body">
								<h4 class='pb-3'>Antes de continuar...</h4>
								<p>Por favor, ayúdanos a actualizar tus datos antes de tu matrícula.</p>
								<div class="alert alert-danger d-none" role="alert"><i class="icofont-warning"></i> <span id="spanMensajeAl"></span> </div>
								<label for=""><small>Nombres:</small></label>
								<input class="form-control text-capitalize" type="text" id="txtActNombre">
								<label for=""><small>Apellidos:</small></label>
								<input class="form-control text-capitalize" type="text" id="txtActApellido">
								<label for=""><small>Fecha de nacimiento:</small></label>
								<input class="form-control" type="date" id="txtActFechaNacimiento">
								<label for=""><small>Celular de contacto:</small></label>
								<input class="form-control" type="text" id="txtActCelular">
								<label for=""><small>Procedencia:</small></label>
								<select class="selectpicker form-control" id="sltPActProcedencia" data-live-search="true" data-width="100%">
									<?php include 'php/OPT_procedencias.php'; ?>
								</select>
								<label for=""><small>Carrera:</small></label>
								<select class="selectpicker form-control" id="sltPActCarrera" data-live-search="true" data-width="100%">
									<?php include 'php/OPT_facultadesMax.php'; ?>
								</select>
								<label for=""><small>Sexo:</small></label>
								<select class="selectpicker form-control" id="sltPActSexo" data-live-search="true" data-width="100%">
									<option value="1">Masculino</option>
									<option value="0">Femenino</option>
								</select>
							</div>
							<div class="card-footer">
								<div class="row d-flex flex-row-reverse px-4">
									<!-- <button class="btn btn-outline-secondary border-0 btnAtras" data-tag='1'><i class="icofont-caret-left"></i> Atrás </button> -->
									<button class="btn btn-outline-secondary border-0 btnSiguiente" queProceso="actualizarData" data-tag='2'>Siguiente <i class="icofont-caret-right"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="row d-none" id="subPro4">
					<div class="card w-100">
						<div class="card-body">
							<h4 class='pb-3'>Tenemos los siguientes horarios disponibles:</h4>
							<div class="row row-cols-2">
								<div class="col d-none"  id="alertSistemaAI">
									<strong>El sistema decidió lo siguiente:</strong>
									<p><strong>Curso: </strong> <span  id="spanCursoPre"></span></p>
									<p><strong>Nivel: </strong> <span  id="spanNivelPre"></span></p>
									<p><strong>Ciclo: </strong> <span id="spanCicloPre"></span></p>
									<p><strong>Sede: </strong> <span id="spaSedePre"></span></p>
									<p><strong>Última nota: </strong> <span id="spaNotaPre"></span></p>
									<p><strong>Motivo: </strong> <span id="spanMotivoPre"></span></p>
									<p>Si deseas cambiar de sucursal, puedes hacerlo acá:</p>
									<select class="selectpicker form-control" id="sltPMismCurso" data-live-search="true" data-width="100%">
										<?php include 'php/OPT_sedes.php'; ?>
									</select>
								</div>
								<div class="col d-none" id="alertNuevoCurso">
									<p>Selecciona el curso nuevo que deseas empezar</p>
									<select class="selectpicker form-control" id="sltPNueCurso" data-live-search="true" data-width="100%">
										<?php include 'php/OPT_idiomas.php'; ?>
									</select>
									<p>¿En qué sucursal deseas llevar el curso?</p>
									<select class="selectpicker form-control" id="sltPNueSede" data-live-search="true" data-width="100%">
										<?php include 'php/OPT_sedes.php'; ?>
									</select>
								</div>
								<div class="col">
									<p>Sólo falta seleccionar el horario que deseas registrate:</p>
									<div class="list-group " id="listaHorarios">
										<?php include "php/verHorarios.php"; ?>
									</div>
								</div>
								
							</div>
						</div>
						<div class="card-footer">
							<div class="row d-flex justify-content-between px-4">
								<button class="btn btn-outline-secondary border-0 btnAtras" data-tag='3'><i class="icofont-caret-left"></i> Atrás </button>
								<button class="btn btn-outline-secondary border-0 btnSiguiente" queProceso = "unirHorarios" data-tag='5'>Siguiente <i class="icofont-caret-right"></i></button>
							</div>
						</div>
					</div>
					</div>
					<div class="row d-none" id="subPro5">
					<div class="card w-100">
						<div class="card-body">
							<img src="images/successful-transaction-image.svg" alt="" class="img-fluid">
							<h4 class="text-primary">Felicitaciones, terminaste tu pre-matrícula. </h4>
							<p>Ahora puedes acercarte al banco a realizar el pago y luego presentar tu voucher a secretaría para finalizar todo el proceso y asistir a clases.</p>
						
						</div>
					</div>
					</div>
                        
            
                    
				</div> <!--Fin de SubProcesos-->
		
		<!-- fin de divPrematricula-->
		<?php endif; ?>
		</div>
		
	</div>
    
			<div class='d-none' id="divCertificados">
				<h1 class="display-3 text-center" style="color: #097bd4;">Certificados  CEID-UNCP</h1>
				<p class="lead">Bienvenido alumno, nos es grato encontrarte acá para que descargues tu certificado. </p>
				<label class="lead text-muted" id="labelDNI" for="">Mi D.N.I. es:</label>
				<div class="row">
				<div class="col-md-4 col-sm-12 d-flex justify-content-center">
					<input type="text" class="text-center form-control" id="txtCertificadoDni" autocomplete="off">
				</div>
					<button class="btn btn-outline-primary" id="txtCertificadoBuscar"><i class="icofont-search-1"></i> Consultar</button>
				</div>
				<div class="row">
					<a href="#!" class='btnVolverMenu text-decoration-none text-secondary mt-3'><i class="icofont-rounded-left"></i> Ver menú principal</a>
				</div>
		
				<div id="divCertificadoResultados">
				
				</div>
			</div>
</div>
<div id="modalSeleccionarDuplicados" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="my-modal-title">Alumnos encontrados</h5>
				<table class="table table-hover" id="tblResultadosDuplicados">
					<thead>
						<tr>
							<td>N°</td>
							<td>D.N.I.</td>
							<td>Apellidos y Nombres</td>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<div class="alert alert-warning" role="alert">
					Si tus datos no están correctos acércate a una de nuestras oficinas para solucionarlo.
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modalConfirmar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="my-modal-title">Antes de guardar</h5>
				<p>¿Estás seguro que deseas realizar tu pre matrícula?</p>
				<div class="d-flex justify-content-between">
					<button class="btn btn-default" data-dismiss="modal" >No</button>
					<button class="btn btn-outline-primary" id="btnGuardarTodo"><i class="icofont-save"></i> Sí, pre matricularme</button>
				</div>
			</div>
		</div>
	</div>
</div>

	<div class='d-none' id="overlay">
		<div class="text"><span id="hojita"><i class="icofont icofont-leaf"></i></span> <p id="pFrase"> Solicitando los datos... <br> <span>«Pregúntate si lo que estás haciendo hoy <br> te acerca al lugar en el que quieres estar mañana» <br> Walt Disney</span></p>
	</div>
</div>

        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="js/bootstrap-select.min.js?version=1.0.1"></script>
<script src="js/moment.js"></script>

<script>
$('.selectpicker').selectpicker();
$('#txtBuscarInfo').click(function () {
	if($('#txtDNI').val()!='' && $('#txtDNI').val().length ==8 ){
		pantallaOver(true);
		$.ajax({url: 'php/buscarDNIRepetidos.php', type: 'POST', data: { texto: $('#txtDNI').val() }}).done(function(resp) {
			//console.log(resp)
			$('#tblResultadosDuplicados tbody').html(resp);
			pantallaOver(false);
			$('#modalSeleccionarDuplicados').modal('show');
		});
		
		
	}
});
function mostrarData(idAlumno){
	pantallaOver(true);
	//console.log(idAlumno);
	$('#modalSeleccionarDuplicados').modal('hide');
	$.ajax({url: "php/listarNotas.php", type: 'POST', data:{codAlu: idAlumno }}).done(function (resp) {
			//console.log(resp);
			$('#divResultados').children().remove();
			$('#divResultados').append(resp);
			pantallaOver(false);
		});
}
$('#txtBuscarReserva').click(function () {
	if($('#txtDNIReserva').val()!=''){
		pantallaOver(true);
		$.ajax({url: "php/listarReservas.php", type: 'POST', data:{dni: $('#txtDNIReserva').val() }}).done(function (resp) {
			//console.log(resp);
			$('#divResultadosReservas').children().remove();
			$('#divResultadosReservas').append(resp);
			pantallaOver(false);
		});
	}
});
$('#txtDNI').keyup(function (e) { if (e.which ==13){ $('#txtBuscarInfo').click(); } });
$('#txtDNIReserva').keyup(function (e) { if (e.which ==13){ $('#txtBuscarReserva').click(); } });

$('#colVerNotas').click(function() {
	$('#divNotas').removeClass('d-none');
	$('#rowOpciones').addClass('d-none');
});
$('#colCertificado').click(function() {
	$('#divCertificados').removeClass('d-none');
	$('#rowOpciones').addClass('d-none');
});
$('#colTotMatriculas').click(function() {
	$('#divReservas').removeClass('d-none');
	$('#rowOpciones').addClass('d-none');
});
$('.btnVolverMenu').click(function() {
	$('#divNotas').addClass('d-none');
	$('#divReservas').addClass('d-none');
	$('#rowOpciones').removeClass('d-none');
});
$('#colMatricula').click(function() {
	$('#divMatricula').removeClass('d-none');
	$('#rowOpciones').addClass('d-none');
});
/* $('.progressbar li').click(function() {
	var proceso = $(this).attr('data-tag'); console.log(proceso)
	$.each( $('.progressbar li') , function(i, objeto){
		if(i<proceso){
			$(this).addClass('active')
		}else{
			$(this).removeClass('active');
		}
	});

	$(`#subPro${proceso-1}`).addClass('animated bounceOutLeft')

	$(`#subPro${proceso-1}`).on('animationend', function() { 
		$(`#subPro${proceso-1}`).addClass('animated bounceOutLeft').addClass('d-none')
		$(`#subPro${proceso}`).addClass('animated bounceInRight').removeClass('d-none');
	});
	
}); */
$('.btnSiguiente').click(function() { console.log('siguiente Proceso')
	var proceso = parseInt($(this).attr('data-tag'));
	$.each( $('.progressbar li') , function(i, objeto){
		if(i<=proceso && proceso<60){
			$(this).addClass('active')
		}else{
			$(this).removeClass('active');
		}
	});

	/* $(`#subPro${proceso-1}`).addClass('animated bounceOutLeft')

	$(`#subPro${proceso-1}`).on('animationend', function() {
		$(`#subPro${proceso-1}`).addClass('animated bounceOutLeft').addClass('d-none')
		$(`#subPro${proceso}`).addClass('animated bounceInRight').removeClass('d-none');
	}); */

	if(  $('#txtDniMatriculante').val().length==8 ){

		var queProceso = $(this).attr('queProceso');
		pantallaOver(true);
		switch (queProceso) {
			case 'buscarDNI':
				if($('#txtDniMatriculante').val().length==8 ){
					$.ajax({url: 'php/buscarDniBDMatricula.php', type: 'POST', data: { dni: $('#txtDniMatriculante').val() }}).done(function(resp) {
						console.log(resp)
						pantallaOver(false);
						var data = JSON.parse(resp);
						if( data.length == 0 ){
							//console.log( 'alumno nuevo' );
							$.dni = $('#txtDniMatriculante').val();
							$('#txtNueDNI').val($.dni);
							$('#txtNueFechaNacimiento').val(moment().format('YYYY-MM-DD'));

							const element =  document.querySelector(`#subPro${1}`)
							element.classList.add('animated', 'bounceOutLeft')/* .remove('bounceOutRight') */
							//console.log(proceso)
							$(`#subPro${61}`).addClass('animated bounceInRight').removeClass('d-none'); //$(`#subPro${proceso+1}`).
							ocultarCard($(`#subPro${1}`));

						}else if(data.length==1 ){
							//console.log( data );
							$.idAlu = data[0].Alu_Codigo;
							$('#txtActNombre').val(data[0].Alu_Nombre);
							$('#txtActApellido').val(data[0].Alu_Apellido);
							$('#txtActFechaNacimiento').val(data[0].Alu_FechaNacimiento);
							$('#txtActCelular').val(data[0].Alu_Telefono);
							$('#sltPActProcedencia').selectpicker('val', data[0].idProcedencia);
							$('#sltPActCarrera').selectpicker('val', data[0].fac_Codigo);
							$('#sltPActSexo').val(data[0].Alu_Sexo);


							console.log('dni unico');
							const element =  document.querySelector(`#subPro${proceso}`)
							element.classList.add('animated', 'bounceOutLeft')/* .remove('bounceOutRight') */
							//console.log(proceso)
							$(`#subPro${60}`).addClass('animated bounceInRight').removeClass('d-none'); //$(`#subPro${proceso+1}`).
							ocultarCard($(`#subPro${proceso}`));

						}else{
							console.log('dni duplicados');
						}
					});
				}
				
				break;
				case 'crearData': crearData(); break;
				case 'actualizarData': actualizarData(); break;
				case 'elegirCurso': elegirCurso(proceso); break;
				case 'unirHorarios': pantallaOver(false); unirHorarios(proceso); break;
					
		
			default:
				break;
		}

	}else{
		$('#alertaDNI').removeClass('d-none');
	}
	
});
function crearData(){ 
	$('#spanMensajeNu').parent().addClass('d-none');
	if( $('#txtNueNombre').val()=='' || $('#txtNueApellido').val()=='' ){
		$('#spanMensajeNu').text('No puedes dejar en blanco el nombre y el apellido').parent().removeClass('d-none');
	}else if( !moment($('#txtNueFechaNacimiento').val(), 'YYYY-MM-DD').isValid() ){
		$('#spanMensajeNu').text('Ingresa una fecha de nacimiento correcta.').parent().removeClass('d-none');
	}else{ //console.log('pase validaciones')
		pantallaOver(true);
		$.ajax({url: 'php/crearAlumnoNuevo.php', type: 'POST', data: {
			dni: $.dni,
			fechanac: $('#txtNueFechaNacimiento').val(),
			nombre: $('#txtNueNombre').val(),
			apellido: $('#txtNueApellido').val(),
			sexo: $('#sltPNueSexo').val(),
			procedencia: $('#sltPNueProcedencia').val(),
			facultad: $('#sltPNueCarrera').val(),
			celular: $('#txtNueCelular').val()
		}}).done(function(resp) {
			//console.log(resp);
			if(resp.length  == 7 ){ $.idAlu = resp; //console.log( 'guardo ok' );
				$.ajax({url: 'php/listarIdiomasAMatricular.php', type: 'POST', data: { idAlu: $.idAlu }}).done(function(resp) {
					//console.log(resp)
					$('#listaCursos').html(resp);

					const element =  document.querySelector(`#subPro${61}`)
					element.classList.add('animated', 'bounceOutLeft')
					//console.log(proceso)
					$(`#subPro${3}`).addClass('animated bounceInRight').removeClass('d-none');
					ocultarCard($(`#subPro${61}`));
					
				});
			}else{
				$('#spanMensajeAl').text('Ocurrió un error al conectarse al servidor, inténtalo más tarde porfavor.').parent().removeClass('d-none');
				$('#spanMensajeAl').parent().parent().find('.btnSiguiente').remove();
			}
		});
		
	}
	pantallaOver(false);
}
function actualizarData(){
	$('#spanMensajeAl').parent().addClass('d-none');
	if( $('#txtActNombre').val()=='' || $('#txtActApellido').val()=='' ){
		$('#spanMensajeAl').text('No puedes dejar en blanco el nombre y el apellido').parent().removeClass('d-none');
	}else if( !moment($('#txtActFechaNacimiento').val(), 'YYYY-MM-DD').isValid() ){
		$('#spanMensajeAl').text('Ingresa una fecha de nacimiento correcta.').parent().removeClass('d-none');
	}else{
		pantallaOver(true);
		$.ajax({url: 'php/updateDataAlumno.php', type: 'POST', data: { idAlu: $.idAlu,
			fNac: $('#txtActFechaNacimiento').val(),
			nombre: $('#txtActNombre').val(),
			apellidos: $('#txtActApellido').val(),
			sexo: $('#sltPActSexo').val(),
			procedencia: $('#sltPActProcedencia').val(),
			facultad: $('#sltPActCarrera').val(),
			celular: $('#txtActCelular').val()
		}}).done(function(resp) {
			//console.log(resp);
			
			if(resp=='todo ok'){
				$.ajax({url: 'php/listarIdiomasAMatricular.php', type: 'POST', data: { idAlu: $.idAlu }}).done(function(resp) {
					//console.log(resp)
					$('#listaCursos').html(resp);

					const element =  document.querySelector(`#subPro${60}`)
					element.classList.add('animated', 'bounceOutLeft')/* .remove('bounceOutRight') */
					//console.log(proceso)
					$(`#subPro${3}`).addClass('animated bounceInRight').removeClass('d-none');
					ocultarCard($(`#subPro${60}`));
					
				});
			}else{
				$('#spanMensajeAl').text('Ocurrió un error al conectarse al servidor, inténtalo más tarde porfavor.').parent().removeClass('d-none');
				$('#spanMensajeAl').parent().parent().find('.btnSiguiente').remove();
			}
		});
		
	}
	pantallaOver(false);
}
function elegirCurso(proceso){ console.log(proceso)
	$.idioma = $('#listaCursos .active').attr('data-id');
	if($.idioma!='nuevo'){
		$.ajax({url: 'php/proximoMomentoAMatricular.php', type: 'POST', data: { idioma: $.idioma, idAlu: $.idAlu }}).done(function(resp) {
			//console.log(resp)
			var respuesta = JSON.parse(resp); console.log(respuesta)
			$('#alertSistemaAI').removeClass('d-none'); $('#alertNuevoCurso').addClass('d-none');
			$('#spanCursoPre').text(respuesta.idioma);
			$('#spanNivelPre').text(respuesta.nivel);
			$('#spanCicloPre').text(respuesta.ciclo);
			$('#spaNotaPre').text(respuesta.notaFin);
			$('#spaSedePre').text(respuesta.sede);
			$('#spanMotivoPre').text(respuesta.comentario);
			$('#sltPMismCurso').selectpicker('val', respuesta.sucursal );
			$.sucursal = respuesta.sucursal;
			$.nivel = respuesta.codNivel;
			$.ciclo = respuesta.ciclo;
			pantallaOver(false);
		});
	}else{
		$('#sltPNueCurso').selectpicker('val', -1);
		$('#alertNuevoCurso').removeClass('d-none'); $('#alertSistemaAI').addClass('d-none');
		pantallaOver(false);
	}
	const element =  document.querySelector(`#subPro${proceso}`)
	element.classList.add('animated', 'bounceOutLeft')/* .remove('bounceOutRight') */
	//console.log(proceso)
	$(`#subPro${proceso+1}`).addClass('animated bounceInRight').removeClass('d-none');
	ocultarCard($(`#subPro${proceso}`));
}
function unirHorarios(proceso){
	$.horario = $('#listaHorarios .active').attr('data-id');
	if($.horario!=null){
		$('#modalConfirmar').modal('show');
	}
}
$('#sltPMismCurso').change(function() {
	$.sucursal = $('#sltPMismCurso').selectpicker('val');
});
$('#sltPNueCurso').change(function() {
	$.nivel ='B1';
	$.ciclo =1;
	$.idioma = $('#sltPNueCurso').selectpicker('val');
	$.sucursal = $('#sltPNueSede').selectpicker('val');
});
$('#btnGuardarTodo').click(function() {
	$('#modalConfirmar').modal('hide');
	pantallaOver(true);

	$.ajax({url: 'php/insertarPreMatricula.php', type: 'POST', data: {
		idAlu: $.idAlu,
		idioma: $.idioma,
		nivel: $.nivel,
		ciclo: $.ciclo,
		horario: $.horario,
		sucursal: $.sucursal,
		motivo: $('#spanMotivoPre').text()+' con nota '+ $('#spaNotaPre').text(),
		periodo: '<?= $periodo; ?>'
	 }}).done(function(resp) {
		pantallaOver(false);
		console.log(resp)
		if(resp =='todo ok'){
			const element =  document.querySelector(`#subPro${3}`)
			element.classList.add('animated', 'bounceOutLeft')/* .remove('bounceOutRight') */
			//console.log(proceso)
			$(`#subPro${5}`).addClass('animated bounceInRight').removeClass('d-none');
			ocultarCard($(`#subPro${4}`));
		}
	});
});
function ocultarCard(elemento){
	$(elemento).addClass('d-none').removeClass('animated bounceInRight bounceInLeft bounceOutLeft bounceOutRight');
}

$('.btnAtras').click(function() { console.log('atras')
	var proceso = parseInt($(this).attr('data-tag'));
	$('.progressbar li').removeClass('active');
	$.each( $('.progressbar li') , function(i, objeto){
		if(i<proceso){
			$(this).addClass('active')
		}else{
			$(this).removeClass('active');
		}
	});
	//console.log(proceso)

	const element =  document.querySelector(`#subPro${proceso+1}`)
	element.classList.add('animated', 'bounceOutRight')
	$(`#subPro${proceso}`).addClass('animated bounceInLeft').removeClass('d-none');
	ocultarCard($(`#subPro${proceso+1}`));
	
});

$('.list-group-item').click(function() {
	$('.list-group-item').removeClass('active')
	$(this).addClass('active');
	
});
$('#txtCertificadoBuscar').click(function() {
	if( $('#txtCertificadoDni').val()!='' ){
		$.ajax({url: 'php/buscarCertificado.php', type: 'POST', data: { dni: $('#txtCertificadoDni').val() }}).done(function(resp) {
			//console.log(resp)
			$('#divCertificadoResultados').html(resp);
		});
	}
});
$('#listaCursos').on('click', '.list-group-item', function (e) {
	$('.list-group-item').removeClass('active');
	$(this).addClass('active');
});
function pantallaOver(tipo) {
	if(tipo){$('#overlay').css('display', 'initial').removeClass('d-none');}
	else{ $('#overlay').css('display', 'none').addClass('d-none'); }
}
$('#txtDniMatriculante').keypress(function (e) { 
	if(e.keyCode == 13){ 
		$(this).parent().parent().find('.btnSiguiente').click();
	}
});

</script>
</body>
</html>