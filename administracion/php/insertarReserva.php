<?php 
include 'conexionInfocat.php';

$idSecc = "RESERVAMATR{$_POST['idioma']}{$_POST['mes']}".substr($_POST['anio'], -2);
$sqlSeccion = "SELECT Sec_Codigo from seccion where Sec_Codigo = '{$idSecc}'; ";
$resultadoSeccion = $esclavo->query($sqlSeccion);

$fecha = date('d').'/'.date('m').'/'.date('Y');
// echo $sqlSeccion;
if($resultadoSeccion->num_rows == 0){

  $codCiclo = "INSERT INTO `seccion`(`Sec_Codigo`, `Idi_Codigo`, `Niv_Codigo`, `Hor_Codigo`, `Sec_Aula`, `Emp_Codigo`, `Sec_FechaIni`, `Sec_FechaFin`, `Sec_Seccion`, `Sec_NroCiclo`, `Sec_Detalle`, `Mes_Codigo`, `Suc_Codigo`, `Sec_fechactualiza`)
  VALUES ('{$idSecc}', '{$_POST['idioma']}', 'TN', 0, null, '000000', null, null, 'X', 0, 'Habilitado', '{$_POST['mes']}{$_POST['anio']}', '{$_POST['sucursal']}', null );
  
  INSERT INTO `registroalumno`(`Reg_Codigo`, `Alu_Codigo`, `Sec_Codigo`, `AlSe_Condicion`, `Reg_EstadoFinal`, `Reg_MontoPension`) VALUES 
  ('{$idSecc}{$_POST['idAlu']}', '{$_POST['idAlu']}', '{$idSecc}', '{$_POST['tramite']}', 'Solicitud - Registro N° {$_POST['numSolicitud']}-{$fecha}', 0); "; 

  if(!$cadena->multi_query($codCiclo)){
    echo $cadena->error;
  }

}else{
  $codCiclo = "INSERT INTO `registroalumno`(`Reg_Codigo`, `Alu_Codigo`, `Sec_Codigo`, `AlSe_Condicion`, `Reg_EstadoFinal`, `Reg_MontoPension`) VALUES ('{$idSecc}{$_POST['idAlu']}', '{$_POST['idAlu']}', '{$idSecc}', '{$_POST['tramite']}', 'Solicitud - Registro N° {$_POST['numSolicitud']}-{$fecha}', 0); "; 

  if(!$cadena->query($codCiclo)){
    echo $cadena->error;
  }
}

echo $idSecc;


?>
