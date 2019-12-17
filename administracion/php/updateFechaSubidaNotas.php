<?php 

include 'conexionInfocat.php';

$sql="UPDATE `configuraciones` SET `ultAnio` = '{$_POST['anio']}', `ultMes` = '{$_POST['mes']}', `fechaMaximaUpload` = '{$_POST['fecha']}' WHERE `configuraciones`.`idConfiguraciones` = 1;
";
if($resultado=$cadena->query($sql)){
  echo "todo ok";
}else{
  echo 'error';
}

?>