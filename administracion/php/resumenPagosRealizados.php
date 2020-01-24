<?php

include 'conexionInfocat.php';

$filas =[];
$sql="SELECT dp.*, e.Emp_Apellido, e.Emp_Nombre FROM `detallepago` dp
inner join empleado e on e.Emp_Codigo = dp.idEmpleado
 where reg_Codigo='{$_POST['codReg']}'; ";
$resultado=$cadena->query($sql); $i=0;
while($row=$resultado->fetch_assoc()){ 
	$filas[$i]=$row;
	$i++;
}
echo json_encode($filas);
?>