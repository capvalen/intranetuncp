<?php 
include 'conexionInfocat.php';
$sql1 = "UPDATE `usuario` SET `usuActivo` = '0' WHERE `usuario`.`Emp_Codigo` = '{$_POST['idEmpleado']}';";
//echo $sql1;
$respuestaSql = $cadena->query($sql1);

if($respuestaSql){
  echo "todo ok";
}else{
  echo "error";
}
?>