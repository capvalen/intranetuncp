<?php
$server="localhost";

/* Net	*/
$username="root";
$password="*123456*";
$db = "uncp";

$cadena= mysqli_connect($server,$username,$password)or die("No se ha podido establecer la conexion");
$sdb= mysqli_select_db($cadena,$db)or die("La base de datos no existe");
$cadena->set_charset("utf8");
mysqli_set_charset($cadena,"utf8");

$esclavo= new mysqli($server, $username, $password, $db);
$esclavo->set_charset("utf8");

$apoyo= new mysqli($server, $username, $password, $db);
$apoyo->set_charset("utf8");

?>