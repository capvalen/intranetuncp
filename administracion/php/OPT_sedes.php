<?php
include 'conexionInfocat.php';

$sql="SELECT Suc_Codigo, lower(sucDescripcion) as sucDescripcion FROM `sucursal` order by Suc_Direccion asc ;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option class="text-capitalize" value="<?= $row['Suc_Codigo'];?>"><?= $row['sucDescripcion'];?></option>
<?php }


?>