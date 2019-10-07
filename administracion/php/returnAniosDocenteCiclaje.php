<?php
include 'conexionInfocat.php';

$sql="SELECT year(ma.Mes_Inicio) as anio
FROM `seccion` s
	inner join mesacademico ma on ma.Mes_Codigo = s.Mes_Codigo
   group by year(ma.Mes_Inicio) order by Mes_Inicio desc;";
/* Emp_Codigo = '{$_COOKIE['ckidUsuario']}' and 
where  Sec_Detalle ='Habilitado'*/
$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['anio'];?>"><?= $row['anio'];?></option>
<?php }


?>