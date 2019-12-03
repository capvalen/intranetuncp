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
		 <h1 class="display-3 text-center" style="color: #097bd4;">Pre-Matrícula</h1>
		 <div class="root" style="display: flex;">
				<div class="contenedor">
					<ul class="progressbar">
						<li data-tag="1" class="active">Reconocimiento</li>
						<li data-tag="2" >Curso</li>
						<li data-tag="3">Horario</li>
						<li data-tag="4">Resumen</li>
						<li data-tag="5">Paso 5</li>
					</ul>
				</div>
				</div>
				<div class="mt-4" id="subProcesos">
					<div class="row col" id="subPro1">
						<div class="card w-100">
							<div class="card-body">
								<h4>Ingrese su DNI</h4>
								<p>Comencemos el proceso de Pre-Matrícula con su D.N.I.: </p>
								<input class="form-control col-6" type="text" id="txtDniMatriculante">
							</div>
							<div class="card-footer">
								<div class="row d-flex justify-content-between px-4">
									<button class="btn btn-outline-secondary border-0 btnSiguiente" data-tag='1'>Siguiente <i class="icofont-caret-right"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="row d-none" id="subPro2">
						<div class="card w-100">
							<div class="card-body">
								<h4 class='pb-3'>¿Qué proceso deseas hacer?</h4>
								<div class="list-group col-6">
									<button type="button" class="list-group-item list-group-item-action active" ><i class="icofont-dotted-right"></i> Quiero empezar un nuevo curso</button>
									<button type="button" class="list-group-item list-group-item-action"><i class="icofont-dotted-right"></i> Continuar con mis estudios de Inglés</button>
									<button type="button" class="list-group-item list-group-item-action"><i class="icofont-dotted-right"></i> Continuar con mis estudios de Italiano</button>
								</div>
							</div>
							<div class="card-footer">
								<div class="row d-flex justify-content-between px-4">
									<button class="btn btn-outline-secondary border-0 btnAtras" data-tag='2'><i class="icofont-caret-left"></i> Atrás </button>
									<button class="btn btn-outline-secondary border-0 btnSiguiente" data-tag='2'>Siguiente <i class="icofont-caret-right"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="row d-none" id="subPro3">
					<div class="card w-100">
						<div class="card-body">
							<h4 class='pb-3'>Tenemos los siguientes horarios disponibles:</h4>
							<div class="list-group col-6">
								<button type="button" class="list-group-item list-group-item-action active" ><i class="icofont-dotted-right"></i> 9:00 - 10:30 a.m.</button>
								<button type="button" class="list-group-item list-group-item-action " ><i class="icofont-dotted-right"></i> 11:00 - 12:30 p.m.</button>
								<button type="button" class="list-group-item list-group-item-action " ><i class="icofont-dotted-right"></i> 3:00 - 4:30 p.m.</button>
							</div>
						</div>
						<div class="card-footer">
							<div class="row d-flex justify-content-between px-4">
								<button class="btn btn-outline-secondary border-0 btnAtras" data-tag='3'><i class="icofont-caret-left"></i> Atrás </button>
								<button class="btn btn-outline-secondary border-0 btnSiguiente" data-tag='3'>Siguiente <i class="icofont-caret-right"></i></button>
							</div>
						</div>
					</div>
					</div>
					<div class="row d-none" id="subPro4">
					<div class="card w-100">
						<div class="card-body">
							<h4 class='pb-3'>Resumen</h4>
							<p>Consolidamos que:</p>
							<p><strong>Alumno: </strong> <span>Carlos Pariona Valencia</span> </p>
							<p><strong>Curso: </strong> <span>Inglés</span> </p>
							<p><strong>Turno: </strong> <span>11:00 - 12:30 p.m.</span> </p>
						<div class="card-footer">
							<div class="row d-flex justify-content-between px-4">
								<button class="btn btn-outline-secondary border-0 btnAtras" data-tag='4'><i class="icofont-caret-left"></i> Atrás </button>
								<button class="btn btn-outline-secondary border-0 btnSiguiente" data-tag='4'>Siguiente <i class="icofont-caret-right"></i></button>
							</div>
						</div>
					</div>
					</div>
                        
            
                    
				</div> <!--Fin de SubProcesos-->
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
        
	<div class='d-none' id="overlay">
		<div class="text"><span id="hojita"><i class="icofont icofont-leaf"></i></span> <p id="pFrase"> Solicitando los datos... <br> <span>«Pregúntate si lo que estás haciendo hoy <br> te acerca al lugar en el que quieres estar mañana» <br> Walt Disney</span></p>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$('#txtBuscarInfo').click(function () {
	if($('#txtDNI').val()!=''){
		pantallaOver(true);
		$.ajax({url: "php/listarNotas.php", type: 'POST', data:{dni: $('#txtDNI').val() }}).done(function (resp) {
			//console.log(resp);
			$('#divResultados').children().remove();
			$('#divResultados').append(resp);
			pantallaOver(false);
		});
	}
});
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
function pantallaOver(tipo) {
	if(tipo){$('#overlay').css('display', 'initial');}
	else{ $('#overlay').css('display', 'none'); }
}
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
$('.btnSiguiente').click(function() { console.log('sig')
	var proceso = parseInt($(this).attr('data-tag'));
	$.each( $('.progressbar li') , function(i, objeto){
		if(i<=proceso){
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

	const element =  document.querySelector(`#subPro${proceso}`)
	element.classList.add('animated', 'bounceOutLeft')/* .remove('bounceOutRight') */
	//console.log(proceso)
	$(`#subPro${proceso+1}`).addClass('animated bounceInRight').removeClass('d-none');
	ocultarCard($(`#subPro${proceso}`));
});
function ocultarCard(elemento){
	$(elemento).addClass('d-none').removeClass('animated bounceInRight bounceInLeft bounceOutLeft bounceOutRight');
}

$('.btnAtras').click(function() { console.log('atras')
	var proceso = parseInt($(this).attr('data-tag'));
	$.each( $('.progressbar li') , function(i, objeto){
		if(i<=proceso){
			$(this).addClass('active')
		}else{
			$(this).removeClass('active');
		}
	});
	//console.log(proceso)

	const element =  document.querySelector(`#subPro${proceso}`)
	element.classList.add('animated', 'bounceOutRight')
	$(`#subPro${proceso-1}`).addClass('animated bounceInLeft').removeClass('d-none');
	ocultarCard($(`#subPro${proceso}`));
	
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

</script>
</body>
</html>