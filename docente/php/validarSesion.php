<?php 
// ini_set("session.cookie_lifetime","7200");
// ini_set("session.gc_maxlifetime","7200");
//session_start();
//header('Content-Type: text/html; charset=utf8');
include 'conexionInfocat.php';

$local="/";

$sqlCons= "SELECT Emp_Codigo, concat(lower(Emp_Apellido), ', ',lower(Emp_Nombre)) as nomCompleto, lower(Emp_Nombre) as Emp_Nombre, lower(trim(Emp_Estado)) as Emp_Estado  FROM `empleado` where Emp_NroDocumento = '{$_POST['user']}' and pwd = '{$_POST['pws']}'; ";
//echo $sqlCons;
$respuestaCons = $cadena->query($sqlCons);
$rowCons = $respuestaCons->fetch_assoc();

if ($respuestaCons->num_rows>0){
	if( $rowCons['Emp_Estado']=='activo' ){
		$expira=time()+60*60*3; //cookie para 3 horas
		
		setcookie('ckAtiende', $rowCons['Emp_Nombre'], $expira, $local);
		setcookie('cknomCompleto', $rowCons['nomCompleto'] , $expira, $local);
		setcookie('ckPower', 105, $expira, $local); //$rowCons['usuPoder']
		setcookie('ckidUsuario', $rowCons['Emp_Codigo'], $expira, $local);
		
	
		echo 'concedido';
	}else{
		echo 'inhabilitado';
	}
	
	//echo $rowCons['idUsuario'];
	
}else{
	echo 'nada';
}
/* liberar la serie de resultados */
mysqli_free_result($log);
/* cerrar la conexión */
mysqli_close($cadena);
?>