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
<title>Publicar tema | AGE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php include "../paginas/_head.php"; ?>
<link rel="stylesheet" type="text/css" href="<?=$todoh?>/foro/estilos/css/main.css">
<link rel="stylesheet" type="text/css" href="<?=$todoh?>/foro/estilos/css/fonts.min.css">
 <script src="https://cdn.tiny.cloud/1/oacfwr1n8ixdyeq3tz4vmz7ylealzfpzsb4ccjf33pululpy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="<?=$todoh?>/foro/estilos/js/lazysizes.min.js" async=""></script>
<script>
tinymce.init({
selector: 'textarea',
plugins: 'emoticons media autosave preview advlist autolink lists wordcount link image charmap print preview hr anchor pagebreak code table insertdatetime',
toolbar_mode: 'floating',
toolbar: 'restoredraft media link image numlist bullist hr wordcount insertdatetime emoticons code table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
language_url : 'views/edittopic/es_ES.js',
language: 'es_ES',

});
</script>
<script>tinymce.init({selector:'textarea'});</script>
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

<?php 
$sqlB = mysqli_query($con, "SELECT * FROM aor_foros WHERE id = '$_GET[c]'");
$fors = mysqli_fetch_array($sqlB); 
?>

<div class="h6 title">Age Of Rol <a class="btn btn-info btn-sm" style="margin-left:9px;" href="showforum?s=<?=$fors['id']?>-<?=$fors['nombre']?>"><?=$fors['nombre']?></a></div>
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
<h6 class="title c-white">Publicar</h6>
</div>
<div class="ui-block-content">

<?php
if(isset($_POST['crear'])) {

$titulo = secureData(mysqli_real_escape_string($con, $_POST['titulo']));
$idforo = secureData(mysqli_real_escape_string($con, $_POST['idforo']));
$prefijo = mysqli_real_escape_string($con, $_POST['prefijo']);
$contenido = secureData(mysqli_real_escape_string($con, $_POST['contenido']));
$fijado = secureData(mysqli_real_escape_string($con, $_POST['fijado']));
$cerrado = secureData(mysqli_real_escape_string($con, $_POST['cerrado']));
$contraseña = secureData(mysqli_real_escape_string($con, $_POST['contraseña']));
$contraseñae = secureData(mysqli_real_escape_string($con, $_POST['contraseñae']));

$insertar = mysqli_query($con, "INSERT INTO aor_temas (nombre,idlider,contenido,idusuario,prefijo,fijado,cerrado,contraseña,contraseñae,fecha,hora) values ('$titulo','$_GET[c]','$contenido','$iduser','$prefijo','$fijado','$cerrado','$contraseña','$contraseñae','$fecha','$hora')");	

echo '<script>window.location="showforum?s='.$_GET[c].'"</script>';

}

?>

<form action="" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">

<div class="row">
<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="form-group label-floating">
<label class="control-label">Titulo</label>
<input class="form-control" type="text" placeholder="" name="titulo" required>
<input class="form-control" type="hidden" placeholder="" name="idforo" value="1">
</div>
</div>

<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="form-group label-floating is-select">
<label class="control-label">Prefijos (Opcional)</label>
<select style="height: 57px;" class="form-control" name="prefijo">

<option selected></option>
<option value="[Novedad]">Novedad</option>
<option value="[Evento]">Evento</option>
<option value="[Presentacion]">Presentación</option>

</select>

</div>
</div>

<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="form-group">
<textarea class="form-control" style="height: 240px" minlength="6" placeholder="Contenido" name="contenido"></textarea>
</div>
</div>

<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div style="border: 1px solid #e9e9e9;padding:15px 15px" class="form-group">
<span style="color:#888da8;">Moderación</span>
<br><br>

<div class="custom-control custom-switch">
<input type="checkbox" class="custom-control-input custom1" value="1" name="fijado" id="customSwitch1">
<label class="custom-control-label" for="customSwitch1">Fijado</label>
</div>

<div class="custom-control custom-switch">
<input type="checkbox" class="custom-control-input custom1" value="1" name="cerrado" id="customSwitch2">
<label class="custom-control-label" for="customSwitch2">Cerrado</label>
</div>

<div class="custom-control custom-switch">
<input type="checkbox" class="custom-control-input custom1" value="1" name="contraseña" id="customSwitch3">
<label class="custom-control-label" for="customSwitch3">Contraseña</label>
</div>
<br>

<input class="form-control" type="text" placeholder="Contraseña" name="contraseñae">

</div>


</div>

<div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
<a onclick="myFunction(this)" class="btn btn-secondary btn-lg full-width">Vista previa</a>
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

<script>
function myFunction(x) {;
tinymce.activeEditor.execCommand('mcePreview');
}
</script>

<!-- FIN -->
<?php include "../paginas/_footer.php"; ?>

</div>

</body>
</html>