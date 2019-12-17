<?php
include 'conexionInfocat.php';
$motivo  = $_POST['motivo'];
if( $motivo ==' con nota ' ){ $motivo = 'Nuevo alumno en el curso'; }

$sql="INSERT INTO `prematricula`(`id`, `Alu_Codigo`, `Idi_Codigo`, `Niv_Codigo`, `Sec_NroCiclo`, `idHorario`, `motivo`, `periodo`, `Suc_Codigo`) VALUES 
(null, '{$_POST['idAlu']}', '{$_POST['idioma']}', '{$_POST['nivel']}', {$_POST['ciclo']}, {$_POST['horario']}, '{$motivo}', '{$_POST['periodo']}', '{$_POST['sucursal']}')";
//echo $sql;
if($resultado=$esclavo->query($sql)){
  echo "todo ok";
}else{
  echo "error";
}

?>