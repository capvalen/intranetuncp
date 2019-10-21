<?php 
include 'conexionInfocat.php';
$sql1 = "UPDATE `usuario` SET `Suc_Codigo` = '{$_POST['sede']}' WHERE `usuario`.`Emp_Codigo` = '{$_POST['usuario']}'; ";
//echo $sql1;
$respuestaSql = $cadena->query($sql1);

if($respuestaSql){
  echo "todo ok";
}else{
  echo "error";
}
?>