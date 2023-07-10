<?php 
$link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$todo = htmlspecialchars('https://', $link, ENT_QUOTES, 'UTF-8');
?>

<div class="col-lg-3 col-xs-7 col-sm-6">

<div style="border-radius:4px;width:220px" class="sidebar-widget">
<div class="nav nav-pills flex-column lavalamp">

<?php 
$pag =basename($_SERVER['SCRIPT_NAME']);
?>

<a class="nav-link nav-sub <?=$pag == 'opciones.php' ? 'active' : ''; ?>" href="<?=$todo?>/perfil?idu=<?=$iduser?>&sec=muro">
<img class="img-profile mr-2" style="width:24px;height:24px;object-fit:cover;border-radius:50%;margin-top:-2px" src="<?=$todo?>/estilos/img/avatars/<?=$avatar?>?nocache=<?=$versiones?>"> <?php $quitargion=str_replace("_"," ",$usuario); echo(''.$quitargion.'') ?>
</a>

<a class="nav-link nav-sub <?=$pag == 'mensajes.php' ? 'active' : ''; ?>" href="<?=$todo?>/mensajes">
<img class="img-profile mr-2" style="width:23px;height:23px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/mensajes.png"> Mensajes
</a>

<a class="nav-link nav-sub <?=$pag == 'cartera.php' ? 'active' : ''; ?>" href="<?=$todo?>/cartera/c">
<img class="img-profile mr-2" style="width:23px;height:23px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/cartera.png"> Cartera
<i style="float:right;margin-top:3px;width:35px" class="fal fa-chevron-down ml-4" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="myFunction()"></i>
</a>

<!-- SUB MENÚ -->
<div class="dropdown-lateralm <?=$pag == 'cartera.php' ? 'show' : ''; ?>" style="" id="myDropdown" aria-labelledby="dropdownMenuButton">

<div style="padding: 13px;" class="nav nav-pills flex-column lavalamp">

<a class="nav-sub <?=$pags == 'envios' ? 'active' : ''; ?>" href="<?=$todo?>/cartera/envios">
<img class="img-profile mr-2" style="width:22px;height:22px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/envios.png"> Envios 
</a>

<a class="nav-sub <?=$pags == 'historial' ? 'active' : ''; ?>" href="<?=$todo?>/cartera/historial/1">
<img class="img-profile mr-2" style="width:22px;height:22px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/historial.png"> Historial de pagos 
</a>
</div>

</div>
<!-- FIN -->

<small style="text-transform:uppercase;font-size:11px;" class="mb-3 text-muted mt-3">Ajustes</small>

<a class="nav-link nav-sub <?=$pag == 'configuracion.php' ? 'active' : ''; ?>" href="<?=$todo?>/configuracion">
<img class="img-profile mr-2" style="width:23px;height:23px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/config.png"> Configuración
</a>

<a class="nav-link nav-sub <?=$pag == 'soporte.php' ? 'active' : ''; ?>" href="<?=$todo?>/soporte">
<img class="img-profile mr-2" style="width:23px;height:23px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/soporte.png"> Soporte
</a>

<a class="nav-link nav-sub <?=$pag == 'personajes.php' ? 'active' : ''; ?>" href="<?=$todo?>/personajes">
<img class="img-profile mr-2" style="width:23px;height:23px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/personajes.png"> Personajes
</a>

<a class="nav-link nav-sub <?=$pag == 'foro.php' ? 'active' : ''; ?>" href="<?=$todo?>/foro">
<img class="img-profile mr-2" style="width:22px;height:22px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/foro.png"> Foro <small class="text-muted">(SAMP)</small>
</a>

<small style="text-transform:uppercase;font-size:11px;" class="mb-3 text-muted mt-3">Explorar</small>

<a class="nav-link nav-sub <?=$pag == 'muro.php' ? 'active' : ''; ?>" href="<?=$todo?>/muro">
<img class="img-profile mr-2" style="width:23px;height:23px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/muro.png"> Muro 
</a>

<a class="nav-link nav-sub <?=$pag == 'privacidad.php' ? 'active' : ''; ?>" href="<?=$todo?>/empresas">
<img class="img-profile mr-2" style="width:23px;height:23px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/empresa.png"> Empresas
</a>

<a class="nav-link nav-sub <?=$pag == 'seguridad.php' ? 'active' : ''; ?>" href="<?=$todo?>/empleos">
<img class="img-profile mr-2" style="width:23px;height:23px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/empleos.png"> Empleos
</a>

<a class="nav-link nav-sub <?=$pag == 'notificacion.php' ? 'active' : ''; ?>" href="<?=$todo?>/bancos">
<img class="img-profile mr-2" style="width:23px;height:23px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/banco.png"> Bancos
</a>

<a class="nav-link nav-sub <?=$pag == 'referidos.php' ? 'active' : ''; ?>" href="<?=$todo?>/tiendaic">
<img class="img-profile mr-2" style="width:23px;height:23px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/tiendaic.png"> Tienda IC
</a>

<a class="nav-link nav-sub <?=$pag == 'tiendaac.php' ? 'active' : ''; ?>" href="<?=$todo?>/tiendaac">
<img class="img-profile mr-2" style="width:23px;height:23px;margin-top:-2px" src="<?=$todo?>/estilos/img/menu/tiendaac.png"> Tienda AC
</a>

</div>
</div>
</div>

<!-- FORMULARIO -->
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