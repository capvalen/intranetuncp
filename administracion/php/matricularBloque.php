<?php 

date_default_timezone_set('America/Lima');
include "conexionInfocat.php";

$ids = $_POST['idsPrematriculados'];
$sqlPagos='';
for ($i=0; $i < count($ids) ; $i++) { 
	//echo $ids[$i]['idAlu']."\n";
	$sqlVerificacion = "SELECT Reg_Codigo FROM `registroalumno` where Reg_Codigo ='".$_POST['codSec']. $ids[ $i ]['idAlu']."' and Alu_Codigo ='{$ids[ $i ]['idAlu']}';";
	//echo $sqlVerificacion;
	$respuestaVerificacion = $esclavo -> query($sqlVerificacion);
	if($respuestaVerificacion -> num_rows==1){
		//echo "ya existe"."\n";
		$sqlPagos = $sqlPagos. " UPDATE `prematricula` SET `atendido` = b'1' WHERE `prematricula`.`id` = {$ids[ $i ]['idReg']};";
	}else{
		//echo "no existe"."\n";

		$sqlPagos = $sqlPagos. "INSERT INTO `registroalumno` (`Reg_Codigo`, `Alu_Codigo`, `Sec_Codigo`, `AlSe_Condicion`, `Reg_EstadoFinal`, `Reg_MontoPension`)
			SELECT '".$_POST['codSec'].$ids[ $i ]['idAlu']."', '{$ids[ $i ]['idAlu']}', '{$_POST['codSec']}', 'Normal', 'Deudor', returnPensionCurso( s.idi_Codigo, s.Niv_Codigo) as pension
			FROM `seccion` s where  s.Sec_Codigo = '{$_POST['codSec']}';
			INSERT INTO `onota`(`Reg_Codigo`, `Apellidos_y_Nombres`, `not_1`, `not_2`, `not_3`, `not_Prom`) 
			SELECT '".$_POST['codSec'].$ids[ $i ]['idAlu']."', concat(a.Alu_Apellido, ' ', a.Alu_Nombre), 0,0,0,0 from alumno a where a.Alu_Codigo = '{$ids[ $i ]['idAlu']}';
			UPDATE `prematricula` SET `atendido` = b'1' WHERE `prematricula`.`id` = {$ids[ $i ]['idReg']};";
		
	}
		
}
//echo $sqlPagos;
if($sqlPagos<>''){
	if($respuestaPagos=$cadena->multi_query($sqlPagos)){
		echo "todo ok";
	}
}else{
	echo "posible error";
}
?>