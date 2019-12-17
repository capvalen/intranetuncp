<?php
include 'conexionInfocat.php';

$sql="SELECT p.Niv_Codigo, n.Niv_Detalle FROM `prematricula` p
inner join idioma i on i.Idi_Codigo = p.Idi_Codigo
inner join nivel n on n.Niv_Codigo = p.Niv_Codigo
where periodo = date_format(STR_TO_DATE( concat('{$_POST['periodo']}', '-01'), '%Y-%m-%d'), '%m%Y') and p.Idi_Codigo = '{$_POST['idioma']}' and atendido =0 and Suc_Codigo='{$_POST['sucursal']}'
group by p.Niv_Codigo; ";

//echo $sql;
$resultado=$cadena->query($sql);
if($resultado->num_rows>=1){
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['Niv_Codigo'];?>"><?= $row['Niv_Detalle'];?></option>
<?php }
}else{ ?> 
  <option value="-1">No existen niveles en éste curso</option>
   <?php }

?>