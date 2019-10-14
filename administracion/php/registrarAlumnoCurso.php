<?php
date_default_timezone_set('America/Lima');
include "conexionInfocat.php";

$sqlVerificacion = "SELECT Reg_Codigo FROM `registroalumno` where Reg_Codigo ='".$_POST['codSec'].$_POST['codAlu']."' and Alu_Codigo ='{$_POST['codAlu']}';";
//echo $sqlVerificacion;
$resultadoVerificacion = $esclavo->query($sqlVerificacion);
if($resultadoVerificacion->num_rows>0){
  //ya esta registrado
  echo "ya registrado";
}else{
  $sqlPagos= "INSERT INTO `registroalumno` (`Reg_Codigo`, `Alu_Codigo`, `Sec_Codigo`, `AlSe_Condicion`, `Reg_EstadoFinal`, `Reg_MontoPension`)
  SELECT '".$_POST['codSec'].$_POST['codAlu']."', '{$_POST['codAlu']}', '{$_POST['codSec']}', Condicion, 'Deudor', calcPagoPension('{$_POST['idIdioma']}', '{$_POST['idNivel']}', {$_POST['idDscto']}) from condicionalumno where idcondicion = {$_POST['idDscto']} ;
    
  INSERT INTO `onota`(`Reg_Codigo`, `Apellidos_y_Nombres`, `not_1`, `not_2`, `not_3`, `not_Prom`) 
  SELECT '".$_POST['codSec'].$_POST['codAlu']."', concat( `Alu_Apellido`, ' ', `Alu_Nombre`), 0, 0, 0, 0 FROM  alumno where Alu_Codigo = '{$_POST['codAlu']}';
   ";
  //echo $sqlPagos;
  $respuestaPagos=$cadena->multi_query($sqlPagos);
  echo "todo ok";
}





?>