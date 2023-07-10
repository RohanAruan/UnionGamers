<?php
include '../funciones/lib.php';

if(!isset($_SESSION['usuario']))
{
header("Location: ../login");
exit;
}
?>
<?php
if($_GET['e'] <> ""){
$noticia = mysqli_query($con, "SELECT * FROM aor_mensajes WHERE id = '$_GET[e]'");
if($notc = mysqli_fetch_array($noticia)){
$idtema = $notc['id'];
$idusuario = $notc['idusuario'];
$idlider = $notc['idtema'];
$fechaa = $notc['fecha'];
$horaa = $notc['hora'];
echo '';
}else{
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Editar mensaje | AGE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php include "../paginas/_head.php"; ?>
<link rel="stylesheet" type="text/css" href="estilos/css/main.css">
<link rel="stylesheet" type="text/css" href="estilos/css/fonts.min.css">
<script src="https://cdn.tiny.cloud/1/oacfwr1n8ixdyeq3tz4vmz7ylealzfpzsb4ccjf33pululpy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="estilos/js/lazysizes.min.js" async=""></script>
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
<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div class="ui-block responsive-flex">
<div class="ui-block-title">
<?php 
$sqlB = mysqli_query($con, "SELECT * FROM aor_temas WHERE id = '$idlider'");
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

<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div class="ui-block">
<div class="ui-block-title bg-blue">
<h6 class="title c-white"><?=$notc['nombre']?></h6>
</div>
<div class="ui-block-content">

<?php
if(isset($_POST['editar'])) 
{

$contenido = secureData(mysqli_real_escape_string($con, $_POST['contenido']));

if($contenido) {

$insertar = mysqli_query($con, "UPDATE aor_mensajes SET idtema='$idlider', mensaje='$contenido', fecha='$fechaa', hora='$horaa' WHERE id = '$_GET[e]'");	

if($insertar) {echo '<script>window.location="showtopic?s='.$_GET[c].'-'.$fors['nombre'].'"</script>';}

} else {echo "<script>Swal.fire({title: '¡No hay ningún mensaje!',icon: 'error',timer: 2500,showConfirmButton: false});</script>";}

}
?>

<form action="" method="POST">

<div class="row">

<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="form-group">
<textarea class="form-control" style="height:500px" name="contenido"><?=$notc['mensaje']?></textarea>
</div>
</div>

<div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
<a onclick="myFunction(this)" class="btn btn-secondary btn-lg full-width">Vista previa</a>
</div>

<div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
<input type="submit" name="editar" class="btn btn-blue btn-lg full-width" value="Editar respuesta">
</div>
</div>

</form>
</div>
</div>

</div>
</div>

<!-- FIN -->
<?php include "../paginas/_footer.php"; ?>

</div>

<script>
function myFunction(x) {;
tinymce.activeEditor.execCommand('mcePreview');
}
</script>

</body>
</html>