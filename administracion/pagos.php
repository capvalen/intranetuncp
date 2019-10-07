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
</style>
	
<div class="wrapper">
<?php include "php/menu-wrapper.php";
if(isset($_GET['cursor'])){
  $sqlAlumno = "SELECT `Alu_Codigo`, lower(`Alu_Nombre`) as Alu_Nombre, lower(`Alu_Apellido`) as Alu_Apellido, `Alu_NroDocumento`, date_format(`Alu_FechaNacimiento`, '%d/%m/%Y') as Alu_FechaNacimiento FROM `alumno` where Alu_NroDocumento = '{$_GET['cursor']}';";
  $resultadoAlumno= $cadena->query($sqlAlumno);
}
?>

<div id="content" class="container-fluid pt-5">
	<!-- Contenido de la Página  -->
		
	<h2 class="d-print-none"><i class="icofont-people"></i> Pagos</h2>
	
	<div class="card col-6">
		<div class="card-body pt-1">
		<p class="card-text m-0"><small class="text-muted"><i class="icofont-filter"></i> Filtro</small></p>
			<div class="form-inline">
      <label class="mr-3" for=""><small>D.N.I Alumno:</small></label>
      <input type="text ml-3" class="form-control" id="txtAlumnoDni">
      <button class="btn btn-outline-primary ml-3" id="btnBuscarDniAlumno"><i class="icofont-search-1"></i> Buscar</button>
		</div>
	</div>
  </div>
  <?php if(isset($_GET['cursor'])){ ?>
  <div class="row mt-3">
    <div class="col-4">
      <div class="card">
        <div class="card-body">
        <?php if($resultadoAlumno->num_rows>0){$rowAlumno = $resultadoAlumno->fetch_assoc(); $_POST['idAlumno'] = $rowAlumno['Alu_Codigo']; ?>
          <h5>Datos del alumno</h5>
          <p><strong>Cod. Int.:</strong> <span><?= $rowAlumno['Alu_Codigo']; ?></span></p>
          <p><strong>D.N.I.:</strong> <span><?= $rowAlumno['Alu_NroDocumento']; ?></span></p>
          <p><strong>Apellidos:</strong> <span class="text-capitalize"><?= $rowAlumno['Alu_Apellido']; ?></span></p>
          <p><strong>Nombres:</strong> <span class="text-capitalize"><?= $rowAlumno['Alu_Nombre']; ?></span></p>
          <p><strong>Fecha de Nacimiento:</strong> <span><?= $rowAlumno['Alu_FechaNacimiento']; ?></span></p>
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
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="">Motivo</label>
        <select name="" id="sltTipoPago" class="form-control">
          <option value="1">ABC</option>
        </select>
        <label for="">Cod. Recibo</label>
        <input type="text" class="form-control" id="txtCodRecibo">
        <label for="">Monto</label>
        <input type="number" class="form-control" value="0.00" min=0 id="txtMontoPago">
        <div class="alert alert-danger d-none my-3" id="alertPagos" role="alert"><i class="icofont-warning-alt"></i> <span>A simple danger alert—check it out!</span></div>
        <div class="row col justify-content-end mx-0 mt-3">
          <button type="button" class="btn btn-outline-primary float-right" id="btnInsertPay"><i class="icofont-save"></i> Insertar pago</button>
        </div>
      </div>
      
    </div>
  </div>
</div>

<?php include "php/footer.php"; ?>

<script>
$('#txtAlumnoDni').keyup(function (e) {
  if (e.which ==13){ $('#btnBuscarDniAlumno').click(); }
})
$('#btnBuscarDniAlumno').click(function () {
  window.location="pagos.php?cursor="+$('#txtAlumnoDni').val();
});
$('.btnAddPagoDyno').click(function () {
  pantallaOver(true);
  $('#btnInsertPay').attr('reg_cod', $(this).parent().parent().attr('id'))
  $('#btnInsertPay').attr('data-idioma', $(this).parent().parent().attr('data-idioma'))
  $('#btnInsertPay').attr('data-ciclo', $(this).parent().parent().attr('data-ciclo'))

  $.ajax({url: 'php/OPT_detalleConPagos.php', type:'POST', data:{idioma: $('#btnInsertPay').attr('data-idioma'), nivel: $('#btnInsertPay').attr('data-ciclo') }}).done(function (resp) {// console.log(resp)
    $('#sltTipoPago').children().remove(); $('#sltTipoPago').append(resp);
    $('#sltTipoPago').change();
    $('#modalAddPay').modal('show');
    pantallaOver(false);
  })
});
$('#sltTipoPago').change(function () {
  $('#txtMontoPago').val(parseFloat($(`#sltTipoPago option[value='${$('#sltTipoPago').val()}']`).attr('data-valor')).toFixed(2))
});
$('#btnInsertPay').click(function () {
  $('#alertPagos').addClass('d-none')
  if($('#txtCodRecibo').val()=='' || ( $('#txtMontoPago').val()=='' || $('#txtMontoPago').val()<0 ) ){
    $('#alertPagos span').text('Tiene campos mal rellenados o en blanco, revise por favor.').parent().removeClass('d-none')
  }else{
    $.ajax({url: 'php/insertarPago.php', type: 'POST', data:{reg: $('#btnInsertPay').attr('reg_cod'), pagCod: $('#sltTipoPago').val(), recibo: $('#txtCodRecibo').val(), monto: $('#txtMontoPago').val() }}).done(function (resp) {
      console.log(resp);
      if(resp=='todo ok'){
        $('#h1Bien').text('Pago insertado con éxito');
        $('#modalAddPay').modal('hide');
			  $('#modalGuardadoCorrecto').modal('show');
      }
    })
  }
})
$('#modalGuardadoCorrecto').on('hidden.bs.modal', function (e) {
  location.reload();
});

</script>
</body>
</html>