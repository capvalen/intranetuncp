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
.cardAcordeon{
  cursor:pointer;
}
.alert-secondary {
    color: #196cc7;
    background-color: #ffffff;
}
.modal-xl {
    max-width: 90vw;
}
@media print{
	#content{padding-top:0px; margin-top:0px;}
	a{text-decoration: none!important; color: #000;}
	#cardEncabezados p{margin-bottom: 0.4rem;}
	#cardEncabezados .card-body{padding: 4px 11px;}
	#divContenidoPagado .card-body{
		padding: 0;
	}
	#divContenidoPagado .card{
		border:none;
		margin-bottom:0px!important;
		padding-top:0px!important;
		padding-bottom:0px!important;
	}
	.h5Titulo{
		font-size: 1rem;
	}
	#rowPadreEncabezados{
		margin-top:0px!important;
	}
	#divTabs{
		padding-top:0px!important;
	}
}
.sltTipoMatriculaDebe{
	width: 250px;
}
/* .checkbox>label{
	margin-bottom: 1rem;
} */
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";
if(isset($_GET['cursor'])){
  $sqlAlumno = "SELECT `Alu_Codigo`, lower(`Alu_Nombre`) as Alu_Nombre, lower(`Alu_Apellido`) as Alu_Apellido, `Alu_NroDocumento`, date_format(`Alu_FechaNacimiento`, '%d/%m/%Y') as Alu_FechaNacimiento FROM `alumno` where Alu_NroDocumento = '{$_GET['cursor']}';";
  $resultadoAlumno= $cadena->query($sqlAlumno);
}else if( isset($_GET['patron'])){
  $sqlAlumno = "SELECT `Alu_Codigo`, lower(`Alu_Nombre`) as Alu_Nombre, lower(`Alu_Apellido`) as Alu_Apellido, `Alu_NroDocumento`, date_format(`Alu_FechaNacimiento`, '%d/%m/%Y') as Alu_FechaNacimiento FROM `alumno` where Alu_Codigo = '{$_GET['patron']}';";
  $resultadoAlumno= $cadena->query($sqlAlumno);
}


?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->
		
	<h2 class="d-print-none"><i class="icofont-people"></i> Pagos</h2>
	
	<div class="card col-7 d-print-none">
		<div class="card-body pt-1">
		<p class="card-text m-0"><small class="text-muted"><i class="icofont-filter"></i> Filtro</small></p>
			<div class="form-inline">
      <label class="mr-3" for=""><small>Nombre/D.N.I Alumno:</small></label>
      <input type="text" class="form-control mr-3" id="txtAlumnoDni">
      <button class="btn btn-outline-primary" id="btnBuscarDniAlumno"><i class="icofont-search-1"></i> Buscar</button>
      <?php if(isset($_GET['cursor']) || isset($_GET['patron'])){ ?>
      <a href="seguimiento.php?cursor=<?= trim($_GET['cursor']); ?>" class="btn btn-outline-dark ml-3" ><i class="icofont-bulb-alt"></i> Ver seguimiento</a>
			<?php } ?>
		</div>
	</div>
  </div>
  <?php if(isset($_GET['cursor']) || isset($_GET['patron'])){ ?>
  <div class="row mt-3" id="rowPadreEncabezados">
    <div class="col-12">
      <div class="card mb-3" id="cardEncabezados">
        <div class="card-body">
        <?php if($resultadoAlumno->num_rows>0){$rowAlumno = $resultadoAlumno->fetch_assoc(); $_POST['idAlumno'] = $rowAlumno['Alu_Codigo']; ?>
          <h5>Datos del alumno</h5>
          <div class="row">
            <div class="col">
              <p><strong>D.N.I.:</strong>  <span><a href="alumnos.php?cursor=<?= $rowAlumno['Alu_Codigo']?>"><?= $rowAlumno['Alu_NroDocumento'];?></a></p>
              <p><strong>Apellidos:</strong> <span class="text-capitalize"><a href="alumnos.php?cursor=<?= $rowAlumno['Alu_Codigo']?>"><?= $rowAlumno['Alu_Apellido']; ?></a></span> </p>
              <p><strong>Nombres:</strong> <span class="text-capitalize"><a href="alumnos.php?cursor=<?= $rowAlumno['Alu_Codigo']?>"><?= $rowAlumno['Alu_Nombre']; ?></a></span> </p>
            </div>
            <div class="col">
              <p id="pCodInt" data-id='<?= $rowAlumno['Alu_Codigo']; ?>'><strong>Cod. Int.:</strong> <span><?= $rowAlumno['Alu_Codigo']; ?></span></p>
              <p><strong>Fecha de Nacimiento:</strong> <span><?= $rowAlumno['Alu_FechaNacimiento']; ?></span></p>
            </div>
          </div>
        </div>
        <?php }else{ ?>
          <p>No se encontraron registros de alumnos con el DNI proporcionado</p>
        <?php } ?>
      </div>
    </div>
    <?php if($resultadoAlumno->num_rows>0){$rowAlumno = $resultadoAlumno->fetch_assoc(); ?>
			<?php include 'php/mostrarCursosPagos.php'; ?>
    <?php } ?>

  </div>
	<?php } ?>
<!-- Fin de Contenido de la Página  -->
</div>

<!-- Fin de #wrapper  -->
</div>

<div class="modal fade" id="modalAddPay" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for=""><small>Motivo</small></label>
        <select name="" id="sltTipoPago" class="form-control">
        </select>
        <label for=""><small>Motivo de Pago</small></label>
        <select name="" id="sltMotivoPago" class="form-control">
        <?php include 'php/OPT_tipoMatricula.php'; ?>
        </select>
        <div class="alert alert-secondary my-3" role="alert"><i class="icofont-diamond"></i> Motivo: <span id="spanMotivo"></span></div>
        <label for=""><small>Código de recibo</small></label>
        <input type="text" class="form-control" id="txtCodRecibo">
        <label for=""><small>Monto (S/) </small></label>
        <input type="number" class="form-control" value="0.00" min=0 id="txtMontoPago">
        <div class="alert alert-danger d-none mt-3" id="alertPagos" role="alert"><i class="icofont-warning-alt"></i> <span style="font-size: 0.8rem;"></span> </div>
        <div class="row col justify-content-end mx-0 mt-3">
          <button type="button" class="btn btn-outline-primary float-right" id="btnInsertPay"><i class="icofont-save"></i> Insertar pago</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
<div class="modal fade" id="modalAddPayv2" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button><h5 class="modal-title">Agregar pago</h5>
				<p>Ingrese los pagos correspondientes:</p>
				<div id="divMostrarFuturosPagos"></div>
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

<div class="modal fade " id="modalBorrarPago" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Borrar pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <p>¿Desea borrar un pago? Éste proceso es irreversible</p>
       <div class="d-flex justify-content-between">
        <button class="btn btn-outline-secondary"  class="close" data-dismiss="modal">No</button>
        <button class="btn btn-outline-danger" id="btnDeletePay">Si, eliminar</button>
       </div>
      </div>
      
    </div>
  </div>
</div>

<?php include "php/footer.php"; ?>

<script>
$('.selectpicker').selectpicker();
$('#txtAlumnoDni').keyup(function (e) {
  if (e.which ==13){ $('#btnBuscarDniAlumno').click(); }
});
$('#btnBuscarDniAlumno').click(function () {
  pantallaOver(true);
  if($('#txtAlumnoDni').val()!=''){
    if( $.isNumeric($('#txtAlumnoDni').val()) ){
      window.location="pagos.php?cursor="+$('#txtAlumnoDni').val();
    }else{ 
      //Buscar texto
      $.ajax({url: 'php/buscarAlumnosApellido.php', type: 'POST', data: {texto:$('#txtAlumnoDni').val() }}).done(function (resp) {
        $('#modalBuscarAlumno tbody').children().remove();
        $('#modalBuscarAlumno tbody').append(resp);
        console.log(resp)
        pantallaOver(false)
        $('#modalBuscarAlumno').modal('show');
      })
    }
  }
});
$('.btnAddPagoDyno').click(function () {
  pantallaOver(true);
  $('#btnInsertPay').attr('reg_cod', $(this).parent().parent().attr('id'));
  $('#btnInsertPay').attr('data-idioma', $(this).parent().parent().attr('data-idioma'));
	$('#btnInsertPay').attr('data-ciclo', $(this).parent().parent().attr('data-ciclo'));
	let padre = $(this).parent().parent();

	$.ajax({url: 'php/resumenMostrarPagos.php', type:'POST', data:{idioma: $('#btnInsertPay').attr('data-idioma'), nivel: $('#btnInsertPay').attr('data-ciclo'), registro: $('#btnInsertPay').attr('reg_cod') }}).done(function (resp) { //console.log(resp)
		$('#divMostrarFuturosPagos').html(resp);
		$.ajax({url: 'php/resumenPagosRealizados.php', type: 'POST', data: { codReg: padre.attr('id') }}).done(function(respuesta) {
			//console.log(resp);
			let data = JSON.parse(respuesta);
			//console.log( data.length );
			if( data.length>0){
				limpiarPagos();
				let padrecito='';
				$.each( data , function(i, objeto){ console.log( objeto );
					switch (objeto.Pag_Codigo) {
						case "Matr0001":
							padrecito = $('#tdMatricula').parent();
							$('#chkMatricula').prop('checked', true);
							break;
						case "Pens0001":
							padrecito = $('#tdPension').parent();
							$('#chkPension').prop('checked', true);
							break;
						case "sltPagoOtro":
							$('#chkOtros').prop('checked', true);
							break;
						default:
							break;
					}
					padrecito.find('.txtCantidadPagaDebe').val(parseFloat(objeto.Monto_Pagado).toFixed(2));
					padrecito.find('.sltTipoMatriculaDebe').val( padrecito.find(`.sltTipoMatriculaDebe option[data-id="${objeto.idCondicion}"]`).val() );
					padrecito.find('.txtReciboDebe').val(objeto.Cod_Recibo);
					padrecito.find('.txtFechaDebe').val(objeto.pagFechaAuto);
					padrecito.find('.tdUser').text(objeto.Emp_Apellido + " " + objeto.Emp_Nombre );
					padrecito.find('.txtFechaDebe').val(objeto.observacion);
					let deuda = parseFloat(padrecito.find('#tdMatricula').attr('data-costo'));
					let descuento = 0;
					switch (padrecito.find('.sltTipoMatriculaDebe').attr('data-tipodscto')) {
						case 'NINGUNO': descuento =0; break;
						case 'PORCENTAJE': descuento = deuda*(padrecito.find('.sltTipoMatriculaDebe').attr('data-tipodscto'))/100 ; break;
						case 'MONTO': descuento = padrecito.find('.sltTipoMatriculaDebe').attr('data-tipodscto') ; break;
						default: break;
					}
					console.log( 'Descuento ' + descuento );
					let paga = parseFloat(objeto.Monto_Pagado);
					let resta = deuda - descuento -paga;
					if( resta>0){
						padrecito.find('.tdDebe').html( '<span class="text-danger">Debe S/ '+ parseFloat(resta).toFixed(2) +'</span>' );
					}else{
						padrecito.find('.tdDebe').html( '<span class="text-primary>Cancelado</span>');
					}
				});
			}
			
			$('#modalAddPayv2').modal('show');
			pantallaOver(false);
		});
		
  });
});
function limpiarPagos(){
	$('#chkMatricula').prop('checked', false);
	$('#chkPension').prop('checked', false);
	$('#chkOtros').prop('checked', false);
	$('.sltTipoMatriculaDebe').val(-1);
	$('.txtCantidadPagaDebe').val('0.00');
	$('.txtReciboDebe').val('');
	$('.txtFechaDebe').val('');
	$('.txtFechaDebe').val('');
	$('.txtObservacion').val('');
	$('.tdUser').text('');

}
$('#sltTipoPago').change(function () { calculoPension(); });
$('#sltMotivoPago').change(function () { calculoPension(); });
function calculoPension(){
  var motivo = $('#sltMotivoPago').selectpicker('val'); /* $(`#sltTipoPago option[value='${$('#sltTipoPago').val()}']`).attr('data-motivo')*/
  var monto = parseFloat($(`#sltTipoPago option[value='${$('#sltTipoPago').val()}']`).attr('data-valor')).toFixed(2) 
  var dscto = 0; 
  var padre = $(`#sltMotivoPago option[value='${$('#sltMotivoPago').val()}']`);
  $.idDscto = padre.attr('data-id');
  //console.log(motivo)
  if(motivo !='Normal' && $('#sltTipoPago').val()!='Matr0001'){
    switch (padre.attr('data-tipodscto')) { 
      case 'MONTO': dscto = parseFloat( padre.attr('data-cantdscto')).toFixed(2); monto = monto - dscto; motivo += ' S/ -'+dscto; break;
      case 'PORCENTAJE': dscto = parseFloat( padre.attr('data-cantdscto')).toFixed(0); monto = monto - monto*(dscto/100);  motivo += ' -'+dscto+'%'; break;
      default:
        break;
    }
  }else if(motivo !='Normal' && $('#sltTipoPago').val()=='Matr0001'){
    motivo = 'Matrículas no tienen ningún descuento'; $.idDscto = 1;
  }
  $('#txtMontoPago').val(parseFloat(monto).toFixed(2));
  $('#spanMotivo').text(motivo);

}
$('#btnInsertPay').click(function () {
  pantallaOver(true);
  $('#alertPagos').addClass('d-none');
  if($('#txtCodRecibo').val()=='' || ( $('#txtMontoPago').val()=='' || $('#txtMontoPago').val()<0 ) ){
    pantallaOver(false);
    $('#alertPagos span').text('Tiene campos mal rellenados o en blanco, revise por favor.').parent().removeClass('d-none')
  }else{
    var motivo = $('#sltMotivoPago').selectpicker('val');
    if(motivo !='Normal' && $('#sltTipoPago').val()=='Matr0001'){
      motivo = 'Normal';
    }
    var registro = $('#btnInsertPay').attr('reg_cod');
    $.ajax({url: 'php/insertarPago.php', type: 'POST', data:{reg: registro, pagCod: $('#sltTipoPago').val(), recibo: $('#txtCodRecibo').val(), monto: $('#txtMontoPago').val(), motivo: motivo  }}).done(function (resp) {
      pantallaOver(false);
      console.log(resp);
      if(resp=='todo ok'){
        /* $('#h1Bien').text('Pago insertado con éxito');
       
			  $('#modalGuardadoCorrecto').modal('show'); */
        $('#modalAddPay').modal('hide');
        alertify.notify('<i class="icofont-check-circled"></i> Pago insertado con éxito', 'success' );
        if( $(`#${registro} table`).length >0 ){
          $(`#${registro}`).find('tbody').append(`/*html*/
            <tr >
                    <td>-</td>
                    <td>-</td>
                    <td>${$(`#sltTipoPago option[value="${$('#sltTipoPago').val()}"]`).text()}</td>
                    <td>${$('#txtCodRecibo').val()}</td>
                    <td>${$('#txtMontoPago').val()}</td>
                  </tr>`);
        }else{
          $(`#${registro} p`).append(`<table class="table table-sm table-hover">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Cod. Pago</th>
                  <th>Concepto</th>
                  <th>Recibo</th>
                  <th>Monto</th>
                </tr>
              </thead>
              <tbody>
              <tr >
                    <td>-</td>
                    <td>-</td>
                    <td>${$(`#sltTipoPago option[value="${$('#sltTipoPago').val()}"]`).text()}</td>
                    <td>${$('#txtCodRecibo').val()}</td>
                    <td>${$('#txtMontoPago').val()}</td>
                  </tr>
              </tbody>
            </table>`)
        }
      }else{
        $('#modalAddPay').modal('hide');
        alertify.notify('<i class="icofont-close-circled"></i> Hubo un error interno, es posible que no se haya registrado su proceso', 'danger' );
      }
    })
  }
})
$('#modalGuardadoCorrecto').on('hidden.bs.modal', function (e) {
  location.reload();
});
<?php if(isset($_GET['cursor']) || isset($_GET['patron'])){ ?>
  
$('.btnBorrarPay').click(function () {
  $('#btnDeletePay').attr('data-id', $(this).parent().parent().attr('data-id'));
  $('#modalBorrarPago').modal('show');
})
$('#btnDeletePay').click(function () {
  $.ajax({url: 'php/deletePay.php', type: 'POST', data:{pago: $('#btnDeletePay').attr('data-id') }}).done(function (resp) {
    console.log(resp)
    if(resp=='todo ok'){
      location.reload();
    }
  })
})
<?php }?>
</script>
</body>
</html>