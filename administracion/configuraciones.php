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
		
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
			<p>Usuarios activos:</p>
			<table class="table table-light">
				<thead class="thead-light">
					<tr>
						<th>#</th>
						<th>Nombre usuario</th>
						<th>Nick</th>
						<th>Acceso</th>
						<th>Sucursal</th>
					</tr>
				</thead>
				<tbody>
				<?php $sqlUsers="SELECT u.*, lower(concat(e.Emp_Apellido, ' ', e.Emp_Nombre)) as nomUsuario, s.sucDescripcion, r.Rol_Detalle FROM `usuario` u
				inner join empleado e on e.Emp_Codigo = u.Emp_Codigo
				inner join sucursal s on s.Suc_Codigo = u.Suc_Codigo
				inner join rol r on r.Rol_Id = u.Rol_Id
				where usuActivo=1; ";
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
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>



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
				<button class="btn btn-outline-primary"  id="btnGuardarDocente"> <i class="icofont-search-1"></i> </button>
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


</script>
</body>
</html>
