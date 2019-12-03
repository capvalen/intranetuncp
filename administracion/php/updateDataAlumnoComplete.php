<?php 
include 'conexionInfocat.php';
if($_POST['fNac']==''){ $fecha = date('Y-m-d');}else{ $fecha = $_POST['fNac']; }
$sql1 = "UPDATE `alumno` SET 
`Alu_Nombre`='{$_POST['nombre']}',
`Alu_Apellido`='{$_POST['apellidos']}',
`Alu_NroDocumento`='{$_POST['dni']}',
`Alu_FechaNacimiento`='{$fecha}',
`Alu_Sexo` = '{$_POST['sexo']}',
`idProcedencia` = '{$_POST['procedencia']}',
`Fac_Codigo` = '{$_POST['facultad']}',
`Alu_Direccion` = '{$_POST['direccion']}',
`Alu_Email` = '{$_POST['email']}',
`Alu_Telefono` = '{$_POST['celular']}'
where `Alu_Codigo` = '{$_POST['idAlu']}'; ";
//echo $sql1;
$respuestaSql = $cadena->query($sql1);

if($respuestaSql){
  echo "todo ok";
}else{
  echo "error";
}
?>