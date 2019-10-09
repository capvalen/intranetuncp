<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'php/header.php';
	include "php/conexionInfocat.php";
	$dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
	?>
</head>
<body>

<style>
/* .selectpicker{
	display: block;
	width: 100%;
	height: calc(1.5em + .75rem + 2px);
	padding: .375rem .75rem;
	font-size: 1rem;
	font-weight: 400;
	line-height: 1.5;
	color: #495057;
	background-color: #fff;
	background-clip: padding-box;
	border: 1px solid #ced4da;
	border-radius: .25rem;
	transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
} */
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->

		
	<h2 class="d-print-none"><i class="icofont-settings-alt"></i> Mes académico</h2>
<?php if( !isset($_GET['nuevo']) && !isset($_GET['edit']) ): ?>
	<div class="card mb-3 col-6 d-print-none">
		<div class="card-body">
			<h6 class="card-subtitle mb-2 text-muted">Año académico:</h6>
			<div class="row">
					<div class="col">
						<select name="" id="sltPAnios" class="selectpicker" data-width="100%" data-live-search="true">
							<?php include 'php/OPT_aniosacademicos.php'; ?>
						</select>
					</div>
					<div class="col-5 d-flex justify-content-end">
						<a class="btn btn-outline-primary" href="mesacademico.php?nuevo"><i class="icofont-bulb-alt"></i> Crear nuevo mes</a>
					</div>
			</div>

		</div>
	</div>
<?php endif; ?>


	<?php if(!isset($_GET['year']) && !isset($_GET['nuevo']) && !isset($_GET['edit']) ): ?>
	<p>Seleccionar un año para visualizar</p>

	<?php elseif( isset($_GET['year']) && !isset($_GET['nuevo'])):
		$sqlMeses = "SELECT `Mes_Codigo`, `Mes_Inicio`, `Mes_Fin`, trim(`Mes_Detalle`) as Mes_Detalle, `Mes_MidExam`, `Mes_FinalExam`, `Mes_tiempoadicional` FROM `mesacademico` where year(Mes_Inicio)='{$_GET['year']}'; ";
		$resultadoMeses=$cadena->query($sqlMeses);
		 ?>
		 
		 
	<div class="container">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Periodo</th>
					<th>Mes</th>
					<th>Inicio</th>
					<th>Examen Medio Ciclo</th>
					<th>Fin</th>
					<th>@</th>
				</tr>
			</thead>
			<tbody>
				<?php while($rowMeses=$resultadoMeses->fetch_assoc()){ ?>
				<tr>
					<td><?php echo substr($rowMeses['Mes_Codigo'], 0, 2).'-'.substr($rowMeses['Mes_Codigo'], 2, 4); ?></td>
					<td><?php echo $rowMeses['Mes_Detalle']; ?></td>
					<td><?php $fechaI = new DateTime($rowMeses['Mes_Inicio']); echo $dias[$fechaI->format('w')].', '.$fechaI->format('d/m/Y'); ?></td>
					<td><?php $fechaM = new DateTime($rowMeses['Mes_MidExam']); echo $dias[$fechaM->format('w')].', '.$fechaM->format('d/m/Y'); ?></td>
					<td><?php $fechaF = new DateTime($rowMeses['Mes_Fin']); echo $dias[$fechaF->format('w')].', '.$fechaF->format('d/m/Y'); ?></td>
					<td><a class="btn btn-sm btn-outline-primary" href="mesacademico.php?edit=<?=$rowMeses['Mes_Codigo']; ?>" ><i class="icofont-edit"></i></a></td>
				</tr>
				<?php }
			?>
			</tbody>
		</table>
	</div>
	<?php elseif( !isset($_GET['year']) && isset($_GET['nuevo']) || isset($_GET['edit']) ): ?>
		<div class="container">
			<div class="card col-6">
				<div class="card-body">
					<p>Rellene los campos</p>
					<div class=" ">
						<label for="">Fecha de inicio del ciclo</label>
						<select class="selectpicker" id="sltMesesLetras" data-width="100%" data-live-search="true">
							<?php $sqlMeses = "SELECT * FROM `mes`;";
							$resultadoMeses = $esclavo->query($sqlMeses);
							while($rowMeses = $resultadoMeses->fetch_assoc()){?>
							<option value="<?= $rowMeses['DetMes']; ?>"><?= $rowMeses['DetMes']; ?></option>
							<?php } ?>
						</select>
						<label for="">Fecha de inicio del ciclo</label>
						<input type="text" class="form-control" id="txtFechaIni">
						<label for="">Fecha de examen de medio ciclo</label>
						<input type="text" class="form-control" id="txtFechaMid">
						<label for="">Fecha de fin del ciclo</label>
						<input type="text" class="form-control" id="txtFechaFin">
					</div>
					<?php if(isset($_GET['nuevo'])){ ?>
					<button class="btn btn-outline-success btn-block mt-3" id="btnGuardarCiclo"><i class="icofont-save"></i> Guardar</button>
					<?php } ?>
					<?php if(isset($_GET['edit'])){
						$sqlEdit = "SELECT `Mes_Codigo`, `Mes_Inicio`, `Mes_Fin`, trim(`Mes_Detalle`) as Mes_Detalle, `Mes_MidExam`, `Mes_FinalExam`, `Mes_tiempoadicional` FROM `mesacademico` where Mes_Codigo='{$_GET['edit']}'; ";
						$resultadoEdit=$cadena->query($sqlEdit);
						$rowEdit = $resultadoEdit->fetch_assoc();
					 ?>
						<button class="btn btn-outline-success btn-block mt-3" id="btnActualizarCiclo"><i class="icofont-refresh"></i> Actualizar</button>
					<?php } ?>
				</div>
			</div>
		</div>
	
	<?php endif; ?>
	

<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
</div>

<?php include "php/footer.php"; ?>

<script>
$('.selectpicker').selectpicker();
<?php if(!isset($_GET['year']) ): ?>
$('#sltPAnios').selectpicker('val',-1);
<?php elseif( isset($_GET['year']) ): ?>
$('#sltPAnios').selectpicker('val',<?= $_GET['year']?>).selectpicker('refresh');
<?php endif; 
if(isset($_GET['nuevo'])): ?>
$('#sltMesesLetras').selectpicker('val',-1);
<?php endif; ?>
$('#sltPAnios').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	if( $('#sltPAnios').selectpicker('val')!= null ){
		location.href = "mesacademico.php?year="+$('#sltPAnios').selectpicker('val');
	}
});
$('#txtFechaIni').bootstrapMaterialDatePicker({format:'DD/MM/YYYY', time: false, lang:'es', switchOnClick:true, okText:'Aceptar', nowText:'Hoy'});
$('#txtFechaFin').bootstrapMaterialDatePicker({format:'DD/MM/YYYY', time: false, lang:'es', switchOnClick:true, okText:'Aceptar', nowText:'Hoy'});
$('#txtFechaMid').bootstrapMaterialDatePicker({format:'DD/MM/YYYY', time: false, lang:'es', switchOnClick:true, okText:'Aceptar', nowText:'Hoy'});

<?php if(isset($_GET['edit'])){ ?>
$('#sltMesesLetras').selectpicker('val', '<?= $rowEdit['Mes_Detalle'];?>')
$('#txtFechaIni').bootstrapMaterialDatePicker('setDate', moment('<?= $rowEdit['Mes_Inicio'];?>'));
$('#txtFechaFin').bootstrapMaterialDatePicker('setDate', moment('<?= $rowEdit['Mes_Fin'];?>'));
$('#txtFechaMid').bootstrapMaterialDatePicker('setDate', moment('<?= $rowEdit['Mes_MidExam'];?>'));
$('#btnActualizarCiclo').click(function () {
	var ciclo = '<?= $_GET['edit']; ?>';
	if( $('#sltMesesLetras').selectpicker('val') == null || $('#txtFechaIni').val()=='' || $('#txtFechaFin').val()=='' || $('#txtFechaMid').val()=='' ){
		$('#toastAdverTitle').text('Advertencia'); $('#toastError').text("Todas los campos deben estar rellenados"); $('#tostadaError').toast('show');
	}else{
		$.ajax({url:'php/updateCiclo.php', type: 'POST', data:{idCiclo: ciclo, fechaIni: moment($('#txtFechaIni').val(), 'DD/MM/YYYY').format('YYYY-MM-DD'), fechaFin: moment($('#txtFechaFin').val(), 'DD/MM/YYYY').format('YYYY-MM-DD'), detalle: $('#sltMesesLetras').selectpicker('val'), fechaMid: moment($('#txtFechaMid').val(), 'DD/MM/YYYY').format('YYYY-MM-DD') }}).done(function (resp) { console.log( resp);
			if(resp=='Ya existe'){
				//console.log( "ya esxiste");
				$('#toastAdverTitle').text('Advertencia'); $('#toastError').text("El mes académico ya se encuentra registrado"); $('#tostadaError').toast('show');
			}else if( $.isNumeric(parseFloat(resp)) ){
				if(parseFloat(resp)>2000){
					window.location.href="mesacademico.php?year="+resp;
				}else{
					$('#toastAdverTitle').text('Advertencia'); $('#toastError').text("Error al intentar guardar, comuníquese con el área de informática"); $('#tostadaError').toast('show');
					//console.log('no es fecha')
				}
			}
		});
	}
})

<?php } ?>
$('#btnGuardarCiclo').click(function () {
	var ciclo = moment($('#txtFechaIni').val(), 'DD/MM/YYYY').format('MMYYYY');
	if( $('#sltMesesLetras').selectpicker('val') == null || $('#txtFechaIni').val()=='' || $('#txtFechaFin').val()=='' || $('#txtFechaMid').val()=='' ){
		$('#toastAdverTitle').text('Advertencia'); $('#toastError').text("Todas los campos deben estar rellenados"); $('#tostadaError').toast('show');
	}else{
		$.ajax({url:'php/crearCiclo.php', type: 'POST', data:{idCiclo: ciclo, fechaIni: moment($('#txtFechaIni').val(), 'DD/MM/YYYY').format('YYYY-MM-DD'), fechaFin: moment($('#txtFechaFin').val(), 'DD/MM/YYYY').format('YYYY-MM-DD'), detalle: $('#sltMesesLetras').selectpicker('val'), fechaMid: moment($('#txtFechaMid').val(), 'DD/MM/YYYY').format('YYYY-MM-DD') }}).done(function (resp) { console.log( resp);
			if(resp=='Ya existe'){
				//console.log( "ya esxiste");
				$('#toastAdverTitle').text('Advertencia'); $('#toastError').text("El mes académico ya se encuentra registrado"); $('#tostadaError').toast('show');
			}else if( $.isNumeric(parseFloat(resp)) ){
				if(parseFloat(resp)>2000){
					window.location.href="mesacademico.php?year="+resp;
				}else{
					$('#toastAdverTitle').text('Advertencia'); $('#toastError').text("Error al intentar guardar, comuníquese con el área de informática"); $('#tostadaError').toast('show');
					//console.log('no es fecha')
				}
			}
		});
	}
})
</script>
</body>
</html>