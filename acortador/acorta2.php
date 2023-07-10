<?php
session_start();
include '../funciones/lib.php';
?>
<?php
$short = $_REQUEST['short'];

$query = mysqli_query($con, "SELECT * FROM aor_acortadores WHERE urlcorta = '".mysqli_escape_string($short)."' LIMIT 1");
$row = mysqli_fetch_row($query);

$sqlB = mysqli_query($con, "SELECT * FROM aor_acortadores WHERE urlcorta = '$short'");
$sh = mysqli_fetch_array($sqlB); 
$urls = $sh['url'];

if(empty($row)) {
Header("HTTP/1.1 301 Moved Permanently");
header("Location: ".$urls."");
} else {
$html = "Error: no se pudo encontrar la URL corta";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Acortar URL - Age Of Rol</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php include "../paginas/_head.php"; ?>
</head>
<!-- FIN -->

<?php 
if(isset($_SESSION["usuario"])) {
include '../paginas/_headerlog.php';
} else {
include '../paginas/_header.php';
}
?>

<!-- CUERPO -->
<br>
<div style="max-width:1000px;" class="container">

<!-- PERFIL -->
<div style="margin-top:70px" class="row">

<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div class="ui-block">
<div class="ui-block-title">
<h6 class="title">Acortar URL</h6>
</div>
<div class="ui-block-content">

<div>
<?= $html ?>
<br /><br />
<span><a href="./">X</a></span>
</div>


</div>
</div>

</div>
</div>
<!-- FIN -->


<a style="background:#2196F3" class="back-to-top" href="#">
<img src="../estilos/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>

<!-- FIN -->
<?php include "../paginas/_footer.php"; ?>

</div>

</body>
</html>