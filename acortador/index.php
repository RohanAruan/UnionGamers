<?php
session_start();
include '../funciones/lib.php';

if(!isset($_SESSION['usuario']))
{
header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Crear URL corta - Union Gamers</title>
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

</body>
</html>