<?php 
include 'conexionInfocat.php';
$sql1 = "UPDATE `prematricula` SET `atendido` = b'1' WHERE `prematricula`.`id` = {$_POST['idPre']}; ";
//echo $sql1;
$respuestaSql = $cadena->query($sql1);

if($respuestaSql){
  echo "todo ok";
}else{
  echo "error";
}
?>