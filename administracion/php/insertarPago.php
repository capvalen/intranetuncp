<?php
date_default_timezone_set('America/Lima');
include "conexionInfocat.php";

$anio = substr(Date('Y'), -2);

$sqlPagos= "INSERT INTO `detallepago`(`Cod_DetPag`, `reg_Codigo`, `Cod_Recibo`, `Pag_Codigo`, `Monto_Pagado`) VALUES
 (proxIdPagos(), '{$_POST['reg']}', '{$_POST['recibo']}', '{$_POST['pagCod']}', {$_POST['monto']} ); ";
 // echo $sqlPagos;
$respuestaPagos=$cadena->query($sqlPagos);
echo "todo ok";

?>