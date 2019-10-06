<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'php/header.php';
	include "php/conexionInfocat.php";
	?>
</head>
<body>

<style>

</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->

<?php 
$sqlEmp= "SELECT `Emp_Codigo`, Emp_NroDocumento, lower(`Emp_Nombre`) as Emp_Nombre, lower(`Emp_Apellido`) as Emp_Apellido, date_format(`Emp_FechaNacimiento`, '%d/%m/%Y') as Emp_FechaNacimiento, date_format(Emp_FechaNacimiento, '%Y-%m-%d') as Emp_FechaNacimientoDef, `Emp_Telefono`,  `Emp_email`  FROM `empleado` WHERE Emp_Codigo = '{$_COOKIE['ckidUsuario']}'; ";

$resultadoEmp = $cadena->query($sqlEmp);
$rowEmp = $resultadoEmp -> fetch_assoc();

?>
		
	<h2 class="d-print-none"><i class="icofont-people"></i> Mi perfil como docente</h2>

	<div class="row">
		<div class=" col-6 p-2">
			<div class="card card-body">
				<h5>Datos personales</h5>
				<p><strong>D.N.I.:</strong> <span><?= $rowEmp['Emp_NroDocumento'];?></span></p>
				<p><strong>Apellidos:</strong> <span class="text-capitalize"><?= $rowEmp['Emp_Apellido'];?></span></p>
				<p><strong>Nombres:</strong> <span class="text-capitalize"><?= $rowEmp['Emp_Nombre'];?></span></p>
				<p><strong>Fecha de nacimiento:</strong> <span><?= $rowEmp['Emp_FechaNacimiento'];?></span></p>
				<p><strong>Teléfono / Celular:</strong> <span><?= $rowEmp['Emp_Telefono'];?></span></p>
				<p><strong>Correo electrónico:</strong> <span><?= $rowEmp['Emp_email'];?></span></p>
			</div>
		</div>
		<div class=" col-6 p-2">
			<div class="card card-body">
				<h5>Actualización de datos</h5>
				<label for="">Fecha de nacimiento</label>
				<input type="date" class="form-control" id="txtFecha" value="<?= $rowEmp['Emp_FechaNacimientoDef'];?>">
				<label for="">Teléfono / Celular</label>
				<input type="text" class="form-control" id="txtCelular">
				<label for="">Correo electrónico</label>
				<input type="text" class="form-control" id="txtCorreo"> <br>
				<button class="btn btn-outline-warning" id="btnActualizarPerfil"><i class="icofont-refresh"></i> Actualizar Datos</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="card">
			<div class="card-body">
				<h5>Cambio de contraseña:</h5>
				<div class="form-inline">
					<label for="">Contraseña nueva:</label>
					<input type="password" class="form-control ml-2" id="txtPwd1">
					<label class="pl-2">Repita la contraseña nueva:</label>
					<input type="password" class="form-control ml-2" id="txtPwd2">
					<button class="btn btn-outline-warning ml-2" id="btnActualizarPwd"><i class="icofont-refresh"></i> Actualizar contraseña</button>
				</div>
			</div>
		</div>
	</div>
<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
</div>

<?php include "php/footer.php"; ?>

<script>
$('#btnActualizarPerfil').click(function () {
	var datos = [];
	var $queActualiza = '';
	if($('#txtFecha').val()!='' ){ datos.push({fecha: $('#txtFecha').val() }); $queActualiza+=' Fecha de nacimiento.'; }else{ datos.push({fecha: '' }); }
	if($('#txtCelular').val()!='' ){ datos.push({celular: $('#txtCelular').val() }); $queActualiza+=' Número telefónico.'; }else{ datos.push({celular: '' }); }
	if($('#txtCorreo').val()!='' ){ datos.push({correo: $('#txtCorreo').val() }); $queActualiza+=' Correo electrónico.'; }else{ datos.push({correo: '' });  }
	$.ajax({url: 'php/updatePerfil.php', type: 'POST', data:{datos: datos}}).done(function (resp) { console.log(resp)
		if(resp == 'todo ok'){
			mostrarInfo('Datos actualizados', `Acaba de actualizar correctamente los siguientes datos: ${$queActualiza}`);
		}
	})
});
$('#btnActualizarPwd').click(function () {
	if($('#txtPwd1').val()== $('#txtPwd2').val() && $('#txtPwd1').val() !=''){
		$.ajax({url: 'php/updatePwd.php', type: 'POST', data:{'pwd': $('#txtPwd2').val()}}).done(function (resp) { console.log(resp)
			if(resp == 'todo ok'){
				mostrarInfo('Datos actualizados', `Su contraseña se actualizó correctamente`);
			}
		})
	}else{
		mostrarError('Advertencia', 'Las contraseñas ingresadas no son iguales o no puede estar vacío.');
	}
})
</script>
</body>
</html>