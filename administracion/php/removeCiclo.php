<?php 
include 'conexionInfocat.php';
$sql1 = "DELETE FROM `seccion` WHERE `seccion`.`Sec_Codigo` = '{$_POST['registro']}'; ";
//echo $sql1;
if($respuestaSql = $cadena->query($sql1)){
 echo "todo ok";
}else{
  echo "error";
}



 ?>