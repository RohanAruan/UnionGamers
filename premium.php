<?php
include 'funciones/lib.php';

if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == $iduser) { } else { header("Location: ".$todo."/salir"); exit; }

$pag =basename($_SERVER['SCRIPT_NAME']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Cartera</title>
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

<div class="col-lg-12">

<div style="margin-bottom:35px;">
<div style="background:url(estilos/img/4.jpg)center;border-radius:12px;" class="gradient-1 gradient-block shadow-sm">
<div class="row align-items-center">
<div class="col-lg-5">

<div style="background-color:#fff;border-radius:12px" class="p-5">
<h2 style="width:600px;font-size:40px;" class="mb-3 text-muted">Premium</h2>
<p>Todos los servicios ofrecidos se canjean mediante Age Coin, son diferentes ventajas.</p>
<a href="#" style="border-radius:2px;" class="btn btn-info mr-2" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Adquirir AC <i class="fal fa-coins"></i></a>
</div>

</div>
</div>
</div>
</div>

<!-- FIN -->


<!-- CARTERA -->

<!-- TITULO -->
<div class="d-flex align-item-center title mb-3">
<h4 style="font-weight:600" class="m-0">Tienda OOC</h4>
</div>
<!-- FIN -->	

<div style="border-radius:4px;margin-bottom:20px;" class="p-4 bg-white">	

<div class="row gutter-1">

<div class="col-md-6">
<div style="text-align:center;" class="form-group"> 
<label style="font-size:14px;text-transform:uppercase;font-weight:600;" class="d-block"><img style="width:20px;height:20px;" class="mr-1" src="<?=$todo?>/estilos/img/ac.png" data-toggle="tooltip" data-placement="bottom" title="Age Coin"> Age Coins</label>

<div class="mb-2">

<?php if($monedas > 0) { ?>

<span style="font-size:30px"><?php echo number_format($monedas);?></span>

<?php } else { ?>

<div class="mb-4 mt-4">
<span style="font-size:15px;color:#93a3b2;text-align:center;">¡No tienes AC!</span>
</div>

<?php } ?>

</div>
</div>

<a href="<?=$todo?>/cartera/historial/1" class="btn btn-light btn-block">Historial</a>

</div>

<div class="col-md-6">
<a class="btn btn-light btn-block" style="float:right" href="<?=$todo?>/comprarpp">Comprar <i class="fal fa-coins ml-2"></i> </a>
<a class="btn btn-light btn-block" style="float:right" href="<?=$todo?>/#">Vender </a>
<a class="btn btn-info btn-block" style="float:right" href="<?=$todo?>/cartera/envios">Transferir <i class="fal fa-sync ml-2"></i></a>
</div>

</div>

</div>
<!-- FIN -->


</div>


<!--
<div class="text-right mt-4">
<a href="opciones" class="btn btn-link">Cancelar</a>	
<button style="border-radius: .25rem;" type="submit" name="actualizar" class="btn btn-info mr-1">Actualizar perfil</button>
</div>
-->

</div>
<!-- FIN -->

</div>
<!-- FIN -->

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</div>
</section>

</body>
</html>
