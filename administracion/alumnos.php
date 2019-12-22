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
h5{
	padding-top:5px;
}
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->

		
	<h2 class="d-print-none"><i class="icofont-people"></i> Alumnado</h2>
	<div class="card col-6">
		<div class="card-body pt-1">
		<p class="card-text m-0"><small class="text-muted"><i class="icofont-filter"></i> Filtro</small></p>
			<div class="form-inline">
				<label class="mr-3" for=""><small>Nombre/D.N.I Alumno:</small></label>
				<input type="text" class="form-control mr-3" id="txtAlumnoDni">
				<button class="btn btn-outline-primary" id="btnBuscarDniAlumno"><i class="icofont-search-1"></i> Buscar</button>
				<button class="btn btn-outline-success ml-3" id="btnCrearAlumno"><i class="icofont-bulb-alt"></i> Crear alumno</button>
			</div>
		</div>
	</div>

	
	<div class="container mt-2 d-none">
		<p><strong class="">Resultados:</strong></p>
		<table class="table table-hover" id="tblResultadoEncontrados">
			<thead>
				<tr>
					<th>N°</th>
					<th>Nombres y Apellidos</th>
					<th>D.N.I.</th>
					<th>@</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<?php if (isset($_GET['cursor'])){ ?>
		
		<div class="card mt-3">
			<div class="card-body container-fluid">
				
				<?php 
				$sql="SELECT `Alu_Codigo`, lower(`Alu_Nombre`) as Alu_Nombre, lower(`Alu_Apellido`) as Alu_Apellido, `Alu_Sexo`, `Alu_CentroLaboralEstudio`, `Alu_FacultadArea`, ifnull(`Alu_Direccion`, '-') as Alu_Direccion, ifnull(`Alu_Telefono`, '-') as Alu_Telefono, `Alu_Estado`, `Alu_NroDocumento`, IFNULL(date_format(`Alu_FechaNacimiento`, '%d/%m/%Y'), '01/01/1950') as Alu_FechaNacimiento, ifnull(date_format(Alu_FechaNacimiento, '%Y-%m-%d'), '1950-01-01') as FNacimiento, ifnull(`Alu_Email`, '-') as Alu_Email, `Alu_cuenta`, f.Fac_Detalle, procDescripcion, a.idProcedencia, a.fac_Codigo, aluCertificado FROM `alumno` a
				inner join facultad f on a.fac_Codigo = f.Fac_Codigo
				inner join procedencia pro on pro.idProcedencia = a.idProcedencia
				where Alu_Codigo = '{$_GET['cursor']}' ;";
//				echo $sql;
				$i=1;
				$resultado=$cadena->query($sql);
				$row = $resultado -> fetch_assoc(); 

				$_GET['idProc'] = $row['idProcedencia'];
				$_GET['idFac'] = $row['fac_Codigo'];
				?>
				<div class="cabecera d-flex justify-content-center">
				<center>
					<?php 
					if($row['Alu_Sexo']==1){ ?>
					<img src="images/58Varon.jpg" alt="" class="img-fluid d-block" width="200px">
					<?php }else{ ?>
					<img src="images/59Dama.jpg" alt="" class="img-fluid d-block" width="200px">
					<?php }
					?>
					
					<h3 class="text-muted d-block">Perfil del alumno CEID <button class="btn btn-outline-primary btn-sm border-0" id="btnHabilitar" onclick="habilitarEdicion()"><i class="icofont-ui-edit"></i></button>
					<button class="btn btn-outline-success btn-sm border-0 d-none" id="btnActualizar" onclick="guardarEdicion()"><i class="icofont-check"></i></button>
					<button class="btn btn-outline-danger btn-sm border-0 d-none" id="btnCancelar" onclick="cancelarEdicion()"><i class="icofont-close"></i></button>
					</h3>
					</center>
				</div>

				<div class="row row-cols-3" id="divDatosAlumno">
					<div class="col text-center">
						<h5>Apellidos</h5>
							<span class="text-capitalize"><?= $row['Alu_Apellido']; ?></span>
							<input class="form-control text-capitalize d-none" type="text" id="txtApellido" name="" autocomplete="nope" value="<?= $row['Alu_Apellido'];?>">
						<h5>Nombres</h5>
							<span class="text-capitalize"><?= $row['Alu_Nombre']; ?></span>
							<input class="form-control text-capitalize d-none" type="text" id="txtNombre" name="" autocomplete="nope" value="<?= $row['Alu_Nombre'];?>">
						<h5>D.N.I</h5>
							<span><?= $row['Alu_NroDocumento']; ?></span>
							<input class="form-control d-none" type="text" id="txtDni" name="" autocomplete="nope" value="<?= $row['Alu_NroDocumento'];?>">
						<h5>Fecha de nacimiento</h5>
							<span><?php $hoy=new DateTime(); $fNac= new DateTime($row['FNacimiento']); echo $row['Alu_FechaNacimiento']. " (" . intval($hoy->format('Y') - $fNac->format('Y') )  ." años)"; ?></span>
							<input class="form-control d-none" type="date" id="txtFechaNacimiento" name="" autocomplete="nope" value="<?= $row['FNacimiento'];?>">
						<h5>Sexo</h5>
							<span><?php if($row['Alu_Sexo']=='1'){echo "Masculino";}else{echo 'Femenino';} ?></span>
							<div class="form-group selects d-none">
								<select id="sltSexo" class="form-control" name="">
									<option value="1" <?php if($row['Alu_Sexo']=='1'){ ?> selected="selected" <?php } ?>>Masculino</option>
									<option value="0" <?php if($row['Alu_Sexo']!='1'){ ?> selected="selected" <?php } ?>>Femenino</option>
								</select>
							</div>
					</div>
					<div class="col text-center">
						<h5>Procedencia</h5>
							<span><?= $row['procDescripcion']; ?></span>
							<div class="form-group selects d-none">
								<select id="sltProcedencia" class="form-control" name="" >
								<?php include 'php/OPT_procedencias.php'; ?>
								</select>
							</div>
						<h5>Facultad</h5>
							<span><?= $row['Fac_Detalle']; ?></span>
							<div class="form-group selects d-none">
								<select id="sltFacultades" class="form-control" name="">
									<?php include 'php/OPT_facultadesMax.php'; ?>
								</select>
							</div>
					</div>
					<div class="col text-center">
						<h5>Dirección</h5>
							<span class="text-capitalize"><?= $row['Alu_Direccion']; ?></span>
							<input class="form-control d-none text-capitalize" type="text" id="txtDireccion" name="" autocomplete="nope" value="<?= $row['Alu_Direccion'];?>">
						<h5>Celular</h5>
							<span><?= $row['Alu_Telefono']; ?></span>
							<input class="form-control d-none" type="text" id="txtCelular" name="" autocomplete="nope" value="<?= $row['Alu_Telefono'];?>">
						<h5>Correo electrónico</h5>
							<span><?= $row['Alu_Email']; ?></span>
							<input class="form-control d-none" type="text" id="txtCorreo" name="" autocomplete="nope" value="<?= $row['Alu_Email'];?>">
					</div>
				</div>
			</div>
		</div>
		<?php $dominio =  preg_replace('/^www\./','',$_SERVER['HTTP_HOST']);
		if($dominio=='infocatsoluciones.com'){ ?>
		
		<div class="card mt-3">
			<div class="card-body">
				<h5 class="card-title"><i class="icofont-certificate"></i> Certificado del estudiante</h5>
				<?php if($row['aluCertificado']==''){ ?>
				<p class="card-text">Adjunte el certificado final del estudiante:</p>
				
				<form id="formUploadImage" action="php/uploadCertificado.php" method="post">
					<input class="d-none" name="idAlumno" type="text" value="<?= $_GET['cursor']; ?>">

				<div class="input-group col-6">
					<div class="custom-file">
						<input type="file" class="custom-file-input" accept="application/pdf" id="txtSubirPDF" name='txtSubirPDF' aria-describedby="inputGroupFileAddon04">
						<label class="custom-file-label" for="inputGroupFile04">Choose file</label>
					</div>
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Subir archivo</button>
					</div>
				</div>
				</form>

				<?php }else{ ?>
				<embed src="<?= "certificados/".$row['aluCertificado']; ?>" width="90%" height="600"   type="application/pdf">
				<?php } ?>

			</div>
		
		</div>

		<?php } ?>
		
	<?php } ?>
	
	
<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
</div>

<!-- Modal para craer alumno  -->
<div class="modal fade" id="modalCrearAlumno" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<p>Ingrese el D.N.I. que se desea crear:</p>
				<input type="text" class="form-control" id="txtCrearDni">
				<div class="alert alert-warning d-none mt-3" role="alert" id="alertaDNIUsado">
					<p><strong class="alert-heading">El Dni ya se encuentra registrado, por:</strong></p>
					<div id="divUsadosDNI"></div>
				</div>
				<button class="btn btn-outline-warning mt-3" id="btnBuscarDni"> <i class="icofont-search-1"></i> Verificar si es nuevo</button>
				<div class="d-none" id="datosEncontrados">
					<label for="">Apellidos</label>
					<input type="text" class="form-control text-capitalize" id="txtCrearApellidos">
					<label for="">Nombres</label>
					<input type="text" class="form-control text-capitalize" id="txtCrearNombres">
					<label for="">Género:</label>
					<select class="selectpicker" id="SltPSexo" data-search='false' data-width='100%'>
						<option value="0">Femenino</option>
						<option value="1">Masculino</option>
					</select>
					<label for="">Fecha de nacimiento:</label>
					<input type="date" class="form-control" id="txtCrearFecha" value="<?= date('Y-m-d'); ?>">
					<label for="">Facultad:</label>
					<select class="selectpicker" id="SltPFacultad" data-search='true' data-width='100%'>
						<?php include 'php/OPT_facultadesMax.php'; ?>
					</select>
					<label for="">Procedencia:</label>
					<select class="selectpicker" id="SltPProcedencia" data-search='true' data-width='100%'>
						<?php include 'php/OPT_procedencias.php'; ?>
					</select>
					
					<button class="btn btn-outline-primary mt-3" id="btnSaveAlumno"><i class="icofont-save"></i> Guardar Alumno</button>
				</div>
			
      </div>
      
    </div>
  </div>
</div>

<?php include "php/footer.php"; ?>
<?php if($dominio=='infocatsoluciones.com'){ ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script> <!-- extraido de https://jquery-form.github.io/form/ -->
<?php } ?>

<script>
$('#btnBuscarDniAlumno').click(()=> {
	$('#tblResultadoEncontrados').parent().removeClass('d-none');
	if( $('#txtAlumnoDni').val()!=''){
		$.ajax({url: 'php/buscarAlumnosDNIApellido.php', type: 'POST', data: { texto: $('#txtAlumnoDni').val() }}).done(function(resp) {
			//console.log(resp);
			$('#tblResultadoEncontrados tbody').html(resp);
		});
	}
});
$('#txtAlumnoDni').keypress(function (e) { 
	if(e.keyCode == 13){ 
		$('#btnBuscarDniAlumno').click();
	}
});
function habilitarEdicion(){
	$('#btnHabilitar').addClass('d-none');
	$('#btnActualizar').removeClass('d-none');
	$('#btnCancelar').removeClass('d-none');
	$('#divDatosAlumno span').addClass('d-none');
	$('#divDatosAlumno input').removeClass('d-none');
	$('#divDatosAlumno .selects').removeClass('d-none');
}
function cancelarEdicion(){
	$('#btnHabilitar').removeClass('d-none');
	$('#btnActualizar').addClass('d-none');
	$('#btnCancelar').addClass('d-none');
	$('#divDatosAlumno span').removeClass('d-none');
	$('#divDatosAlumno input').addClass('d-none');
	$('#divDatosAlumno .selects').addClass('d-none');

}
$('#btnCrearAlumno').click(function () {
	$('#alertaDNIUsado').addClass('d-none');
	$('#modalCrearAlumno').modal('show');
});
$('#btnSaveAlumno').click(function () {
	pantallaOver(true);
	$.ajax({url: 'php/insertarAlumnoNuevo.php', type: 'POST', data: {
		dni: $('#txtCrearDni').val(), nombre: $('#txtCrearNombres').val(), apellido: $('#txtCrearApellidos').val(), sexo: $('#SltPSexo').val(), facultad: $('#SltPFacultad').val(), fechanac: $('#txtCrearFecha').val(), procedencia: $('#SltPProcedencia').val()
	}}).done(function (resp) {
		console.log(resp)
		pantallaOver(false);
		if(resp=='todo ok'){
			window.location='matricula.php?cursor='+$('#txtCrearDni').val();
		}else{
			$('#h1Advertencia').text('Ocurrió un error al intentar insertar al alumno, comuníquelo al área de soporte');
			$('#modalAdvertencia').modal('show');
		}
	})
});
$('#txtCrearDni').keyup(function (e) {
	e.preventDefault();
	if($('#txtCrearDni').val().length==8){if (e.which ==13){ $('#btnBuscarDni').click(); }}else if($('#txtCrearDni').val().length<8){
		$('#btnBuscarDni').removeClass('d-none');
		$('#datosEncontrados').addClass('d-none');
	}
})
$('#btnBuscarDni').click(function () {
	pantallaOver(true);
	$.ajax({url: 'php/apiReniec.php', type: 'POST', data: {dni: $('#txtCrearDni').val() }}).done(function (resp) {
		var data = JSON.parse(resp);
		
		if(data[0].resp =='ya registrado'){
			var repetidos = '';
			for (let index = 1; index < data.length; index++) { 
				repetidos = repetidos + `<p><a class="text-capitalize" href="alumnos.php?cursor=${data[index].codigo}">${data[index].nombres}</a></p>`;
			}
			$('#divUsadosDNI').html(repetidos);
			//ya fue
			$('#alertaDNIUsado').removeClass('d-none');
			$('#datosEncontrados').addClass('d-none');
			pantallaOver(false);
		}else{
			//var datos = JSON.parse(resp);
			//console.log(datos)
			$('#alertaDNIUsado').addClass('d-none');
			$('#txtCrearApellidos').val(''); //$.trim(datos[0]+ ' '+ datos[1])
			$('#txtCrearNombres').val(''); //datos[2]
			$('#btnBuscarDni').addClass('d-none');
			$('#datosEncontrados').removeClass('d-none');
			$('#txtCrearApellidos').focus();

			pantallaOver(false);
		}
	})
});
<?php if(isset($_GET['cursor'])){ ?>
function guardarEdicion(){
pantallaOver(true);
$.ajax({url: 'php/updateDataAlumnoComplete.php', type: 'POST', data: {idAlu: '<?= $_GET['cursor']; ?>',
	nombre: $.trim($('#txtNombre').val()),
	apellidos: $.trim($('#txtApellido').val()),
	dni: $.trim($('#txtDni').val()),
	sexo: $('#sltSexo').val(),
	fNac: $('#txtFechaNacimiento').val(),
	procedencia: $('#sltProcedencia').val(),
	facultad: $('#sltFacultades').val(),
	direccion: $.trim($('#txtDireccion').val()),
	email: $.trim($('#txtCorreo').val()),
	celular: $.trim($('#txtCelular').val()),
 }}).done(function(resp) {
	console.log(resp)
	pantallaOver(false)
	if(resp == 'todo ok'){
		location.reload();
	}
});
}
<?php if($dominio=='infocatsoluciones.com'){ ?>
	$('input[type="file"]').change(function(e){
		var fileName = e.target.files[0].name;
		$('.custom-file-label').html(fileName);
	});
	$('#formUploadImage').submit(function () {
    event.preventDefault();
    var basicoRellenado = false;
    pantallaOver(true);
    
		if($('#txtSubirPDF').val() ){
				//console.log('algo para subir')
				$(this).ajaxSubmit({
						beforeSubmit: function () {
								$('#porcentajeSub').text("0%");
						},
						uploadProgress: function(event, position, total, percentageComplete){
								$('#porcentajeSub').text(percentageComplete + '%');
						},
						success:function( resp ){ console.log(resp)
								if(resp=='vacio'){
										$('#toastError').text("No se subieron las fotos por falta de fotos"); $('#tostadaError').toast('show');
								}
								if( $.isNumeric(resp)){
										//location.href = "ficha.php?cursor="+resp;
										location.reload();
										
								}
								pantallaOver(false);
						},
						//resetForm: true
				});
		}else{
				//console.log('nada para subir')
				alertify.error('Debe seleccionar un archivo PDF para subirlo'); 
				pantallaOver(false);
				return false;
		}
    
});
<?php } ?>

<?php } ?>

</script>
</body>
</html>