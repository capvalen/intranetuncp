<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Administración - CEID UNCP - Intranet académica</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/icofont.min.css">
  <link rel="shortcut icon" href="images/favicon.png" >
<?php 
include "php/conexionInfocat.php";

?>
</head>
<body>
<style>
#labelDNI{font-size: 1rem;}
#txtDNI{font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
  font-size: 1.5rem;font-weight: 300;}
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
#cardMayor{
  border-radius: 1.25rem; box-shadow: 4px 2px 27px #a9a6a666;
}
#divPapa{position: relative;}
#spanFlotante{position: absolute; bottom: 8px; right: 8px; color: #646769;}
#spanFlotante:active{color: #2f2f2f;}
</style>
<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #fff;">
  <a href="#!" class="navbar-brand">
    <img src="https://alumno.ceiduncp.edu.pe/images/logoceid.png" width="auto" height="70px" alt="CEID centro de Idiomas UNCP">
  </a>
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="https://ceiduncp.edu.pe"><i class="icofont-rounded-left"></i> Volver al portal</a>
    </li>
  </ul>
</nav>
  <div class="container">
    <h1 class="display-4 text-center">Estudiar idiomas es conocer el mundo</h1>
    <p class="lead text-center">Ingresar al centro de Idiomas - UNCP:</p>
    <div class="card border-0 col-md-4 col-sm-12 mx-auto" id="cardMayor">
      <div class="card-body ">
        <h5 class="text-center">Login</h5>
        <div class="row d-flex justify-content-center mb-3">
          <label class="text-muted" for=""><i class="icofont-id"></i> <small>Usuario</small></label>
          <input type="text" class="text-center form-control" id="txtNegocioLog" autocomplete="off"> 
        </div>
        <div class="row d-flex justify-content-center mb-3" id="divPapa">
          <label class="text-muted" for=""><i class="icofont-finger-print"></i> <small>Contraseña</small></label>
          <input type="password" class="text-center form-control" id="txtlocalLog" autocomplete="off">
          <span id="spanFlotante"><i class="icofont-eye-alt"></i></span>
        </div>
        <div class="row d-flex justify-content-center mb-3">
        <button class="btn btn-primary" id="btnAcceder">INGRESAR</button>
    
        </div>
      </div>
    </div>


</div>
<div class="toast fixed-top ml-auto mr-3 mt-3" role="alert" id="tostadaInfo" data-delay="700" data-autohide="false">
  <div class="toast-header">
    <strong class="mr-auto text-primary" ><i class="icofont-warning-alt"></i> <span id="toastInfoTitle"></span></strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body" id="toastInfo"> </div>
</div>
<div class="toast fixed-top ml-auto mr-3 mt-3" role="alert" id="tostadaError" data-delay="700" data-autohide="false">
  <div class="toast-header">
   <strong class="mr-auto text-danger" ><i class="icofont-warning-alt"></i> <span id="toastAdverTitle"></span></strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body" id="toastError"></div>
</div>


  </div>
  <div id="overlay">
	  <div class="text"><span id="hojita"><i class="icofont icofont-leaf"></i></span> <p id="pFrase"> Solicitando los datos... <br> <span>«Pregúntate si lo que estás haciendo hoy <br> te acerca al lugar en el que quieres estar mañana» <br> Walt Disney</span></p>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>

<script>
$(document).ready(function () {
	$('#txtNegocioLog').focus();
});
$('#txtNegocioLog').keyup(function (e) {
	if (e.which ==13){ $('#btnAcceder').click(); }
})
$('#txtlocalLog').keyup(function (e) {
	if (e.which ==13){ $('#btnAcceder').click(); }
})
$('#btnAcceder').click(function() {
	$.ajax({
		type:'POST',
		url: 'php/validarSesion.php',
		data: {user: $('#txtNegocioLog').val(), pws: $('#txtlocalLog').val()},
		success: function(resp) { console.log( "respuesta " + resp);
			//if (parseInt(iduser)>0){//console.log('el id es '+data)
			if( resp=='concedido' ){
				console.log(resp)
				window.location="perfil.php";
			}else if(resp=='inhabilitado'){
				$('#spanError2').text('Tu usuario fue inhabilitado temporalmente. No inista y llame a soporte informático.');
				$('#divError').removeClass('hidden');
				$('#txtUser_app').select();
				$('.fa-spin').addClass('sr-only');$('.icofont-ui-lock').removeClass('sr-only');
				$('#txtPassw').val(''); $('#txtPassw').focus();
        $('#toastAdverTitle').text('Advertencia'); $('#toastError').text('No se puede dar acceso con las credenciales que estás comunicándonos, comunicarse con soporte.'); $('#tostadaError').toast('show');
				console.log('error en los datos')
			}else {
        
				$('#divError').removeClass('hidden');
				//var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
				// $('#btnAcceder').addClass('animated wobble' ).one(animationEnd, function() {
				// 		$(this).removeClass('animated wobble');
				// });
				$('#txtUser_app').select();
				$('.fa-spin').addClass('sr-only');$('.icofont-ui-lock').removeClass('sr-only');
				//console.log(resp);
        $('#txtPassw').val(''); $('#txtPassw').focus();
        $('#toastAdverTitle').text('Advertencia'); $('#toastError').text('No se puede dar acceso con las credenciales que estás comunicándonos, comunicarse con soporte.'); $('#tostadaError').toast('show');
				console.log('error en los datos')}
		}
	});
});
$('#spanFlotante').mousedown(function() {
  $('#txtlocalLog').get(0).type = 'text';
});
$('#spanFlotante').mouseup(function() {
  $('#txtlocalLog').get(0).type = 'password';
});
$('#spanFlotante').mouseleave(function() {
  $('#txtlocalLog').get(0).type = 'password';
});
</script>
</body>
</html>