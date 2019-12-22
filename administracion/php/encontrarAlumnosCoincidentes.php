<?php
include 'conexionInfocat.php';

$sql="SELECT `Alu_Codigo`, lower(`Alu_Nombre`) as Alu_Nombre, lower(`Alu_Apellido`) as Alu_Apellido, `Alu_NroDocumento` FROM `alumno` 
where Alu_NroDocumento='{$_POST['texto']}' or concat(Alu_Apellido, ' ',Alu_Nombre)  like concat('{$_POST['texto']}','%') order by Alu_Apellido, Alu_Nombre asc  ;";
//echo $sql;
$filas=array();
$i=0;

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){
    $filas[$i]= $row;
    $i++;
}
echo json_encode($filas);

?>