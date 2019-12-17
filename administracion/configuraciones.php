<?php 
include "php/variablesGenerales.php";
if (!isset($_COOKIE['ckPower'])){ header('Location: index.php'); }

if( in_array($_COOKIE['ckPower'], $secretaria) || in_Array($_COOKIE['ckPower'], $subBasico) ){
	header('Location: sinPermiso.php'); }
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
.filter-option-inner-inner{ text-transform: capitalize!important;}
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->

		
	<h2 class="d-print-none"><i class="icofont-settings-alt"></i> Configuraciones</h2>

	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" href="#home" data-toggle="tab" ><i class="icofont-people"></i> Usuarios </a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#docentes" data-toggle="tab" ><i class="icofont-graduate"></i> Docentes</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#fechas" data-toggle="tab" ><i class="icofont-clock-time"></i> Fechas</a>
		</li>
		
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		<button class="btn btn-outline-primary mt-3"  id="btnAddUsuario"> <i class="icofont-ui-add"></i> Nuevo usuario</button>
			<p>Usuarios activos:</p>
			<table class="table table-hover">
				<thead class="">
					<tr>
						<th>#</th>
						<th>Nombre usuario</th>
						<th>Nick</th>
						<th>Acceso</th>
						<th>Sucursal</th>
						<th>@</th>
					</tr>
				</thead>
				<tbody>
				<?php $sqlUsers="SELECT u.*, lower(concat(e.Emp_Apellido, ' ', e.Emp_Nombre)) as nomUsuario, s.sucDescripcion, r.Rol_Detalle FROM `usuario` u
				inner join empleado e on e.Emp_Codigo = u.Emp_Codigo
				inner join sucursal s on s.Suc_Codigo = u.Suc_Codigo
				inner join rol r on r.Rol_Id = u.Rol_Id
				where usuActivo=1 order by e.Emp_Apellido asc; ";
				$resultadoUsers = $cadena->query($sqlUsers); $i=1;
				while($rowUsers = $resultadoUsers->fetch_assoc()){ ?>
					<tr data-user="<?= $rowUsers['Emp_Codigo']; ?>">
						<td><?= $i; ?></td>
						<td class="text-capitalize"><?= $rowUsers['nomUsuario']; ?></td>
						<td><?= $rowUsers['Usu_Descripcion']; ?></td>
						<td>
							<select class="form-control text-capitalize sltPTNiveles" data-value='<?= $rowUsers['Rol_Id']; ?>'>
								<?php include "php/OPT_roles.php"; ?>
							</select>
						</td>
						<td>
							<select class="form-control text-capitalize sltPTSedes" data-value='<?= $rowUsers['Suc_Codigo']; ?>'>
								<?php include "php/OPT_sedes.php"; ?>
							</select>
						</td>
						<td>
							<button class="btn btn-outline-secondary btn-sm border-0" onClick="changePwd('<?= $rowUsers['Emp_Codigo']; ?>')"> <i class="icofont-key-hole"></i> </button>
							<button class="btn btn-outline-danger btn-sm border-0" onClick="deleteUser('<?= $rowUsers['Emp_Codigo']; ?>')"> <i class="icofont-close"></i> </button>
						</td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade " id="docentes" role="tabpanel" aria-labelledby="home-tab">
			<button class="btn btn-outline-primary mt-3"  id="btnAddDocente"> <i class="icofont-ui-add"></i> Nuevo docente</button>
			<p>Docentes activos:</p>

			<table class="table table-light">
				<thead class="thead-light">
					<tr>
						<th>#</th>
						<th>Nombre usuario</th>
						<th>D.N.I.</th>
						<th>@</th>
			
					</tr>
				</thead>
				<tbody>
				<?php $sqlDocentes="SELECT Emp_Codigo, lower(concat(e.Emp_Apellido, ', ', e.Emp_Nombre)) as nomDocente, Emp_NroDocumento FROM empleado e 
				where trim(Emp_Estado)= 'Activo' and Emp_Codigo not in ('000000', '000001') order by nomDocente; ";
				$resultadoDocentes = $cadena->query($sqlDocentes); $i=1;
				while($rowDocentes = $resultadoDocentes->fetch_assoc()){ ?>
					<tr data-user="<?= $rowDocentes['Emp_Codigo']; ?>">
						<td><?= $i; ?></td>
						<td class="text-capitalize"><?= $rowDocentes['nomDocente']; ?></td>
						<td class="text-capitalize"><?= $rowDocentes['Emp_NroDocumento']; ?></td>
						<td>
							<button class="btn btn-outline-secondary btn-sm border-0" onClick="changePwdDocente('<?= $rowDocentes['Emp_Codigo']; ?>')"> <i class="icofont-key-hole"></i> </button>
							<button class="btn btn-outline-danger btn-sm border-0" onClick="deleteDocente('<?= $rowDocentes['Emp_Codigo']; ?>')"> <i class="icofont-close"></i> </button>
						</td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>



		</div>
		<div class="tab-pane fade" id="fechas" role="tabpanel" aria-labelledby="home-tab">
			<p>Fecha máxima para la subida de notas y el inicio para las pre matrículas.</p>
			<input type="date" name="" id="dtpFechaMaxima" class="form-control col-md-4">
			<button class="btn btn-outline-danger btn-sm border-0" onClick="actualizarfecha()"> <i class="icofont-close"></i> </button>
		</div>

	</div>
	
	
<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
</div>

<div id="modalAddDocente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="my-modal-title">Nuevo Docente</h5>
				<label for="">D.N.I.</label>
				<input class="form-control" type="text" id="txtDNIDocente">
				<label for="">Apellidos</label>
				<input class="form-control" type="text" id="txtApellidosDocente">
				<label for="">Nombres</label>
				<input class="form-control" type="text" id="txtNombresDocente">
			</div>
			<div class="modal-footer">
				<button class="btn btn-outline-primary"  id="btnGuardarDocente"> <i class="icofont-save"></i> Crear Docente </button>
			</div>
		</div>
	</div>
</div>
<div id="modalAddUsuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="my-modal-title">Nuevo Usuario</h5>
				<label for="">D.N.I.</label>
				<input class="form-control" type="text" id="txtDNIUsuario">
				<label for="">Apellidos</label>
				<input class="form-control" type="text" id="txtApellidosUsuario">
				<label for="">Nombres</label>
				<input class="form-control" type="text" id="txtNombresUsuario">
			</div>
			<div class="modal-footer">
				<button class="btn btn-outline-primary"  id="btnGuardarUsuario"> <i class="icofont-save"></i> Crear Usuario</button>
			</div>
		</div>
	</div>
</div>
<div id="modalNuevoPwd" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="my-modal-title">Nueva contraseña</h5>
				<p>Ingrese la nueva clave para éste usuario:</p>
				<input id="txtClave1" class="form-control mb-3" type="password" name="">
				<input id="txtClave2" class="form-control mb-3" type="password" name="">
				<button class="btn btn-outline-primary float-right"  id="btnGuardarPwd"> <i class="icofont-refresh"></i> Cambiar clave </button>
			</div>
		</div>
	</div>
</div>
<div id="modalNuevoPwdDocente" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="my-modal-title">Nueva contraseña</h5>
				<p>Ingrese la nueva clave para éste docente:</p>
				<input id="txtClave3" class="form-control mb-3" type="password" name="">
				<input id="txtClave4" class="form-control mb-3" type="password" name="">
				<button class="btn btn-outline-primary float-right"  id="btnGuardarPwdDocente"> <i class="icofont-refresh"></i> Cambiar clave </button>
			</div>
		</div>
	</div>
</div>

<?php include "php/footer.php"; ?>

<script>
/* $('.sltPNiveles').selectpicker();
$('.sltPSedes').selectpicker(); */
$.each( $('.sltPTNiveles') , function(i, objeto){
	var id= $(this).attr('data-value');
	$(this).val( id );
});
$.each( $('.sltPTSedes') , function(i, objeto){
	var sede= $(this).attr('data-value');
	$(this).val( sede );
});
$('.sltPTNiveles').change(function() {
	var usuario = $(this).parent().parent().attr('data-user');
	
	if(usuario != null){
		$.ajax({url: 'php/updateRolUser.php', type: 'POST', data: { usuario: usuario, rol: $(this).val() }}).done(function(resp) {
			console.log(resp)
		});
	}
});
$('.sltPTSedes').change(function() {
	var usuario = $(this).parent().parent().attr('data-user');
	
	if(usuario != null){
		$.ajax({url: 'php/updateSedeUser.php', type: 'POST', data: { usuario: usuario, sede: $(this).val() }}).done(function(resp) {
			console.log(resp)
		});
	}
});
$('#btnAddDocente').click(function() {
	$('#modalAddDocente').modal('show');
});
$('#btnGuardarDocente').click(function() {
	$.ajax({url: 'php/insertarDocente.php', type: 'POST', data: {dni: $('#txtDNIDocente').val(), apellido: $('#txtApellidosDocente').val(), nombre: $('#txtNombresDocente').val() }}).done(function(resp) {
		console.log(resp)
		$('#modalAddDocente').modal('hide');
		if(resp=='todo ok'){
			$('#h1Bien').text('Docente registrado con éxito');
			$('#modalGuardadoCorrecto').modal('show');
		}else if(resp=='ya registrado'){
			$('#h1Advertencia').text('El docente ya se encontraba registrado ');
			$('#modalAdvertencia').modal('show');
		}else{
			$('#h1Advertencia').text('Error desconocido, comuníquelo al área de soporte');
			$('#modalAdvertencia').modal('show');
		}
		$('#modalGuardadoCorrecto').on('hidden.bs.modal', function (e) {
			location.reload();
		});
		$('#modalAdvertencia').on('hidden.bs.modal', function (e) {
			location.reload();
		});

	});
});
$('#btnAddUsuario').click(function() {
	$('#modalAddUsuario').modal('show');
});
$('#btnGuardarUsuario').click(function() {
	$.ajax({url: 'php/insertarUsuario.php', type: 'POST', data: {dni: $('#txtDNIUsuario').val(), apellido: $('#txtApellidosUsuario').val(), nombre: $('#txtNombresUsuario').val() }}).done(function(resp) {
		console.log(resp)
		$('#modalAddUsuario').modal('hide');
		if(resp=='todo ok'){
			$('#h1Bien').text('Usuario registrado con éxito');
			$('#modalGuardadoCorrecto').modal('show');
		}else if(resp=='ya registrado'){
			$('#h1Advertencia').text('El Usuario ya se encontraba registrado ');
			$('#modalAdvertencia').modal('show');
		}else{
			$('#h1Advertencia').text('Error desconocido, comuníquelo al área de soporte');
			$('#modalAdvertencia').modal('show');
		}
		$('#modalGuardadoCorrecto').on('hidden.bs.modal', function (e) {
			location.reload();
		});
		$('#modalAdvertencia').on('hidden.bs.modal', function (e) {
			location.reload();
		});

	});
});
function deleteUser(idEmpleado) {
	$.ajax({url: 'php/deleteEmpleado.php', type: 'POST', data: { idEmpleado }}).done(function(resp) {
		console.log(resp)
		if(resp == 'todo ok'){
			location.reload();
		}
	});
}
function changePwd(idEmpleado) {
	$.idEmpleado = idEmpleado;
	$('#modalNuevoPwd').modal('show');
}
$('#btnGuardarPwd').click(function() {
	if($('#txtClave1').val() == $('#txtClave2').val() ){
		$.ajax({url: 'php/actualizarPwd.php', type: 'POST', data: { idEmpleado: $.idEmpleado , clave: $('#txtClave1').val() }}).done(function(resp) {
			console.log(resp)
			$('#modalNuevoPwd').modal('hide');
			if(resp=='todo ok'){
				$('#h1Bien').text('Datos actualizados correctamente');
				$('#modalGuardadoCorrecto').modal('show');
			}else{
				$('#h1Advertencia').text('Error desconocido, comuníquelo al área de soporte');
				$('#modalAdvertencia').modal('show');
			}
			$('#modalGuardadoCorrecto').on('hidden.bs.modal', function (e) {
				location.reload();
			});
			$('#modalAdvertencia').on('hidden.bs.modal', function (e) {
				location.reload();
			});
		});
	}else{
		$('#h1Advertencia').text('Las claves no coinciden');
		$('#modalAdvertencia').modal('show');
	}
});
function deleteDocente(idDocente) {
	$.ajax({url: 'php/deleteDocente.php', type: 'POST', data: { idDocente }}).done(function(resp) {
		console.log(resp)
		if(resp == 'todo ok'){
			location.reload();
		}
	});
}
function changePwdDocente(idDocente) {
	$.idDocente = idDocente;
	$('#modalNuevoPwdDocente').modal('show');
}
$('#btnGuardarPwdDocente').click(function() {
	if($('#txtClave3').val() == $('#txtClave4').val() ){
		$.ajax({url: 'php/actualizarPwdDocente.php', type: 'POST', data: { idDocente: $.idDocente , clave: $('#txtClave3').val() }}).done(function(resp) {
			console.log(resp)
			$('#modalNuevoPwdDocente').modal('hide');
			if(resp=='todo ok'){
				$('#h1Bien').text('Datos actualizados correctamente');
				$('#modalGuardadoCorrecto').modal('show');
			}else{
				$('#h1Advertencia').text('Error desconocido, comuníquelo al área de soporte');
				$('#modalAdvertencia').modal('show');
			}
			$('#modalGuardadoCorrecto').on('hidden.bs.modal', function (e) {
				location.reload();
			});
			$('#modalAdvertencia').on('hidden.bs.modal', function (e) {
				location.reload();
			});
		});
	}else{
		$('#h1Advertencia').text('Las claves no coinciden');
		$('#modalAdvertencia').modal('show');
	}
});
function actualizarfecha(){
	var efecha = moment($('#dtpFechaMaxima').val(), 'YYYY-MM-DD');
	if( efecha.isValid() ){
		$.ajax({url: 'php/updateFechaSubidaNotas.php', type: 'POST', data: { fecha: $('#dtpFechaMaxima').val(), anio: efecha.format('YYYY'), mes: efecha.format('M') }}).done(function(resp) {
			console.log(resp)
		});
	}
}


</script>
</body>
</html>
