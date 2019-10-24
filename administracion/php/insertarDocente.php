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
  $sqlAluNew= "INSERT INTO `empleado`(`Emp_Codigo`, `Emp_Nombre`, `Emp_Apellido`, `Emp_Sexo`, `Emp_FechaNacimiento`, `Emp_Direccion`, `Emp_Nacionalidad`, `Emp_Telefono`, `Emp_TipoDocumento`, `Emp_NroDocumento`, `Emp_email`, `Emp_Estado`, `Emp_Foto`, `Emp_Trato`, `Emp_cuenta`, `pwd`)
  VALUES (proxIdDocente('{$_POST['apellido']}', '{$_POST['nombre']}'), '{$_POST['nombre']}', '{$_POST['apellido']}', 0, null, 'No registró', 'Ninguna', '', 'DNI', '{$_POST['dni']}', '', 'Activo',null,null, null, '{$_POST['dni']}'); ";
  //echo $sqlAluNew;
  if($respuestaAluNew=$cadena->query($sqlAluNew)){
    echo "todo ok";
  }else{
    echo "error";
  }
}
?>