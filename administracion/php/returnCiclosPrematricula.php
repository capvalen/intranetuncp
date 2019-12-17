<?php
include 'conexionInfocat.php';

$sql="SELECT p.Sec_NroCiclo  FROM `prematricula` p
where periodo = date_format(STR_TO_DATE( concat('{$_POST['periodo']}', '-01'), '%Y-%m-%d'), '%m%Y') and p.Idi_Codigo = '{$_POST['idioma']}' and p.Niv_Codigo = '{$_POST['nivel']}' and atendido =0 and Suc_Codigo='{$_POST['sucursal']}'
group by p.Sec_NroCiclo; ";

//echo $sql;
$resultado=$cadena->query($sql);
if($resultado->num_rows>=1){
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['Sec_NroCiclo'];?>"><?= $row['Sec_NroCiclo'];?></option>
<?php }
}else{ ?> 
  <option value="-1">No existen niveles en éste curso</option>
   <?php }

?>