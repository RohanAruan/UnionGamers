<?php
include 'funciones/lib.php';
include 'funciones/anexos/paypal.php';

if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == $iduser) { } else { header("Location: ".$todo."/salir"); exit; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Ajustes de perfil</title>
<?php include "paginas/_head.php"; ?>
</head>
<!-- FIN -->

<?php 
if(isset($_SESSION["usuario"])) {
include 'paginas/_headerlog.php';
} else {
include 'paginas/_header.php';
}
?>

<!-- CUERPO -->
<div class="row">				 

<?php include "paginas/_lateralu.php"; ?>
<!-- FIN -->

<!-- TITULO -->
<div class="d-flex align-item-center title mb-3">
<h4 style="font-weight:600" class="m-0">Perfil</h4>
</div>
<!-- FIN -->	

<div style="border-radius:4px;padding:1.50rem 3rem 1rem!important" class="bg-white">
<div class="row">

<div class="col-md-12 mb-4">
<div class="form-group">

<form role="form" method="post" action="" enctype="multipart/form-data">

<?php
if(isset($_FILES['avatar']))
{

$tipo = $_FILES['avatar'];
$rfoto = $_FILES['avatar']['tmp_name'];
$peso = $_FILES['avatar']['size'];
$name = $iduser.'.'.$tipo;

if($_FILES["avatar"]["type"]=="image/jpeg" || $_FILES["avatar"]["type"]=="image/gif" || $_FILES["avatar"]["type"]=="image/png")
{

if((($peso < 3000000))) {

if(is_uploaded_file($rfoto))
{
$destino = 'estilos/img/avatars/'.$name;
$nombrea = $name;
copy($rfoto, $destino);
} else {
$nombrea = $avatar;
}

$sql = mysqli_query($con, "UPDATE usuarios SET avatar = '$nombrea' WHERE ID = '{$_SESSION['usuario']}'");

if($sql) {echo "<script>Swal.fire({title: 'Se cambió la foto de perfil',icon: 'success',timer: 3000,showConfirmButton: false}).then(function() {
    window.location = 'opciones';});</script>";}

} else {echo "<script>Swal.fire({title: 'El limite de peso es de 3MB',icon: 'warning',timer: 3000,showConfirmButton: false});</script>";}

} else {echo "<script>Swal.fire({title: 'El tipo de archivo es erróneo',icon: 'error',timer: 3000,showConfirmButton: false});</script>"; }

}
?>

<div style="float:left;" class="mr-4">
<img class="img-profile mr-2" style="width:120px;height:120px;object-fit:cover;border-radius:4px;" src="<?=$todo?>/estilos/img/avatars/<?=$avatar?>?nocache=<?=$versiones?>">

<label class="custom-file-new btn" style="z-index:1;margin-left: -55px;
    margin-top: -60px;" data-toggle="tooltip" data-placement="top" title="Máximo 3MB"><i style="margin-left:-4px;" class="fal fa-camera"></i>
<input type="file" onchange="this.form.submit()" name="avatar" id="avatar" value="<?=$avatar?>" />
</label>
</div>
</form>

<form role="form" method="post" action="" enctype="multipart/form-data">

<?php
if(isset($_FILES['banner']))
{

$tipo = $_FILES['banner'];
$rfoto = $_FILES['banner']['tmp_name'];
$peso = $_FILES['banner']['size'];
$name = $iduser.'.'.$tipo;

if($_FILES["banner"]["type"]=="image/jpeg" || $_FILES["banner"]["type"]=="image/gif" || $_FILES["banner"]["type"]=="image/png")
{

if((($peso < 4000000))) {

if(is_uploaded_file($rfoto))
{
$destino = 'estilos/img/avatars/banners/'.$name;
$nombrea = $name;
copy($rfoto, $destino);
} else {
$nombrea = $banner;
}

$sql = mysqli_query($con, "UPDATE usuarios SET banner = '$nombrea' WHERE ID = '{$_SESSION['usuario']}'");

if($sql) {echo "<script>Swal.fire({title: 'Se cambió la foto de portada',icon: 'success',timer: 3000,showConfirmButton: false}).then(function() {
    window.location = 'opciones';});</script>";}

} else {echo "<script>Swal.fire({title: 'El limite de peso es de 4MB',icon: 'warning',timer: 3000,showConfirmButton: false});</script>";}

} else {echo "<script>Swal.fire({title: 'El tipo de archivo es erróneo',icon: 'error',timer: 3000,showConfirmButton: false});</script>"; }

}
?>

<div style="float:left;">
<img class="img-profile" style="width:489px;height:120px;object-fit:cover;border-radius:4px;z-index: 0;" src="<?=$todo?>/estilos/img/avatars/banners/<?=$banner?>?nocache=<?=$versiones?>">

<label class="custom-file-new btn" style="z-index:1;margin-left: -45px;
    margin-top: -60px;" data-toggle="tooltip" data-placement="top" title="Máximo 4MB"><i style="margin-left:-4px;" class="fal fa-camera"></i>
<input type="file" onchange="this.form.submit()" name="banner" id="banner" value="<?=$banner?>" /></label>
</div>

</form>

</div>
</div>

<form role="form" style="width:100%" method="POST" action="" enctype="multipart/form-data" accept-charset="UTF-8">

<?php
if(isset($_POST['actualizar']))
{
$nombrex = secureData(mysqli_real_escape_string($con, $_POST['nombrex']));
$sexox = secureData(mysqli_real_escape_string($con, $_POST['sexox']));
$nacimientox = secureData(mysqli_real_escape_string($con, $_POST['nacimientox']));

if($nacimientox != '') {$nac = $nacimientox;} else {$nac = $fechanaci;}

if(validarCadenaUsuario($nombrex) == true)
{   

$sql = mysqli_query($con, "UPDATE usuarios SET nombre = '$nombrex', sexo = '$sexox', nacimiento = '$nac' WHERE ID = '{$_SESSION['usuario']}'");

if($sql) {echo "<script>Swal.fire({title: 'Se guardaron los datos',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
    window.location = 'opciones';});</script>";}

} else {echo "<script>Swal.fire({title: 'Caracteres inválidos',icon: 'error',timer: 2500,showConfirmButton: false})</script>";}

}
?>

<div class="col-md-12">
<div class="form-group">
<label class="mb-0"><?=$lang['nombrecompleto']?></label>
<p style="font-size:12px;" class="mb-3 text-muted">Elige un nombre de perfil. Esto no cambiará tu nombre de usuario.</p>

<input type="text" style="border-radius:2px;border-color: #e1e1e1;" name="nombrex" class="for-control" value="<?=$nombre;?>">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Usuario</label>
<div style="border-radius:2px;border-color: #e1e1e1;padding: 0.525rem 0.85rem;background-color: #e9ecef;" class="for-control"><?=$usuario;?></div>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Fecha de nacimiento</label>
<input type="date" style="border-radius:2px;border-color: #e1e1e1;" name="nacimientox" class="for-control" value="<?=$nacimiento;?>">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Sexo</label><br>
<select class="custom-select for-control" name="sexox" style="border-radius:2px;border-color: #e1e1e1;">
<option value="H" <?php if($sexo == 'H') { echo 'selected'; } ?>>Hombre</option>
<option value="M" <?php if($sexo == 'M') { echo 'selected'; } ?>>Mujer</option>
</select>
</div>
</div>

<!--
<hr>
<div class="col-md-12">
<div class="form-group"> 
<label class="d-block text-danger">Borrar usuario</label>
<p class="text-muted font-size-sm">Una vez que elimine su cuenta, no hay vuelta atrás. Por favor esté seguro.</p>
</div>

<button class="btn btn-danger" type="button">Borrar</button>
</div>
-->

</div>
</div>

<div class="text-right mt-4">
<a href="opciones" class="btn btn-link">Cancelar</a>	
<button style="border-radius: 2px;" type="submit" name="actualizar" class="btn btn-info mr-1">Actualizar perfil</button>
</div>
</form>

</div>
<!-- FIN -->

</div>
<!-- FIN -->

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</div>
</section>

</body>
</html>