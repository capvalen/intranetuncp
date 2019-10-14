<?php
$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
$i=0;
while ($i <= 11) {
  ?>
  <option class="text-capitalize" value="<?= str_pad($i+1, 0, STR_PAD_LEFT); ?>"><?= $meses[$i];?></option>
  <?php $i++;
}
?>