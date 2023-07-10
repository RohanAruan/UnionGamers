<?php
include 'funciones/lib.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>404 | AOR</title>
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

<div style="max-width:403px;" class="container">

<center>
<div style="border-radius:12px !important;background:transparent;padding:40px" class="card mt-5">
<div style="padding:10px !important;" class="card-body">
<div style="font-size:100px;text-align:center;color:#000" class="display-4 mb-2 mt-2 font-weight-bold">404</div>
<p style="text-align:center;" class="mb-4 lead">¡Uy! Parece que siguió un enlace incorrecto.</p>
<a onclick="history.back()" style="color:#fff;border-radius:12px;" class="btn btn-block btn-lg btn-info">Volver</a>
</div>
</div>

</div>
</div>

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</div>

</body>
</html>