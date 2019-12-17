<?php
include 'conexionInfocat.php';

$sql="SELECT p.idHorario, hd.horDiaInicial, hd.horDiaFinal, hc.Hor_HoraInicio, hc.Hor_HoraSalida FROM `prematricula` p
inner join idioma i on i.Idi_Codigo = p.Idi_Codigo
inner join nivel n on n.Niv_Codigo = p.Niv_Codigo
inner join horarioclases hc on hc.Hor_Codigo = p.idHorario
inner join horarioDias hd on hd.idHorarioDia = hc.idHorarioDia
where periodo = date_format(STR_TO_DATE( concat('{$_POST['periodo']}', '-01'), '%Y-%m-%d'), '%m%Y') and p.Idi_Codigo = '{$_POST['idioma']}' and p.Niv_Codigo = '{$_POST['nivel']}' and Sec_NroCiclo = {$_POST['ciclo']} and atendido =0 and Suc_Codigo='{$_POST['sucursal']}'
group by hc.Hor_Codigo; ";

//echo $sql;
$resultado=$cadena->query($sql);
if($resultado->num_rows>=1){
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['idHorario'];?>"><?= $row['horDiaInicial']. ' a '.$row['horDiaFinal']. ' '. $row['Hor_HoraInicio']." ".$row['Hor_HoraSalida'];?></option>
<?php }
}else{ ?> 
  <option value="-1">No existen niveles en éste curso</option>
   <?php }

?>