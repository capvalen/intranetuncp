<?php
include 'conexionInfocat.php';

$sql="SELECT s.Niv_Codigo, n.Niv_Detalle  FROM `seccion` s
inner join idioma i on i.Idi_Codigo = s.Idi_Codigo 
inner join nivel n on n.Niv_Codigo = s.Niv_Codigo
where Mes_Codigo='". str_pad($_GET['month'],2, '0', STR_PAD_LEFT).$_GET['year']. "' and i.Idi_Codigo='{$_GET['language']}' and Sec_NroCiclo<>0 group by s.Niv_Codigo; ";
/* Emp_Codigo = '{$_COOKIE['ckidUsuario']}' and Sec_Detalle ='Habilitado' and */
//echo $sql;
$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['Niv_Codigo'];?>"><?= $row['Niv_Detalle'];?></option>
<?php }


?>