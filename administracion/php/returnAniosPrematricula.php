<?php
include 'conexionInfocat.php';

$sql="SELECT date_format(STR_TO_DATE( concat('01-', periodo), '%d-%m%Y'), '%Y-%m') as fecha FROM `prematricula`
where atendido = 0
group by fecha
order by fecha desc";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option value="<?= $row['fecha'];?>"><?= $row['fecha'];?></option>
<?php }


?>