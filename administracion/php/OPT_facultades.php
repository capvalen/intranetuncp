<?php
include 'conexionInfocat.php';

$sql="SELECT `Fac_Detalle` FROM `facultad` group by `Fac_Detalle` order by Fac_Detalle;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option class="text-capitalize" value="<?= $row['Fac_Detalle'];?>"><?= $row['Fac_Detalle'];?></option>
<?php }


?>