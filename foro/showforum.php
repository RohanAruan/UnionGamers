<?php
include '../funciones/lib.php';
include 'views/_lib.php';
?>
<?php
if($_GET['s'] <> ""){
$noticia = mysqli_query($con, "SELECT * FROM aor_foros WHERE id = '$_GET[s]'");
if($notc = mysqli_fetch_array($noticia)){
$idcategoria = $notc['idcategoria'];
$idforo = $notc['idforo'];
$idforos = $notc['id'];
echo '';
}else{
}
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
<link rel="stylesheet" type="text/css" href="<?=$todoh?>/foro/estilos/css/main.css">
<link rel="stylesheet" type="text/css" href="<?=$todoh?>/foro/estilos/css/fonts.min.css">
<script src="<?=$todoh?>/foro/views/edittopic/tinymce.min.js" referrerpolicy="origin"></script>
<script src="<?=$todoh?>/foro/estilos/js/lazysizes.min.js" async=""></script>
</head>
<!-- FIN -->

<?php 
if(isset($_SESSION["usuario"])) {
include '../paginas/_headerlog.php';
} else {
include '../paginas/_header.php';
}
?>


<!-- PRIMERO -->
<?php if(mysqli_num_rows($noticia) > 0) { ?>
<div class="row">
<div style="padding-left:0px;" class="col col-xl-12 col-lg-12">


<!-- BREAD -->
<nav aria-label="breadcrumb">
<ol style="padding:0px;background-color:transparent;margin-bottom:0px;float:left;" class="breadcrumb">
<li class="breadcrumb-item"><a href="index">Foros</a></li>

<?php 
$sqlForos = mysqli_query($con, "SELECT * FROM aor_foros WHERE id = '$_GET[s]'");
$sforos = mysqli_fetch_array($sqlForos);    
$categoriar = $sforos['idcategoria']; 
$categoriarr = $sforos['id']; 
$idforor = $sforos['idforo'];
?>

<?php 
$sqlA = mysqli_query($con, "SELECT * FROM aor_categorias WHERE id = '$categoriar'");
$categoria = mysqli_fetch_array($sqlA);     
?>

<?php 
$sqlAx = mysqli_query($con, "SELECT * FROM aor_foros WHERE id = '$categoriarr'");
$categoriaxx = mysqli_fetch_array($sqlAx);     
?>

<li class="breadcrumb-item"><a href="index"><?=$categoria['nombre']?> </a></li>

<?php if($idforor > 0) { ?>

<?php 
$sqlsForos = mysqli_query($con, "SELECT * FROM aor_foros WHERE id = '$idforor'");
$suforos = mysqli_fetch_array($sqlsForos);    
$idfororr = $suforos['idforo'];
?>

<?php if($idfororr > 0) { ?>

<?php 
$sqlsForos = mysqli_query($con, "SELECT * FROM aor_foros WHERE id = '$idfororr'");
$suforosx = mysqli_fetch_array($sqlsForos);    
?>

<li class="breadcrumb-item"><a href="showforum?s=<?=$suforos['id']?>-<?=$suforos['nombre']?>"><?=$suforosx['nombre']?></a></li>

<?php } else { } ?>


<li class="breadcrumb-item"><a href="showforum?s=<?=$suforos['id']?>-<?=$suforos['nombre']?>"><?=$suforos['nombre']?></a></li>

<?php } else { } ?>

<li class="breadcrumb-item active" aria-current="page"><?=$categoriaxx['nombre']?></li>

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
<!-- FIN -->

<div class="ui-block responsive-flex">
<div class="ui-block-title">
<div style="text-transform:uppercase;font-size:14px;color:#000;font-weight:bold;" class="h6 title"><?=$notc['nombre']?>
	
<?php if($idforo == $idforo || $idforos == $idforos) { ?>

<!-- PERMISOS -->
<?php 
$permisos = mysqli_query($con, "SELECT * FROM aor_permisos WHERE idforo = $idforos");
$perm = mysqli_fetch_array($permisos);  
$pidforo = $perm['idforo'];
$pidusuario = $perm['idusuario'];
$pidfaccion = $perm['idfaccion'];
$pidrango = $perm['idrango'];
?>	

<?php if($pidusuario == $iduser) { 
if($pidforo == $idforos) { ?>
<button type="button" style="border-radius:5px;font-size:10px !important" class="btn btn-warning btn-sm ml-2">Administrar</button> 
<?php } elseif($pidfaccion == $grupofaccion) { echo ''; } } ?>
<!-- FIN -->

<?php } else { ?>

<!-- PERMISOS -->
<?php 
$permisos = mysqli_query($con, "SELECT * FROM aor_permisos WHERE idforo = $idforo");
$perm = mysqli_fetch_array($permisos);  
$pidforo = $perm['idforo'];
$pidusuario = $perm['idusuario'];
$pidfaccion = $perm['idfaccion'];
$pidrango = $perm['idrango'];
?>	

<?php if($pidusuario == $iduser) { 
if($pidforo == $idforo) { ?>
<button type="button" style="border-radius:5px;font-size:10px !important" class="btn btn-warning btn-sm ml-2">Administrar</button> 
<?php } elseif($pidfaccion == $grupofaccion) { echo ''; } } ?>
<!-- FIN -->

<?php } ?>

</div>

<p><?=$notc['descripcion']?></p>
<div class="align-right">

<?php 
if($Srango >= 1) { echo '<a href="createtopic?c='.$notc['id'].'" style="border-radius:2px !important;color:white" class="btn btn-blue"><i style="font-size:11px;" class="fa fa-plus"></i> Crear nuevo tema</a>';
} elseif($Srango >= 0) { ?>
<?php 
if($notc['ctema'] == 0) { } else { echo '<a href="createtopic?c='.$notc['id'].'" style="border-radius:2px !important;color:white" class="btn btn-blue"><i style="font-size:11px;" class="fa fa-plus"></i> Crear nuevo tema</a>'; }
} elseif($miembrof == $miembrofac) { echo '<a href="createtopic?c='.$notc['id'].'" style="border-radius:2px !important;color:white" class="btn btn-blue"><i style="font-size:11px;" class="fa fa-plus"></i> Crear nuevo tema</a>'; }
?>

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

<!-- CUERPO -->
<div class="row">

<div style="padding-left:0px;" class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<!-- SUBFOROS -->
<?php
$net = $con->query("SELECT * FROM aor_categorias WHERE idforo = '$_GET[s]'");

while($row = $net->fetch_array()) {

$idcategoria = $row['id'];
$tipocat = $row['tipo'];
$esfaccion = $row['faccion'];
$idforoc = $row['idforo'];
?>

<?php 
$sqlForos = mysqli_query($con, "SELECT * FROM aor_foros WHERE idforo = '$idforoc' AND idcategoria = '$idcategoria'");
$sforos = mysqli_fetch_array($sqlForos);  
?>

<?php if($sforos > 0) { ?>

<div class="ui-block">

<table class="forums-table">

<thead>

<tr>

<th style="font-weight:bold;font-size:14px;line-height:1;" class="forum">
<?=$row['nombre']?> 
</th>

<th  class="forum">
</th>

<th class="forum">
<a data-toggle="collapse" href="#collapseExampleSF" role="button" aria-expanded="true" aria-controls="collapseExampleSF">
<i onclick="myFunction(this)" style="float:right;font-size:16.70px;font-weight:700;color:#d1d2d5;transition: 0.3s all linear;" class="aca fa fa-chevron-down"></i>  
</a>
</th>

</tr>

</thead>

<tbody class="collapse show" id="collapseExampleSF">

<?php
$subforosx = $con->query("SELECT * FROM aor_foros WHERE idforo = '$_GET[s]' AND idcategoria = '$idcategoria'");

while($subforos = $subforosx->fetch_array()) {
$idsub = $subforos['id']; 
?>

<tr>
<td class="forum topics-1">
<div class="forum-item">
<img style="width:45px;height:45px;margin-top:3px;object-fit:cover;" src="<?=$subforos['icono']?>" alt="forum">
<div class="content">
<a href="showforum?s=<?=$subforos['id']?>-<?=$subforos['nombre']?>" style="font-size:14px;" class="h6 title"><?=$subforos['nombre']?></a>

<p style="margin-bottom:1px;">
<?php
$subforosf = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idsub'");
if(mysqli_num_rows($subforosf) > 0 )
{
?>

<span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span>
<span>
<?php
} else { }

while($subforose = $subforosf->fetch_array()) {
?>

<small><a style="font-size:12px;" href="showforum?s=<?=$subforose['id']?>-<?=$subforose['nombre']?>"><?=$subforose['nombre']?></a>,</small> 

<?php } ?>
</span>
</p>

<p class="text"><?=$subforos['descripcion']?></p>
</div>
</div>
</td>

<?php
$sql = "SELECT * FROM aor_temas WHERE idlider = '$idsub'";
$temas = $con->query($sql);
$totaltemas = mysqli_num_rows($temas);
$ntemas = number_format($totaltemas);
?>  
<?php
$sql = "SELECT * FROM aor_mensajes WHERE idlider = '$idsub'";
$mensajes = $con->query($sql);
$totalmens = mysqli_num_rows($mensajes);
$nmens = number_format($totalmens);
?>  

<td class="topics topics-2">

<div class="row">

<div class="col-lg-6" style="border-right: 1px solid #bfc1c5;text-align:center;margin-left:-5px;padding-left:10px">
<p style="margin-bottom:0px;font-weight:400 !important;font-size:11px;text-align:center;color:#9ba5c0">Temas</p>
<p style="margin-bottom:0px;"><span style="margin-bottom:0px;font-size:17px;text-align:center;color:#000;"><?=$ntemas?></span></p>  
</div>

<div style="text-align:center;" class="col-lg-6">
<p style="margin-bottom:0px;font-weight:400 !important;font-size:11px;text-align:center;color:#9ba5c0">Mensajes</p>
<p style="margin-bottom:0px;"><span style="margin-bottom:0px;font-size:17px;text-align:center;color:#000;"><?=$nmens?></span>
</p>
</div>

</div>

</td>

<?php
$sql = mysqli_query($con, "SELECT * FROM aor_mensajes WHERE idtema = '$idsub' ORDER BY id DESC, fecha");
$mensajes = mysqli_fetch_array($sql); 

$idusuario = $mensajes['idusuario'];
$idtema = $mensajes['idtema'];
$fecham = $mensajes['fecha'];
$newDateM = date("d-m-Y", strtotime($fecham));

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$idusuario'");
$usuario = mysqli_fetch_array($sqlA);
$rol = $usuario['Admin']; 	
$typerankx = $usuario['Typerank']; 	     

$sqlB = mysqli_query($con, "SELECT * FROM aor_temas WHERE id = '$idtema'");
$temas = mysqli_fetch_array($sqlB); 

if($mensajes > 0) { 
?>  

<td class="freshness">

<div style="width:250px" class="author-freshness">

<span>
<a href="<?=$todo?>/perfil?idu=<?=$usuario['ID']?>&sec=muro">	
<img style="width:40px;height:40px;border-radius:50%;float:left;margin-top:3px;" src="../estilos/img/avatars/<?=$usuario['avatar']?>?nocache=<?=$versiones?>" alt="author">
</a>
</span>

<div style="padding-left: 52px;">
<a href="showtopic?s=<?=$temas['id']?>-<?=$temas['nombre']?>" style="color:#38a9ff;white-space: nowrap;font-size:14px;" title="<?=$temas['nombre']?>"><span style="color:<?=$temas['prefijoc']?>;font-weight:500;text-transform:uppercase;"><?=$temas['prefijo']?></span> <?=limitar_cadena($temas['nombre'], 20, '...');?></a> 

<p style="margin-bottom:0px;">
Por <a href="../perfil?idu=<?=$usuario['ID']?>" style="color:<?php include "views/permisos/croles.php"; ?> !important;"><?php $quitargion=str_replace("_"," ",$usuario['Username']); echo(''.$quitargion.'') ?></a>,
<time class="entry-date updated" style="font-size:14px" datetime="<?=$fecha?>"><?=strftime("%d de %B", strtotime($newDateM));?></time>
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

</tbody>
</table>

</div>
<!-- FIN -->

<?php } else { ?>

<?php } ?>

<?php } ?>
<!-- FIN -->


<!-- TEMAS -->
<div class="ui-block">

<table class="forums-table">
<thead>

<tr>

<th style="font-weight:bold;font-size:14px;" class="forum">
Titulo / Autor
</th>

<th style="float:right" class="freshness">

<!-- ORDENAR --
<form method="POST"> 

<select name="id_tema" style="margin-bottom:0px;color:#000 !important;border: 2px solid #e3e7ea!important;background:transparent;width:120px;" class="btn btn-light btn-sm" onchange="this.form.submit();"> 
<option selected>Ordenar</option>
<option value="1">Subidos recientemente</option>
<option value="2">Temas cerrados</option>
<option value="3">Orden alfabético (A-Z)</option>
<option value="4">Fecha de publicación</option>
</select>

</form> 
<!-- FIN -->

</th>

<th class="forum">
<a data-toggle="collapse" href="#collapseExample<?=$idcategoria?>" role="button" aria-expanded="true" aria-controls="collapseExample<?=$idcategoria?>">
<i onclick="myFunction(this)" style="float:right;font-size:16.70px;font-weight:700;color:#d1d2d5;transition: 0.3s all linear;" class="aca fa fa-chevron-down"></i>  
</a>
</th> 

</tr>

</thead>

<!-- TEMAS -->
<tbody class="collapse show" id="collapseExample<?=$idcategoria?>">

<?php 
mysqli_set_charset($con, "utf8");

if( !isset($_POST['id_tema']) ){
$peticion = "SELECT * FROM aor_temas WHERE id ORDER BY fijado DESC, cerrado DESC, fecha DESC, hora DESC, prefijo LIMIT 25";
}else{
if ( $_POST['id_tema'] == "1" ){
$peticion = "SELECT * FROM aor_temas  order by hora desc";
}
if ( $_POST['id_tema'] == "2" ){
$peticion = "SELECT * FROM aor_temas  order by cerrado desc";
}
if ( $_POST['id_tema'] == "3" ){
$peticion = "SELECT * FROM aor_temas  order by nombre asc";
}
if ( $_POST['id_tema'] == "4" ){
$peticion = "SELECT * FROM aor_temas order by fecha desc";
}
}

$resultado = mysqli_query($con, $peticion);

while ($fila = mysqli_fetch_array($resultado)) {
?> 

<?php
$temasx = $con->query("SELECT * FROM aor_temas WHERE idlider = '$_GET[s]' AND id = ".$fila["id"]." ORDER BY fijado DESC, fecha DESC, cerrado DESC, prefijo LIMIT 25");

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

$fechat = $temas["fecha"];
$newDate = date("d-m-Y", strtotime($fechat));

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$idusuario'");
$usuariot = mysqli_fetch_array($sqlA);   	
$usuariox = $usuariot['Username'];
$rol = $usuariot['Admin']; 
$typerankx = $usuariot['Typerank']; 	
$fmostrar = $usuariot['mostrar'];

$sqlFac = mysqli_query($con, "SELECT * FROM characters WHERE Username = '$usuariox'");
$pj = mysqli_fetch_array($sqlFac); 
$personaje = $pj['Personaje'];
$skinx = $pj['Skin'];
?>

<tr style="border-bottom: 1px solid #CECECE;background:url(<?php if($fijado != 0) {?>https://foro.unplayer.com/images/gradients/bg-sticky.png<?php } ?>)" class="bg-smoke-light <?php if($fijado != 0) {?>bg-fijado<?php } ?>">
<td class="forum">
<div class="forum-item">
<img src="../estilos/img/iconos/off.png" alt="forum">	
<div class="content">

<!-- CONTRASEÑA -->
<?php if($contraseña != 1) { ?>
<a href="showtopic?s=<?=$temas['id']?>-<?=$temas['nombre']?>" style="font-family: Roboto;font-weight:500 !important;font-size: 14px;" class="h6 title">
<?php if($fijado != 0) {?>
<i style="padding-right:2px;font-weight:500;" class="fa fa-thumbtack" data-toggle="tooltip" data-placement="top" data-original-title="Este tema esta fijado"></i>
<?php } ?> 
<?php if($cerrado != 0) {?>
<i style="padding-right:2px;font-weight:500;color:#eb4d4b" class="fa fa-lock" data-toggle="tooltip" data-placement="top" data-original-title="Este tema esta cerrado"></i>
<?php } ?> 
<?php if($contraseña != 0) {?>
<i style="padding-right:2px;font-weight:500;" class="fa fa-user-lock" data-toggle="tooltip" data-placement="top" data-original-title="Este tema esta protegido con contraseña"></i>
<?php } ?> 

<span style="color:<?=$temas['prefijoc']?>;font-weight:500;text-transform:uppercase;"><?=$temas['prefijo']?></span>

<?=$temas['nombre']?>
</a>

<?php } else if($contraseña != 0) { ?> 

<a href="#" data-toggle="modal" data-target="#exampleModal" style="font-weight:500 !important;font-size: 14px;" class="h6 title">

<?php if($fijado != 0) {?>
<i style="padding-right:2px;font-weight:500;" class="fa fa-thumbtack" data-toggle="tooltip" data-placement="top" data-original-title="Ese tema está fijado"></i>
<?php } ?> 
<?php if($cerrado != 0) {?>
<i style="padding-right:2px;font-weight:500;color:#eb4d4b" class="fa fa-lock" data-toggle="tooltip" data-placement="top" data-original-title="Ese tema está bloqueado"></i>
<?php } ?> 
<?php if($contraseña != 0) {?>
<i style="padding-right:2px;font-weight:500;" class="fa fa-user-lock" data-toggle="tooltip" data-placement="top" data-original-title="Está protegido con contraseña"></i>
<?php } ?> 

<span style="color:<?=$temas['prefijoc']?>;font-weight:500;text-transform:uppercase;"><?=$temas['prefijo']?></span>

<?=$temas['nombre']?>
</a>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body">
<?php 
if($_POST['password'] != $contraseñae) {
?>
<h6 style="text-align:center;margin-bottom:10px;margin-top:5px;">Este foro está protegido con contraseña, ingrésela a continuación.</h6>
<form method="POST" action="">
<input type="password" style="border-radius:2px;" name="password" placeholder="Contraseña"><br>
<input type="submit" class="btn btn-info" value="Acceder al Foro">
</form>
<?php } else { ?>
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
<a href="<?=$todo?>/perfil?idu=<?=$usuariot['ID']?>&sec=muro">	

<?php if($fmostrar == 0) { ?>
<img style="background:url('../estilos/img/avatars/defect.jpg');" src="../estilos/img/avatars/<?=$usuariot['avatar']?>?nocache=<?=$versiones?>" alt="author">
<?php } else { ?>
<img style="background:url('../estilos/img/avatars/defect.jpg');" src="../estilos/img/skins/<?=$pj['Skin']?>.jpg?nocache=<?=$versiones?>" alt="author">	 
<?php } ?>

</a>
</div>

<?php if($fmostrar == 0) { ?>
<a href="../perfil?idu=<?=$usuariot['ID']?>&sec=muro" style="font-weight:400 !important;" class="h6 title"><span style="color:<?php include "views/permisos/croles.php"; ?> !important;"><?php $quitargion=str_replace("_"," ",$usuariot['Username']); echo(''.$quitargion.'') ?></span>, <?=strftime("%d de %B, %Y", strtotime($newDate));?> </a>
<?php } else { ?>
<a href="../perfil?idu=<?=$usuariot['ID']?>&sec=muro" style="font-weight:400 !important;" class="h6 title"><span style="color:<?php include "views/permisos/croles.php"; ?> !important;"><?php $quitargion=str_replace("_"," ",$pj['Personaje']); echo(''.$quitargion.'') ?></span>, <?=strftime("%d de %B, %Y", strtotime($newDate));?> </a>
<?php } ?>

</div>
</div>
</td>

<!-- VISTAS/MENSAJES -->
<?php
$sql = "SELECT * FROM aor_mensajes WHERE idtema = '".$idtema."'";
$mensaje = $con->query($sql);
$totalmensaje = mysqli_num_rows($mensaje);
$nmens = number_format($totalmensaje);
?>	
<?php 
$sqlvi = mysqli_query($con, "SELECT * FROM aor_vistas WHERE idtema = '".$idtema."'");
$vistas = mysqli_num_rows($sqlvi);
$nvistas = number_format($vistas);
?>	

<td style="width:200px;text-align: right;" class="topics">
<p style="margin-bottom:0px;font-weight:400 !important;font-size:13px;"><span><?=$nmens?></span> respuestas</p>  
<p style="margin-bottom:0px;font-weight:400 !important;font-size:13px;" class="text-muted"><span><?=$nvistas?></span> vistas</p>
</td>


<!-- MENSAJES -->
<?php
$sql = mysqli_query($con, "SELECT * FROM aor_mensajes WHERE idtema = '".$idtema."' ORDER BY id DESC, fecha");
$mensajes = mysqli_fetch_array($sql); 

$idusuario = $mensajes['idusuario'];
$fecham = $mensajes['fecha'];
$newDateM = date("d-m-Y", strtotime($fecham));

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$idusuario'");
$usuariom = mysqli_fetch_array($sqlA); 
$usuarioe = $usuariom['Username'];
$emostrar = $usuariom['mostrar'];
$rol = $usuariom['Admin']; 
$typerankx = $usuariom['Typerank']; 	

$sqlFac = mysqli_query($con, "SELECT * FROM characters WHERE Username = '$usuarioe'");
$pje = mysqli_fetch_array($sqlFac); 

if($mensajes > 0) {
?>

<td style="width:250px" class="freshness">

<div class="author-freshness">

<span>
<a href="<?=$todo?>/perfil?idu=<?=$usuariom['ID']?>&sec=muro">	

<?php if($emostrar == 0) { ?>
<img style="width:40px;height:40px;border-radius:50%;float:left;margin-top:3px;background:url('../estilos/img/avatars/defect.jpg');" src="../estilos/img/avatars/<?=$usuariom['avatar']?>?nocache=<?=$versiones?>" alt="author">
<?php } else { ?>
<img style="width:40px;height:40px;border-radius:50%;float:left;margin-top:3px;background:url('../estilos/img/avatars/defect.jpg');" src="../estilos/img/skins/<?=$pje['Skin']?>.jpg?nocache=<?=$versiones?>" alt="author">	
<?php } ?>

</a>
</span>

<div style="padding-left: 52px;">

<p style="margin-bottom:0px;">

<?php if($emostrar == 0) { ?>
<a href="../perfil?idu=<?=$usuariom['ID']?>&sec=muro" style="color:<?php include "views/permisos/croles.php"; ?> !important;"><?php $quitargion=str_replace("_"," ",$usuariom['Username']); echo(''.$quitargion.'') ?></a>
<?php } else { ?>
<a href="../perfil?idu=<?=$usuariom['ID']?>&sec=muro" style="color:<?php include "views/permisos/croles.php"; ?> !important;"><?php $quitargion=str_replace("_"," ",$pje['Personaje']); echo(''.$quitargion.'') ?></a>
<?php } ?>

</p>
<p style="margin-bottom:0px;">
<time class="entry-date updated text-muted" style="font-size:14px" datetime="<?=$fecha?>"><?=strftime("%d de %B, %Y", strtotime($newDateM));?></time>
</p>
</div>


</div>

</td>

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

</tbody>
</table>
<!-- FIN -->

</div>
<!-- FIN -->

<!-- PAGINACION -->
<?php 
$sql = "SELECT * FROM aor_temas WHERE idforo = '$_GET[s]'";
$rows = $con->query($sql);
$temas = mysqli_num_rows($rows);
?>

<br>

<?php 
if($temas > 10) { 
?>

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

<?php } ?>

<!-- WIDGETS -->
<div class="row">

<div style="margin-bottom:18px;" class="col-lg-6">
<div class="card">
<div class="card-header">Información de foro y opciones 
<i style="float:right" data-toggle="collapse" href="#collapseExampleI" role="button" aria-expanded="true" aria-controls="collapseExampleI" class="fa fa-arrow-down"></i>
</div>
<div class="collapse show" id="collapseExampleI">
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

<!-- USUARIOS NAVEGANDO -->
<p style="margin-bottom:7px;">Usuarios navegando estos foros</p>

<?php
$usuarios = mysqli_query($con, "SELECT * FROM aor_onlines WHERE eid AND idforo = '$_GET[s]'");
while($row=mysqli_fetch_array($usuarios)) {
$user = $row['eid'];
$user1_online = $row['tiempo'];
$this_date = date('U');
if ($user1_online>($this_date-160)) {
$user1_online = '0';
} else {
$user1_online = '1';
}

$usuario = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '".$user."'");
$user = mysqli_fetch_array($usuario); 
$nombrec = $user['Username'];
$fmostrar = $user['mostrar'];

$sqlFac = mysqli_query($con, "SELECT * FROM characters WHERE Username = '$nombrec'");
$pj = mysqli_fetch_array($sqlFac); 

if($usuarios < 20) {
?>

<?php if($user1_online != 1) { ?>

<?php if($fmostrar == 0) { ?>	
<a href="../perfil?idu=<?=$user['ID']?>&sec=muro"> 
<img style="width:25px;height:25px;border-radius:50%;object-fit:cover;background:url('../estilos/img/avatars/defect.jpg');" src="../estilos/img/avatars/<?=$user['avatar']?>?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="top" title="<?php $quitargion=str_replace("_"," ",$user['Username']); echo(''.$quitargion.'') ?>"> 
</a>
<?php } else { ?>
<a href="../perfil?idu=<?=$user['ID']?>&sec=muro"> 
<img style="width:25px;height:25px;border-radius:50%;object-fit:cover;background:url('../estilos/img/avatars/defect.jpg');" src="../estilos/img/skins/<?=$pj['Skin']?>.jpg?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="top" title="<?php $quitargion=str_replace("_"," ",$pj['Personaje']); echo(''.$quitargion.'') ?>"> 
</a>	
<?php } ?>

<?php } else if($user1_online != 0) { ?>
<?php } ?>

<?php } else {} ?>

<?php } ?>

</div>
</div>
</div>
</div>
<!-- FIN-->

<!-- LEYENDAS --
<div style="margin-bottom:18px;" class="col-lg-6">
<div class="card">
<div class="card-header">Leyenda de iconos
<i style="float:right" data-toggle="collapse" href="#collapseExampleL" role="button" aria-expanded="true" aria-controls="collapseExampleL" class="fa fa-arrow-down"></i>
</div>
<div class="collapse show" id="collapseExampleL">
<div class="card-body">

</div>
</div>
</div>
</div>
<!-- FIN -->

<!-- PERMISOS -->
<?php 
if(isset($_SESSION["usuario"])) {
?>
<div style="margin-bottom:18px;" class="col-lg-6">
<div class="card">
<div class="card-header">Permisos de publicación
<i style="float:right" data-toggle="collapse" href="#collapseExampleP" role="button" aria-expanded="true" aria-controls="collapseExampleP" class="fa fa-arrow-down"></i>
</div>

<div class="collapse show" id="collapseExampleP">
<div class="card-body">

<div class="row">

<div class="col-lg-6">
<ul class="youcandoblock">
<?php
if($notc['ctema'] == 1) {
echo '<li><strong>Puedes</strong> crear nuevos temas</li>';
} else { echo '<li><strong>No puedes</strong> crear nuevos temas</li>'; }
?>
<li><strong>Puedes</strong> responder temas</li>
<li><strong>Puedes</strong> subir archivos adjuntos</li>
<li><strong>Puedes</strong> editar tus mensajes</li>
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
<!-- FIN -->

</div>
<!-- FIN -->

</div>
<!-- FIN -->

</div>
</div>
</div>
<!-- FIN -->

<a style="background: #000;" class="back-to-top" href="#">
<img src="<?=$todoh?>/foro/estilos/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>

<!-- FIN -->
<script type="text/javascript">
function myFunction(x) {
x.classList.toggle("fa-chevron-left");
x.classList.toggle("fa-chevron-down");
}
</script>

<?php } else { ?>
<a href="javascript: history.go(-1)" style="margin-top:0px;margin-left: -14px;" class="btn btn-outline-info"><i class="fa fa-arrow-left mr-1"></i> Volver</a> <br>

<img style="text-align:center;margin:auto;width: 213px;margin-top: 150px;border-radius:10px;margin-left: 470px;" src="<?=$todo?>/estilos/img/errores/temas.png">
<h5 style="color:#93a3b2;text-align:center;margin-top:40px !important;margin:auto;width:100%;margin-bottom:200px">El foro que estás buscando no existe.</h5>

<?php } ?>

<?php include "../paginas/_footer.php"; ?>

</div>
</div>

</body>
</html>