<?php
unset($_COOKIE['ckAtiende']);
unset($_COOKIE['ckPower']);
unset($_COOKIE['ckidUsuario']);
unset($_COOKIE['cknomCompleto']);

setcookie('ckAtiende', "", time() - 3600, '/');
setcookie('ckPower', "", time() - 3600, '/');
setcookie('ckidUsuario', "", time() - 3600, '/');
setcookie('cknomCompleto', "", time() - 3600, '/');
header("location: ../index.php");
?>