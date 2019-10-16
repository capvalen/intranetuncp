<?php
date_default_timezone_set('America/Lima');
include "conexionInfocat.php";

$anio = substr(Date('Y'), -2);

$sqlPagos= "INSERT INTO `detallepago`(`Cod_DetPag`, `reg_Codigo`, `Cod_Recibo`, `Pag_Codigo`, `Monto_Pagado`) VALUES
 (proxIdPagos(), '{$_POST['reg']}', '{$_POST['recibo']}', '{$_POST['pagCod']}', {$_POST['monto']} );
 UPDATE `registroalumno` SET 
`AlSe_Condicion`='{$_POST['motivo']}'
where `Reg_Codigo` = '{$_POST['reg']}'; ";
//  echo $sqlPagos;
$respuestaPagos=$cadena->multi_query($sqlPagos);
echo "todo ok";

?>