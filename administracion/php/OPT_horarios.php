<?php
include 'conexionInfocat.php';

$sql="SELECT * FROM `horarioclases`
WHERE Hor_Codigo <>0
order by Hor_HoraInicio asc;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['Hor_Codigo'];?>"><?= $row['Hor_HoraInicio'].' '.$row['Hor_HoraSalida'] ;?></option>
<?php }


?>