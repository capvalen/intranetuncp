<?php 
include 'conexionInfocat.php';
if($_POST['fNac']==''){ $fecha = date('Y-m-d');}else{ $fecha = $_POST['fNac']; }
$sql1 = "UPDATE `empleado` SET 
`Emp_Nombre`='{$_POST['nombre']}',
`Emp_Apellido`='{$_POST['apellidos']}',
`Emp_NroDocumento`='{$_POST['dni']}',
`Emp_FechaNacimiento`='{$fecha}',
`Emp_Sexo` = '{$_POST['sexo']}',
`Emp_Direccion` = '{$_POST['direccion']}',
`Emp_Email` = '{$_POST['email']}',
`Emp_Telefono` = '{$_POST['celular']}'
where `Emp_Codigo` = '{$_POST['idDoc']}'; ";
//echo $sql1;
$respuestaSql = $cadena->query($sql1);

if($respuestaSql){
  echo "todo ok";
}else{
  echo "error";
}
?>