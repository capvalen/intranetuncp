<?php
include 'conexionInfocat.php';

$sql="SELECT `nxi_Pension`, `nxi_Matricula` FROM `nivelxidioma` WHERE `idi_Codigo`='{$_POST['idioma']}' and Niv_Codigo='{$_POST['nivel']}';";

$resultado=$cadena->query($sql);
$row=$resultado->fetch_assoc(); ?>
<option value='Matr0001' data-valor="<?= $row['nxi_Matricula'];?>">Matrícula</option>
<option value='Pens0001' data-valor="<?= $row['nxi_Pension'];?>">Pensión</option>
