<?php
date_default_timezone_set('America/Lima');
include "conexionInfocat.php";

$anio = substr(Date('Y'), -2);

$sqlPagos= "DELETE FROM `detallepago` WHERE `detallepago`.`Cod_DetPag` = '{$_POST['pago']}' ; ";
//echo $sqlPagos;
$respuestaPagos=$cadena->query($sqlPagos);

echo "todo ok";
?>