<?php 
$link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$todo = htmlspecialchars('https://', $link, ENT_QUOTES, 'UTF-8');
?>
<link data-n-head="true" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<body>

<!-- MENÚ 2 -->
<div class="loading-bar"></div>

<!-- MENÚ -->
<nav style="height:52px;box-shadow: 0 1px 2px rgb(0 0 0 / 10%);background:#185ADB !important" class="navbar navbar-expand navbar-dark bg-<?=$tema?> osahan-nav-top p-0 px-2">
<div style="max-width:1210px;" class="container">

<a id="alert" class="navbar-brand mr-4" href="<?=$todo?>/index">
<img style="width:57px;height:auto;margin-top:-2px;margin-left:2.50px" src="<?=$todo?>/estilos/img/logo.png" alt="">
</a>
<!-- FIN -->

<ul class="navbar-nav mr-auto d-flex align-items-center">

<!-- BUSCAR -->
<li class="nav-item no-arrow mr-5">
<a class="nav-link nav-icon search-open" href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Buscar">
<i style="font-size:18px" class="fa fa-search"></i>
</a>
</li>

<div class="search-inline d-none d-sm-inline-block">
<form>
<input type="text" class="form-control" placeholder="Buscar...">
<button type="submit">
<i style="font-size:16px" class="fa fa-search"></i>
</button>
<a href="javascript:void(0)" class="search-close">
<i style="font-size:20px;margin-top: 18px;" class="fal fa-times"></i>
</a>
</form>
</div>
<!-- FIN -->

</ul>
<!-- FIN -->


<ul class="navbar-nav ml-auto d-flex align-items-center">

<!-- BUSCAR --
<form style="margin-left:15px;width:336px;" method="POST" action="buscar" class="d-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search px-4">
<div style="border-radius:2px;background:#fff;border: 2px solid #f5f2f2;" class="input-group">
<input type="text" name='PalabraClave' id="search" id="inlineFormInput" style="background:transparent;border-radius:2px 0px 0px 2px;height:32px;border:0px" class="form-control shadow-none" placeholder="Buscar..." aria-label="Buscar">
<input name="buscar" type="hidden" class="form-control mb-2" id="inlineFormInput" value="v">
<div class="input-group-append">
<button style="border-radius:0px 2px 2px 0px;height:32px;background:transparent !important" class="btn btn-dark" type="submit">
<i style="color:rgba(3,3,3);" class="fal fa-search"></i>
</button>
</div>
</div>
</form>
<!-- FIN -->


<!-- BUSCAR MOVIL -->
<li class="nav-itemdropdown no-arrow d-sm-none">
<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="feather-search mr-2"></i>
</a>
<div class="dropdown-menu dropdown-menu-right p-3 shadow-sm animated--grow-in" aria-labelledby="searchDropdown">
<form class="form-inline mr-auto w-100 navbar-search" accept-charset="UTF-8" method="POST" action="buscar">
<div class="input-group">
<input type="text" name='PalabraClave' id="search" class="form-control border-0 shadow-none" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2">
<div class="input-group-append">
<button class="btn" type="submit">
<i class="feather-search"></i>
</button>
</div>
</div>
</form>
</div>
</li>
<!-- FIN -->


<!-- MONEDAS -->
<li class="nav-item no-arrow mx-4">
<a class="nav-link nav-banner" href="<?=$todo?>/cartera/c">

<img style="width:24px;height:24px;margin-top:3px;" src="<?=$todo?>/estilos/img/ac1.png" data-toggle="tooltip" data-placement="bottom" title="Age Coin">

<span class="ml-2" style="float:right;font-size:8px;font-weight:normal;text-transform:uppercase;margin-top:4px;">Cartera<br>

<?php if($monedas > 0) { ?>

<span style="font-size:12px;text-align:center;font-weight:600;"><?php echo number_format($monedas);?></span>

<?php } else { ?>

<span style="font-size:9.40px;text-align:center;font-weight:600;text-transform:none;">No tienes</span>

<?php } ?>

</span>

</a>
</li>
<!-- FIN -->


<!-- SOLICITUDES DE AMISTAD -->
<li class="nav-item no-arrow mx-1">

<div class="dropdown">

<a type="button" class="nav-link nav-icon" href="<?=$todo?>/solicitudes" id="Solicitudes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i style="font-size:17px;margin-left:-3px !important;" class="fa fa-user-friends"></i>

<!--
<div class="iconon count"></div>-->

</a>

<div style="margin-top:15px;border-radius:3px !important;margin-right: 6px;width: 325px;padding:0px;" class="dropdown-menu dropdown-menu-right shadow-sm arrow-right" aria-labelledby="Solicitudes">

<div style="height:33px;width:auto;margin-bottom:10px;border-bottom:1px solid #DDDFE2;padding: 1.3rem 13px;" class="d-flex align-items-center">
<div style="width:325px">
<span class="mr-5" style="font-size:16px;font-weight:600;">Solicitudes</span>

<!--
<?php
if(isset($_POST['visto'])) {
$borrar = mysqli_query($con, "DELETE FROM notificaciones WHERE user2 = '".$usuario."'");
if($borrar) {echo '<script>history.back();</script>';}
}
?>	
<form style="float:right" method="POST" action="">
<button type="submit" style="background:transparent;border:0px" name="visto" data-toggle="tooltip" data-placement="bottom" title="Borrar todo">
<i style="font-size:16px" class="fal fa-trash" type="button"></i> 
</button>
</form>
-->

</div>
</div>

<div style="margin-right:1px;margin-left:0px;overflow: auto; height: auto;" class="row">

<!--
<div class="menunoti">
</div>	
-->

<?php if($solicitudes == 1) { ?>
<small style="color:#93a3b2;text-align:center;margin-left: 27%;font-size: 90%;margin-bottom:180px;">Solicitudes desactivadas</small>
<?php } ?>

</div>

<a href="#" style="text-align:center">
<div style="width:325px;background-color: #f6f9fc;text-align: center;font-weight: bold;padding: 10px;font-size: 12px;border-top: 1px solid #dddddd;margin-top:5px;">
Ver todo
</div>
</a>

</div>
</div>
</li>
<!-- FIN -->


<!-- MENSAJES -->
<li class="nav-item no-arrow mx-1">

<div class="dropdown">

<a type="button" class="nav-link nav-icon" href="<?=$todo?>/mensajes" id="Mensajes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i style="font-size:17px" class="fa fa-comment"></i>

<?php
$sql = "SELECT * FROM pcu_cchats WHERE de = '".$_SESSION['id']."' OR para = '".$_SESSION['id']."'";
$nmensajes = $con->query($sql);
$totalmensajes = mysqli_num_rows($nmensajes);

if($totalmensajes) {
?>

<div class="iconon"><?=$totalmensajes?></div>

<?php } ?>

</a>

<div style="margin-top:15px;border-radius:3px !important;margin-right: 6px;width: 325px;padding:0px;margin-bottom:0px" class="dropdown-menu dropdown-menu-right shadow-sm arrow-right" aria-labelledby="Mensajes">

<div style="height:33px;width:auto;border-bottom:1px solid #DDDFE2;padding: 1.3rem 13px;" class="d-flex align-items-center">
<div style="width:325px">
<span class="mr-5" style="font-size:16px;font-weight:600;">Mensajes</span>
</div>
</div>

<div style="margin-right:1px;margin-left:0px;overflow: auto; height: auto;" class="row">

<?php
$chats = mysqli_query($con, "SELECT * FROM pcu_cchats WHERE de = '".$_SESSION['id']."' OR para = '".$_SESSION['id']."' order by id_cch desc");
while($ch = mysqli_fetch_array($chats)) { 

if($ch['de'] == $_SESSION['id']) {$var = $ch['para'];} elseif ($ch['para'] == $_SESSION['id']) {$var = $ch['de'];}

$chat = mysqli_query($con, "SELECT * FROM pcu_chats WHERE id_cch = '".$ch['id_cch']."' ORDER BY id_cha DESC");
$cha = mysqli_fetch_array($chat);
$fechac = $cha["fecha"];
$horac = $cha["hora"];
$date = "$fechac,$horac";
$fecha2 = preg_replace('/:[0-9][0-9][0-9]/','/:[0-9][0-9][0-9]/',$date);
$time = strtotime($fecha2);
$time2 = dateDiff($time,time());

$usere = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$var'");
$us = mysqli_fetch_array($usere);
?>

<?php
$usuarioenm = mysqli_query($con, "SELECT tiempo FROM pcu_onlines WHERE eid = '".$us['ID']."'");
$enlineam = mysqli_fetch_array($usuarioenm);
$user_onlinem = $enlineam['tiempo'];
$this_date = date('U');
if ($user_onlinem>($this_date-60)) {
$user_onlinem = '0';
} else {
$user_onlinem = '1';
}
?>	

<div style="border-bottom: 1px solid #DDDFE2;" class="col-lg-12 mensaje">
<a style="color:inherit" href="<?=$todo?>/mensajes?usuario=<?=$us['ID']?>">	
<div class="row">
<div class="col-lg-3">
	
<img style="object-fit:cover;width:60px;height:60px;border-radius:4px;" src="<?=$todo?>/estilos/img/avatars/<?=$us['avatar']?>?nocache=<?=$versiones?>">
<?php if($user_onlinem != 1) {?>
<div style="top: 47px;right: 0px;height: 0.95rem;width: 0.95rem;" class="status-indicator bg-success" data-toggle="tooltip" data-placement="top" title="Conectado"></div>
<?php } else if($user_onlinem != 0) { ?>
<div style="top: 47px;right: 0px;height: 0.95rem;width: 0.95rem;" class="status-indicator bg-danger" data-toggle="tooltip" data-placement="top" title="Desconectado"></div>
<?php } ?>	

</div>

<div class="col-lg-9">
	
<h5 style="font-weight:600;font-size:14px;margin-bottom:3px;margin-top:4px;"><?=$us['Username']?></h5>

<p style="font-size:13px;margin-bottom:5px"><?=limitar_cadena($cha['mensaje'], 35, '...')?></p>

<p style="font-size:11px;margin-bottom:0px" class="text-muted">hace <?=$time2?></p>

</div>
</div>
</a>
</div>

<?php } ?>

</div>

<a href="mensajes" style="text-align:center">
<div style="width:325px;background-color: #f6f9fc;text-align: center;font-weight: bold;padding: 10px;font-size: 12px;">
Ver todo
</div>
</a>

</div>
</div>
</li>
<!-- FIN -->


<!-- NOTIFICACIONES -->
<li class="nav-item no-arrow mx-1">

<div class="dropdown">

<a type="button" class="nav-link nav-icon" href="#" id="Notificaciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i style="font-size:18px" class="fa fa-bell"></i>

<div class="iconon count"></div>	

</a>

<div style="margin-top:15px;border-radius:3px !important;margin-right: 6px;width: 325px;padding:0px;" class="dropdown-menu dropdown-menu-right shadow-sm arrow-right" aria-labelledby="Notificaciones">

<div style="height:33px;width:auto;margin-bottom:10px;border-bottom:1px solid #DDDFE2;padding: 1.3rem 13px;" class="d-flex align-items-center">
<div style="width:325px">
<span class="mr-5" style="font-size:16px;font-weight:600;">Notificaciones</span>

<?php
if(isset($_POST['visto'])) {
$borrar = mysqli_query($con, "DELETE FROM pcu_notificaciones WHERE user2 = '".$usuario."'");
if($borrar) {echo "<script>Swal.fire({title: '¡Exitoso!',icon: 'success',timer: 2500,showConfirmButton: false});</script>";}
}
?>	

<?php if($notificaciones == 0) { ?>
<form style="float:right" method="POST" action="">
<button type="submit" style="background:transparent;border:0px" name="visto" data-toggle="tooltip" data-placement="bottom" title="Borrar todo">
<i style="font-size:16px" class="fal fa-trash" type="button"></i> 
</button>
</form>
<?php } ?>

</div>
</div>

<div style="margin-right:1px;margin-left:0px;overflow: auto; height: auto;" class="row">

<div class="menunoti">
</div>	

<?php if($notificaciones == 1) { ?>
<small style="color:#93a3b2;text-align:center;margin-left: 27%;font-size: 90%;">Notificaciones desactivadas</small>
<?php } ?>

</div>

<a href="#" style="text-align:center">
<div style="width:325px;background-color: #f6f9fc;text-align: center;font-weight: bold;padding: 10px;font-size: 12px;border-top: 1px solid #dddddd;margin-top:5px;">
Ver todo
</div>
</a>

</div>
</div>
</li>
<!-- FIN -->


<!-- MENUS -->
<li class="nav-item no-arrow ml-1 mr-1">

<div class="dropdown">

<a class="nav-link pr-0" href="#" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<img class="img-profile avatar" style="width:31px;height:31px;object-fit:cover;border-radius:50%;" src="<?=$todo?>/estilos/img/avatars/<?=$avatar?>?nocache=<?=$versiones?>">
</a>

<div style="margin-top:15px;border-radius:3px !important;margin-right: 6px;" class="dropdown-menu dropdown-menu-right shadow-sm arrow-right" aria-labelledby="dropdownMenuButton">

<div style="height:73px;width:230px" class="p-3 d-flex align-items-center">

<div class="dropdown-list-image mr-3">
<img class="rounded-circle" style="object-fit:cover;" src="<?=$todo?>/estilos/img/avatars/<?=$avatar?>?nocache=<?=$versiones?>" alt="">
<?php if($user_online != 1) {?>
<div class="status-indicator bg-success" data-toggle="tooltip" data-placement="top" title="Conectado"></div>
<?php } else if($user_online != 0) { ?>
<div class="status-indicator bg-danger" data-toggle="tooltip" data-placement="top" title="Desconectado"></div>
<?php } ?>	
</div>

<div class="font-weight-bold">
<div class="text-truncate"><?php $quitargion=str_replace("_"," ",$usuario); echo(''.$quitargion.'') ?></div>
<div class="small text-gray-500">Usuario (PCU)</div>
</div>

</div>

<div class="dropdown-text">General</div>

<a class="dropdown-item header-menu" href="<?=$todo?>/perfil?idu=<?=$iduser?>&sec=muro">
<i style="font-size:18px" class="fal fa-user mr-3"></i> Perfil
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>/opciones">
<i style="font-size:18px" class="fal fa-cog mr-3"></i> Configuración
</a>

<div class="dropdown-text mt-3">Configuración</div>

<a type="button" class="dropdown-item header-menu" data-toggle="modal" data-target="#Aspecto">
<i style="font-size:18px" class="fal fa-<?php if($tema == 'claro') { echo 'clouds-sun'; } ?><?php if($tema == 'oscuro') { echo 'moon'; } ?> mr-2"></i> Aspecto: <?php if($tema == 'claro') { echo 'Claro'; } ?><?php if($tema == 'oscuro') { echo 'Oscuro'; } ?>
<span style="float:right"><i style="font-size:15px" class="fal fa-chevron-right"></i></span>
</a>

<a class="dropdown-item header-menu" href="#">
<i style="font-size:18px" class="fal fa-globe mr-3"></i> Ubicación: 

<img style="width:25px;height:25px;margin-top:-3px" class="ml-1" src="<?=$todo?>/estilos/img/banderas/<?php echo(getCountryFromIP($ip, "code"));?>.png" data-toggle="tooltip" data-placement="top" title="<?php echo(getCountryFromIP($ip, "name"));?>">

<!--<?=limitar_cadena($pais, 10, "<small class='text-muted'>...</small>");?>-->
</a>

<div style="margin: .5rem 14px;max-width: 85%;" class="dropdown-divider"></div>

<a class="dropdown-item header-menu" href="<?=$todo?>/salir">
<i style="font-size:18px" class="fal fa-sign-in mr-3"></i> Cerrar sesión
</a>

</div>
</li>

<?php if($enlazado == 1) { ?>

<!-- USUARIO -->
<li class="nav-item no-arrow ml-1 mr-2">

<div class="dropdown">

<a class="nav-link pr-0" href="#" role="button" id="Cuenta" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<img class="img-profile avatar" style="width:31px;height:31px;object-fit:cover;border-radius:50%;" src="<?=$todo?>/estilos/img/skins/<?=$Sropa?>.jpg">
</a>

<div style="margin-top:15px;border-radius:3px !important;margin-right: 6px;" class="dropdown-menu dropdown-menu-right shadow-sm arrow-right" aria-labelledby="Cuenta">

<div style="height:73px;width:210px;margin-bottom:5px !important;" class="p-3 d-flex align-items-center">

<div class="dropdown-list-image mr-3">
<img class="rounded-circle" style="object-fit:cover;" src="<?=$todo?>/estilos/img/skins/<?=$Sropa?>.jpg" alt="">
<?php if($Sonline == 1) {?>
<div class="status-indicator bg-success" data-toggle="tooltip" data-placement="top" title="Conectado"></div>
<?php } else { ?>
<div class="status-indicator bg-danger" data-toggle="tooltip" data-placement="top" title="Desconectado"></div>
<?php } ?>	
</div>

<div class="font-weight-bold">
<div class="text-truncate"><?php $quitargion=str_replace("_"," ",$Susuario); echo(''.$quitargion.'') ?></div>
<div style="font-size:11px;" class="small text-gray-500"><span style="font-size:10px;text-transform:none;margin-top:1px;" class="badge badge-warning">Membresía ??</span></div>
</div>

</div>

<div style="padding: 0px 15px 15px 15px;margin-top:-5px">

<div class="progress" style="height: 10px;margin-bottom:9px;" data-toggle="tooltip" data-placement="top" title="<?=$Svida?>%">
<div class="progress-bar bg-danger" role="progressbar" style="width: <?=$Svida?>%" aria-valuenow="<?=$Svida?>" aria-valuemin="0" aria-valuemax="100"></div>
</div>

<div class="progress" style="height: 10px;" data-toggle="tooltip" data-placement="top" title="<?=$Schaleco?>%">
<div class="progress-bar bg-info" role="progressbar" style="width: <?=$Schaleco?>%;background-color:#0156f1 !important" aria-valuenow="<?=$Schaleco?>" aria-valuemin="0" aria-valuemax="100"></div>
</div>

</div>

<div class="dropdown-text">General <span class="dropdown-text" style="float:right;margin-right:15px"><b style="color:#FFC93C">EXP:</b> <?=$Sexp?> / 10</span></div>

<a class="dropdown-item header-menu" href="<?=$todo?>/cuenta">
<i style="font-size:18px" class="fal fa-user mr-3"></i> Cuenta
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>/muro">
<i style="font-size:18px" class="fal fa-heart mr-3"></i> Muro
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>/propiedades">
<i style="font-size:18px" class="fal fa-car-building mr-3"></i> Propiedades
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>/sanciones">
<i style="font-size:18px" class="fal fa-ban mr-3"></i> Sanciones
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>/opciones">
<i style="font-size:18px" class="fal fa-cog mr-3"></i> Configuración
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>/banco">
<i style="font-size:18px" class="fal fa-receipt mr-3"></i> Transacciones
</a>

</div>
</div>
</li>

<?php } ?>

<!-----
<li class="nav-item no-arrow ml-1 mr-1">
<a class="nav-link pr-0" role="button" id="Cuenta" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span class="pr-0 mr-2" style="font-weight:400"><?php $quitargion=str_replace("_"," ",$usuario); echo(''.$quitargion.'') ?></span> <span><i style="font-size:9px" class="fal fa-chevron-down"></i></span>
</a>
</li>
<!---->

<li class="nav-item dropdown mr-2">
<div class="dropdown">	

<a class="nav-link" href="#" id="navbarDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i style="font-size:17px;color: rgb(255 255 255 / 85%) !important;
font-weight: 600;" class="fa fa-stream"></i>
</a>

<div style="height:auto;margin-top:15px;border-radius:3px !important;margin-right:8px;width:700px;" class="dropdown-menu dropdown-menu-right shadow-sm arrow-right" aria-labelledby="navbarDropdown">

<div style="margin-top:4px;" class="row">

<div class="col-lg-4 ml-1" style="border-right: 2px solid #f4f6fd;padding-right:0px">

<div class="dropdown-text">General</div>

<a class="dropdown-item header-menu" type="button" id="fullscr">
<i style="font-size:17px" class="fal fa-server mr-3"></i> Estado de servicios
</a>

<a class="dropdown-item header-menu" type="button" id="fullscr">
<i style="font-size:17px" class="fal fa-users-crown mr-3"></i> Cúpula
</a>

<a class="dropdown-item header-menu" type="button" id="fullscr">
<i style="font-size:17px" class="fal fa-link mr-3"></i> Acortador URL
</a>

<a class="dropdown-item header-menu" type="button" id="fullscr">
<i style="font-size:17px" class="fal fa-store mr-3"></i> Tienda AC
</a>
</div>

<div class="col-lg-4 ml-1" style="border-right: 2px solid #f4f6fd;padding-right:0px">

<div class="dropdown-text">Foro</div>

<a class="dropdown-item header-menu" href="<?=$todo?>/foro">
<i style="font-size:17px" class="fal fa-home mr-3"></i> Principal
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>/foro/mensajes">
<i style="font-size:17px" class="fal fa-comment mr-3"></i> Mensajes
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>/foro/perfil">
<i style="font-size:17px" class="fal fa-user mr-3"></i> Perfil
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>/foro/opciones">
<i style="font-size:17px" class="fal fa-cog mr-3"></i> Configuración
</a>
</div>

<div class="col-lg-3" style="padding-right:0px"> 

<div class="dropdown-text">Cuenta</div>

<a class="dropdown-item header-menu" type="button" id="fullscr">
<i style="font-size:17px" class="fal fa-user mr-3"></i> Perfil
</a>
</div>

</div>

</div>
</div>
</li>

</ul>
</div>
</nav>

<!-- MODAL ASPECTO -->
<div class="modal fade" id="Aspecto" tabindex="-1" aria-labelledby="AspectoLabel" aria-hidden="true">
<div style="border-radius:2px;" class="modal-dialog shadow-sm">
<div style="border-bottom: 2px solid #0652DD;" class="modal-content">
<div style="border:0px;padding: 1rem 1rem;">
<i style="font-size:18px" class="fal fa-arrow-left mr-2" type="button" data-dismiss="modal" aria-label="Cerrar"></i> 
<span style="font-size:18px;">Aspecto</span>

<i style="font-size:18px;float:right" class="fal fa-<?php if($tema == 'claro') { echo 'clouds-sun'; } ?><?php if($tema == 'oscuro') { echo 'moon'; } ?>"></i> 

</div>

<div class="modal-body">

<small>Este ajuste solo se aplica a este usuario</small>
<br><br>

<form method="POST" action="">

<?php
if(isset($_POST['claro'])) {
$add = mysqli_query($con, "UPDATE usuarios SET tema = 'claro' WHERE ID = '$iduser'");
if($add) {echo '<script>window.history.back();</script>';}
}
?>

<?php
if(isset($_POST['oscuro'])) {
$add = mysqli_query($con, "UPDATE usuarios SET tema = 'oscuro' WHERE ID = '$iduser'");
if($add) {echo '<script>window.history.back();</script>';}
}
?>

<button type="submit" name="claro" class="dropdown-item header-menu">
<i style="font-size:18px" class="<?php if($tema == 'claro') { echo 'fal fa-check'; } ?> mr-2" type="button" data-dismiss="modal" aria-label="Cerrar"></i>  Tema claro
</button>

<button type="submit" name="oscuro" class="dropdown-item header-menu">
<i style="font-size:18px" class="<?php if($tema == 'oscuro') { echo 'fal fa-check'; } ?> mr-2" type="button" data-dismiss="modal" aria-label="Cerrar"></i>  Tema oscuro
</button>

</form>

</div>

</div>
</div>
</div>
<!-- FIN -->

<!-- Notificaciones --
<div class="modal fade" id="Notificaciones" tabindex="-1" aria-labelledby="NotificacionesLabel" aria-hidden="true">
<div style="border-radius:2px;" class="modal-dialog shadow-sm">
<div style="height:auto;border-bottom: 2px solid #0652DD;" class="modal-content">
<div style="border:0px;padding: 1rem 1rem;">
<i style="font-size:18px" class="fal fa-arrow-left mr-2" type="button" data-dismiss="modal" aria-label="Cerrar"></i> 
<span style="font-size:18px;">Notificaciones</span>

<?php
if(isset($_POST['vistox'])) {
$borrar = mysqli_query($con, "DELETE FROM notificaciones WHERE user2 = '".$_SESSION['usuario']."'");
if($borrar) {echo '<script>window.location="notificaciones"</script>';}
}
?>	
<form style="float:right" method="POST" action="">
<button type="submit" style="background:transparent;border:0px" name="visto">
<i style="font-size:18px" class="fal fa-trash mr-2" type="button" data-dismiss="modal" aria-label="Vaciar"></i> 
</button>
</form>

</div>

<div class="modal-body">

<section style="overflow: auto; height: auto;">
<div style="margin-right:1px;margin-left:0px" class="menunoti row">

</div>

<?php if($notificaciones == 1) { ?>
<h5 style="color:#93a3b2;text-align:center;margin-top:90px;margin-bottom:180px;">Notificaciones desactivadas</h5>
<?php } ?>

</section>

</div>

</div>
</div>
</div>
<!-- FIN -->

<section>
<div style="max-width: 1201px;" class="container">