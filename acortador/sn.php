<?php
session_start();
include '../funciones/lib.php';
?>

<?php
$fecha = date('Y-m-d');
$url = $_REQUEST['url'];

if(!preg_match("/^[a-zA-Z]+[:\/\/]+[A-Za-z0-9\-_]+\\.+[A-Za-z0-9\.\/%&=\?\-_]+$/i", $url)) {
$html = "ERROR url no válida";
} else {

$short = substr(md5(time().$url), 0, 5);

if(mysqli_query($con, "INSERT INTO `aor_acortadores` (`urlcorta`, `url`, `fecha`) VALUES ('".$short."', '".$url."', '".$fecha."')")) {
$html = "".$short;
} else {
$html = "Error: base de datos no encontrada";
}

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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body">

<h5 class="modal-title" style="text-align:center;text-transform: uppercase;font-size: 16px;color: #1d68f1;font-weight: 600;margin-bottom:10px;" id="exampleModalLabel">Enlace corto</h5>

<a style="font-size:17px;text-align:center !important;color:#444b7a" href="https://uniongamers.org/s/<?= $html ?>">https://uniongamers.org/s/<?= $html ?></a>

</div>
<div class="modal-footer">
<button type="button" data-dismiss="modal" class="btn btn-primary btn-block">Listo</button>
</div>
</div>
</div>
</div>

<!-- CUERPO -->
<div class="container">
<div style="margin-left:25px">

<div style="max-width:500px;" class="container">

<!-- PERFIL -->
<div style="margin-top:25px" class="row">

<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div class="ui-block">

<div class="ui-block-title">
<h6 class="title">Acortar URL</h6>
</div>

<div class="ui-block-content">

<form action="sn" method="POST">
<div class="row">
<div class="col col-lg-12 col-md-6 col-sm-12 col-12">
<fieldset class="form-group">
<input class="form-control" type="text" name="url" style="border-radius:2px;border-color: #e1e1e1;" placeholder="URL de uniongamers.org">
</fieldset>

<button type="submit" class="btn btn-info">Crear URL corta</button>

</div>
</div>

</form>

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
</div>

<script>
$( document ).ready(function() {
$('#exampleModal').modal('toggle')
});
</script>