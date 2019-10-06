<?php 
include 'conexionInfocat.php';
$sql1 = "SELECT * FROM `mesacademico` where Mes_Codigo = '{$_POST['idCiclo']}'";
//echo $sql1;
$respuestaSql = $cadena->query($sql1);
if($respuestaSql->num_rows==0){

  $sql= "INSERT INTO `mesacademico`(`Mes_Codigo`, `Mes_Inicio`, `Mes_Fin`, `Mes_Detalle`, `Mes_MidExam` ) 
  VALUES ('{$_POST['idCiclo']}','{$_POST['fechaIni']}', '{$_POST['fechaFin']}', '{$_POST['detalle']}', '{$_POST['fechaMid']}' ); ";
  //echo $sql;
  if ($llamadoSQL = $apoyo->query($sql)) { //Ejecución mas compleja con retorno de dato de sql del procedure.
  
    $fecha = new DateTime($_POST['fechaIni']);
    echo $fecha -> format('Y');
  }else{echo mysql_error( $apoyo);}
}else{
  echo "Ya existe";
}


 ?>