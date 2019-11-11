<?php
date_default_timezone_set('America/Lima');
include "conexionInfocat.php";

$sqlVerificacion = "SELECT Emp_Codigo FROM `empleado` where Emp_NroDocumento='{$_POST['dni']}';";
//echo $sqlVerificacion;
$resultadoVerificacion = $esclavo->query($sqlVerificacion);
if($resultadoVerificacion->num_rows>0){
  //ya esta registrado
  echo "ya registrado";
}else{
  $sqlQueID= "SELECT proxIdDocente('{$_POST['apellido']}', '{$_POST['nombre']}') as id";
  $respuestaQueID = $esclavo -> query($sqlQueID);
  $rowQueID = $respuestaQueID -> fetch_assoc();
  $queId = $rowQueID['id'];

  $sqlAluNew= "INSERT INTO `empleado`(`Emp_Codigo`, `Emp_Nombre`, `Emp_Apellido`, `Emp_Sexo`, `Emp_FechaNacimiento`, `Emp_Direccion`, `Emp_Nacionalidad`, `Emp_Telefono`, `Emp_TipoDocumento`, `Emp_NroDocumento`, `Emp_email`, `Emp_Estado`, `Emp_Foto`, `Emp_Trato`, `Emp_cuenta`, `pwd`)
  VALUES (  '{$queId}' , '{$_POST['nombre']}', '{$_POST['apellido']}', 0, null, 'No registró', 'Ninguna', '', 'DNI', '{$_POST['dni']}', '', 'Activo',null,null, null, '{$_POST['dni']}'); 
  
  INSERT INTO `usuario`(`Emp_Codigo`, `Usu_Descripcion`, `Usu_Pasword`, `Rol_Id`, `Suc_Codigo`, `usuActivo`) 
  VALUES ('{$queId}', concat( SUBSTRING('{$_POST['nombre']}', 1, 1), replace('{$_POST['apellido']}', ' ', '')), 'algo', 112 , 'SUC001', 1);
  ";
  
  $respuestaAluNew=$cadena->multi_query($sqlAluNew);
  //echo $queId;

  echo $sqlAluNew;
  if($respuestaAluNew){
    echo "todo ok";
  }else{
    echo "error";
  }
}
?>