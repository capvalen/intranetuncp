<?php
include 'conexionInfocat.php';

$sql="INSERT INTO `prematricula`(`id`, `Alu_Codigo`, `Idi_Codigo`, `Niv_Codigo`, `Sec_NroCiclo`, `idHorario`, `motivo`, `periodo`) VALUES 
(null, '{$_POST['idAlu']}', '{$_POST['idioma']}', '{$_POST['nivel']}', {$_POST['ciclo']}, {$_POST['horario']}, '{$_POST['motivo']}', '')";
//echo $sql;
if($resultado=$esclavo->query($sql)){
  echo "todo ok";
}else{
  echo "error";
}

?>