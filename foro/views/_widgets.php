<?php 
$link = $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];
$todo = htmlspecialchars('https://', $link, ENT_QUOTES, 'UTF-8');
?>

<!-- WIDGET #1 -->
<aside style="padding-left:2px;" class="col-lg-3">

<!-- ÚLTIMOS TEMAS -->
<div class="ui-block">
<div style="padding: 16px;" class="ui-block-title">
<h6 class="title" style="font-weight:bold;font-size:15px;line-height:1;color:#000">Temas</h6>
<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="estilos/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
</div>

<ul class="widget w-friend-pages-added notification-list friend-requests">

<?php
$temasx = $con->query("SELECT * FROM aor_temas WHERE id AND tipoadm = '0' ORDER BY fecha DESC, hora DESC LIMIT 7");

while($temas = $temasx->fetch_array()) {

$idusuariot = $temas['idusuario'];
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

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$idusuariot'");
$usuariot = mysqli_fetch_array($sqlA);   
$fmostrar = $usuariot['mostrar'];	
$usuariox = $usuariot['Username'];
$rol = $usuariot['Admin']; 
$typerankx = $usuariot['Typerank']; 

$sqlFac = mysqli_query($con, "SELECT * FROM characters WHERE Username = '$usuariox'");
$pj = mysqli_fetch_array($sqlFac); 
$personaje = $pj['Personaje'];
$skinx = $pj['Skin'];
?>

<li style="padding: 14px;" class="inline-items">
<div class="author-thumb">
<a href="<?=$todo?>/perfil?idu=<?=$usuariot['ID']?>&sec=muro">

<?php if($fmostrar == 0) { ?>
<img style="width:30px;height:30px;object-fit:cover;background:url('../../estilos/img/avatars/defect.jpg');" src="../../estilos/img/avatars/<?=$usuariot['avatar']?>?nocache=<?=$versiones?>" alt="author">
<?php } else { ?>
<img style="width:30px;height:30px;object-fit:cover;background:url('../../estilos/img/avatars/defect.jpg');" src="../estilos/img/skins/<?=$pj['Skin']?>.jpg?nocache=<?=$versiones?>" alt="author">	
<?php } ?>

</a>
</div>
<div class="notification-event">
<a href="showtopic?s=<?=$temas['id']?>-<?=$temas['nombre']?>" class="h6 notification-friend"><span style="color:<?=$temas['prefijoc']?>;font-weight:500;text-transform:uppercase;"><?=$temas['prefijo']?></span> <?=limitar_cadena($temas['nombre'], 21, '...');?></a>

<span class="chat-message-item">Por <?php if($fmostrar == 0) { ?>
<a href="../perfil?idu=<?=$usuariot['ID']?>&sec=muro" style="color:<?php include "views/permisos/croles.php"; ?> !important;"><?php $quitargion=str_replace("_"," ",$usuariot['Username']); echo(''.$quitargion.'') ?></a>
<?php } else { ?>
<a href="../perfil?idu=<?=$usuario['ID']?>&sec=muro" style="color:<?php include "views/permisos/croles.php"; ?> !important;"><?php $quitargion=str_replace("_"," ",$pj['Personaje']); echo(''.$quitargion.'') ?></a>
<?php } ?> <br><?=strftime("%d de %B, %Y", strtotime($newDate));?></span>
</div>

<?php
$sql = "SELECT * FROM aor_mensajes WHERE idtema = '$idtema'";
$mensaje = $con->query($sql);
$totalmensaje = mysqli_num_rows($mensaje);
?>	

<span style="float:right" class="olymp-star-icon" data-toggle="tooltip" data-placement="top" data-original-title="Mensajes">
<button type="button" style="border-radius:50%;padding: 0.15rem .65em;background-color:#edf2f7 !important;border-color:#edf2f7 !important;color:#000 !important;font-weight:100;" class="btn btn-primary"><?=$totalmensaje?></button>
</span>

</li>

<?php } ?>

</ul>
</div>
<!-- FIN -->

<!-- ÚLTIMOS MENSAJES --
<div class="ui-block">
<div style="padding: 16px;" class="ui-block-title">
<h6 class="title" style="font-weight:bold;font-size:15px;line-height:1;color:#000">Mensajes</h6>
<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="estilos/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
</div>

<ul class="widget w-friend-pages-added notification-list friend-requests">

<?php
$mensajesx = $con->query("SELECT * FROM aor_mensajes WHERE id ORDER BY fecha DESC, hora DESC LIMIT 7");

while($mensajes = $mensajesx->fetch_array()) {

$idusuario = $mensajes['idusuario'];

$fecha = $mensajes["fecha"];
$hora = $mensajes["hora"];
$date = "$fecha,$hora";
$fecha2 = preg_replace('/:[0-9][0-9][0-9]/','',$date);
$time = strtotime($fecha2);
$time2 = dateDiff($time,time());  

$fechat = $mensajes["fecha"];
$newDate = date("d-m-Y", strtotime($fechat));

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$idusuario'");
$usuariot = mysqli_fetch_array($sqlA);   	
$rol = $usuariot['Admin']; 
?>

<li style="padding: 14px;" class="inline-items">
<div class="author-thumb">
<img style="width:30px;height:30px;object-fit:cover;background:url('../../estilos/img/avatars/defect.jpg');" src="../../estilos/img/avatars/<?=$usuariot['avatar']?>?nocache=<?=$versiones?>" alt="author">
</div>
<div class="notification-event">
<a href="showtopic?s=<?=$temas['id']?>-<?=$temas['nombre']?>" class="h6 notification-friend"><span style="color:<?=$temas['prefijoc']?>;font-weight:500;text-transform:uppercase;"><?=$temas['prefijo']?></span> <?=limitar_cadena($temas['nombre'], 21, '...');?></a>

<span class="chat-message-item">Por <a style="color:<?php include "permisos/croles.php"; ?> !important;" href="../../perfil?idu=<?=$usuariot['ID']?>&sec=muro"><?php $quitargion=str_replace("_"," ",$usuariot['Username']); echo(''.$quitargion.'') ?></a>, <?=strftime("%d de %B, %Y", strtotime($newDate));?></span>
</div>

<?php } ?>

</ul>
</div>
<!-- FIN -->


<!-- ACTIVIDAD --
<div class="ui-block">
<div style="padding: 16px;" class="ui-block-title">
<h6 class="title" style="font-weight:bold;font-size:15px;line-height:1;color:#000">Estado del foro</h6>
</div>



</div>

<!-- PRIMER WIDGET --
<div class="ui-block">
<div style="background: url(http://html.crumina.net/html-olympus/img/bg-wethear.jpg);" class="widget w-action">
<div class="widget-thumb">
<img src="https://html.crumina.net/html-olympus/img/build-fav.png" alt="notebook">
</div>
<div class="content">
<span style="font-weight:700;margin-top:-10px;">¡Nueva tienda! para comerciantes, entra y reúnete con un vendedor, compra a largo plazo!</span>
<a style="margin-left:-31px" href="tienda" class="btn btn-bg-secondary btn-md">Publica tu CV!</a>
</div>
</div>
</div>
<!-- FIN -->

<!-- EVENTOS --
<div class="ui-block">
<div class="widget w-birthday-alert">
<div class="icons-block">
<svg class="olymp-cupcake-icon"><use xlink:href="estilos/svg-icons/sprites/icons.svg#olymp-cupcake-icon"></use></svg>
<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="estilos/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
</div>

<div class="content">
<div class="author-thumb">
<img src="img/avatar48-sm.jpg" alt="author">
</div>
<span>Hoy es</span>
<a href="#" class="h4 title">Evento de Halloween!</a>
<p>Leave her a message with your best wishes on her profile page!</p>
</div>
</div>
</div>
<!-- FIN -->		

<!-- AVISOS --
<div class="ui-block">
<div class="ui-block-title">
<h6 class="title">Avisos</h6>
</div>

<ul class="widget w-twitter">
<li class="twitter-item">
<div class="author-folder">
<center>
<img style="width:30px" src="<?=$todo?>/estilos/img/logo.png" alt="avatar">
</center>
<div class="author">
<a href="#" class="author-name">Deugub Roleplay</a>
<a href="#" class="group">@deugubrp</a>
</div>
</div>
<p>El servidor entro en modo mantenimiento hasta nuevo aviso, informarse más por nuestras redes.</p>
<span class="post__date">
<time class="published" datetime="2017-03-24T18:18">
hace 2 horas
</time>
</span>
</li>
</ul>
</div>
<!-- FIN --

<?php
$sql = "SELECT * FROM cuentas WHERE Online = '1' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
?>

<div class="ui-block">
<div class="ui-block-title">
<h6 class="title">En línea (<?=$numero?>)</h6>
</div>

<div class="ui-block-content">
<ul class="widget w-faved-page">

<?php
$usuario = mysqli_query($con, "SELECT * FROM cuentas WHERE ID AND Online = '1'");
while($user = mysqli_fetch_array($usuario)) {
?>

<!-- USUARIOS --
<li>	
<a href="perfil?id=<?=$user['Nombre_Apellido']?>">	
<img style="width:30px;height:30px;border-radius:50%;object-fit:cover" src="estilos/img/skins/<?=$user['Skin']?>.jpg?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="top" title="<?php $quitargion=str_replace("_"," ",$user['Nombre_Apellido']); echo(''.$quitargion.'') ?>"> 
</a>
</li>

<?php } ?>

</ul>

</div>
</div>
<!-- FIN -->

</aside>