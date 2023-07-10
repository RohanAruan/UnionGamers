<?php
error_reporting(0);
include '../lib.php';

$idpub = secureData(mysqli_real_escape_string($con, $_POST['id'])); 

$comprobar = mysqli_query($con, "SELECT * FROM pcu_likes WHERE post = '".$idpub."' AND usuario = '".$iduser."'");
$count = mysqli_num_rows($comprobar);

if($count == 0) {	

$comprobar1 = mysqli_query($con, "SELECT * FROM pcu_publicaciones WHERE id_pub = '".$idpub."'");
$compro = mysqli_fetch_array($comprobar1);
$iduserx = $compro['usuario'];

$comprobar2 = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '".$iduserx."'");
$userx = mysqli_fetch_array($comprobar2);
$nombrex = $userx['Username'];

if($iduserx == $iduser) {} else {

$insertx = mysqli_query($con, "INSERT INTO pcu_notificaciones (user1, user2, tipo, leido, fecha, hora) VALUES ('$usuario', '$nombrex', 'le encanta tu comentario', '0', '$fecha', '$hora')");
}

$insert = mysqli_query($con, "INSERT INTO pcu_likes (usuario,post,fecha,hora) values ('$iduser','$idpub','$fecha','$hora')");

} else { $delete = mysqli_query($con, "DELETE FROM pcu_likes WHERE post = '".$idpub."' AND usuario = '".$iduser."'"); }
?>