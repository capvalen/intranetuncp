<?php
include 'conexionInfocat.php';

$sql="SELECT * FROM `facultad` group by `Fac_Detalle` order by Fac_Detalle;";

if (isset($_GET['idFac'])){ $idFac = $_GET['idFac'];  }else{ $idFac = 'Q1__'; }

$resultado=$esclavo->query($sql);
while($rowMax=$resultado->fetch_assoc()){ ?>
<option class="text-capitalize" value="<?= $rowMax['Fac_Codigo'];?>" <?php if($rowMax['Fac_Codigo']==$idFac){ ?> selected="selected" <?php } ?>><?= $rowMax['Fac_Detalle'];?></option>
<?php }


?>