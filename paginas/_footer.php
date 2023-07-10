<?php 
$link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$todo = htmlspecialchars('https://', $link, ENT_QUOTES, 'UTF-8');
?>

<br><br><br>

<!-- FOOTER --
<section style="background:#fff;border: 0px;border-radius:12px;border: 1px solid #e6ecf5;width:100%" class="alert alert-dark osahan-copyright shadow-sm">

<div class="col-lg-12" style="padding:5px">
<div class="row">

<div class="col-xl-12">

<?php
$sql = "SELECT * FROM cuentas WHERE Online = '1' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
?>

<div class="ui-block">
<div class="ui-block-title">
<h5 style="font-weight:500;text-align:center;margin-bottom:20px;" class="title">SAMP: <b>samp.ageofrol.com</b> (<?=$numero?> / 100)</h5>
</div>

<div style="padding:10px;border:2px solid #f2f5fb;border-radius:4px;" class="ui-block-content">

<?php
$usuarioff = mysqli_query($con, "SELECT * FROM cuentas WHERE ID AND Online = '1'");

$usuariof = mysqli_query($con, "SELECT * FROM cuentas WHERE ID AND Online = '1'");
$res = mysqli_fetch_array($queryx); 
if($res == 1) {

while($user = mysqli_fetch_array($usuariof)) {
?>

<!-- USUARIOS --

<a href="perfil?idu=<?=$user['ID']?>&sec=muro">	
<img style="width:30px;height:30px;border-radius:50%;object-fit:cover" src="estilos/img/skins/<?=$user['Skin']?>.jpg?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="top" title="<?=$user['Nombre_Apellido']?>"> 
</a>

<?php } } else { ?>

<h6 class="mt-1" style="text-align:center;">No hay usuarios conectados.</h6>

<?php } ?>

</div>
</div>

</div>

<div class="col-xl-12 mt-4">
<div style="font-size:13px;" class="d-flex align-items-center justify-content-between">
<p class="m-0 text-muted" style="margin-right:20px">© 2020-2021 <b>Age Of Rol v0.1</b> <i style="color:#4825f5" class="fa fa-heart parpadea"></i> por <a class="text-dark" href="perfil?idu=7&sec=muro">Lambito</a></p>
<p class="m-0">
<a href="#" class="text-secondary">Sobre Nosotros</a>
&nbsp; · &nbsp;
<a href="#" class="text-secondary">Política de Privacidad</a>
&nbsp; · &nbsp;
<a href="#" class="text-secondary">Términos de Condiciones</a>
</p>
</div>
</div>


</div>
</div>
</section>
<!-- FIN --

</div>
<br>

<!-- SCRIPTS -->
<script>
if ('loading' in HTMLImageElement.prototype) {
// Si el navegador soporta lazy-load, tomamos todas las imágenes que tienen la clase
// `lazyload`, obtenemos el valor de su atributo `data-src` y lo inyectamos en el `src`.
const images = document.querySelectorAll("img.lazyload");
images.forEach(img => {
img.src = img.dataset.src;
});
} else {
// Importamos dinámicamente la libreria `lazysizes`
let script = document.createElement("script");
script.async = true;
script.src = "https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.0/lazysizes.min.js";
document.body.appendChild(script);
}
</script>

<?php 
if($notificaciones == 0) { ?>
<script>
$(document).ready(function(){

function load_unseen_notification(view = '')
{
$.ajax({
url:"<?=$todo?>/funciones/anexos/notificacion.php",
method:"POST",
data:{view:view},
dataType:"json",
success:function(data)
{
$('.menunoti').html(data.notification);
if(data.unseen_notification > 0)
{
$('.count').html(data.unseen_notification);
}
}
});
}

load_unseen_notification();

$(document).on('click', '.notificacion', function(){
$('.count').html('');
load_unseen_notification('yes');
});

setInterval(function(){ 
load_unseen_notification();; 
},20000);

});
</script>
<?php } ?>

<script>
let fullscreen;
let fsEnter = document.getElementById("fullscr");
fsEnter.addEventListener("click", function (e) {
e.preventDefault();
if (!fullscreen) {
fullscreen = true;
document.documentElement.requestFullscreen();
fsEnter.innerHTML = "<i style='font-size:15px' class='fal fa-compress mr-3'></i> Quitar";
} else {
fullscreen = false;
document.exitFullscreen();
fsEnter.innerHTML = "<i style='font-size:15px' class='fal fa-expand mr-3'></i> Pantalla completa";
}
});

</script>	

<script>
window.onload=function(){
var pos=window.name || 0;
window.scrollTo(0,pos);
}
window.onunload=function(){
window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}
</script>

<script>
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>

<script>
var sp = document.querySelector('.search-open');
var searchbar = document.querySelector('.search-inline');
var shclose = document.querySelector('.search-close');
function changeClass() {
searchbar.classList.add('search-visible');
}
function closesearch() {
searchbar.classList.remove('search-visible');
}
sp.addEventListener('click', changeClass);
shclose.addEventListener('click', closesearch);
</script>

<script>
$('.btn').on('click', function() {
var $this = $(this);
$this.button('loading');
setTimeout(function() {
$this.button('reset');
}, 8000);
});
</script>

<script>
if(window.history.replaceState) {
window.history.replaceState(null, null, window.location.href);
}
</script>

<!--
<script type="text/javascript">
if(screen.width<800) {
window.location="https://m.ageofrol.net";
}
</script>
-->

<!--
<script type="text/javascript">
window.setInterval(function () {
updateStats();
}, 1000);
function updateStats() {
updateConnectedUsers();
updateDailyRevenue();
}
function updateConnectedUsers() {
jQuery.get(
'get_connected_users.php',
function (data) {
$('#connected_users').text(data);
}
);
}
function updateDailyRevenue() {
jQuery.get(
'notificaciones1.php',
function (data) {
$('#daily_revenue').text(data);
}
);
}
</script>
-->	

<script src="<?=$todo?>/estilos/css/bootstrap/4.5.1/js/bootstrap.bundle.min.js"></script>

<!-- FUENTES -->
<script src="<?=$todo?>/estilos/fonts/awesome/js/all.min.js"></script>
<script src="<?=$todo?>/estilos/fonts/awesome/js/fontawesome.min.js"></script>



