<?php 
include 'conexionInfocat.php';
$sql1 = "UPDATE `usuario` SET `Usu_Pasword` = '{$_POST['clave']}' WHERE `usuario`.`Emp_Codigo` = '{$_POST['idEmpleado']}';";
//echo $sql1;
$respuestaSql = $cadena->query($sql1);

if($respuestaSql){
  echo "todo ok";
}else{
  echo "error";
}
?>