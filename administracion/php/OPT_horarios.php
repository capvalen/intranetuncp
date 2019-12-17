<?php
include 'conexionInfocat.php';

$sql="SELECT * FROM `horarioclases` hc inner join horarioDias hd on hd.idHorarioDia = hc.idHorarioDia
WHERE Hor_Codigo <>0 and horarioDisplay =1
order by horDiaInicial asc;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['Hor_Codigo'];?>"><?= $row['horDiaInicial'].' a '. $row['horDiaFinal'].' - '. $row['Hor_HoraInicio'].' '.$row['Hor_HoraSalida'] ;?></option>
<?php }


?>