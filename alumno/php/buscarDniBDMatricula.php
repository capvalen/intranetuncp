<?php 
include 'conexionInfocat.php';

$filas = [];

$sqlVerificar="SELECT * FROM `alumno` 
where trim(Alu_NroDocumento) = '{$_POST['dni']}'; ";
//echo $sqlVerificar;

$resultadoVerificar=$esclavo->query($sqlVerificar);
while($rowVerificar=$resultadoVerificar->fetch_assoc()){ 
  $filas[] = $rowVerificar;
}

echo json_encode($filas);
?>