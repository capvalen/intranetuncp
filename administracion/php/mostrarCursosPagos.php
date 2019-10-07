<div class="col">
<?php 
$sqlCursos = "SELECT i.Idi_Codigo, i.Idi_Nombre FROM `registroalumno` ra
inner join seccion s on s.Sec_Codigo = ra.Sec_Codigo
inner join idioma i on s.Idi_Codigo = i.Idi_Codigo
where Alu_Codigo = '{$_POST['idAlumno']}' group by i.Idi_Codigo";
$resultadoCursos = $cadena->query($sqlCursos);
if( $resultadoCursos->num_rows>0){

  

?>
<div class="card">
  <div class="card-body">
    <h5>Cursos registrados</h5>
    <nav>
      <ul class="nav nav-tabs" role="tablist">
      <?php $i=0; while($rowCursos = $resultadoCursos->fetch_assoc()){ ?>
        <li class="nav-item">
          <a class="nav-link <?php if($i==0){echo "active"; } $i++; ?>" href="#<?= $rowCursos['Idi_Codigo']; ?>" data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><?= $rowCursos['Idi_Nombre']; ?></a>
        </li>
        <?php }  //fin de while cursos ?>
      </ul>
    </nav>
    <div class="tab-content pt-3">
    <?php $resultadoCursos->data_seek(0); $i=0;
      while($rowCursos = $resultadoCursos->fetch_assoc()){ //inicio de tabPane cursos ?>
      <div class="tab-pane fade <?php if($i==0){echo "show active"; } $i++; ?>" id="<?= $rowCursos['Idi_Codigo']; ?>" role="tabpanel" aria-labelledby="home-tab" >
      <div class="accordion" id="accordionExample">
      <?php
      $sqlCiclos= "SELECT ra.*, s.Niv_Codigo, n.Niv_Detalle, s.Sec_NroCiclo, s.Idi_Codigo FROM `registroalumno` ra
      inner join seccion s on s.Sec_Codigo = ra.Sec_Codigo
      inner join idioma i on s.Idi_Codigo = i.Idi_Codigo
      inner join nivel n on n.Niv_Codigo = s.Niv_Codigo
      where Alu_Codigo = '{$_POST['idAlumno']}' and s.Idi_Codigo ='{$rowCursos['Idi_Codigo']}'";
      //echo $sqlCiclos;
      $resultadoCiclos = $esclavo->query($sqlCiclos);
      if($resultadoCiclos->num_rows>0){
        ?> <p>Total de ciclos: <?= $resultadoCiclos->num_rows; ?></p> <?php
        while($rowCiclos = $resultadoCiclos->fetch_assoc()){
      
       ?>
        
        
        <div class="card">
          <div class="card-header cardAcordeon" id="" data-toggle="collapse" data-target="#<?= $rowCiclos['Reg_Codigo'];?>" aria-expanded="false" aria-controls="collapseOne">
            <h2 class="mb-0">
              <button class="btn btn-link text-decoration-none" type="button"><?= $rowCiclos['Niv_Detalle'].' '.$rowCiclos['Sec_NroCiclo'] ?></button> <span class="float-right text-primary"><i class="icofont-rounded-down"></i></span>
            </h2>
          </div>

          <div id="<?= $rowCiclos['Reg_Codigo'];?>" data-idioma='<?= $rowCiclos['Idi_Codigo'];?>' data-ciclo='<?= $rowCiclos['Niv_Codigo'];?>' class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <button class="btn btn-outline-success mb-3 btnAddPagoDyno"><i class="icofont-plus"></i> Agregar nuevo pago</button>
            <?php $sqlPagos="SELECT Cod_DetPag, dp.Pag_Codigo, round(dp.Monto_Pagado,2) as Monto_Pagado, pg.Pag_Detalle, dp.Cod_Recibo  FROM `detallepago` dp
            inner join pago pg on pg.Pag_Codigo = dp.Pag_Codigo 
            where reg_Codigo='{$rowCiclos['Reg_Codigo']}' order by Pag_Codigo asc ";
            $resultadoPagos = $apoyo->query($sqlPagos);
            if($resultadoPagos->num_rows>0){
            ?>
            <table class="table table-hover">
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
              <?php $i=1; while($rowPagos = $resultadoPagos->fetch_assoc()){ ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $rowPagos['Cod_DetPag']; ?></td>
                  <td><?= $rowPagos['Pag_Detalle']; ?></td>
                  <td><?= $rowPagos['Cod_Recibo']; ?></td>
                  <td><?= $rowPagos['Monto_Pagado']; ?></td>
                </tr>
              <?php $i++; } ?>
            
                
              </tbody>
            </table>
            <?php }else{ ?>
              <p>No hay pagos aún</p>
            <?php } ?>

          </div>
          </div>
              
        </div>
        
        
      
      <?php } //fin de while ciclos
      }else{ // fin de if resultadoCiclos ?>
      <p>Aún no tiene registrado ciclos</p>
      <?php } // ?>
      </div>
      </div> <!-- fin de tabPane cursos -->
      <?php } // ?>
    </div> <!-- fin de tabContent padre cursos -->
  </div>
</div>
    
<?php 
  }else{ ?>
<p>El estudiante aún tiene cursos matriculados</p>  
<?php  } ?>
</div>