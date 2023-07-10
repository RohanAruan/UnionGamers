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
<title>Privacidad</title>
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
<h4 style="font-weight:600" class="m-0">Privacidad</h4>
</div>
<!-- FIN -->	

<?php
if(isset($_POST['actualizar']))
{
$muro = secureData(mysqli_real_escape_string($con, $_POST['muro']));
$mostrare = secureData(mysqli_real_escape_string($con, $_POST['mostrare']));

$sql = mysqli_query($con, "UPDATE usuarios SET privada = '$muro', mostrar = '$mostrare'  WHERE ID = '{$_SESSION['usuario']}'");

if($sql) {echo "<script>Swal.fire({title: '¡Se guardaron los datos!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
    window.location = 'privacidad';});</script>";}

}
?>

<div style="border-radius:4px" class="p-4 bg-white">	

<div class="row gutter-1">

<form role="form" method="post" style="width:100%" action="" enctype="multipart/form-data">

<?php if($enlazado == 1) { ?>
<div class="col-md-12">
<div class="form-group">
<label>Nombre a mostrar</label><br>
<select class="custom-select for-control" name="mostrare" style="border-radius:2px;border: 1px solid #f2f5fb;width:60%;">
<option value="0" <?php if($mostrar == '0') { echo 'selected'; } ?>>PCU</option>
<option value="1" <?php if($mostrar == '1') { echo 'selected'; } ?>>SAMP</option>
</select>
</div>
</div>
<?php } ?>

<div class="col-md-12">
<div class="form-group">
<label>Muro</label><br>
<select class="custom-select for-control" name="muro" style="border-radius:2px;border: 1px solid #f2f5fb;width:60%;">
<option value="0" <?php if($muro == '0') { echo 'selected'; } ?>>Público</option>
<option value="1" <?php if($muro == '1') { echo 'selected'; } ?>>Privado</option>
</select>
</div>
<hr>
</div>
<!-- FIN -->

<div class="col-md-12">
<div class="form-group mb-0">
<label class="d-block">Sesión</label>
<ul class="list-group list-group-sm">
<li class="list-group-item has-icon">
<div>
<h6 class="mb-0"><img class="mr-2" style="width:20px;height:20px;margin-top:-4px;" src="estilos/img/banderas/<?=$paiss?>.png"> <?=$ip?></h6>
<small class="text-muted">Tu sesión actual es en <?=$nombrepais?></small>
</div>
<button class="btn btn-light btn-sm ml-auto" type="button" data-toggle="modal" data-target="#Sesiones">Historial</button>
</li>
</ul>
</div>
</div>

</div>
</div>

<div class="text-right mt-4">
<a href="opciones" class="btn btn-link">Cancelar</a> <button style="border-radius:2px;" type="submit" name="actualizar" class="btn btn-info">Guardar</button>
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

<!-- HISTORIAL -->
<div class="modal fade" id="Sesiones" tabindex="-1" aria-labelledby="SesionesLabel" aria-hidden="true">
<div style="border-radius:2px;" class="modal-dialog shadow-sm">
<div style="height:auto;border-bottom: 2px solid #0652DD;" class="modal-content">
<div style="border:0px;padding: 1rem 1rem;">
<i style="font-size:18px" class="fal fa-arrow-left mr-2" type="button" data-dismiss="modal" aria-label="Cerrar"></i> 
<span style="font-size:18px;">Historial de sesiones</span>
</div>

<div style="overflow: auto; height: 538px;" class="modal-body">
<ul class="list-group list-group-sm">

<?php
$query = "SELECT * FROM pcu_sesiones WHERE usuario = '$iduser' ORDER BY fecha";
$result = mysqli_query($con, $query);

while($row = mysqli_fetch_array($result)){	 	
?> 

<li class="list-group-item has-icon">
<div>
<h6 class="mb-0"><img class="mr-2" style="width:20px;height:20px;margin-top:-4px;" src="estilos/img/banderas/<?=$row['pais']?>.png"> <?=$row['ip']?></h6>
<h6 style="float:right"><?=$row['fecha']?></h6>
<small class="text-muted">Esta sesión fue en <?=$row['nombrepais']?></small>
</div>
</li>

<?php } ?>

</ul>

</div>

</div>
</div>
</div>
<!-- FIN -->

</body>
</html>
