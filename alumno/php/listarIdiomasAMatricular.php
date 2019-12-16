<button type="button" class="list-group-item list-group-item-action active" data-id="nuevo" ><i class="icofont-dotted-right"></i> Quiero empezar un nuevo curso</button>

<?php 
include 'conexionInfocat.php';

$sql="SELECT i.Idi_Codigo, i.Idi_Nombre FROM registroalumno ra
inner join seccion s on s.Sec_Codigo = ra.Sec_Codigo
inner join idioma i on i.Idi_Codigo = s.Idi_Codigo
where ra.Alu_Codigo = '{$_POST['idAlu']}'
group by s.Idi_Codigo";
$resultado=$esclavo->query($sql);
while($row=$resultado->fetch_assoc()){ ?> 
  <button type="button" class="list-group-item list-group-item-action" data-id="<?= $row['Idi_Codigo']; ?>"><i class="icofont-dotted-right"></i> Continuar con mis estudios de <?= $row['Idi_Nombre']; ?></button>
<?php } ?>