<?php
include 'funciones/config.php';
?>

<?php
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
if (!headers_sent()) {
header("Status: 301 Moved Permanently");
header(sprintf(
'Location: https://%s%s',
$_SERVER['HTTP_HOST'],
$_SERVER['REQUEST_URI']
));
exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Mantenimiento | Union Gamers</title>
<?php include "paginas/_head.php"; ?>
<style>
body {background: url('estilos/img/mantenimiento.jpg') !important;}
</style>
</head>
<!-- FIN -->

<div style="max-width:680px;" class="container">

<center>
<div style="border-radius:12px !important;background:#fff;padding:20px" class="card mt-5 shadow-sm">
<div style="padding:10px !important;" class="card-body">
<img style="width:130px;margin-bottom:15px;border-radius:3px;margin-left:-5px" src="<?=$todo?>/estilos/img/logo1.png">
<p style="text-align:center;" class="lead">Panel de Control de Usuario y Foro en mantenimiento.</p>
<p style="text-align:center;" class="mb-4">El sitio web (PCU, foro) se encuentra en mantenimiento. Estaremos lanzando la apertura del foro a todo el público en septiembre.</p>
<p style="text-align:center;" class="mb-3">No olvides visitar nuestro Discord para mantenerte actualizado sobre la apertura del servidor</p>

<a href="https://discord.uniongamers.org" style="background: #154a98 !important;border-color: #154a98 !important;" class="btn btn-info mb-3">Discord</a> 
<a href="https://www.facebook.com/UnionGamersOficial" style="background: #154a98 !important;border-color: #154a98 !important;" class="btn btn-info mb-3"><img style="width:22.50px;height:22.50px;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Facebook_f_logo_%282019%29.svg/2048px-Facebook_f_logo_%282019%29.svg.png"></a> 

<p style="text-align:center;" class="mb-4">¡Gracias por la espera!</p>
<small style="font-weight:600;">- Equipo de UG.</small>
</div>
</div>

</div>
</div>

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</div>

</body>
</html>