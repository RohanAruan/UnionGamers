<?php 
$link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$todo = htmlspecialchars('https://', $link, ENT_QUOTES, 'UTF-8');
?>

<link rel="stylesheet" href="<?=$todo?>/estilos/css/<?php if(isset($_SESSION['usuario'])) { echo $tema; } else { echo 'claro'; } ?>.css?ver=2.4">
<link rel="stylesheet" href="<?=$todo?>/estilos/css/style.css?ver=1.4">
<link href="<?=$todo?>/estilos/css/bootstrap/4.5.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?=$todo?>/estilos/css/feather.css">
<link rel="icon" type="image/x-ico" href="<?=$todo?>/estilos/img/logo.png" />


<!-- FUENTES -->
<link rel="stylesheet" href="<?=$todo?>/estilos/fonts/awesome/css/all.min.css">
<link rel="stylesheet" href="<?=$todo?>/estilos/fonts/awesome/css/fontawesome.min.css">

<!-- JQUERY -->
<script src="<?=$todo?>/estilos/js/jquery-1.11.2.min.js"></script>
<script src="<?=$todo?>/estilos/js/jquery.min.js"></script>
<script src="<?=$todo?>/estilos/js/lazysizes.min.js" async=""></script>

<!-- SWEETALERT2 -->
<script src="<?=$todo?>/estilos/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="<?=$todo?>/estilos/plugins/sweetalert2/sweetalert2.min.css">

<!-- IDIOMAS -->
<style>
i {
position:relative;
}
</style>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
