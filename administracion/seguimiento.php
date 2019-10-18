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
@media print{
	header {
    position: fixed;
    top: 0;
  }
	footer {
    position: fixed;
    bottom: 0;
  }
	
}
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";?>

<div id="content" class="container-fluid ">
	<!-- Contenido de la Página  -->

		
	<h2 class="d-print-none mt-3"><i class="icofont-people"></i> Seguimiento académico</h2>
	
	<div class="card mb-3 col-6 d-print-none">
		<div class="card-body">
			<h6 class="card-subtitle mb-2 text-muted">Filtro de búsqueda por Nombre/D.N.I. Alumno:</h6>
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
	}else if(isset($_GET['patron'])){
		$sqlAlumno = "SELECT lower(a.Alu_Apellido) as Alu_Apellido, lower(a.Alu_Nombre) as Alu_Nombre, a.Alu_Codigo FROM `alumno` a where Alu_Codigo = '{$_GET['patron']}'";
	}
	?>

	<?php if(isset($_GET['cursor']) || isset($_GET['patron']) ){ 
		
		
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
			left join onota ono on ono.Reg_Codigo = ra.Reg_Codigo
			where Alu_Codigo='{$rowAlumno['Alu_Codigo']}' 
			order by i.Idi_Nombre, year(STR_TO_DATE(s.Mes_Codigo, '%m%Y')), month(STR_TO_DATE(s.Mes_Codigo, '%m%Y')) asc ;"; //  and Sec_Detalle = 'Habilitado'
	?> 

	<div class="content-block">
		<div class="">
			<div class="row">
				<div class="col-3 "><img src="images/ceid_print.png" class="d-none d-print-block img-fluid "></div>
				<div class="col d-flex align-items-center justify-content-center">
					<h3 class="">Hoja de seguimiento de Alumno</h3>
				</div>
				<div class="col-3 d-flex justify-content-end "> <img class="d-none d-print-block" src="images/uncp-logo.png?v=1" style="height: 80px;"> </div>
			</div>
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
						<?php if(trim($rowDetalles['AlSe_Condicion'])=='Normal'){ ?>
							<p>Sin pagos</p>
						<?php }else{ ?>
							<p class='text-capitalize'><strong><?= $rowDetalles['AlSe_Condicion']; ?></strong></p>
						<?php } ?>
						</div>
						<?php } ?>
					
						
					</div>
				</div>
			</div>
			<?php } // fin de bucle while ?>
		</div>
	</div>
	
	<footer>
	<span>17/10/2019</span>
	</footer>
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

<div class="modal fade " id="modalBuscarAlumno" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alumnos coincidentes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table table-hover">
       <thead>
        <tr>
          <th>N°</th>
          <th>Apellidos y Nombres</th>
          <th>D.N.I.</th>
        </tr>
       </thead>
       <tbody>
        
       </tbody>
       </table>
      </div>
      
    </div>
  </div>
</div>

<!-- Fin de #wrapper  -->
</div>

<?php include "php/footer.php"; ?>

<script>
$('#txtBusquedaAlumno').keyup(function (e) {
  if (e.which ==13){ $('#btnBuscarAlumno').click(); }
});
$('#btnBuscarAlumno').click(function () {
	pantallaOver(true);
  if($('#txtBusquedaAlumno').val()!=''){
    if( $.isNumeric($('#txtBusquedaAlumno').val()) ){
      window.location.href = 'seguimiento.php?cursor='+$('#txtBusquedaAlumno').val();
    }else{ 
      //Buscar texto
      $.ajax({url: 'php/buscarAlumnosApellido2.php', type: 'POST', data: {texto:$('#txtBusquedaAlumno').val() }}).done(function (resp) {
        $('#modalBuscarAlumno tbody').children().remove();
        $('#modalBuscarAlumno tbody').append(resp);
        console.log(resp)
        pantallaOver(false)
        $('#modalBuscarAlumno').modal('show')
      })
    }
  }
})
</script>
	</body>
</html>