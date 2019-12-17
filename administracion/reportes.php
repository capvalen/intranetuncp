<?php 
include "php/variablesGenerales.php";
if (!isset($_COOKIE['ckPower'])){ header('Location: index.php'); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'php/header.php';
	include "php/conexionInfocat.php";
	?>
</head>
<body>

<style>
.bootstrap-select .dropdown-toggle{
	text-transform: capitalize;
}
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->

		
	<h2 class="d-print-none"><i class="icofont-paper"></i> Reportes</h2>
	
	<div class="card col-7 py-2">
		<p class="card-text m-0"><small class="text-muted"><i class="icofont-filter"></i> Filtro</small></p>
			<div class="row row-cols-5">
				<div class="col">	
				
				<div class="form-inline">
					<label class="mr-3" for=""><small>Tipo de reporte:</small></label>
					<select class="selectpicker" id="sltPTipoReporte" data-live-search="true" data-width="100%">
						<option value="1">Alumnos por facultad</option>
						<option value="2">Alumnos por edad</option>
						<option value="4">Alumnos por procedencia</option>
						<option value="3">Alumnos por género</option>
					</select>
				</div>
				</div>
				<div class="col">	
					<div class="form-inline">
						<label for=""><small>Sucursal</small></label>
						<select class="selectpicker" id="sltPSede" data-live-search="true" data-width="100%">
							<?php include "php/OPT_sedes.php"; ?>
						</select>
					</div>
				</div>
				<div class="col">	
					<div class="form-inline">
						<label for=""><small>Año</small></label>
						<select class="selectpicker" id="sltPAnio" data-live-search="true" data-width="100%">
							<?php include "php/OPT_aniosacademicos.php"; ?>
						</select>
					</div>
				</div>
				<div class="col">	
					<div class="form-inline">
						<label for=""><small>Mes</small></label>
						<select class="selectpicker" id="sltPMeses" data-live-search="true" data-width="100%">
							<?php include "php/OPT_mesesTodos.php"; ?>
						</select>
					</div>
				</div>
				<div class="col d-flex align-items-end">	
					<button class="btn btn-outline-secondary" id="btnBuscarReporte"><i class="icofont-search-1"></i></button>
				</div>
			</div>
			
		</div>

		<div class="card col-6 mt-2">
		<div class="card-body" id="cardResultados">
			<p class="text-muted">Esperando que haga una consulta</p>
		</div>
	</div>
	
	</div>

	
<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
</div>

<?php include "php/footer.php"; ?>

<script>
$('.selectpicker').selectpicker('val', -1);
$('#btnBuscarReporte').click(function() {
	$.ajax({url: 'php/reportesPersonalizados.php', type: 'POST', data: { 
		tipoReporte: $('#sltPTipoReporte').val(),
		periodo: ('0' + $('#sltPMeses').val()).slice(-2) +$('#sltPAnio').val(),
		sucursal: $('#sltPSede').val()
	}}).done(function(resp) {
		//console.log(resp)
		$('#cardResultados').html(resp);
		estadistica();
});
function estadistica(){
	var total = parseFloat($('#totalAlumnos').text());
	$.each( $('.porcentaje') , function(i, objeto){
		cant = parseFloat($(this).prev().find('.cantAlumno').text());
		$(this).text( parseFloat(parseFloat(cant/total*100).toFixed(1)).toFixed(2) + "%");
	});
}
	/*
	SELECT s.*, a.Alu_Codigo, f.Fac_Detalle FROM `seccion` s
inner join registroalumno ra on ra.Sec_Codigo = s.Sec_Codigo
inner join alumno a on a.Alu_Codigo = ra.Alu_Codigo
inner join facultad f on f.Fac_Codigo = a.fac_Codigo
where Mes_Codigo = '012019' and Suc_Codigo="SUC001" 
and Sec_NroCiclo<>0
*/	
});
</script>
</body>
</html>