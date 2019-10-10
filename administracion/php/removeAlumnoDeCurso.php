<?php 
include 'conexionInfocat.php';

$sql1 = "DELETE FROM `onota` WHERE `onota`.`Reg_Codigo` = '{$_POST['rege']}';
DELETE FROM `registroalumno` WHERE `Reg_Codigo`= '{$_POST['rege']}'; ";
//echo $sql1;
if($respuestaSql = $cadena->multi_query($sql1)){
  echo "todo ok";
} 
?>