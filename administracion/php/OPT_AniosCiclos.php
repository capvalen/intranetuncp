<?php

$i=2016;
while ($i <= date(Y)+1) {
  ?>
  <option class="text-capitalize" value="<?= $i; ?>"><?= $i;?></option>
  <?php $i++;
}
?>