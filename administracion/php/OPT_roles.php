<?php
include 'conexionInfocat.php';

$sql="SELECT `Rol_Id`, `Rol_Detalle`  FROM `rol` WHERE `rolActivo`=1 order by Rol_Detalle asc ;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option class="text-capitalize" value="<?= $row['Rol_Id'];?>"><?= $row['Rol_Detalle'];?></option>
<?php }


?>