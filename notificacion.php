<?php
include 'funciones/lib.php';

if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == $iduser) { } else { header("Location: ".$todo."/salir"); exit; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Notificaciones</title>
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

<?php 
$sql1 = mysqli_query($con, "SELECT * FROM aor_grupos WHERE id = '$grupousuario'");
$grupo1 = mysqli_fetch_array($sql1);

$sql2 = mysqli_query($con, "SELECT * FROM aor_grupos WHERE id = '$grupofaccion'");
$grupo2 = mysqli_fetch_array($sql2);

$sql3 = mysqli_query($con, "SELECT * FROM aor_grupos WHERE id = '$grupoempresa'");
$grupo3 = mysqli_fetch_array($sql3);

$sql4 = mysqli_query($con, "SELECT * FROM aor_grupos WHERE id = '$grupostaff'");
$grupo4 = mysqli_fetch_array($sql4);

if($grupo4['id'] == $grupostaff) {
include 'views/index/inde.php';
} elseif($grupo2['id'] == $grupofaccion) {
include 'views/index/inde.php';
} elseif($grupo3['id'] == $grupoempresa) {
include 'views/index/inde.php';
} elseif($grupo1['id'] == $grupousuario) {
include 'views/index/index.php'; }
?>

<!-- CUERPO -->
<div class="row">				 

<?php include "paginas/_lateralu.php"; ?>
<!-- FIN -->


<!-- TITULO -->
<div class="d-flex align-item-center title mb-3">
<h4 style="font-weight:600" class="m-0">Notificaciones</h4>
</div>
<!-- FIN -->	

<form role="form" method="post" action="" enctype="multipart/form-data">

<?php
if(isset($_POST['actualizar']))
{
$notificacionesr = mysqli_real_escape_string($con, $_POST['notificacionesr']);

$sql = mysqli_query($con, "UPDATE usuarios SET notificaciones = '$notificacionesr'  WHERE ID = '{$_SESSION['usuario']}'");

if($sql) {echo "<script>Swal.fire({title: '¡Se guardaron los datos!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
    window.location = 'notificacion';});</script>";}

}
?>

<div style="border-radius:4px" class="p-4 bg-white">	

<div class="row gutter-1">

<div class="col-md-12">
<div class="form-group">
<label>Notificaciones</label>
<div class="custom-control custom-switch">
<input type="checkbox" class="custom-control-input" name="notificacionesr" id="customSwitch0" value="<?php if($notificaciones == '0') { echo '1'; } ?><?php if($notificaciones == '1') { echo '0'; } ?>" onChange='submit()' <?php if($notificaciones == '1') { echo ''; } ?><?php if($notificaciones == '0') { echo 'checked'; } ?>>
<label class="custom-control-label" for="customSwitch0"><input type="submit" style="color:transparent;background: transparent;border:0px;margin-left:-37px;width:30px;height:30px;border-radius:15px;z-index:100;position:static;position: sticky;" name="actualizar"></label>
</div>

</div>
</div>

<!-- OTROS -->
<div class="col-md-12">
<div class="form-group mb-0"> 
<ul class="list-group list-group-sm">
<li class="list-group-item has-icon"> Comentarios<div class="custom-control custom-control-nolabel custom-switch ml-auto"> 
<input type="checkbox" class="custom-control-input" id="customSwitch1"> 
<label class="custom-control-label" for="customSwitch1"></label>
</div>
</li>

<li class="list-group-item has-icon"> Seguidores<div class="custom-control custom-control-nolabel custom-switch ml-auto"> 
<input type="checkbox" class="custom-control-input" id="customSwitch2"> 
<label class="custom-control-label" for="customSwitch2"></label>
</div>
</li>

<li class="list-group-item has-icon"> Empleos<div class="custom-control custom-control-nolabel custom-switch ml-auto"> 
<input type="checkbox" class="custom-control-input" id="customSwitch3"> 
<label class="custom-control-label" for="customSwitch3"></label>
</div>
</li>

<li class="list-group-item has-icon"> Eventos<div class="custom-control custom-control-nolabel custom-switch ml-auto"> 
<input type="checkbox" class="custom-control-input" id="customSwitch4"> 
<label class="custom-control-label" for="customSwitch4"></label>
</div>
</li>

<li class="list-group-item has-icon"> Empresas nuevas<div class="custom-control custom-control-nolabel custom-switch ml-auto"> 
<input type="checkbox" class="custom-control-input" id="customSwitch5"> <label class="custom-control-label" for="customSwitch5"></label>
</div>
</li>
</ul>
</div>
</div>
<!-- FIN -->

</div>
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
