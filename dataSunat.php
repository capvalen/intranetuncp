<?php
$hoy=date('Y-m-d');
$fechaInicial = date('Y-m-d', strtotime("2019-04-05"));
$fechaFinal = date('Y-m-d', strtotime("2020-08-05"));

if (($hoy >= $fechaInicial) && ( $hoy <= $fechaFinal))
{
	//$json = file_get_contents("https://api.sunat.cloud/ruc/{$_GET['ruc']}");
	$json = file_get_contents("https://infocatsoluciones.com/app/sunat/demo.php?ruc={$_GET['ruc']}");
	$obj = json_decode($json);
	//echo $obj->access_token;
	//var_dump($obj->ruc);
	echo json_encode($obj);
}else{
	echo "[]";
}


?>
