<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CEID UNCP - Visualizador de record académico</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/icofont.min.css">
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
    <h1 class="display-3 text-center" style="color: #097bd4;">Record de notas CEID-UNCP</h1>
    <h4>¿Qué deseas hacer?</h4>
    <div class="row">
      <div class="col">
        <h5 class="lead">Generar pre matrícula</h5>
      </div>
      <div class="col">
        <h5 class="lead">Ver notas</h5>
      </div>
    </div>
    <p class="lead">Bienvenido alumno de CEID, por favor rellene su DNI para poner visualizar sus record de notas: </p>
    <label class="lead text-muted" id="labelDNI" for="">Mi D.N.I. es:</label>
    <div class="row">
    <div class="col-md-4 col-sm-12 d-flex justify-content-center">
      <input type="text" class="text-center form-control" id="txtDNI" autocomplete="off">
    </div>
      <button class="btn btn-outline-primary" id="txtBuscarInfo"><i class="icofont-search-1"></i> Consultar</button>
    </div>

    <div id="divResultados">
    
    </div>

    
  </div>
  <div id="overlay">
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
$('#txtDNI').keyup(function (e) {
	if (e.which ==13){ $('#txtBuscarInfo').click(); }
})
function pantallaOver(tipo) {
	if(tipo){$('#overlay').css('display', 'initial');}
	else{ $('#overlay').css('display', 'none'); }
}
</script>
</body>
</html>