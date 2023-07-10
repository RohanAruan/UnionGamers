<?php
include 'funciones/lib.php';
include 'funciones/anexos/paypal.php';

if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == $iduser) { } else { header("Location: ".$todo."/salir"); exit; }
?>

<?php
$nombre = "Age Coin";
$moneda = "USD";
$precio = '0.80';
$productId = '100';
$valor = '3';
$orderNumber = '000999';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Tienda AC</title>
<?php include "paginas/_head.php";?>
</head>
<body>

<?php 
if(isset($_SESSION["usuario"])) {
include 'paginas/_headerlog.php';
} else {
include 'paginas/_header.php';
}
?>


<!-- CUERPO -->
<div class="row">

<?php include "paginas/_lateralm.php"; ?>	

<div class="col-lg-9">

<h4 style="font-weight:600" class="m-0">Tienda <img src="estilos/img/ac.png" style="width:35px" /></h4>	<br>

<div class="row gutter-1">

<?php 
$tienda = "SELECT * FROM pcu_planes WHERE ID ORDER BY ID";
$result = mysqli_query($con, $tienda);

while($store = mysqli_fetch_array($result)) {	
$idpack = $store['ID'];
?>

<!-- PLAN 1 -->
<div class="col-lg-4 mb-4">
<div style="border-radius:4px" class="p-4 bg-white">	
<h6 style="text-transform:uppercase;font-size:14px;" class="m-0">Paquete <strong style="color:<?=$store['color']?>"><?=$store['nombre']?></strong> <?php if($store['oferta'] == 1) { ?><a href="#" style="float:right;margin-left:12px;margin-top:-6px" class="tag">Oferta</a><?php } ?></h6>
<h3 class="mt-3" style="font-weight:600;margin-bottom:20px;">$<?=$store['precio']?></h3>

<div style="border-left: 1px solid #e9e9e9;padding:3px;">
<span class="ml-2"><strong class="text-success ml-2">+</strong> <?=$store['ac']?> AC</span><br>
<span class="ml-2"><strong class="text-success ml-2">+</strong> <?=$store['ptos']?> punto de compra</span>
</div>

<?php
$error = false;

if (isset($_GET['error']))
$error = $_GET['error'];

if (isset($_POST['submitPayment'.$idpack.''])) {

$order = date('ymdHis');

?>

<div class="btn btn-info btn-block mt-4 loading" style="border-radius:3px;">
<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
<span class="sr-only">Loading...</span>
</div>

<form id="realizarPago" action="<?php echo PAYPAL_URL; ?>" method="post">
<input name="cmd" type="hidden" value="_cart" />
<input name="upload" type="hidden" value="1" />
<input name="business" type="hidden" value="<?php echo PAYPAL_ID; ?>" />
<input name="shopping_url" type="hidden" value="https://ageofrol.com" />
<input name="currency_code" type="hidden" value="<?=$currency?>" />
<input name="cancel_return" type="hidden" value="<?php echo PAYPAL_CANCEL_URL; ?>" />
<input name="return" type="hidden" value="<?php echo PAYPAL_RETURN_URL; ?>" />
<input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">

<input name="rm" type="hidden" value="2" />
<input name="item_number_1" type="hidden" value="<?=$order; ?>" />
<input name="item_name_1" type="hidden" value="Paquete <?=$store['nombre']?>" />
<input name="amount_1" type="hidden" value="<?=$store['precior']?>" />
<input name="payer_email_1" type="hidden" value="<?=$email?>" />
<input name="quantity_1" type="hidden" value="<?=$store['ac']?>" /> 
<input name="custom" type="hidden" value="<?=$iduser?>" />

</form>


<script>
$(document).ready(function () {
$("#realizarPago").submit();
});
</script>
<?php
} else {   
?>
<form class="form-amount" action="tiendaac" method="post">
<?php if ($error) { echo "<script>Swal.fire({title: 'Error',icon: 'error',timer: 2500,showConfirmButton: false})</script>"; } ?>
<input class="btn btn-info btn-block mt-4" style="border-radius:3px;" name="submitPayment<?=$idpack?>" type="submit" value="Comprar">
</form> 
<?php
}
?>

</div>	
</div>
<!-- FIN -->

<?php } ?>

</div>
<!-- FIN -->


<!--
<table class="table">
<tr>
<td style="width:150px"><img src="estilos/img/ac.png" style="width:50px" /></td>
<td style="width:150px">$<?php echo $precio; ?></td>
<td style="width:150px">AC <?php echo $valor; ?></td>
<td style="width:150px">
<?php
$error = false;

if (isset($_GET['error']))
$error = $_GET['error'];

if (isset($_POST['submitPayment'])) {

$order = date('ymdHis');

?>

<div class="loading">Un momento, por favor</div>

<form id="realizarPago" action="<?php echo PAYPAL_URL; ?>" method="post">
<input name="cmd" type="hidden" value="_cart" />
<input name="upload" type="hidden" value="1" />
<input name="business" type="hidden" value="<?php echo PAYPAL_ID; ?>" />
<input name="shopping_url" type="hidden" value="http://agerp.ddns.net" />
<input name="currency_code" type="hidden" value="<?=$currency?>" />
<input name="cancel_return" type="hidden" value="<?php echo PAYPAL_CANCEL_URL; ?>" />
<input name="return" type="hidden" value="<?php echo PAYPAL_RETURN_URL; ?>" />
<input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">

<input name="rm" type="hidden" value="2" />
<input name="item_number_1" type="hidden" value="<?=$order; ?>" />
<input name="item_name_1" type="hidden" value="<?=$productName; ?>" />
<input name="amount_1" type="hidden" value="<?=$productPrice; ?>" />
<input name="payer_email_1" type="hidden" value="<?=$email?>" />
<input name="quantity_1" type="hidden" value="<?=$productValor?>" /> 
<input name="custom" type="hidden" value="<?=$iduser?>" />

</form>
<script>
$(document).ready(function () {
$("#realizarPago").submit();
});
</script>
<?php
}
else {   
?>
<form class="form-amount" action="comprarpp" method="post">
<?php if ($error) { echo "<script>Swal.fire({title: 'Error',icon: 'error',timer: 2500,showConfirmButton: false})</script>"; } ?>
<input class="btn btn-info btn-sm" style="border-radius:4px;" name="submitPayment" type="submit" value="Pagar desde PayPal">
</form> 
<?php
}
?>
</td>
</tr>
</table>
-->

</div>	

<?php include "paginas/_footer.php";?>

</body>
</html>
