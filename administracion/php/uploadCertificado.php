<?php

include "conexionInfocat.php";

$codigo = $_POST['idAlumno'];

if(!empty($_FILES)){
 if(is_uploaded_file($_FILES['txtSubirPDF']['tmp_name'])){
  //sleep(1);
  $exptension = explode(".", $_FILES['txtSubirPDF']['name']);
  $nombreArhivo = time().'.'.end($exptension);
  $source_path = $_FILES['txtSubirPDF']['tmp_name'];
  $objetivo_path = '../certificados/' . $nombreArhivo;
  if(move_uploaded_file($source_path, $objetivo_path)){
   //echo '<img src="'.$target_path.'" class="img-thumbnail" width="300" height="250" />';
   $sql="UPDATE `alumno` SET `aluCertificado`='{$nombreArhivo}' WHERE `Alu_Codigo` = '{$codigo}' ";
   
   $resultado=$cadena->query($sql);
  }
 }

echo $codigo;
}else{
  echo "vacio";
}

?>