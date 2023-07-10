<?php
include '../../../funciones/config.php';

$insertar = mysqli_query($con, "UPDATE aor_temas SET idlider = '$_GET[idf]' WHERE id = '$_GET[s]'");	
$mover1 = mysqli_query($con, "UPDATE aor_mensajes SET idtema = '$_GET[idf]' WHERE idtema = '$_GET[s]'");

echo '<script>window.location="../../showtopic?s='.$_GET[s].'-'.$nombretema.'"</script>';
?>