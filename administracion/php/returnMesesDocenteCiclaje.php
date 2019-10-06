<?php
include 'conexionInfocat.php';

$sql="SELECT month(ma.Mes_Inicio) as meses, Mes_Detalle
FROM `seccion` s
	inner join mesacademico ma on ma.Mes_Codigo = s.Mes_Codigo
  where Emp_Codigo = '{$_COOKIE['ckidUsuario']}' and Sec_Detalle ='Habilitado' and year(ma.Mes_Inicio)= {$_GET['year']}
  group by month(ma.Mes_Inicio) order by meses asc;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['meses'];?>"><?= $row['Mes_Detalle'];?></option>
<?php }


?>