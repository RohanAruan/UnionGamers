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

<div style="padding-left:0px;" class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div class="ui-block">
<div class="ui-block-title bg-blue">
<h6 class="title c-white">Crear Foro</h6>
</div>
<div class="ui-block-content">

<?php
if(isset($_POST['crear'])) {

$titulo = secureData(mysqli_real_escape_string($con, $_POST['titulo']));
$categoria = secureData(mysqli_real_escape_string($con, $_POST['categoria']));
$descripcion = secureData(mysqli_real_escape_string($con, $_POST['descripcion']));
$icono = secureData(mysqli_real_escape_string($con, $_POST['icono']));

$insertar = mysqli_query($con, "INSERT INTO aor_foros (nombre,idcategoria,descripcion,icono) values ('$titulo','$categoria','$descripcion','$icono')");	

echo '<div class="alert alert-success" style="border-radius:1px;" role="alert">¡Has creado el foro!</div>';

}

?>

<form action="" method="POST">

<div class="row">
<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="form-group label-floating">
<label class="control-label">Nombre</label>
<input class="form-control" type="text" placeholder="" name="titulo">
<input class="form-control" type="hidden" value="../estilos/img/iconos/on.png" name="icono">
</div>
</div>

<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="form-group label-floating is-select">
<label class="control-label">Categoría</label>
<select style="height: 57px;" class="form-control" name="categoria">

<?php
$result = mysqli_query($con, "SELECT * FROM aor_categorias WHERE idforo = '0'");

while($foros = mysqli_fetch_array($result)){	
?>

<option value="<?=$foros['id']?>"><?=$foros['nombre']?></option>

<?php } ?>

</select>

</div>
</div>

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

</div>
</div>

<a style="background: #a4433c;" class="back-to-top" href="#">
<img src="<?=$todoh?>/estilos/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>

<!-- FIN -->
<?php include "paginas/_footer.php"; ?>

</div>

</body>
</html>