<?php 
session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Perucash - Sistema para control de préstamos y empeños</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="css/icofont.min.css">


<style>
/* body{ background-color: #8627b9;} */
#delivery{color:#d40000}
.display-5{font-size: 2rem;font-weight: 300;line-height: 1.2;}
.display-6{font-size: 1.5rem;font-weight: 300;line-height: 1.2;}
</style>
</head>

<body class="mb-5 pb-5">
<div class="container  text-center mb-5 pb-5" >
	<img  class="img-responsive" src="images/noAccess.png?ver=1.0.2" alt="">
	<img  class=" py-5" src="images/uncp-logo.png?version=1.1" alt="">
		<h2 class="display-5 text-muted pb-3">Hola.</h2>
		<h2 class="display-6 text-muted pb-3">La sección que intentas ver no está autorizada para tu nivel de usuario.<br> ¿Qué debes hacer ahora?<br>- Debes comunicarte con la administración o con soporte para que eleven tu cuenta.</h2>
   
	<a class="btn btn-dark" href="php/desconectar.php"><i class="icofont-dotted-right"></i> Ir a la página principal</a>
	
	

</div>
	
</body>
</html>