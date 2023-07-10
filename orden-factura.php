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

<h2>Factura de pago de PayPal</h2>	
<?php 
$sql = mysqli_query($con, "SELECT * FROM pcu_pagos WHERE txn_id = '$_GET[id]' AND usuario = '$_SESSION[usuario]'");
$datos = mysqli_fetch_array($sql);
?>

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