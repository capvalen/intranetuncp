<?php
include 'conexionInfocat.php';
$campus = '';
if(isset($_GET['campus'])){ 
  $sql = "SELECT i.`Idi_Codigo`, `Idi_Nombre` FROM `idioma` i
  inner join seccion s on s.Idi_Codigo = i.Idi_Codigo where Mes_Codigo='". str_pad($_GET['month'], 2, 0, STR_PAD_LEFT). $_GET['year'] ."'  and s.Suc_Codigo = '{$_GET['campus']}'
  group by s.Idi_Codigo
  ORDER BY i.`Idi_Nombre` ASC";
 }else{
  $sql="SELECT `Idi_Codigo`, `Idi_Nombre` FROM `idioma` ORDER BY `idioma`.`Idi_Nombre` ASC; ";
}
echo $sql;

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option class="text-capitalize" value="<?= $row['Idi_Codigo'];?>"><?= $row['Idi_Nombre'];?></option>
<?php }


?>