<?php
include '../funciones/lib.php';

if(!isset($_SESSION['usuario']))
{
header("Location: ../login");
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Foro | AGE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php include "../paginas/_head.php"; ?>
<link rel="stylesheet" type="text/css" href="<?=$todoh?>/foro/estilos/css/main.css">
<link rel="stylesheet" type="text/css" href="<?=$todoh?>/foro/estilos/css/fonts.min.css">
<script src="https://cdn.tiny.cloud/1/oacfwr1n8ixdyeq3tz4vmz7ylealzfpzsb4ccjf33pululpy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="<?=$todoh?>/foro/estilos/js/lazysizes.min.js" async=""></script>
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
<div style="margin-top:10px;" class="row">

<!-- PRIMERO -->

<div style="padding-left:0px;" class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div class="ui-block responsive-flex">
<div class="ui-block-title">
<div class="h6 title">Age Of Rol</div>
<form class="w-search">
<div style="float:right;margin-top:-5px" class="form-group with-button">
<input class="form-control" type="text" placeholder="Buscar en el foro...">
<button>
<i class="fa fa-search"></i>
</button>
</div>
</form>
</div>
</div>
</div>

<div style="padding-left:0px;" class="col-lg-6">
<div class="ui-block">
<div class="ui-block-title bg-blue">
<h6 class="title c-white">Foros</h6>
</div>
<div class="ui-block-content">	
<ul>
<?php
$sqlA = mysqli_query($con, "SELECT * FROM aor_categorias WHERE id AND idforo = '0'");
while($categoria = $sqlA->fetch_array()) {
$idcat = $categoria['id'];	
?>

<li style="font-weight:bold;"><?=$categoria['nombre']?></li>

<?php  
$forosx = $con->query("SELECT * FROM aor_foros WHERE idforo = '0' AND idcategoria = '$idcat'");

while($foros = $forosx->fetch_array()) {

$idforo = $foros['id'];
$tipo = $foros['tipo'];
?>

<li style="" data-value="<?=$foros['id']?>"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> #<?=$foros['id']?> —  <?=$foros['nombre']?>

<span></span>

</li>

<?php
$subforosx = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo'");
while($sforos = $subforosx->fetch_array()) {
$idforo0 = $sforos['id'];
?>

<li style="margin-left:10px;"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> #<?=$sforos['id']?> —  <?=$sforos['nombre']?></li>

<?php
$subforosx0 = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo0'");
while($sforos0 = $subforosx0->fetch_array()) {
$idforo1 = $sforos0['id'];
?>

<li style="margin-left:25px;"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> #<?=$sforos0['id']?> — <?=$sforos0['nombre']?></li>

<?php
$subforosx1 = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo1'");
while($sforos1 = $subforosx1->fetch_array()) {
$idforo2 = $sforos1['id'];
?>

<li style="margin-left:40px;"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> #<?=$sforos1['id']?> — <?=$sforos1['nombre']?></li>

<?php
$subforosx2 = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo2'");
while($sforos2 = $subforosx2->fetch_array()) {
$idforo3 = $sforos2['id'];
?>

<li style="margin-left:55px;"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> #<?=$sforos2['id']?> — <?=$sforos2['nombre']?></li>

<?php } ?>

<?php } ?>

<?php } ?>

<?php } ?>

<?php } ?>

<?php } ?>
</ul>
</div>
</div>
</div>

<div style="padding-left:0px;" class="col-lg-6">

<div class="ui-block">
<div class="ui-block-title bg-blue">
<h6 class="title c-white">Crear SubForo</h6>
</div>
<div class="ui-block-content">

<?php
if(isset($_POST['crear'])) {

$titulo = secureData(mysqli_real_escape_string($con, $_POST['titulo']));
$idforo = secureData(mysqli_real_escape_string($con, $_POST['idforo']));
$idcat = secureData(mysqli_real_escape_string($con, $_POST['idcat']));
$descripcion = secureData(mysqli_real_escape_string($con, $_POST['descripcion']));
$icono = secureData(mysqli_real_escape_string($con, $_POST['icono']));

$insertar = mysqli_query($con, "INSERT INTO aor_foros (nombre,idforo,idcategoria,descripcion,icono) values ('$titulo','$idforo','$idcat','$descripcion','$icono')");	

echo "<script>Swal.fire({title: '¡Exitoso!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {window.history.back();});</script>";

}

?>

<form action="" method="POST">

<div class="row">
<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="form-group label-floating">
<label class="control-label">Nombre</label>
<input class="form-control" type="text" placeholder="" name="titulo" required>
<input class="form-control" type="text" placeholder="ID del foro/subforo" name="idforo" required>
<input class="form-control" type="text" placeholder="ID de categoría" name="idcat" required>
<input class="form-control" type="hidden" value="../estilos/img/iconos/on.png" name="icono">
</div>
</div>

<!--
<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="form-group label-floating is-select">
<label class="control-label">Foro</label>
<select style="height: 57px;" class="form-control" name="idforo">

<?php
$result = mysqli_query($con, "SELECT * FROM aor_foros WHERE id");

while($foros = mysqli_fetch_array($result)){	
?>

<option value="<?=$foros['id']?>"><?=$foros['nombre']?></option>

<?php } ?>

</select>

</div>
</div>
-->

<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="form-group">
<textarea class="form-control" style="height: 240px" placeholder="Descripción" name="descripcion"></textarea>
</div>
</div>

<div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
<a href="#" class="btn btn-secondary btn-lg full-width">Cancelar</a>
</div>

<div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
<input type="submit" name="crear" class="btn btn-blue btn-lg full-width" value="Publicar">
</div>
</div>
</form>
</div>
</div>

<div class="ui-block">
<div class="ui-block-title bg-blue">
<h6 class="title c-white">Borrar SubForo (Manual)</h6>
</div>
<div class="ui-block-content">

<?php
if(isset($_POST['borrar'])) {

$idf = secureData(mysqli_real_escape_string($con, $_POST['idf']));

$insertar = mysqli_query($con, "DELETE FROM aor_foros WHERE id = '".$idf."'");	

echo "<script>Swal.fire({title: '¡Exitoso!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {window.history.back();});</script>";

}

?>

<form action="" method="POST">

<div class="row">
<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="form-group label-floating">
<label class="control-label">ID</label>
<input class="form-control" type="text" name="idf">
</div>
</div>

<div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
<input type="submit" name="borrar" class="btn btn-blue btn-lg full-width" value="Borrar">
</div>

</div>

</form>

</div>
</div>

<div class="ui-block">
<div class="ui-block-title bg-blue">
<h6 class="title c-white">Sub-Foros</h6>
</div>
<div class="ui-block-content">	
<ul>
<?php
$sqlA = mysqli_query($con, "SELECT * FROM aor_categorias WHERE idforo");
while($categoria = $sqlA->fetch_array()) {
$idcat = $categoria['id'];	
?>

<li style="font-weight:bold;"><?=$categoria['id']?> | <?=$categoria['nombre']?></li>

<?php  
$forosx = $con->query("SELECT * FROM aor_foros WHERE idcategoria = '$idcat'");

while($foros = $forosx->fetch_array()) {

$idforo = $foros['id'];
$tipo = $foros['tipo'];
?>

<li style="" data-value="<?=$foros['id']?>"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> #<?=$foros['id']?> —  <?=$foros['nombre']?>

<span></span>

</li>

<?php
$subforosx = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo'");
while($sforos = $subforosx->fetch_array()) {
$idforo0 = $sforos['id'];
?>

<li style="margin-left:10px;"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> #<?=$sforos['id']?> —  <?=$sforos['nombre']?></li>

<?php
$subforosx0 = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo0'");
while($sforos0 = $subforosx0->fetch_array()) {
$idforo1 = $sforos0['id'];
?>

<li style="margin-left:25px;"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> #<?=$sforos0['id']?> — <?=$sforos0['nombre']?></li>

<?php
$subforosx1 = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo1'");
while($sforos1 = $subforosx1->fetch_array()) {
$idforo2 = $sforos1['id'];
?>

<li style="margin-left:40px;"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> #<?=$sforos1['id']?> — <?=$sforos1['nombre']?></li>

<?php
$subforosx2 = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo2'");
while($sforos2 = $subforosx2->fetch_array()) {
$idforo3 = $sforos2['id'];
?>

<li style="margin-left:55px;"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> #<?=$sforos2['id']?> — <?=$sforos2['nombre']?></li>

<?php } ?>

<?php } ?>

<?php } ?>

<?php } ?>

<?php } ?>

<?php } ?>
</ul>
</div>
</div>

</div>	

</div>

<a style="background: #000;" class="back-to-top" href="#">
<img src="estilos/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>

<!-- FIN -->
<?php include "paginas/_footer.php"; ?>

</div>

</body>
</html>