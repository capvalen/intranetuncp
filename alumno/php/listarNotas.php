<?php include 'conexionInfocat.php';
$sqlAlumno="SELECT lower(a.Alu_Nombre) as Alu_Nombre, lower(a.Alu_Apellido) as Alu_Apellido
FROM alumno a 
  where a.Alu_NroDocumento = '{$_POST['dni']}'; ";

$resultadoAlumno=$esclavo->query($sqlAlumno);
$rowAlumno=$resultadoAlumno->fetch_assoc();

?>
<div class="row pt-3 mt-3">
  <p class="lead"><strong>Datos personales:</strong> <span class="text-capitalize"><?= $rowAlumno['Alu_Apellido'].', '. $rowAlumno['Alu_Nombre'];?></span></p>
  </div>
  <div class="row">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Periodo</th>
          <th>Idioma</th>
          <th>Nivel</th>
          <th>Ciclo</th>
          <th>Promedio</th>
        </tr>
      </thead>
      <tbody>     
<?php
$sql="SELECT s.Mes_Codigo , i.Idi_Nombre, n.Niv_Detalle, s.Sec_NroCiclo,
ono.not_Prom, lower(a.Alu_Nombre) as Alu_Nombre, lower(a.Alu_Apellido) as Alu_Apellido
FROM `registroalumno` ra
  inner join alumno a on a.Alu_Codigo = ra.Alu_Codigo
  inner join seccion s on s.Sec_Codigo = ra.Sec_Codigo
  inner join idioma i on s.Idi_Codigo = i.Idi_Codigo
  inner join nivel n on n.Niv_Codigo = s.Niv_Codigo
  inner join onota ono on ono.Reg_Codigo = ra.Reg_Codigo
  where a.Alu_NroDocumento = '{$_POST['dni']}'
  order by i.Idi_Nombre asc, n.Niv_Detalle asc, s.Sec_NroCiclo asc";

$resultado=$esclavo->query($sql);
if($resultado->num_rows >= 1){
while($row=$resultado->fetch_assoc()){ ?>
<tr>
  <td><?= $row['Mes_Codigo']; ?></td>
  <td><?= $row['Idi_Nombre']; ?></td>
  <td><?= $row['Niv_Detalle']; ?></td>
  <td><?= $row['Sec_NroCiclo']; ?></td>
  <td class="<?php if($row['not_Prom']>12){echo 'text-primary';}else{echo 'text-danger';} ?>"><?= str_pad($row['not_Prom'], 2, '0', STR_PAD_LEFT); ?></td>
</tr>
<?php }
}else{ ?>
<tr>
  <td colspan="5">Actualmente éste DNI, no tiene cursos registrados, comunícate con el área de registros del Centro de Idiomas UNCP, si consideras ésto un error.</td>
</tr>
<?php  }

?>
</tbody>

</table>
</div>