<?php
include 'conexionInfocat.php';

$sql="SELECT e.Emp_Codigo, lower(Emp_Apellido) as Emp_Apellido, lower(Emp_Nombre) as Emp_Nombre FROM `empleado` e
order by Emp_Apellido, Emp_Nombre asc;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option class="text-capitalize" value="<?= $row['Emp_Codigo'];?>"><?= $row['Emp_Apellido'].', '.$row['Emp_Nombre'] ;?></option>
<?php }


?>