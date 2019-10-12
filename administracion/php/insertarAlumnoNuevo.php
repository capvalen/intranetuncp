<?php
date_default_timezone_set('America/Lima');
include "conexionInfocat.php";

$sqlVerificacion = "SELECT Alu_Codigo FROM `alumno` where Alu_NroDocumento='{$_POST['dni']}';";
//echo $sqlVerificacion;
$resultadoVerificacion = $esclavo->query($sqlVerificacion);
if($resultadoVerificacion->num_rows>0){
  //ya esta registrado
  echo "ya registrado";
}else{
  $sqlAluNew= "INSERT INTO `alumno`(`Alu_Codigo`, `Alu_Nombre`, `Alu_Apellido`, `Alu_Sexo`, `Alu_CentroLaboralEstudio`, `Alu_FacultadArea`, `Alu_Direccion`, `Alu_Telefono`, `Alu_Estado`, `Alu_TipoDocumento`, `Alu_NroDocumento`, `Alu_FechaNacimiento`, `Alu_Foto`, `Alu_Email`, `Alu_cuenta`)
  VALUES (proxIdAlumno(), '{$_POST['nombre']}', '{$_POST['apellido']}', {$_POST['sexo']}, null, '{$_POST['facultad']}', '', '', 'Activo', 'DNI', '{$_POST['dni']}', '{$_POST['fechanac']}',null,null, null); ";
  //echo $sqlAluNew;
  $respuestaAluNew=$cadena->multi_query($sqlAluNew);
  echo "todo ok";
}
?>