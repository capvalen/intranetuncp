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
  SELECT '".$_POST['codSec'].$_POST['codAlu']."', '{$_POST['codAlu']}', '{$_POST['codSec']}', 'Normal', 'Deudor', nxi_Pension from nivelxidioma where idi_Codigo ='{$_POST['idIdioma']}' and Niv_Codigo='{$_POST['idNivel']}' ;
   ";
    //echo $sqlPagos;
  $respuestaPagos=$cadena->query($sqlPagos);
  echo "todo ok";
}





?>