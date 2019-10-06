<?php
include 'conexionInfocat.php';

$sql="SELECT * FROM `nivel`;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option class="text-capitalize" value="<?= $row['Niv_Codigo'];?>"><?= $row['Niv_Detalle'];?></option>
<?php }


?>