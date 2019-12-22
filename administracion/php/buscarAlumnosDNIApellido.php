<?php
include 'conexionInfocat.php';

$sql="SELECT `Alu_Codigo`, lower(`Alu_Nombre`) as Alu_Nombre, lower(`Alu_Apellido`) as Alu_Apellido, `Alu_NroDocumento` FROM `alumno` 
where Alu_NroDocumento = '{$_POST['texto']}' or concat(Alu_Apellido, ' ',Alu_Nombre) like concat('{$_POST['texto']}','%') order by Alu_Apellido, Alu_Nombre asc  ;";
echo $sql;
$i=1;
$resultado=$cadena->query($sql);
if($resultado->num_rows >0 ){
while($row=$resultado->fetch_assoc()){ ?>
<tr>
    <td><?= $i;?></td>
    <td class="text-capitalize"><a href="alumnos.php?cursor=<?=  $row['Alu_Codigo']; ?>"><?= $row['Alu_Apellido']. ", ". $row['Alu_Nombre'];?></a></td>
    <td><a href="alumnos.php?cursor=<?=  $row['Alu_Codigo']; ?>"><?= $row['Alu_NroDocumento'];?></a></td>
    <td><a class="btn btn-outline-primary btn-sm" href="alumnos.php?cursor=<?=  $row['Alu_Codigo']; ?>" role="button"><i class="icofont-chart-pie-alt"></i></a></td>
</tr>
<?php $i++; }
}else{ ?>
<tr>
  <td colspan="4">No hay coincidenias con el campo <strong><?=$_POST['texto']; ?></strong></td>
</tr>  
<?php }

?>