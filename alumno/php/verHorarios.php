<?php 
include 'conexionInfocat.php';

$sql="SELECT hd.horDiaInicial, hd.horDiaFinal, hc.*  FROM `horarioclases` hc
inner join horarioDias hd on hd.idHorarioDia = hc.idHorarioDia WHERE horarioDisplay = 1
ORDER BY horDiaInicial";
$resultado=$esclavo->query($sql); $i=0;
while($row=$resultado->fetch_assoc()){ ?> 
  <button type="button" class="list-group-item list-group-item-action <?php if($i==0){echo "active"; }?>" data-id="<?= $row['Hor_Codigo'];?>" ><i class="icofont-dotted-right"></i> <?= $row['horDiaInicial']. " ".$row['horDiaFinal'] . " - ". $row['Hor_HoraInicio']." ".$row['Hor_HoraSalida'] ; ?></button>
  <?php
  $i++;
}
?>