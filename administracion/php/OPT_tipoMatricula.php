<?php
include 'conexionInfocat.php';

$sql="SELECT `idcondicion`, `Condicion`, `TipoDcto`, `ValDcto` FROM `condicionalumno` WHERE 1
order by Condicion asc ;";

$resultado=$cadena->query($sql);
while($row=$resultado->fetch_assoc()){ ?>
<option class="text-capitalize" value="<?= $row['Condicion'];?>" data-id='<?= $row['idcondicion'];?>' data-tipoDscto='<?= $row['TipoDcto'];?>' data-cantDscto='<?= $row['ValDcto'];?>'><?= $row['Condicion'];?></option>
<?php }


?>