<?php 
include 'conexionInfocat.php';
if($_POST['fNac']==''){ $fecha = date('Y-m-d');}else{ $fecha = $_POST['fNac']; }
$sql1 = "UPDATE `alumno` SET 
`Alu_Nombre`='{$_POST['nombre']}',
`Alu_Apellido`='{$_POST['apellidos']}',
`Alu_NroDocumento`='{$_POST['dni']}',
`Alu_FechaNacimiento`='{$fecha}'
where `Alu_Codigo` = '{$_POST['idAlu']}'; ";
//echo $sql1;
$respuestaSql = $cadena->query($sql1);

if($respuestaSql){
  echo "todo ok";
}else{
  echo "error";
}
?>