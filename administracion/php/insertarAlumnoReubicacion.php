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
    SELECT '".$_POST['codSec'].$_POST['codAlu']."', '{$_POST['codAlu']}', '{$_POST['codSec']}', 'Examen {$_POST['tipoProceso']}', 'Deudor', returnPensionCurso( s.idi_Codigo, s.Niv_Codigo) as pension
    FROM `seccion` s where  s.Sec_Codigo = '{$_POST['codSec']}';
  INSERT INTO `onota`(`Reg_Codigo`, `Apellidos_y_Nombres`, `not_1`, `not_2`, `not_3`, `not_Prom`) 
    SELECT '".$_POST['codSec'].$_POST['codAlu']."', concat(a.Alu_Apellido, ' ', a.Alu_Nombre), 0,0,0,0 from alumno a where a.Alu_Codigo = '{$_POST['codAlu']}'; 
  INSERT INTO `detallepago`(`Cod_DetPag`, `reg_Codigo`, `Cod_Recibo`, `Pag_Codigo`, `Monto_Pagado`) VALUES
 (proxIdPagos(), '{$_POST['codSec']}{$_POST['codAlu']}', '{$_POST['codAlu']} {$_POST['tipoProceso']}: {$_POST['idiomaC']} Prom. {$_POST['calificacion']}', '{$_POST['tipoProceso']}', '0.00' ); ";
    //echo $sqlPagos;
  $respuestaPagos=$cadena->multi_query($sqlPagos);
  echo "todo ok";
}
?>