<?php
include 'conexionInfocat.php';

$sql="SELECT year(ma.Mes_Inicio) as anio
FROM `seccion` s
	inner join mesacademico ma on ma.Mes_Codigo = s.Mes_Codigo
  where Emp_Codigo = '{$_COOKIE['ckidUsuario']}' and Sec_Detalle ='Habilitado' group by year(ma.Mes_Inicio) order by Mes_Inicio desc;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['anio'];?>"><?= $row['anio'];?></option>
<?php }


?>