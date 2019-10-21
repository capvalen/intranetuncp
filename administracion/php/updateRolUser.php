<?php 
include 'conexionInfocat.php';
$sql1 = "UPDATE `usuario` SET `Rol_Id` = '{$_POST['rol']}' WHERE `usuario`.`Emp_Codigo` = '{$_POST['usuario']}'; ";
//echo $sql1;
$respuestaSql = $cadena->query($sql1);

if($respuestaSql){
  echo "todo ok";
}else{
  echo "error";
}
?>