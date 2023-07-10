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
<meta http-equiv="x-ua-compatible" content="ie=edge">	
<title><?=$onombre?></title>
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

<?php include "paginas/_lateralm.php"; ?>	

<div class="col-lg-9">

<!-- ANUNCIO --
<div style="margin-bottom:15px;background:#1d68f1;color:#fff;padding: .45rem 1.25rem;font-size: 14px;border-radius:6px;" class="alert alert-dismissible fade show" role="alert">
<strong><i class="fal fa-info-circle mr-2"></i></strong> Se está trabajando en AOR (PCU v0.9)
<button type="button" style="margin-top:-5px;margin-left:10px" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<!-- FIN -->

<!-- VERIFICACIÓN DE MAIL -->
<?php if($vmail == 2) { ?>
<div class="alert alert-warning alert-dismissible fade show" style="margin-bottom:15px;font-size: 14px;padding:.45rem 1.25rem !important;background:#fff2cc !important;border-color:#fff2cc;border-radius:6px;" role="alert">

<strong><i class="fal fa-info-circle mr-2"></i></strong> Revisa la bandeja de <a href="mailto:<?=$email?>"><?= substr_replace("$email","***",0,-14);?></a> para completar el proceso de activación. <a href="seguridad" class="btn btn-info btn-sm ml-4">Verificar ahora</a>

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>

</div>
<?php } elseif($vmail == 0) { ?>
<div class="alert alert-warning alert-dismissible fade show" style="margin-bottom:15px;font-size: 14px;padding:.45rem 1.25rem !important;background:#fff2cc !important;border-color:#fff2cc;border-radius:6px;" role="alert">

<strong><i class="fal fa-info-circle mr-2"></i></strong> Completa el proceso de verificación para tu correo <a href="mailto:<?=$email?>"><?= substr_replace("$email","***",0,-14);?></a> <a href="seguridad" class="btn btn-info btn-sm ml-4">Verificar ahora</a>

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>

</div>
<?php } ?>
<!-- FIN -->

<div class="row">

<!--- USUARIOS --->
<div style="margin-bottom:15px;" class="col-lg-12">
<div class="statbox widget box box-shadow">
<div class="widget-header">
<div class="row">
<div class="col-xl-12 col-md-12 col-sm-12 col-12">
<h5 class="pb-0">Ciudadanos más nuevos</h5>
</div>
</div>
</div>

<div class="widget-content widget-content-area shadow-sm">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div id="content_1" class="tabcontent story-area"> 
<div class="story-container-1">

<?php
$query = "SELECT * FROM usuarios WHERE ID ORDER BY ID DESC LIMIT 7";
$result = mysqli_query($con, $query);

while($row = mysqli_fetch_array($result)){	  	
?> 
<div class="single-story">
<img src="estilos/img/avatars/<?=$row['avatar']?>" class="single-story-bg">
<div class="story-author">
<a href="perfil?idu=<?=$row['ID']?>&sec=muro">
<img src="estilos/img/avatars/<?=$row['avatar']?>">
<p class="p-1"><?php $quitargion=str_replace("_"," ",$row['Username']); echo(''.$quitargion.'') ?></p>
</a>
</div>
</div>
<?php } ?>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!--- FIN --->

<div style="margin-bottom:15px;" class="col-lg-8">
<div class="statbox widget box box-shadow">
<div class="widget-header">
<div class="row">
<div class="col-xl-12 col-md-12 col-sm-12 col-12">
<h5 class="pb-0">Periódico de hoy</h5>
</div>
</div>
</div>

<div class="widget-content widget-content-area shadow-sm">
<div style="display:flex;align-items:center;justify-content:flex-start;padding:5px" class="container-fluid mb-2">

<div class="row">

<?php
$record_per_page = 20;
$pagina = '';
if(isset($_GET["pagina"]))
{
$pagina = $_GET["pagina"];
}
else
{
$pagina = 1;
}

$start_from = ($pagina-1)*$record_per_page;

$query = "SELECT * FROM pcu_publicaciones WHERE id_pb ORDER BY fecha DESC LIMIT $start_from, $record_per_page";
$result = mysqli_query($con, $query);
?>
<?php
while($row = mysqli_fetch_array($result)){	
$cadena = $row['titulo'];		
$idusuario = $row['usuario'];	 

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$idusuario'");
$usuario = mysqli_fetch_array($sqlA);   	
?>  

<div style="margin-top:-10px" class="col-lg-12">
<div class="blog-post rounded border">
<div class="content p-3">
<small class="text-muted p float-right">19th Oct, 19</small>
<small><a href="javascript:void(0)" class="text-primary">Marketing</a></small>
<h4 class="mt-2"><a href="javascript:void(0)" class="text-dark title">Quick guide on business with friends.</a></h4>
<p class="text-muted mt-2">There is now an abundance of readable dummy texts. These are usually used when a text is required purely to fill a space.</p>
<div class="pt-3 mt-3 border-top d-flex">
<img class="img-profile mr-2" style="width:25px;height:25px;object-fit:cover;border-radius:50%;" src="<?=$todo?>/estilos/img/avatars/<?=$usuario['avatar']?>?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="bottom" title="<?=$usuario['usuario']?>">
<div class="author mt-1">
<h6 class="mb-0"><a href="javascript:void(0)" class="text-dark name">Lisa Marvel</a></h6>
</div>
</div>
</div>
</div><!--end blog post-->
</div><!--end col-->

<?php
}
?>

</div>
</div>
</div>
</div>

</div>

<div style="margin-bottom:15px;" class="col-lg-4">
<div class="statbox widget box box-shadow">
<div class="widget-header">
<div class="row">
<div class="col-xl-12 col-md-12 col-sm-12 col-12">
<h5 class="pb-0">Empleos</h5>
</div>
</div>
</div>

<div class="widget-content widget-content-area shadow-sm">

</div>
</div>
</div>
</div>

<!----
<div style="margin-bottom:15px;" class="col-lg-12">
<div style="background:url(estilos/img/4.jpeg)center;border-radius:3px;" class="gradient-1 gradient-block">
<div class="row align-items-center">
<div class="col-lg-5">
<div class="p-5">
<h2 style="width:600px" class="mb-3 text-white">Cliente SA-MP 0.3dl</h2>
<a href="#" style="border-radius:2px;" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Descargar</a>
</div>
</div>
</div>
</div>
</div>
<!-- FIN --

<div class="col-lg-6">
<div class="card">
<div class="card-title">Ejemplo de noticia</div>	
<div class="card-body">

En todos los aniversarios comenzamos mirando hacia atrás en el tiempo, recordando el año 2009. En este año dos comunidades de rol en español tomaron la decisión de unificar esfuerzos y fusionarse para convertirse en lo que sería hoy en día una de las comunidades más grandes de rol en español de Grand Theft Auto: San Andreas, Los Santos – Juego de Rol.

<br><br>

<a href="#">
<img class="img-profile" style="width:27px;height:27px;object-fit:cover;border-radius:50%;" src="<?=$todo?>/estilos/img/avatars/<?=$avatar?>?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="bottom" title="<?=$usuario?>">
</a>

</div>
</div>
</div>
<!---->

</div>

<!-- WIDGETS -->
<?php include "paginas/_widget.php"; ?>
<!-- FIN -->

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</div>
</section>

</body>
</html>