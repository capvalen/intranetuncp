<?php
include 'conexionInfocat.php';

$sql="SELECT `nxi_Pension`, `nxi_Matricula` FROM `nivelxidioma` WHERE `idi_Codigo`='{$_POST['idioma']}' and Niv_Codigo='{$_POST['nivel']}';";

$resultado=$cadena->query($sql);
$row=$resultado->fetch_assoc(); ?>
<option value='Matr0001' data-valor="<?= $row['nxi_Matricula'];?>" data-motivo='Normal'>Matrícula</option>
<?php
$sqlEsp="SELECT AlSe_Condicion, reg_MontoPension FROM `registroalumno` where reg_codigo = '{$_POST['registro']}';";

$resultadoEsp=$esclavo->query($sqlEsp);
$rowEsp=$resultadoEsp->fetch_assoc(); ?>
<option value='Pens0001' data-valor="<?= $rowEsp['reg_MontoPension'];?>" data-motivo="<?= $rowEsp['AlSe_Condicion'];?>">Pensión</option>
?>