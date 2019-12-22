<?php
include "conexionInfocat.php";
$sqlVerificar = "SELECT Alu_Codigo, lower(concat(Alu_Apellido, ' ', Alu_Nombre)) as nombres FROM `alumno`
where Alu_NroDocumento ='{$_POST['dni']}'; ";
$filas = [];
$respuestaVerificar = $cadena->query($sqlVerificar);
if($respuestaVerificar->num_rows>0){
  $filas[0] = array('resp' => 'ya registrado'); $i=1;
  while($rowVerificar = $respuestaVerificar->fetch_assoc()){
    $filas[$i] = array('codigo' => $rowVerificar['Alu_Codigo'], 'nombres' => $rowVerificar['nombres'] );
    $i++;
  }
  
}else{
  $filas[0] = array('resp' => 'vacio');
  /* $api= file_get_contents("http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI=".$_POST['dni']);
  $data= explode('|', $api);*/

 /*  $url = 'http://www.dayangels.com/api/reniec/';
	$ch = curl_init($url);
	
	 $token = array(
            "user" => "carlos98",
						"pass" => "pariona10",
						"dni" => $_POST['dni']
        );
	$json = json_encode($token);
	
	//enviamos el json
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

	//especificamos el tipo de contenido a enviar
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

	//devolver respuesta en lugar de generar
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	//ejecuta la peticion post
	$resultado = curl_exec($ch);

	$respuesta = json_decode($resultado);
	
	$data = array($respuesta->paterno, $respuesta->materno, $respuesta->nombres);
	
  curl_close($ch); */
  
  //echo json_encode($data);
}
echo json_encode($filas);

?>