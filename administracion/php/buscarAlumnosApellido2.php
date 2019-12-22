<?php
include 'conexionInfocat.php';

$sql="SELECT `Alu_Codigo`, lower(`Alu_Nombre`) as Alu_Nombre, lower(`Alu_Apellido`) as Alu_Apellido, `Alu_NroDocumento` FROM `alumno` 
where concat(Alu_Apellido, ' ',Alu_Nombre) like concat('{$_POST['texto']}','%') order by Alu_Apellido, Alu_Nombre asc  ;";
//echo $sql;
$i=1;
$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<tr>
    <td><?= $i;?></td>
    <td class="text-capitalize"><a href="seguimiento.php?<?php if( $row['Alu_NroDocumento']=='' ){echo 'patron='.$row['Alu_Codigo']; }else{ echo "cursor=".$row['Alu_NroDocumento']; } ?>"><?= $row['Alu_Apellido']. " ". $row['Alu_Nombre'];?></a></td>
    <td><?= $row['Alu_NroDocumento'];?></td>
    <td></td>
</tr>
<?php $i++; }


?>