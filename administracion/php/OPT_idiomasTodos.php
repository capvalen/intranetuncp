<?php
include 'conexionInfocat.php';
$campus = '';
$sql="SELECT `Idi_Codigo`, `Idi_Nombre` FROM `idioma` ORDER BY `idioma`.`Idi_Nombre` ASC; ";
//echo $sql;

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option class="text-capitalize" value="<?= $row['Idi_Codigo'];?>"><?= $row['Idi_Nombre'];?></option>
<?php }


?>