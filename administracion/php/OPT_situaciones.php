<?php
include 'conexionInfocat.php';

$sql="SELECT * FROM `situación` order by sitDescripcion asc;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option class="text-capitalize" value="<?= $row['sitDescripcion'];?>"><?= $row['sitDescripcion'];?></option>
<?php }


?>