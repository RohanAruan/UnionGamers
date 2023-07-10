<!-- PERMISOS PARA MOSTRAR RANGOS SUPERIOR O INFERIOR -->
<?php 
$forosx = $con->query("SELECT * FROM aor_foros WHERE idcategoria = '$idcategoria' AND idforo = '0'");

while($foros = $forosx->fetch_array()) {

$idforo = $foros['id'];
$tipo = $foros['tipo'];
$tipoadm = $foros['tipoadm'];
?>

<!-- SI EL RANGO DE PERSONAJE ES IGUAL AL DE TIPO DE ADMIN DEL FORO -->
<?php if($rango == $tipoadm) { ?> 

<?php include "roles-tipos.php"; ?>
<!-- FIN -->

<!-- SI EL RANGO DE PERSONAJE ES IGUAL O MAYOR QUE EL TIPO DE ADMIN DEL FORO -->
<?php } elseif($rango >= $tipoadm) { ?> 

<?php include "roles-tipos.php"; ?>

<?php } ?>	
<!-- FIN -->

<?php } ?>
<!-- FIN -->

