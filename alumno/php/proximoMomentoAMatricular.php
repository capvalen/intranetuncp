<?php 
include 'conexionInfocat.php';

$sql="SELECT ra.Reg_Codigo, s.Idi_Codigo, i.Idi_Nombre, s.Niv_Codigo, n.Niv_Detalle, s.Sec_NroCiclo, ma.Mes_Inicio, nt.not_Prom, ultimoCicloIdioma(s.Idi_Codigo, s.Niv_Codigo) as maxCiclos, s.Suc_Codigo, su.sucDescripcion FROM `alumno` a
inner join registroalumno ra on ra.Alu_Codigo = a.Alu_Codigo
inner join seccion s on s.Sec_Codigo = ra.Sec_Codigo
inner join idioma i on i.Idi_Codigo = s.Idi_Codigo
inner join nivel n on n.Niv_Codigo = s.Niv_Codigo
inner join mesacademico ma on ma.Mes_Codigo = s.Mes_Codigo
inner join sucursal su on su.Suc_Codigo = s.Suc_Codigo
inner join onota nt on nt.Reg_Codigo = ra.Reg_Codigo
where ra.alu_codigo = '{$_POST['idAlu']}'
and s.Idi_Codigo = '{$_POST['idioma']}'
order by ma.Mes_Inicio desc
limit 1; ";  /*'{$_POST['idAlumno']}'*/
$resultado=$esclavo->query($sql);
$filas = [];
if($resultado->num_rows>=1){
  $row=$resultado->fetch_assoc();
   
  //Verificamos si aprobó el curso con más de 13
  if( $row['not_Prom']>13 ){
    //Aprobó next level
    if( $row['maxCiclos'] == $row['Sec_NroCiclo'] ){
      //Promover de nivel
      $letraNivel = substr($row['Niv_Codigo'], 0,1);
      $proxCiclo = 1;

      switch ($letraNivel) {
        case 'B': $proxNivel = "I1"; break;
        case 'I': $proxNivel = "A1"; break;
        case 'A': $proxNivel = "Z1"; break;
        default: break;
      }
      $comentario = 'Promoción de ciclo';
      
    }else{
      //Sumar 1 ciclo en el mismo nivel
      $proxNivel = $row['Niv_Codigo'];
      $proxCiclo = $row['Sec_NroCiclo']+1;
      $comentario = 'Aprobó y pasa al nuevo ciclo';
    }
  }else{
    //Desaprobó repetir level
    $proxNivel = $row['Niv_Codigo'];
    $proxCiclo = $row['Sec_NroCiclo'];
    $comentario = 'Reprobó, lleva el ciclo nuevamente';
  }

  $filas = array( 'codAlu'=> $_POST['idAlu'], 'idioma' => $row['Idi_Nombre'], 'codIdioma' => $_POST['idioma'], 'nivel'=>$row['Niv_Detalle'], 'codNivel' => $proxNivel, 'ciclo' => $proxCiclo, 'notaFin'=> $row['not_Prom'], 'sede'=> $row['sucDescripcion'], 'sucursal' => $row['Suc_Codigo'], 'comentario' => $comentario ); //$_POST['idioma']
  

}else{
  //Alumno nuevo en el curso que se solicita, o no tiene registros previos, bajarlo a nivel 1
  $comentario = 'Alumno nuevo en el curso';
  $filas = array( 'idioma' => $row['Idi_Nombre'], 'codIdioma' => 'IN1', 'nivel'=>$row['Niv_Detalle'], 'codNivel' => 'B1', 'ciclo' => 1, 'notaFin'=> 0, 'comentario' => $comentario ); //$_POST['idioma']
}

echo json_encode($filas);
?>