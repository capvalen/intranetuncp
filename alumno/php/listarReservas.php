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
          <th>Código</th>
          <th>Periodo</th>
          <th>Sucursal</th>
          <th>Idioma</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>     
<?php
$sql="SELECT s.Mes_Codigo , i.Idi_Nombre, lower(a.Alu_Nombre) as Alu_Nombre, lower(a.Alu_Apellido) as Alu_Apellido, su.sucDescripcion, ra.Reg_Codigo, lower(AlSe_Condicion) as AlSe_Condicion
FROM `registroalumno` ra
  inner join alumno a on a.Alu_Codigo = ra.Alu_Codigo
  inner join seccion s on s.Sec_Codigo = ra.Sec_Codigo
  inner join idioma i on s.Idi_Codigo = i.Idi_Codigo
  inner join nivel n on n.Niv_Codigo = s.Niv_Codigo
  inner join sucursal su on su.Suc_Codigo = s.Suc_Codigo
  where a.Alu_NroDocumento = '{$_POST['dni']}' and s.Hor_Codigo=0
  order by i.Idi_Nombre asc, n.Niv_Detalle asc, s.Sec_NroCiclo asc; ";
 
$resultado=$esclavo->query($sql);
if($resultado->num_rows >= 1){
while($row=$resultado->fetch_assoc()){ ?>
<tr>
  <td class="text-capitalize"><?= $row['Reg_Codigo']; ?></td>
  <td class="text-capitalize"><?= $row['Mes_Codigo']; ?></td>
  <td class="text-capitalize"><?= $row['sucDescripcion']; ?></td>
  <td class="text-capitalize"><?= $row['Idi_Nombre']; ?></td>
  <td class="text-capitalize"><?= $row['AlSe_Condicion']; ?></td>
</tr>
<?php }
}else{ ?>
<tr>
  <td colspan="5">Actualmente con éste DNI, no existen reservas de matrículas, comunícate con el área de registros del Centro de Idiomas UNCP, si consideras ésto un error.</td>
</tr>
<?php  }

?>
</tbody>

</table>
</div>