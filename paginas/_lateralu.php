<?php 
$link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$todo = htmlspecialchars('https://', $link, ENT_QUOTES, 'UTF-8');
?>

<div style="padding-left:0px;" class="col-lg-3 col-xs-7 col-sm-6">

<!--	
<div style="border-radius:4px;width:260px" class="box box-widget widget-user">
<img src="<?=$todo?>/estilos/img/avatars/banners/<?=$banner?>?nocache=<?=$versiones?>" style="object-fit:cover;width:100%" class="widget-user-header">

<div class="widget-user-image">
<img class="img-profile rounded-circle" style="object-fit:cover;width:90px;height:90px;" src="<?=$todo?>/estilos/img/avatars/<?=$avatar?>?nocache=<?=$versiones?>">

<?php if($user_online != 1) {?>
<div style="top: 67px;right: 9px;" class="status-indicator bg-success" data-toggle="tooltip" data-placement="top" title="Conectado"></div>
<?php } else if($user_online != 0) { ?>
<div style="top: 67px;right: 9px;" class="status-indicator bg-danger" data-toggle="tooltip" data-placement="top" title="Desconectado"></div>
<?php } ?>	
</div>
<div class="box-footer">
<div class="row">

<div class="col-sm-12">
<div class="description-block">
<h5 class="description-header"><?php if($mostrar == 0) { echo ''.$usuario.''; } else { $quitargion=str_replace("_"," ",$Susuario); echo(''.$quitargion.''); } ?></h5>
<small class="text-muted">Usuario</small>
</div>
</div>

</div>
</div>
</div>
-->

<div style="border-radius:4px;width:260px" class="bg-white p-3 sidebar-widget mb-4">
<div class="nav nav-pills flex-column lavalamp">

<?php 
$pag =basename($_SERVER['SCRIPT_NAME']);
?>

<a class="nav-link nav-sub <?=$pag == 'opciones.php' ? 'active' : ''; ?>" href="<?=$todo?>/opciones">
<i class="fal fa-user mr-3 icon <?=$pag == 'opciones.php' ? 'active' : ''; ?>"></i> Perfil
</a>

<a class="nav-link nav-sub <?=$pag == 'configuracion.php' ? 'active' : ''; ?>" href="<?=$todo?>/configuracion">
<i class="fal fa-cog mr-3 icon <?=$pag == 'configuracion.php' ? 'active' : ''; ?>"></i> Configuración
</a>

<a class="nav-link nav-sub <?=$pag == 'cartera.php' ? 'active' : ''; ?>" href="<?=$todo?>/cartera/c">
<i class="fal fa-wallet mr-3 icon <?=$pag == 'cartera.php' ? 'active' : ''; ?>"></i> Cartera 
<i style="float:right;margin-top:3px;width:35px" class="fal fa-chevron-down ml-4" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="myFunction()"></i>
</a>

<!-- SUB MENÚ -->
<div class="dropdown-lateral <?=$pag == 'cartera.php' ? 'show' : ''; ?>" style="" id="myDropdown" aria-labelledby="dropdownMenuButton">

<div style="padding: 13px;" class="nav nav-pills flex-column lavalamp">

<a class="nav-sub <?=$pags == 'envios' ? 'active' : ''; ?>" href="<?=$todo?>/cartera/envios">
<i class="fal fa-handshake mr-3 icon <?=$pags == 'envios' ? 'active' : ''; ?>"></i> Envios 
</a>

<a class="nav-sub <?=$pags == 'historial' ? 'active' : ''; ?>" href="<?=$todo?>/cartera/historial/1">
<i class="fal fa-history mr-3 icon <?=$pags == 'historial' ? 'active' : ''; ?>"></i> Historial de pagos 
</a>
</div>

</div>
<!-- FIN -->

<a class="nav-link nav-sub <?=$pag == 'privacidad.php' ? 'active' : ''; ?>" href="<?=$todo?>/privacidad">
<i class="fal fa-low-vision mr-3 icon <?=$pag == 'privacidad.php' ? 'active' : ''; ?>"></i> Privacidad
</a>

<a class="nav-link nav-sub <?=$pag == 'seguridad.php' ? 'active' : ''; ?>" href="<?=$todo?>/seguridad">
<i class="fal fa-shield mr-3 icon <?=$pag == 'seguridad.php' ? 'active' : ''; ?>"></i> Seguridad
</a>

<a class="nav-link nav-sub <?=$pag == 'notificacion.php' ? 'active' : ''; ?>" href="<?=$todo?>/notificacion">
<i class="fal fa-bell mr-3 icon <?=$pag == 'notificacion.php' ? 'active' : ''; ?>"></i> Notificación
</a>

<a class="nav-link nav-sub <?=$pag == 'referidos.php' ? 'active' : ''; ?>" href="referidos">
<i class="fal fa-users-medical mr-2 icon <?=$pag == 'referidos.php' ? 'active' : ''; ?>"></i> Referidos
</a>

<a class="nav-link nav-sub <?=$pag == 'enlazar.php' ? 'active' : ''; ?>" href="<?=$todo?>/enlazar">
<i class="fal fa-user-plus mr-2 icon <?=$pag == 'enlazar.php' ? 'active' : ''; ?>"></i> Enlazar
</a>

</div>
</div>
</div>

<!-- FORMULARIO -->
<div class="col-lg-9">

<script>
function myFunction() {
document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
if (!event.target.matches('.dropbtn')) {
var dropdowns = document.getElementsByClassName("dropdown-content");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
}
</script>