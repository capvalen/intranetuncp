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
	<h4 class="d-print-none"><i class="icofont-people"></i> Usuarios</h4>
	
	<p>Usuarios activoss:</p>
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
<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
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


</script>
</body>
</html>