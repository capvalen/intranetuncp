<?php 
include 'conexionInfocat.php';
$sql1 = "UPDATE `mesacademico` SET `Mes_Inicio`='{$_POST['fechaIni']}', `Mes_Fin`='{$_POST['fechaFin']}',`Mes_Detalle`='{$_POST['detalle']}', `Mes_MidExam`='{$_POST['fechaMid']}' WHERE `Mes_Codigo`= '{$_POST['idCiclo']}';";
//echo $sql1;
$respuestaSql = $cadena->query($sql1);

$fecha = new DateTime($_POST['fechaIni']);
echo $fecha -> format('Y');


 ?>