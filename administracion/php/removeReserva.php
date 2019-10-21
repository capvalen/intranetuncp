<?php 
include 'conexionInfocat.php';
$sql1 = "DELETE FROM `registroalumno` WHERE Reg_Codigo = '{$_POST['reg']}'; ";
//echo $sql1;
if($respuestaSql = $cadena->query($sql1)){
 echo "todo ok";
}else{
  echo "error";
}



 ?>