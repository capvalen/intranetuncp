<?php
$server="localhost";

/* Net	*/
$username="root";
$password="*123456*";
$db = "uncp";

$esclavo= new mysqli($server, $username, $password, $db);
$esclavo->set_charset("utf8");

$pendiente= new mysqli($server, $username, $password, $db);
$pendiente->set_charset("utf8");

?>