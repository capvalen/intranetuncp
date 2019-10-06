<?php 
include 'conexionInfocat.php';


$sqlParametros ='';
if($_POST['datos'][0]['fecha']<>''){  $sqlParametros .="`Emp_FechaNacimiento`= '{$_POST['datos'][0]['fecha']}',"; }
if($_POST['datos'][1]['celular']<>''){  $sqlParametros .="`Emp_Telefono`='{$_POST['datos'][1]['celular']}',"; }
if($_POST['datos'][2]['correo']<>''){  $sqlParametros .="`Emp_email`='{$_POST['datos'][2]['correo']}',"; }


$sql1 = "UPDATE `empleado` SET 
".substr($sqlParametros, 0, -1)."
WHERE `Emp_Codigo`='{$_COOKIE['ckidUsuario']}' ;";
//echo $sql1;
if($respuestaSql = $cadena->query($sql1)){
  echo "todo ok";
}


 ?>