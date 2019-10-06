<?php
include 'conexionInfocat.php';

$sql="SELECT Suc_Codigo, lower(Suc_Direccion) as Suc_Direccion FROM `sucursal` order by Suc_Direccion desc ;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option class="text-capitalize" value="<?= $row['Suc_Codigo'];?>"><?= $row['Suc_Direccion'];?></option>
<?php }


?>