<?php 
// ini_set("session.cookie_lifetime","7200");
// ini_set("session.gc_maxlifetime","7200");
//session_start();
//header('Content-Type: text/html; charset=utf8');
include 'conexionInfocat.php';
$local="/";

$sqlCons= "SELECT lower(Emp_Nombre) as Emp_Nombre, e.Emp_Codigo, concat(lower(Emp_Apellido), ', ', lower(Emp_Nombre)) as nomCompleto, Emp_Estado FROM `usuario` u
inner join empleado e on e.Emp_Codigo= u.Emp_Codigo where Usu_Descripcion = '{$_POST['user']}' and Usu_Pasword = '{$_POST['pws']}'; ";
$log = mysqli_query($cadena, $sqlCons);
//echo $sqlCons;
$row = mysqli_fetch_array($log, MYSQLI_ASSOC);
if ($log->num_rows>0){
	if( $row['Emp_Estado']=='Activo' ){
		$expira=time()+60*60*3; //cookie para 3 horas
		
		setcookie('ckAtiende', $row['Emp_Nombre'], $expira, $local);
		setcookie('cknomCompleto', $row['nomCompleto'] , $expira, $local);
		setcookie('ckPower', 105, $expira, $local); //$row['usuPoder']
		setcookie('ckidUsuario', $row['Emp_Codigo'], $expira, $local);
		
	
		echo 'concedido';
	}else{
		echo 'inhabilitado';
	}
	
	//echo $row['idUsuario'];
	
}else{
	echo 'nada';
}
/* liberar la serie de resultados */
mysqli_free_result($log);
/* cerrar la conexión */
mysqli_close($cadena);
?>