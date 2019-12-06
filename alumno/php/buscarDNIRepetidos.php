<?php
include 'conexionInfocat.php';

$sql="SELECT `Alu_Codigo`, `Alu_Nombre`, `Alu_Apellido`, `Alu_NroDocumento` FROM `alumno` 
where trim(`Alu_NroDocumento`) like '{$_POST['texto']}%'
order by Alu_Apellido, Alu_Nombre asc;";
//echo $sql;
$i=1;
$resultado=$esclavo->query($sql);
if($resultado -> num_rows>=1){
while($row=$resultado->fetch_assoc()){ ?>
<tr>
    <td><?= $i;?></td>
    <td><?= $row['Alu_NroDocumento'];?></td>
    <td><a class="text-capitalize" href="#!" onClick="mostrarData('<?= $row['Alu_Codigo']; ?>')" ><?= $row['Alu_Apellido']. " ". $row['Alu_Nombre'];?></a></td>
    <td></td>
</tr>
<?php $i++; }
}
else{ ?>
<tr>
    <td colspan='3'>No hay coincidencias</td>
</tr>
<?php }

?>