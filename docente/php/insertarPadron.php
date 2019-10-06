<?php
include 'conexionInfocat.php';


$padron= $_POST['padron'];


/* $sql="SELECT year(ma.Mes_Inicio) as anio
FROM `seccion` s
	inner join mesacademico ma on ma.Mes_Codigo = s.Mes_Codigo
  where Emp_Codigo = '{$_COOKIE['ckidUsuario']}' and Sec_Detalle ='Habilitado' group by year(ma.Mes_Inicio) order by Mes_Inicio desc;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['anio'];?>"><?= $row['anio'];?></option>
<?php } */
$sql='';

for($i=0; $i< count($padron); $i++)
{
  //saco el valor de cada elemento
  $promedio =  round(($padron[$i]['n1'] + $padron[$i]['n2'] + $padron[$i]['n3'])/3, 0, PHP_ROUND_HALF_UP) ;
  //echo $promedio . "\n";

  $sql = $sql."UPDATE `onota` SET `not_1`={$padron[$i]['n1']},`not_2`={$padron[$i]['n2']},`not_3`={$padron[$i]['n3']},`not_Prom`={$promedio} WHERE `Reg_Codigo`='{$padron[$i]['registro']}';";
}

if($resultado=$cadena->multi_query($sql)){
  echo "ok";
}else{
  echo "error";
}
?>