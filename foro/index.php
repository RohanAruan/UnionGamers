<?php
include '../funciones/lib.php';
include 'views/_lib.php';
?> 

<!DOCTYPE html>
<html lang="es">
<head>
<title>Foro | AGE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php include "../paginas/_head.php"; ?>
<link rel="stylesheet" type="text/css" href="<?=$todo?>/foro/estilos/css/main.css?ver=1.4">
<link rel="stylesheet" type="text/css" href="<?=$todo?>/foro/estilos/css/fonts.min.css">
</head>
<!-- FIN -->

<!-- MENÚ -->
<?php 
if(isset($_SESSION["usuario"])) {
include '../paginas/_headerlog.php';
} else {
include '../paginas/_header.php';
}
?>
<!-- FIN -->

<!-- CUERPO -->
<div style="margin-top:15px;" class="row">

<!-- PRIMERO -->
<div style="padding-left:0px;" class="col-lg-9">

<!-- FOROS -->
<?php
$net = $con->query("SELECT * FROM aor_categorias WHERE id AND idforo = '0'");

while($row = $net->fetch_array()) {

$idcategoria = $row['id'];
$tipocat = $row['tipo'];
$esfaccion = $row['faccion'];
?>

<!-- MOSTRAR CATEGORÍAS Y FOROS/SUBFOROS SOLO PARA EL STAFF -->
<?php if($tipocat != 0) { ?>

<?php if($rango > 0) { ?> 

<?php include "views/index/roles-categorias.php"; ?>

<?php } ?>

<?php } else { ?>
<!-- FIN -->


<!-- FOROS Y SUBFOROS -->
<div class="ui-block">

<table class="forums-table">

<thead>

<tr>

<th style="font-weight:bold;font-size:15px;line-height:1;" class="forum">
<?=$row['nombre']?> 
</th>

<th  class="forum">
</th>

<th class="forum">
<a data-toggle="collapse" href="#collapseExample<?=$idcategoria?>" role="button" aria-expanded="true" aria-controls="collapseExample<?=$idcategoria?>">
<i onclick="myFunction(this)" style="float:right;font-size:16.70px;font-weight:700;color:#d1d2d5;transition: 0.3s all linear;" class="aca fa fa-chevron-down"></i>	
</a>
</th>

</tr>

</thead>

<tbody class="collapse show" id="collapseExample<?=$idcategoria?>">

<?php 
$forosx = $con->query("SELECT * FROM aor_foros WHERE idcategoria = '$idcategoria' AND idforo = '0'");

while($foros = $forosx->fetch_array()) {

$idforo = $foros['id'];
$tipo = $foros['tipo'];
$tipoadmx = $foros['tipoadm'];
?>

<?php
$sqlLogs = mysqli_query($con, "SELECT * FROM aor_logs WHERE idforo = '$idforo'"); 
$logs = mysqli_fetch_array($sqlLogs); 
$visto = $logs['visto'];
?>

<tr>
<td class="forum topics-1">
<div class="forum-item">
<?php if($visto != 0) { ?>	
<img style="width:45px;height:45px;margin-top:3px;" src="<?=$todo?>/foro/img/iconos/<?=$foros['icono']?>.png" alt="forum">
<?php } else { ?>
<img style="width:45px;height:45px;opacity: 0.2;margin-top:3px;" src="<?=$todo?>/foro/img/iconos/<?=$foros['icono']?>.png" alt="forum">
<?php } ?>

<div style="padding-left: 10px;" class="content">

<!-- SI ES UN FORO DE ENLACE -->
<?php if($tipo != 0) { ?>

<?php
if(isset($_POST['visitamas'])) {
mysqli_query($con, "UPDATE aor_visitas SET redireccion = redireccion + 1 WHERE idforo = '$idforo'");
mysqli_query($con, "INSERT aor_visitas SET redireccion = redireccion + 1, idforo = '$idforo'");
echo '<script>window.location="'.$foros["redireccion"].'"</script>';
}
?>

<?php 
$sqlvi = mysqli_query($con, "SELECT * FROM aor_visitas WHERE idforo = '$idforo'");
$visitas = mysqli_fetch_array($sqlvi);

$redireccion = $visitas['redireccion'];

$nvisitas = number_format($redireccion);
?>	

<form action="" method="POST">
<button type="submit" name="visitamas" style="color:#000;font-size:18px;line-height:20px;font-weight:400;border: 1px white !important;background:transparent;padding:0px;"><?=$foros['nombre']?> <small style="padding-left:10px;font-style: italic;" class="text-muted">(<?=$nvisitas?> redirecciones)</small></button>
</form>

<?php } else { ?>
<!-- FIN -->

<!-- SÍ ES UN FORO NORMAL -->	
<a href="showforum?s=<?=$foros['id']?>-<?=$foros['nombre']?>" style="color:#000;font-size:18px;line-height:20px;font-weight:400;"><?=$foros['nombre']?> 

<?php
$sql = "SELECT * FROM aor_onlines WHERE idforo = '$idforo'";
$tviendo = $con->query($sql);
$totalviendo = mysqli_num_rows($tviendo);
 
if($totalviendo != 0) {
?>	

<small style="font-style: italic;padding-left:10px;" class="text-muted">(<?=$totalviendo;?> viendo)</small>
<?php } else { ?>
<?php } ?>

</a>
<?php } ?>
<!-- FIN -->

<!-- SÍ ES UN FORO DE FACCIONES/EMPRESAS --> 
<?php if($esfaccion != 0) { ?>
<p style="margin-bottom:8px;">
<?php
$subforosx = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo'");
if (mysqli_num_rows($subforosx)>0)
{
?>

<span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span>
<div style="display:grid" class="row">
<?php
} else { }

while($subforos = $subforosx->fetch_array()) {
$idsubx = $subforos['id'];
?>

<span style="padding-left:15px;margin-bottom:5px;"><img style="width:20px;height:20px;object-fit:cover;border-radius:50%;" src="<?=$subforos['icono']?>">
<a style="font-size:12px;" href="showforum?s=<?=$subforos['id']?>-<?=$subforos['nombre']?>"><?=$subforos['nombre']?></a></span>

<?php } ?>
</div>
</p>

<?php } else { ?>
<!-- FIN -->

<!-- SÍ ES UN SUBFORO NORMAL -->
<p style="margin-bottom:1px;">
<?php
$subforosx = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo'");
if(mysqli_num_rows($subforosx) > 0)
{
?>

<span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span>
<span>
<?php
} else { }

while($subforos = $subforosx->fetch_array()) {
$idsubx = $subforos['id'];
?>

<small><a style="font-size:12px;" href="showforum?s=<?=$subforos['id']?>-<?=$subforos['nombre']?>"><?=$subforos['nombre']?></a>,</small> 

<?php } ?>
</span>
</p>
<?php } ?>
<!-- FIN -->

<!-- DESCRIPCIÓN DEL FORO -->
<p class="text"><?=$foros['descripcion']?></p>
<!-- FIN -->

</div>
</div>
</td>
<!-- FIN -->

<!-- QUE TIPO ES, Y SÍ ES PARA FACCIÓN -->
<?php if($tipo != 0) { ?>

<?php } else { ?>

<?php if($esfaccion != 0) { ?>

<?php } else { ?>
<!-- FIN -->

<!-- TEMAS/MENSAJES -->
<?php
$sql = "SELECT * FROM aor_temas WHERE idlider = '$idforo'";
$temas = $con->query($sql);
$totaltemas = mysqli_num_rows($temas);
$ntemas = number_format($totaltemas);
?>	

<?php
$sqlSubs = "SELECT * FROM aor_temas WHERE idlider = '$idsubx'";
$temass = $con->query($sqlSubs);
$totaltemass = mysqli_num_rows($temass);
$ntemass = number_format($totaltemass);
?>	

<?php
$sql = "SELECT * FROM aor_mensajes WHERE idlider = '$idforo'";
$mensajes = $con->query($sql);
$totalmens = mysqli_num_rows($mensajes);
$nmens = number_format($totalmens);
?>	

<td class="topics topics-2">

<div class="row">

<div class="col-lg-6" style="border-right: 1px solid #bfc1c5;text-align:center;margin-left:-10px;padding-left:10px">
<p style="margin-bottom:0px;font-weight:400 !important;font-size:11px;text-align:center;color:#9ba5c0">Temas</p>
<p style="margin-bottom:0px;"><span style="margin-bottom:0px;font-size:17px;text-align:center;color:#000;"><?=$ntemas + $ntemass?></span></p>  
</div>

<div style="text-align:center;" class="col-lg-6">
<p style="margin-bottom:0px;font-weight:400 !important;font-size:11px;text-align:center;color:#9ba5c0">Mensajes</p>
<p style="margin-bottom:0px;"><span style="margin-bottom:0px;font-size:17px;text-align:center;color:#000;"><?=$nmens?></span>
</p>
</div>

</div>

</td>
<!-- FIN -->

<!-- ÚLTIMO MENSAJE DE FORO/SUBFORO -->
<?php
$sql = mysqli_query($con, "SELECT * FROM aor_mensajes WHERE idlider = '$idforo' ORDER BY id DESC, fecha");
$mensajes = mysqli_fetch_array($sql); 

$idusuario = $mensajes['idusuario'];
$idtema = $mensajes['idtema'];
$fecha = $mensajes["fecha"];
$hora = $mensajes["hora"];
$newDate = date("d-m-Y", strtotime($fecha));

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID  = '$idusuario'");
$usuario = mysqli_fetch_array($sqlA);  
$usuariox = $usuario['Username'];
$rol = $usuario['Admin']; 	
$typerankx = $usuario['Typerank']; 	
$fmostrar = $usuario['mostrar'];

$sqlFac = mysqli_query($con, "SELECT * FROM characters WHERE Username = '$usuariox'");
$pj = mysqli_fetch_array($sqlFac); 
$personaje = $pj['Personaje'];
$skinx = $pj['Skin'];

$sqlB = mysqli_query($con, "SELECT * FROM aor_temas WHERE id = '$idtema'");
$temas = mysqli_fetch_array($sqlB); 

if($mensajes > 0) { 
?>	

<td class="freshness">

<div style="width:250px" class="author-freshness">

<span>
<a href="<?=$todo?>/perfil?idu=<?=$usuario['ID']?>&sec=muro">	

<?php if($fmostrar == 0) { ?>
<img style="width:40px;height:40px;border-radius:50%;float:left;margin-top:3px;object-fit:cover;background:url('../estilos/img/avatars/defect.jpg');" src="../estilos/img/avatars/<?=$usuario['avatar']?>?nocache=<?=$versiones?>" class="shadow-sm"> 
<?php } else { ?>
<img style="width:40px;height:40px;border-radius:50%;float:left;margin-top:3px;object-fit:cover;background:url('../estilos/img/avatars/defect.jpg');" src="../estilos/img/skins/<?=$pj['Skin']?>.jpg?nocache=<?=$versiones?>" class="shadow-sm">     
<?php } ?>

</a>
</span>

<div style="padding-left: 52px;">
<a href="showtopic?s=<?=$temas['id']?>-<?=$temas['nombre']?>" style="color:#38a9ff;white-space: nowrap;font-size:14px;" title="<?=$temas['nombre']?>"><span style="color:<?=$temas['prefijoc']?>;font-weight:500;text-transform:uppercase;"><?=$temas['prefijo']?></span> <?=limitar_cadena($temas['nombre'], 20, '...');?></a> 

<p style="margin-bottom:0px;">
Por <?php if($fmostrar == 0) { ?>
<a href="../perfil?idu=<?=$usuario['ID']?>&sec=muro" style="color:<?php include "views/permisos/croles.php"; ?> !important;"><?php $quitargion=str_replace("_"," ",$usuario['Username']); echo(''.$quitargion.'') ?></a>
<?php } else { ?>
<a href="../perfil?idu=<?=$usuario['ID']?>&sec=muro" style="color:<?php include "views/permisos/croles.php"; ?> !important;"><?php $quitargion=str_replace("_"," ",$pj['Personaje']); echo(''.$quitargion.'') ?></a>
<?php } ?>,
<time class="entry-date updated" style="font-size:14px" datetime="<?=$fecha?>"><?=strftime("%d de %B", strtotime($newDate));?></time>
</p>
</div>


</div>

</td>
</tr>

<?php } else { ?>	

<td style="text-align:center;" class="freshness">
<div class="author-freshness">
<span class="h6 title">No hay mensajes</span>
</div>
</td>

</tr>
<?php } ?>
<!-- FIN -->

<?php } ?>
<!-- FIN -->

<?php } ?>
<!-- FIN -->

<?php } ?>

</tbody>
</table>

</div>
<!-- FIN -->

<?php } ?>
<!-- FIN -->

<?php } ?>
<!-- FIN -->

<!-- ESTADÍSTICAS DEL FORO -->
<div class="ui-block responsive-flex">
<div style="border-bottom: 1px solid #e6ecf5;" class="ui-block-title">
<div style="font-weight:bold;font-size:15px;line-height:1;color:black" class="h6 title">Estadísticas
<a data-toggle="collapse" href="#collapseExample100" role="button" aria-expanded="true" aria-controls="collapseExample100">
<i onclick="myFunction(this)" style="float:right;font-size:16.70px;font-weight:700;color:#d1d2d5;transition: 0.3s all linear;" class="aca fa fa-chevron-down">
</i>	
</a>
</div>
</div>

<div style="margin-bottom:25px;margin-top:20px;text-align:center" class="container collapse show" id="collapseExample100">
<div class="row">

<div class="col-lg-3">

<?php
$sql = "SELECT * FROM usuarios WHERE ID";
$miembros = $con->query($sql);
$totalmiembros = mysqli_num_rows($miembros);
$nmiembros = number_format($totalmiembros);
?>	

<h5 style="font-weight:600;margin-bottom:0px;margin-top:15px;"><?=$nmiembros?></h5>
<small style="text-align:center" class="text-muted">Miembros</small>
</div>

<div class="col-lg-2">

<?php
$sql = "SELECT * FROM aor_mensajes WHERE id";
$mensajes = $con->query($sql);
$totalmensajes = mysqli_num_rows($mensajes);
$nmensajes = number_format($totalmensajes);
?>	

<h5 style="font-weight:600;margin-bottom:0px;margin-top:15px;"><?=$nmensajes?></h5>
<small style="text-align:center" class="text-muted">Respuestas</small>
</div>

<div class="col-lg-3">

<?php
$sql = "SELECT * FROM aor_temas WHERE id";
$temas = $con->query($sql);
$totaltemas = mysqli_num_rows($temas);
$ntemas = number_format($totaltemas);
?>	

<h5 style="font-weight:600;margin-bottom:0px;margin-top:15px;"><?=$ntemas?></h5>
<small style="text-align:center" class="text-muted">Temas</small>
</div>

<div style="border-left:1px solid #eaecef" class="col-lg-4">

<?php 
$userrdb = mysqli_query($con, "SELECT * FROM usuarios WHERE ID ORDER BY ID DESC LIMIT 1");
$userr = mysqli_fetch_array($userrdb);	
$fechac = $userr["RegisterDate"];
$fecha2 = preg_replace('/:[0-9][0-9][0-9]/',$fechac);
$time = strtotime($fecha2);
$time2 = dateDiff($time,time());
?>

<div class="row">
<div style="width:47px;padding-left:5px;margin-left:50px;margin-top:10px;">
<a href="<?=$todo?>/perfil?idu=<?=$userr['ID']?>&sec=muro">		
<img style="width:44px;height:44px;border-radius:50%;object-fit:cover" src="../estilos/img/avatars/<?=$userr['avatar']?>?nocache=<?=$versiones?>">
</a>
</div>	

<div style="width:100px;margin-left:10px;">
<h6 style="font-weight:600;margin-bottom:0px;margin-top:15px;"><a style="color:#000" href="<?=$todo?>/perfil?idu=<?=$userr['ID']?>&sec=muro"><?=$userr['Username']?></a></h6>
<small style="text-align:center" class="text-muted">Se unió hoy</small>
</div>

</div>

</div>
</div>	
</div>

</div>
<!-- FIN -->

</div>
<!-- FIN -->

<?php include "views/_widgets.php"; ?>

</div>

<a style="background: #000;" class="back-to-top" href="#">
<img src="estilos/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>
<!-- FIN -->

<!-- FOOTER -->
<?php include "../paginas/_footer.php"; ?>

<script type="text/javascript">
function myFunction(x) {
x.classList.toggle("fa-chevron-left");
x.classList.toggle("fa-chevron-down");
}
</script>
<script src="<?=$todo?>/foro/views/edittopic/tinymce.min.js" referrerpolicy="origin"></script>
<script src="<?=$todo?>/foro/estilos/js/lazysizes.min.js" async=""></script>
<!-- FIN -->

</body>
</html>