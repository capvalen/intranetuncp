<?php 
include "conexionInfocat.php";

$filas = [];
$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

$hoy = date('Y-m-d');

$sqlConfig="SELECT * FROM `configuraciones` where 1";
$resultadoConfig=$esclavo->query($sqlConfig);
$rowConfig=$resultadoConfig->fetch_assoc();

$periodo = str_pad( $rowConfig['ultMes'], 2, '0', STR_PAD_LEFT) . $rowConfig['ultAnio']  ;
$periodoAmigable  = $meses[ $rowConfig['ultMes'] ] . ' '  . $rowConfig['ultAnio'];
 


?>