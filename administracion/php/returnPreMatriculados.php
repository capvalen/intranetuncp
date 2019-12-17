<?php
include 'conexionInfocat.php';

$sql="SELECT p.*, lower(a.Alu_Apellido) as Alu_Apellido, lower(a.Alu_Nombre) as Alu_Nombre, i.Idi_Nombre, n.Niv_Detalle, hc.Hor_HoraInicio, hc.Hor_HoraSalida, hd.horDiaInicial, hd.horDiaFinal
FROM `prematricula` p
inner join alumno a on a.Alu_Codigo = p.Alu_Codigo
inner join idioma i on i.Idi_Codigo = p.Idi_Codigo
inner join nivel n on n.Niv_Codigo = p.Niv_Codigo
inner join horarioclases hc on hc.Hor_Codigo = p.idHorario
inner join horarioDias hd on hd.idHorarioDia = hc.idHorarioDia
where periodo = date_format(STR_TO_DATE( concat('{$_POST['periodo']}', '-01'), '%Y-%m-%d'), '%m%Y') and p.Idi_Codigo = '{$_POST['idioma']}' and p.Niv_Codigo = '{$_POST['nivel']}' and Sec_NroCiclo = {$_POST['ciclo']} and p.idHorario  = {$_POST['horario']} and atendido =0
order by a.Alu_Apellido, a.Alu_Nombre asc; ";

//echo $sql;
$resultado=$cadena->query($sql); $i=0;
if($resultado->num_rows>=1){ ?> 
<div class="row row-cols-2 my-2">
  <div class="col">
    <p class="">Listado de Pre matriculados:</p>
  </div>
  <div class="col d-flex flex-row-reverse">
    <?php $sqlSeccion = "SELECT * FROM `seccion`
    where Idi_Codigo ='{$_POST['idioma']}' and Hor_Codigo = {$_POST['horario']} and Mes_Codigo = date_format(STR_TO_DATE( concat('{$_POST['periodo']}', '-01'), '%Y-%m-%d'), '%m%Y') and Niv_Codigo='{$_POST['nivel']}' and Sec_NroCiclo = {$_POST['ciclo']} and Sec_Seccion<>'X'  and Suc_Codigo='{$_POST['sucursal']}'; ";
    //echo $sqlSeccion;
    $resultadoSeccion = $apoyo->query($sqlSeccion);
    if($resultadoSeccion->num_rows == 1){ 
      $rowSeccion = $resultadoSeccion->fetch_assoc(); ?>
      <button class="btn btn-outline-primary" id="btnMatricularTodos" data-id="<?= $rowSeccion['Sec_Codigo']; ?>"><i class="icofont-certificate-alt-2"></i> Matricular en bloque</button>
    <?php }else{ ?> 
      <div class="alert alert-secondary" role="alert">
        Aún no existe <strong>Mes académico</strong> y/o <strong>Ciclo</strong> creado para poder auto matricular a los alumnos.
      </div>
    <?php } ?>
  </div>
</div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>N°</th>
        <th>Apellidos y Nombres</th>
        <th>Curso</th>
        <th>Nivel</th>
        <th>Ciclo</th>
        <th>Días</th>
        <th>Horario</th>
        <th>Motivo</th>
        <th>@</th>
      </tr>
    </thead>  
  <?php
while($row=$resultado->fetch_assoc()){ ?>
  <tr data-id="<?= $row['id']; ?>" data-alumno='<?= $row['Alu_Codigo']; ?>'>
    <td> <span class="text-danger btnBorrarPreMatricula "><i class="icofont-close"></i></span> <?= $i+1; ?></td>
    <td class="text-capitalize"><?= $row['Alu_Apellido'].' '.$row['Alu_Nombre']; ?></td>
    <td><?= $row['Idi_Nombre']; ?></td>
    <td><?= $row['Niv_Detalle']; ?></td>
    <td><?= $row['Sec_NroCiclo']; ?></td>
    <td><?= 'De '.$row['horDiaInicial'].' a '.$row['horDiaFinal']; ?></td>
    <td><?= 'De '.$row['Hor_HoraInicio'].' a '.$row['Hor_HoraSalida']; ?></td>
    <td><?= $row['motivo']; ?></td>
    <td><!-- <button class="btn btn-outline-secondary border-0"><i class="icofont-certificate-alt-2"></i></button> -->
    <div class="form-check abc-checkbox abc-checkbox-warning form-check-inline">
      <input class="form-check-input" type="checkbox" id="singleCheckbox<?= $i; ?>" value="option2" aria-label="">
      <label class="form-check-label pb-3" for="singleCheckbox<?= $i; ?>"></label>
    </div>
  </td>
  </tr>
<?php $i++; } ?> 
  </table>
<?php } else{ ?> 
  <p>No hay alumnos que se hayan matriculado en los filtros indicados.</p>
<?php }

?>