<?php
include 'conexionInfocat.php';

$sql="SELECT year(Mes_Inicio) as anios FROM `mesacademico` GROUP by year(Mes_Inicio) order by Mes_Inicio desc;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['anios'];?>"><?= $row['anios'];?></option>
<?php }


?>