<?php 
include 'conexionInfocat.php';
$sql1 = "UPDATE `empleado` SET `Emp_displayWeb` = b'0' WHERE `empleado`.`Emp_Codigo` = '{$_POST['idDocente']}';";
//echo $sql1;
$respuestaSql = $cadena->query($sql1);

if($respuestaSql){
  echo "todo ok";
}else{
  echo "error";
}
?>