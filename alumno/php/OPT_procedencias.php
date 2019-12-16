<?php
include 'conexionInfocat.php';

$sql="SELECT * FROM `procedencia`;";

if (isset($_GET['idProc'])){ $idPro = $_GET['idProc'];  }else{ $idPro = 'Q1__'; }

$resultado=$esclavo->query($sql);
while($rowProc=$resultado->fetch_assoc()){ ?>
<option class="text-capitalize" value="<?= $rowProc['IdProcedencia'];?>" <?php if($rowProc['IdProcedencia']==$idPro){ ?> selected="selected" <?php } ?> ><?= $rowProc['procDescripcion'];?></option>
<?php }
?>