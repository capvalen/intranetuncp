<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CEID - UNCP - Instranet administrativa</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="css/icofont.min.css">
	<link rel="shortcut icon" href="images/VirtualCorto.png" type="image/png">
</head>
<body>
<style>
	body{
		background-color: #eee;
	}
	.card{border-radius: .45rem;}
</style>

<section class="p-5 m-5">
	<div class="container p-3 col-sm-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title text-primary">Intranet CEID - UNCP </h5>
				<label class="text-muted text-center" for=""><i class="icofont-ui-user"></i> Usuario</label>
				<input type="text" class="form-control" id="txtNegocioLog" value="">
				<label class="text-muted text-center mt-2" for=""><i class="icofont-key"></i> Contraseña</label>
				<input type="password" class="form-control" id="txtlocalLog" value="">
        <button class="btn btn-outline-primary mt-3 btn-block " id="btnAcceder"><i class="icofont-key-hole"></i> Acceder</button>
        <p class='pt-2'><small>Versión 1.0</small></p>
				<div id="divError"><span id="spanError2"></span></div>
			</div>
		</div> 
		
	</div>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
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
				window.location="docente.php";
			}else if(resp=='inhabilitado'){
				$('#spanError2').text('Tu usuario fue inhabilitado temporalmente. No inista y llame a soporte informático.');
				$('#divError').removeClass('hidden');
				$('#txtUser_app').select();
				$('.fa-spin').addClass('sr-only');$('.icofont-ui-lock').removeClass('sr-only');
				$('#txtPassw').val(''); $('#txtPassw').focus();
				console.log('error en los datos')
			}else {
				$('#spanError2').text('Error interno, comunicarse con soporte.');
				$('#divError').removeClass('hidden');
				//var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
				// $('#btnAcceder').addClass('animated wobble' ).one(animationEnd, function() {
				// 		$(this).removeClass('animated wobble');
				// });
				$('#txtUser_app').select();
				$('.fa-spin').addClass('sr-only');$('.icofont-ui-lock').removeClass('sr-only');
				//console.log(resp);
				$('#txtPassw').val(''); $('#txtPassw').focus();
				console.log('error en los datos')}
		}
	});
});
</script>


</body>
</html>