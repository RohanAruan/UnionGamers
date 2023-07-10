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
<title>Publicar respuesta | AGE</title>
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
$sqlB = mysqli_query($con, "SELECT * FROM aor_temas WHERE id = '$_GET[c]'");
$fors = mysqli_fetch_array($sqlB); 
$idtem = $fors['id'];
?>

<div class="h6 title">Age Of Rol <a class="btn btn-info btn-sm" style="margin-left:9px;" href="showtopic?s=<?=$fors['id']?>-<?=$fors['nombre']?>"><?=$fors['nombre']?></a></div>
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
<h6 class="title c-white">Publicar respuesta</h6>
</div>
<div class="ui-block-content">

<?php
if(isset($_POST['crear']))
{

$contenido = secureData(mysqli_real_escape_string($con, $_POST['contenido']));

if($contenido) {

$insertar = mysqli_query($con, "INSERT INTO aor_mensajes (idtema,idlider,idsub,mensaje,idusuario,fecha,hora) values ('$idtem','".$_GET['idf']."','".$_GET['idf1']."','$contenido','$iduser','$fecha','$hora')");	

if($insertar) {echo '<script>window.location="showtopic?s='.$_GET[c].'-'.$fors['nombre'].'"</script>';}

} else {echo "<script>Swal.fire({title: '¡No hay ningún mensaje!',icon: 'error',timer: 2500,showConfirmButton: false});</script>";}

}

?>

<form action="" method="POST">

<div class="row">

<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="form-group">
<textarea class="form-control" style="height: 240px" minlength="6" name="contenido"></textarea>
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