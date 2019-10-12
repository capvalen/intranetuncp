<?php
include "conexionInfocat.php";
$sqlVerificar = "SELECT Alu_Codigo as contador FROM `alumno`
where Alu_NroDocumento ='{$_POST['dni']}'; ";
$respuestaVerificar = $cadena->query($sqlVerificar);
if($respuestaVerificar->num_rows>0){
  echo "ya registrado";
}else{
  $api= file_get_contents("http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI=".$_POST['dni']);
  $data= explode('|', $api);
  echo json_encode($data);
}


?>