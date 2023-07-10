<?php
session_start();
include '../config.php';
include '../socialnetwork-lib.php';

ini_set('error_reporting',0);

if(!isset($_SESSION['usuario']))
{
header("Location: login.php");
}
?>

<?php
if(isset($_GET['id'])) {

$id = mysqli_real_escape_string($con, $_GET['id']);
$action = mysqli_real_escape_string($con, $_GET['action']);

if($action == 'aceptar') {

$datos = mysqli_query($con, "SELECT * FROM amigos WHERE id_ami = '$id'");
$compro = mysqli_fetch_array($datos);
$para = $compro['para'];
$de = $compro['de'];

$update = mysqli_query($con, "UPDATE amigos SET estado = '1' WHERE id_ami = '$id'");
$insertx = mysqli_query($con, "INSERT INTO notificaciones (user1, user2, tipo, leido, fecha, id_pub) VALUES ('$para', '$de', 'te aceptó la solicitud', '0', now(), '$post')");
header('Location:' . getenv('HTTP_REFERER'));

}

if($action == 'rechazar') {

$delete = mysqli_query($con, "DELETE FROM amigos WHERE id_ami = '$id'");
header('Location:' . getenv('HTTP_REFERER'));

}



}