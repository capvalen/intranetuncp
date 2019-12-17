<?php
include 'conexionInfocat.php';

$sql="SELECT p.Idi_Codigo, i.Idi_Nombre FROM `prematricula` p
inner join idioma i on i.Idi_Codigo = p.Idi_Codigo
where periodo = date_format(STR_TO_DATE( concat('{$_POST['periodo']}', '-01'), '%Y-%m-%d'), '%m%Y') and atendido =0 and Suc_Codigo='{$_POST['sucursal']}'
group by p.Idi_Codigo; ";

//echo $sql;
$resultado=$cadena->query($sql);
if($resultado->num_rows>=1){
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['Idi_Codigo'];?>"><?= $row['Idi_Nombre'];?></option>
<?php }
}else{ ?> 
<option value="-1">No existen cursos en éste periodo</option>
 <?php }


?>