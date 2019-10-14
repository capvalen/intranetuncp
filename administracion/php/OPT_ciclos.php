<?php

$i=1;
while ($i <= 12) {
  ?>
  <option class="text-capitalize" value="<?= str_pad($i, 2, 0, STR_PAD_LEFT); ?>"><?= str_pad($i, 2, 0, STR_PAD_LEFT);?></option>
  <?php $i++;
}
?>