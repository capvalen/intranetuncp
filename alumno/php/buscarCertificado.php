<?php 
include 'conexionInfocat.php';

$sql="SELECT * FROM `alumno` WHERE Alu_NroDocumento = '{$_POST['dni']}'; ";
$resultado=$esclavo->query($sql);
if($resultado -> num_rows >=1){
while($row=$resultado->fetch_assoc()){ 
  if($row['aluCertificado']<>''){ ?>
    <embed src="<?= "../administracion/certificados/".$row['aluCertificado']; ?>" width="90%" height="600" type="application/pdf">
  <?php }else{
    echo "<p>No se encontraron certificados.</p>" ;
  }
}
}else{
  echo "<p>No se encuentra al alumno con ese DNI.</p>" ;
}
?>