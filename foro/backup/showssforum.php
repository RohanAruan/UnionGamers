<?php
error_reporting(0);
session_start();
include '../funciones/config.php';
include '../funciones/lib.php';
include_once('../funciones/anexos/fecha.php');
?>
<?php
if($_GET['s'] <> ""){
$noticia = mysqli_query($con, "SELECT * FROM aor_subforos WHERE id = '$_GET[s]'");
if($notc = mysqli_fetch_array($noticia)){
$idforo = $notc['idforo'];
$idsub = $notc['idsub'];
echo '';
}else{
}
}
?>
<?php
$z_user_id = mysqli_query($con, "SELECT eid FROM onlines WHERE eid = '$iduser'");
$o_user_id = mysqli_fetch_array($z_user_id);
$user_id = $o_user_id['eid'];
$this_date = date('U');

if ($user_id) {
mysqli_query($con, "UPDATE onlines SET tiempo='$this_date', idsforo='$_GET[s]', idforo='0', idtema='0' WHERE eid = '$iduser'");
} else {
mysqli_query($con, "INSERT onlines SET eid='$iduser', idsforo='$_GET[s]', tiempo='$this_date'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?=$notc['nombre']?> | AGE</title>
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
<br>
<div style="max-width:1000px;" class="container">
<div style="margin-top:70px;" class="row">

<!-- PRIMERO -->

<div class="container">
<div class="row">
<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<nav aria-label="breadcrumb">
<ol style="padding:0px;background-color:transparent;margin-bottom:0px;float:left;" class="breadcrumb">
<li class="breadcrumb-item"><a href="index"><i class="fa fa-home"></i> Foros</a></li>

<?php 
$sqlB = mysqli_query($con, "SELECT * FROM aor_foros WHERE id = '$idforo'");
$forosb = mysqli_fetch_array($sqlB); 

$sqlBR = mysqli_query($con, "SELECT * FROM aor_subforos WHERE id = '$idsub'");
$forosbr = mysqli_fetch_array($sqlBR); 

$categoriar = $forosb['idcategoria'];

$sqlA = mysqli_query($con, "SELECT * FROM aor_categorias WHERE id = '$categoriar'");
$categoria = mysqli_fetch_array($sqlA);     
?>

<li class="breadcrumb-item"><a href="index"><?=$categoria['nombre']?></a></li>

<li class="breadcrumb-item"><a href="showforum?s=<?=$forosb['id']?>-<?=$forosb['nombre']?>"><?=$forosb['nombre']?></a></li>

<li class="breadcrumb-item"><a href="showsforum?s=<?=$forosbr['id']?>-<?=$forosbr['nombre']?>"><?=$forosbr['nombre']?></a></li>

<li class="breadcrumb-item active" aria-current="page"><?=$notc['nombre']?></li>

</ol>

<form class="w-search">
<div style="float:right;margin-top:-5px" class="form-group with-button">
<input class="form-control" type="text" placeholder="Buscar en el foro...">
<button>
<i class="fa fa-search"></i>
</button>
</div>
</form>

</nav>

<br><br>

<div class="ui-block responsive-flex">
<div class="ui-block-title">
<div style="text-transform:uppercase;font-size:14px;" class="h6 title"><?=$notc['nombre']?></div>
<p><?=$notc['descripcion']?></p>
<div class="align-right">
<a href="#" class="btn btn-blue btn-sm"><i style="font-size:11px;" class="fa fa-plus"></i> Crear nuevo tema</a>
</div>
</div>
</div>

<!--
<nav style="padding: .0rem 1rem;background:#FAFAFA !important;margin-bottom:10px;" class="navbar navbar-expand-lg navbar-light bg-light">
<div class="collapse navbar-collapse" id="navbarNavDropdown">
<ul class="navbar-nav">
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Herramientas de foro</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<a class="dropdown-item" href="#">Something else here</a>
</div>
</li>
</ul>
</div>
</nav>
-->

</div>
</div>
</div>


<!-- CUERPO -->
<div class="container">
<div class="row">

<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<!-- SUBFOROS --
<div class="ui-block">
<table class="forums-table">

<thead>

<tr>

<th class="forum">
Sub-Foros
</th>

<th class="topics">
Temas / Mensajes
</th>

<th class="freshness">
Último Tema
</th>

</tr>

</thead>

<tbody>

<?php
$subforosx = $con->query("SELECT * FROM aor_subforos WHERE idsub = '$_GET[s]'");

while($subforos = $subforosx->fetch_array()) {
$idsub = $subforos['id'];
?>

<tr>
<td class="forum">
<div class="forum-item">
<img src="<?=$subforos['icono']?>" alt="forum">
<div class="content">
<a href="showssforum?s=<?=$subforos['id']?>-<?=$subforos['nombre']?>" style="text-transform:uppercase;" class="h6 title"><?=$subforos['nombre']?></a>
<p class="text"><?=$subforos['descripcion']?></p>
</div>
</div>
</td>

<?php
$sql = "SELECT * FROM aor_temas WHERE idsub = '$idsub'";
$temas = $con->query($sql);
$totaltemas = mysqli_num_rows($temas);
?>	
<?php
$sql = "SELECT * FROM aor_mensajes WHERE idsub = '$idsub'";
$mensajes = $con->query($sql);
$totalmens = mysqli_num_rows($mensajes);
?>	

<td class="topics">
<a href="#" style="font-size: 12px;" class="h6"><?=$totaltemas?></a> / <a href="#" style="font-size: 12px;" class="h6"><?=$totalmens?></a>
</td>

<?php
$sql = mysqli_query($con, "SELECT * FROM aor_mensajes WHERE idsub = '$idsub'");
$mensajes = mysqli_fetch_array($sql); 

$idusuario = $mensajes['idusuario'];
$idtema = $mensajes['idtema'];
$fecha = $mensajes["fecha"];
$hora = $mensajes["hora"];
$date = "$fecha,$hora";
$fecha2 = preg_replace('/:[0-9][0-9][0-9]/','',$date);
$time = strtotime($fecha2);
$time2 = dateDiff($time,time());

$sqlA = mysqli_query($con, "SELECT * FROM cuentas WHERE ID = '$idusuario'");
$usuario = mysqli_fetch_array($sqlA);   	

$sqlB = mysqli_query($con, "SELECT * FROM aor_temas WHERE id = '$idtema'");
$temas = mysqli_fetch_array($sqlB);  

if($mensajes > 0) { 
?>	

<td class="freshness">
<div class="author-freshness">
<a href="#" style="color:#38a9ff" class="h6 title"><?=$temas['nombre']?> <img style="padding-left:3px;" src="../estilos/img/iconos/lastpost-right.png"></a> 
<span class="title"><small>por</small> <a href="../perfil?id=<?=$usuario['Nombre_Apellido']?>" style="color:#38a9ff"><?php $quitargion=str_replace("_"," ",$usuario['Nombre_Apellido']); echo(''.$quitargion.'') ?></a></span>

<time class="entry-date updated" datetime="2017-06-24T18:18">hace <?=$time2?></time>
</div>
</td>
</tr>

<?php } else { ?>	

<td class="freshness">
<div class="author-freshness">
<span class="h6 title">No hay temas</span>
</div>
</td>

</tr>
<?php } ?>

<?php } ?>

</tbody>
</table>
</div>
<!-- FIN -->


<!-- TEMAS -->
<div class="ui-block">

<table class="forums-table">
<thead>

<tr>

<th class="forum">
Titulo / Autor
</th>

<th class="topics">
Respuestas / Visitas
</th>

<th class="freshness">
Último mensaje
</th>

</tr>

</thead>

<!-- TEMAS -->
<tbody>

<?php
$temasx = $con->query("SELECT * FROM aor_temas WHERE idsub = '$_GET[s]' ORDER BY fijado DESC LIMIT 25");

while($temas = $temasx->fetch_array()) {

$idusuario = $temas['idusuario'];
$idtema = $temas['id'];
$fijado = $temas['fijado'];
$cerrado = $temas['cerrado'];
$contraseña = $temas['contraseña'];
$contraseñae = $temas['contraseñae'];

$fecha = $temas["fecha"];
$hora = $temas["hora"];
$date = "$fecha,$hora";
$fecha2 = preg_replace('/:[0-9][0-9][0-9]/','',$date);
$time = strtotime($fecha2);
$time2 = dateDiff($time,time()); 

$sqlA = mysqli_query($con, "SELECT * FROM cuentas WHERE ID = '$idusuario'");
$usuariot = mysqli_fetch_array($sqlA);   	
?>

<tr style="border: 1px solid #CECECE;" class="bg-smoke-light <?php if($fijado != 0) {?>bg-fijado<?php } ?>">
<td class="forum">
<div class="forum-item">
<img src="../estilos/img/iconos/off.png" alt="forum">	
<div class="content">

<!-- CONTRASEÑA -->
<?php if($contraseña != 1) { ?>
<a href="showtopic?s=<?=$temas['id']?>-<?=$temas['nombre']?>" style="font-weight:500 !important;font-size: 14px;" class="h6 title">
<?php if($fijado != 0) {?>
<i style="padding-right:2px;font-weight:500;" class="fa fa-thumbtack" data-toggle="tooltip" data-placement="top" data-original-title="Ese tema esta fijado"></i>
<?php } ?> 
<?php if($cerrado != 0) {?>
<i style="padding-right:2px;font-weight:500;color:#eb4d4b" class="fa fa-lock" data-toggle="tooltip" data-placement="top" data-original-title="Ese tema esta bloqueado"></i>
<?php } ?> 
<?php if($contraseña != 0) {?>
<i style="padding-right:2px;font-weight:500;" class="fa fa-user-lock" data-toggle="tooltip" data-placement="top" data-original-title="Esta protegido con contraseña"></i>
<?php } ?> 

<span style="color:<?=$temas['prefijoc']?>;font-weight:500;text-transform:uppercase;"><?=$temas['prefijo']?></span>

<?=$temas['nombre']?>
</a>

<?php } else if($contraseña != 0) { ?> 

<a href="#" data-toggle="modal" data-target="#exampleModal" style="font-weight:500 !important;font-size: 14px;" class="h6 title">

<?php if($fijado != 0) {?>
<i style="padding-right:2px;font-weight:500;" class="fa fa-thumbtack" data-toggle="tooltip" data-placement="top" data-original-title="Ese tema esta fijado"></i>
<?php } ?> 
<?php if($cerrado != 0) {?>
<i style="padding-right:2px;font-weight:500;color:#eb4d4b" class="fa fa-lock" data-toggle="tooltip" data-placement="top" data-original-title="Ese tema esta bloqueado"></i>
<?php } ?> 
<?php if($contraseña != 0) {?>
<i style="padding-right:2px;font-weight:500;" class="fa fa-user-lock" data-toggle="tooltip" data-placement="top" data-original-title="Esta protegido con contraseña"></i>
<?php } ?> 

<span style="color:<?=$temas['prefijoc']?>;font-weight:500;text-transform:uppercase;"><?=$temas['prefijo']?></span>

<?=$temas['nombre']?>
</a>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body">
<?php 
if ($_POST['password'] != $contraseñae) { 
?>
<h6 style="text-align:center;margin-bottom:10px;margin-top:5px;">Este foro está protegido con contraseña, ingresela a continuación.</h6>
<form method="POST" action="">
<input type="password" style="border-radius:2px;" name="password" placeholder="Contraseña"><br>
<input type="submit" class="btn btn-info" value="Acceder al Foro">
</form>
<?php }else{ ?>
<script type="text/javascript">
function redireccionar(){
  window.location="showtopic?s=<?=$temas['id']?>-<?=$temas['nombre']?>";
} 
setTimeout ("redireccionar()", 1); 
</script>
<?php } ?>
</div>
</div>
</div>
</div>

<?php } ?>
<!-- FIN -->

</div>

<div class="author-started">
<div class="author-thumb">
<img src="../estilos/img/skins/<?=$usuariot['Skin']?>.jpg" alt="author">
</div>
<a href="../perfil?id=<?=$usuariot['Nombre_Apellido']?>" style="font-weight:400 !important" class="h6 title"><?php $quitargion=str_replace("_"," ",$usuariot['Nombre_Apellido']); echo(''.$quitargion.'') ?>, <?=$temas['fecha']?> </a>
<!-- FIN -->

</div>
</div>
</td>

<!-- VISITAS/MENSAJES -->
<?php
$sql = "SELECT * FROM aor_mensajes WHERE idtema = '$idtema'";
$mensaje = $con->query($sql);
$totalmensaje = mysqli_num_rows($mensaje);
?>	
<?php
$sql = "SELECT * FROM aor_visitas WHERE idtema = '$idtema'";
$visitas = $con->query($sql);
$totalvisitas = mysqli_num_rows($visitas);
?>	

<td class="topics">
<p style="margin-bottom:0px;font-weight:400 !important;font-size:13px;">Respuestas: <span><?=$totalmensaje?></span></p>  
<p style="margin-bottom:0px;font-weight:400 !important;font-size:13px;">Visitas: <span><?=$totalvisitas?></span></p>
</td>


<!-- MENSAJES -->
<?php
$sql = mysqli_query($con, "SELECT * FROM aor_mensajes WHERE idtema = '$idtema'");
$mensajes = mysqli_fetch_array($sql); 

$idusuario = $mensajes['idusuario'];

$sqlA = mysqli_query($con, "SELECT * FROM cuentas WHERE ID = '$idusuario'");
$usuariom = mysqli_fetch_array($sqlA); 

if($mensajes > 0) {
?>

<td class="freshness">
<div class="author-freshness">
<div class="author-thumb">
<img style="width:21px;height:21px;" src="../estilos/img/skins/<?=$usuariom['Skin']?>.jpg" alt="author">
</div>
<a href="../perfil?id=<?=$usuariom['Nombre_Apellido']?>" class="h6 title"><?php $quitargion=str_replace("_"," ",$usuariom['Nombre_Apellido']); echo(''.$quitargion.'') ?></a>
<time class="entry-date updated" datetime="2017-06-24T18:18">hace <?=$time2?></time>
</div>
</td>

<?php } else { ?>	

<td class="freshness">
<div class="author-freshness">
<span class="h6 title">No hay mensajes</span>
</div>
</td>

</tr>
<?php } ?>

<!-- FIN -->

<?php } ?>

</tbody>
</table>

<!-- FIN -->

</div>


<!-- PAGINACION -->
<nav aria-label="Page navigation">
<ul class="pagination justify-content-center">
<li style="width:auto;" class="page-item disabled">
<a class="page-link" style="text-align:center;" href="#" tabindex="-1">Anterior</a>
</li>
<li class="page-item"><a class="page-link" href="#">1<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: -10.3833px; top: -16.8333px; background-color: rgb(255, 255, 255); transform: scale(16.7857);"></div></div></a></li>
<li class="page-item"><a class="page-link" href="#">2</a></li>
<li style="width:auto;" class="page-item">
<a class="page-link" style="text-align:center;" href="#">Siguiente</a>
</li>
</ul>
</nav>

<!-- VISITANTES-->
<?php include "../funciones/anexos/usuarios.php"; ?>
<?php include "../funciones/anexos/visitantes.php"; ?>

<!-- WIDGETS -->
<div style="margin-bottom:18px;" class="card">
<div class="card-header">Información de foro y opciones 
<i style="float:right" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="true" aria-controls="collapseExample3" class="fa fa-arrow-down"></i>
</div>
<div class="collapse show" id="collapseExample3">
<div class="card-body">

<!-- 
<p style="margin-bottom:0px;">Usuarios navegando estos foros</p>
<p style="margin-bottom:0px;">Actualmente hay 

<?php if($visitor_online + $usere_online != 1) {?>
<?=$totalu + $totalv;?> 
<?php } else if($usere_online + $visitor_online != 0) {?>
0
<?php } ?> 


usuarios navegando en este foro. (<?php if($usere_online != 1) {?>
<?=$totalu?>
<?php } else if($usere_online != 0) {?>
0
<?php } ?> miembros y <?php if($visitor_online != 1) {?>
<?=$totalv?>
<?php } else if($visitor_online != 0) { ?>
0
<?php } ?> visitantes)</p>
-->

<p style="margin-bottom:7px;">Usuarios navegando estos foros</p>

<?php
$usuarios = mysqli_query($con, "SELECT * FROM onlines WHERE eid AND idsforo = '$_GET[s]'");
while($row=mysqli_fetch_array($usuarios)) {
$user = $row['eid'];
$user1_online = $row['tiempo'];
$this_date = date('U');
if ($user1_online>($this_date-160)) {
$user1_online = '0';
} else {
$user1_online = '1';
}

$usuario = mysqli_query($con, "SELECT * FROM cuentas WHERE ID = '".$user."'");
$usero = mysqli_fetch_array($usuario); 
?>

<?php if($user1_online != 1) { ?>
<a href="../perfil?id=<?=$usero['ID']?>"> 
<img style="width:25px;height:25px;border-radius:50%;object-fit:cover" src="../estilos/img/skins/<?=$usero['Skin'];?>.jpg" data-toggle="tooltip" data-placement="top" title="<?php $quitargion=str_replace("_"," ",$usero['Nombre_Apellido']); echo(''.$quitargion.'') ?>"> 
</a>
<?php } else if($user1_online != 0) { ?>
<?php } ?>

<?php } ?>

</div>
</div>
</div>
<!-- VISITANTES-->

<div class="row">

<div style="margin-bottom:18px;" class="col-lg-6">
<div class="card">
<div class="card-header">Leyenda de iconos
<i style="float:right" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2" class="fa fa-arrow-down"></i>
</div>
<div class="collapse show" id="collapseExample2">
<div class="card-body">

</div>
</div>
</div>
</div>

<?php 
if(isset($_SESSION["usuario"])) {
?>
<div style="margin-bottom:18px;" class="col-lg-6">
<div class="card">
<div class="card-header">Permisos de publicación
<i style="float:right" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="true" aria-controls="collapseExample1" class="fa fa-arrow-down"></i>
</div>

<div class="collapse show" id="collapseExample1">
<div class="card-body">

<div class="row">

<div class="col-lg-6">
<ul class="youcandoblock">
<li><strong>Puedes</strong> crear nuevos temas</li>
<li><strong>Puedes</strong> responder temas</li>
<li><strong>Puedes</strong> subir archivos adjuntos</li>
<li><strong>Puedes</strong> editar tus mensajes</li>
<li>&nbsp;</li>
</ul>
</div>

<div class="col-lg-6">
<ul>
<li><a href="misc.php?do=bbcode" target="_blank">Códigos BB</a> están <strong>Activo</strong></li>
<li>Los <a href="misc.php?do=showsmilies" target="_blank">Emoticonos</a> están <strong>Activo</strong></li>
<li>Código <a href="misc.php?do=bbcode#imgcode" target="_blank">[IMG]</a> está <strong>Activo</strong></li>
<li>Código <a href="misc.php?do=bbcode#videocode" target="_blank">[VIDEO]</a> está <strong>Activo</strong></li>
<li>Código HTML está <strong>Inactivo</strong></li>
</ul>
</div>


</div>

</div>
</div>

</div>
</div>
<?php } else {  ?> 

<?php } ?>

</div>
<!-- FIN -->

</div>
<!-- FIN -->


<!-- WIDGETS --
<div class="col col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="ui-block">
<div class="ui-block-title">
<h6 class="title">Últimos mensajes</h6>
</div>
<div class="ui-block-content">

<ul class="widget w-featured-topics">

<li>
<i class="icon fa fa-star" aria-hidden="true"></i>
<div class="content">
<a href="#" class="h6 title">The new Goddess of War trailer was launched at E3!</a>
<time class="entry-date updated" datetime="2017-06-24T18:18">2 hours, 16 minutes ago</time>
</div>
</li>

</ul>

</div>
</div>

<div class="ui-block">
<div class="ui-block-title">
<h6 class="title">Recent Topics</h6>
</div>
<div class="ui-block-content">

<ul class="widget w-featured-topics">
<li>
<div class="content">
<a href="#" class="h6 title">Summer is Coming! Picnic in the east boulevard park</a>
<time class="entry-date updated" datetime="2017-06-24T18:18">26 minutes ago</time>
<div class="forums">The Community</div>
</div>
</li>

</ul>

</div>
</div>

</div>
<!-- FIN -->

</div>
</div>
</div>
<!-- FIN -->

<a style="background: #a4433c;" class="back-to-top" href="#">
<img src="<?=$todo?>/estilos/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>

<!-- FIN -->
<?php include "../paginas/_footer.php"; ?>

</div>
</div>

</body>
</html>