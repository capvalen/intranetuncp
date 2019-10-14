<?php 
include 'conexionInfocat.php';

$sqlSeccion = "SELECT proxSeccion('{$_POST['idioma']}' , '{$_POST['nivel']}', '".str_pad($_POST['mes'], 2, 0, STR_PAD_LEFT)."', '{$_POST['anio']}') as idSec";
$resultadoSeccion = $esclavo->query($sqlSeccion);
$rowSeccion = $resultadoSeccion-> fetch_assoc();
$idSec = $rowSeccion['idSec'];
//echo $idSec;
if($resultadoSeccion->num_rows >0){

  $codCiclo = "INSERT INTO `seccion`(`Sec_Codigo`, `Idi_Codigo`, `Niv_Codigo`, `Hor_Codigo`, `Sec_Aula`, `Emp_Codigo`, `Sec_FechaIni`, `Sec_FechaFin`, `Sec_Seccion`, `Sec_NroCiclo`, `Sec_Detalle`, `Mes_Codigo`, `Suc_Codigo`, `Sec_fechactualiza`)
  VALUES (
    concat('{$_POST['sucursal']}', '{$_POST['idioma']}', '{$_POST['nivel']}', '{$_POST['ciclo']}', '{$idSec}', '".str_pad($_POST['mes'], 2, 0, STR_PAD_LEFT)."', substring('{$_POST['anio']}',-2) ),
    '{$_POST['idioma']}', '{$_POST['nivel']}', '{$_POST['horario']}', null, '{$_POST['docente']}', null, null, '{$idSec}', '{$_POST['ciclo']}', 'Habilitado', concat('".str_pad($_POST['mes'], 2, 0, STR_PAD_LEFT)."', '{$_POST['anio']}'), '{$_POST['sucursal']}', null)";
    //echo $codCiclo;
  if($respuestaCiclo = $cadena->query($codCiclo)){
    echo $_POST['sucursal']. $_POST['idioma'] . $_POST['nivel'] . $_POST['ciclo'] . $idSec .str_pad($_POST['mes'], 2, 0, STR_PAD_LEFT). substr($_POST['anio'],-2);
    
  }else{
    echo $cadena->error;
  }
}


?>
