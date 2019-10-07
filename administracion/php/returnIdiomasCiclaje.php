<?php
include 'conexionInfocat.php';

$sql="SELECT s.Idi_Codigo, i.Idi_Nombre  FROM `seccion` s
inner join idioma i on i.Idi_Codigo = s.Idi_Codigo 
where Mes_Codigo='". str_pad($_GET['month'],2, '0', STR_PAD_LEFT).$_GET['year']. "' GROUP BY s.Idi_Codigo; ";
/* Emp_Codigo = '{$_COOKIE['ckidUsuario']}' and Sec_Detalle ='Habilitado' and */
//echo $sql;
$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['Idi_Codigo'];?>"><?= $row['Idi_Nombre'];?></option>
<?php }


?>