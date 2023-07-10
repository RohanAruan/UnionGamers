<?php 
include 'funciones/lib.php';

if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == $iduser) { } else { header("Location: ".$todo."/salir"); exit; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Prueba</title>
<?php include 'paginas/_head.php';?>
</head>
<body>

<?php 
if(isset($_SESSION["usuario"])) {
include 'paginas/_headerlog.php';
} else {
include 'paginas/_header.php';
}
?>

<h2>Prueba pago desde PayPal</h2>   
<?php 
$sql = mysqli_query($con, "SELECT * FROM pcu_pagos WHERE txn_id = '$_GET[tx]' AND usuario = '$_SESSION[usuario]'");
$datos = mysqli_fetch_array($sql);

$paymentID = $_GET['tx'];
$payerID = $_GET['payer_email'];
$token = $_GET['pay_key'];
$valor = $_GET['quantity1'];
$precio = $_GET['mc_gross'];
$producto = $_GET['item_name1'];
$currency = $_GET['mc_currency'];
$estado = $_GET['payment_status'];

echo "<script>Swal.fire({title: 'El pago se ha completado',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
    window.location = '".$todo."/orden-factura?id=".$paymentID."';});</script>";
?>

<div class="alert alert-success">
<strong>Completado!</strong> Tu orden fue procesada correctamente!
</div> 

<span>Pago ID:  <?=$datos['txn_id'];?></span><br>
<span>Comprador ID: <?=$datos['usuario'];?></span><br>
<span>Producto: <?=$datos['producto'];?></span><br>
<span>Valor del producto: <?=$datos['valor'];?></span><br>
<span>Precio: <?=$datos['precio'];?></span><br>
<span>Estado: <?=$datos['estado'];?></span><br>
<span>Moneda: <?=$datos['moneda'];?></span>

<?php include "paginas/_footer.php";?>

</body>
</html>