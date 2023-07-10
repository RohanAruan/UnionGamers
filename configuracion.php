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
<title>Configuración</title>
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
<h4 style="font-weight:600" class="m-0">Configuración</h4>
</div>
<!-- FIN -->	

<!-- IDIOMA -->
<form role="form" method="post" action="" enctype="multipart/form-data">

<?php
if(isset($_POST['actualizar']))
{
$tema = secureData(mysqli_real_escape_string($con, $_POST['tema']));

$sql = mysqli_query($con, "UPDATE usuarios SET tema = '$tema' WHERE ID = '{$_SESSION['usuario']}'");

if($sql) {echo "<script>Swal.fire({title: '¡Se guardaron los datos!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
    window.location = 'configuracion';});</script>";}

}
?>

<div style="border-radius:4px" class="p-4 bg-white">	

<div class="row gutter-1">

<div class="col-md-12">
<div class="form-group">
<label>Tema</label><br>
<select class="custom-select for-control" name="tema" style="width:60%;border: 1px solid #f2f5fb;">
<option value="claro" <?php if($tema == 'claro') { echo 'selected'; } ?>>Claro</option>
<option value="oscuro" <?php if($tema == 'oscuro') { echo 'selected'; } ?>>Oscuro</option>
</select>
</div>
</div>

<!--
<div class="col-md-12">
<div class="form-group">
<label class="d-block">Autentificación de 2 pasos</label>
<button class="btn btn-info" type="button">Habilitar Two-Factor</button>
<p class="small text-muted mt-2">Two-factor authentication adds an additional layer of security to your account by requiring more than just a password to log in.</p>
</div>
<hr>
</div>
-->



</div>
</div>
<div class="text-right mt-4">
<a href="opciones" class="btn btn-link">Cancelar</a>	
<button style="border-radius: .25rem;" type="submit" name="actualizar" class="btn btn-info mr-1">Actualizar</button>
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
