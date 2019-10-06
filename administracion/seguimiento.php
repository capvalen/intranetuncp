<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'php/header.php';
	include "php/conexionInfocat.php";
	?>
</head>
<body>

<style>
.colSubInt{border-bottom: 2px solid #525252; }
.colNormal, .colHorarios{font-size: .8em;}
.border-dark{border: 2px solid #525252!important; border-bottom: 0!important;}
.border-dark:last-child{border-bottom: 2px solid #525252!important; }
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>

<div id="content" class="container-fluid ">
	<!-- Contenido de la Página  -->

		
	<h2 class="d-print-none"><i class="icofont-people"></i> Seguimiento académico</h2>
	
	<div class="card mb-3 col-6 d-print-none">
		<div class="card-body">
			<h6 class="card-subtitle mb-2 text-muted">Filtro de búsqueda por D.N.I.:</h6>
			<div class="row">
					<div class="col">
						<input type="text" class="form-control" id="txtBusquedaAlumno">
					</div>
					<div class="col-3">
						<button class="btn btn-outline-primary" id="btnBuscarAlumno"><i class="icofont-search-1"></i> Buscar</button>
					</div>
					
			</div>

		</div>
	</div>
	
	<?php if(isset($_GET['cursor'])){ 
		$sqlAlumno = "SELECT lower(a.Alu_Apellido) as Alu_Apellido, lower(a.Alu_Nombre) as Alu_Nombre, a.Alu_Codigo FROM `alumno` a where Alu_NroDocumento = '{$_GET['cursor']}'";
		
		$resultadoAlumno=$cadena->query($sqlAlumno);
		if($resultadoAlumno->num_rows>=1){
			$rowAlumno=$resultadoAlumno->fetch_assoc();

			$sqlDetalles = "SELECT ra.*, i.Idi_Nombre, n.Niv_Detalle, s.Sec_NroCiclo, year(ma.Mes_Inicio) as Mes_Inicio, ma.Mes_Detalle, su.Suc_Direccion,
			lower(concat(e.Emp_Apellido, ' ' , e.Emp_Nombre)) as nomDocente, h.Hor_HoraInicio, h.Hor_HoraSalida, ono.not_Prom, lower(AlSe_Condicion) as AlSe_Condicion
			FROM `registroalumno` ra
			inner join seccion s on s.Sec_Codigo = ra.Sec_Codigo
			inner join idioma i on s.Idi_Codigo = i.Idi_Codigo
			inner join nivel n on n.Niv_Codigo = s.Niv_Codigo
			inner join sucursal su on su.Suc_Codigo = s.Suc_Codigo
			inner join empleado e on e.Emp_Codigo = s.Emp_Codigo
			inner join mesacademico ma on ma.Mes_Codigo = s.Mes_Codigo
			inner join horarioclases h on h.Hor_Codigo = s.Hor_Codigo
			inner join onota ono on ono.Reg_Codigo = ra.Reg_Codigo
			where Alu_Codigo='{$rowAlumno['Alu_Codigo']}' ;"; //  and Sec_Detalle = 'Habilitado'
	?> 

	<div class="">
		<div class="">
			<h3 class="text-center">Hoja de seguimiento de Alumno</h3>
			<p><strong>Apellidos y nombres: </strong> <span class="text-capitalize"><?= $rowAlumno['Alu_Apellido'].', '.$rowAlumno['Alu_Nombre'];?></span></p>
		<?php 
			$resultadoDetalles=$cadena->query($sqlDetalles);
			if($resultadoDetalles->num_rows>=1){
			while($rowDetalles=$resultadoDetalles->fetch_assoc()){

		 ?>
			<div class="container-fluid bloqueEntero border border-dark">
				<div class="row">
					<div class="col colHorarios"><?= $rowDetalles['Idi_Nombre']; ?></div>
					<div class="col-3 colHorarios"><?= $rowDetalles['Niv_Detalle'].'-'.$rowDetalles['Sec_NroCiclo']; ?></div>
					<div class="col-3 colHorarios"><?= $rowDetalles['Hor_HoraInicio'].'-'.$rowDetalles['Hor_HoraSalida']; ?></div>
					<div class="col-4 text-capitalize "><?= $rowDetalles['nomDocente']; ?></div>
					<div class="col"><strong><?php if( $rowDetalles['not_Prom']<=9){ echo str_pad($rowDetalles['not_Prom'], 2, "0", STR_PAD_LEFT); }else{ echo $rowDetalles['not_Prom']; } ?></strong></div>
				</div>
				<div class="row">
					<div class="col-2"><?= $rowDetalles['Mes_Inicio'].'-'.$rowDetalles['Mes_Detalle']; ?></div>
					<div class="col-2"><?= $rowDetalles['Suc_Direccion']; ?></div>
					<div class="col container-fluid">
						<div class="row"><div class="col colNormal text-capitalize"><?= $rowDetalles['AlSe_Condicion']; ?></div></div>
						<div class="row container-fluid">
							<div class="col text-center colSubInt"><strong>N° Recibo</strong></div>
							<div class="col-3 text-center colSubInt"><strong>Descripción</strong></div>
							<div class="col-2 text-center colSubInt"><strong>Monto</strong></div>
						</div>
						<?php $sqlPagos = "SELECT dp.`Cod_DetPag`, dp.`Cod_Recibo`, dp.`Pag_Codigo`, round(dp.`Monto_Pagado`,2) as Monto_Pagado , pg.Pag_Detalle FROM `detallepago` dp
						inner join registroalumno ra on ra.Reg_Codigo = dp.Reg_Codigo 
						inner join pago pg on pg.Pag_Codigo = dp.Pag_Codigo
						where dp.Reg_Codigo = '{$rowDetalles['Reg_Codigo']}' order by Pag_Detalle desc ;";
						$resultadoPagos=$esclavo->query($sqlPagos);
						if($resultadoPagos->num_rows>=1){ 
							while($rowPagos=$resultadoPagos->fetch_assoc()){ ?>
								<div class="row container-fluid">
									<div class="col text-uppercase"><?= $rowPagos['Cod_Recibo']; ?></div>
									<div class="col-3"><?= $rowPagos['Pag_Detalle']; ?></div>
									<div class="col-2"><?= $rowPagos['Monto_Pagado']; ?></div>
								</div>
						<?php } //fin de while
						}else{ ?>
						<div class="row">
							<p>Sin pagos</p>
						</div>
						<?php } ?>
					
						
					</div>
				</div>
			</div>
			<?php } // fin de bucle while ?>
		</div>
	</div>
	<?php
		}else{ //fin de busqueda de cursos ?>
		<p>El alumno no tiene cursos asignados aún.</p>
		<?php
		}
		} //fin de resultado alumno
		else { ?>
		<p>No se ubicaron datos para el DNI <strong><?= $_GET['cursor'];?> proporcionado</strong></p>
		<?php }
 } //fin de isset cursor ?>
<!-- Fin de Contenido de la Página  -->
</div>

<div class="modal fade" id="modalDocumentoNuevo" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Registro de nuevo documento</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row mb-2">
						<div class="col-4"><label for="">N° de Registro</label></div>
						<div class="col"><input type="text" class="form-control" id="txtDocNumero"></div>
					</div>
					<div class="row mb-2">
						<div class="col-4"><label for="">Tipo de documento</label></div>
						<div class="col">
							<select class="form-control" id="sltTipoDocumento">
								<option value="2">Solicitud</option>
								<option value="1">Oficio</option>
								<option value="3">Memorandum</option>
								<option value="4">Otro</option>
							</select>
						</div>
					</div>
					<div class="row mb-2" id="divComboTramites">
						<div class="col-4"><label for="">Tipo de trámite</label></div>
						<div class="col">
							<select class="form-control" id="sltTipoTramite">
								<option value="1">Solicitud de Certificado</option>
								<option value="2">Media Beca</option>
								<option value="3">Beca completa</option>
								<option value="4">Examen de ubicación</option>
								<option value="5">Examen de re-ubicación</option>
								<option value="6">Examen de suficiencia</option>
							</select>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-4"><label for="">Detalle</label></div>
						<div class="col"><input type="text" class="form-control" id="txtDocAsunto"></div>
					</div>
					<div class="row mb-2" id="divDNIInteresado">
						<div class="col-4"><label for="">D.N.I. Interesado</label></div>
						<div class="col"><input type="text" class="form-control" id="txtDniInteresado"></div>
					</div>
					<div class="row mb-2">
						<div class="col-4"><label for="">Datos interesado</label></div>
						<div class="col"><input type="text" class="form-control" id="txtDocInteresado" readonly></div>
					</div>
					
					<div class="alert alert-danger d-none" role="alert"> <strong>Advertencia: </strong> <span id="spanAlertTramites"></span></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-primary" id="btnInsertDoc"><i class="icofont-save"></i> Insertar documento</button>
				</div>
			</div>
		</div>
	</div>
		
<!-- Fin de #wrapper  -->
</div>

<?php include "php/footer.php"; ?>

<script>

$('#btnBuscarAlumno').click(function () {
	if( $('#txtBusquedaAlumno').val()!='' ){
		window.location.href = 'alumnado.php?cursor='+$('#txtBusquedaAlumno').val();
	}
})
</script>
  </body>
</html>