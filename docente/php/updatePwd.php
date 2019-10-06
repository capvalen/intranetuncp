<?php 
include 'conexionInfocat.php';
$sql1 = "UPDATE `empleado` SET `pwd`='{$_POST['pwd']}' WHERE `Emp_Codigo`= '{$_COOKIE['ckidUsuario']}' ;";
//echo $sql1;
$respuestaSql = $cadena->query($sql1);

if($respuestaSql = $cadena->query($sql1)){
  echo "todo ok";
}


 ?>