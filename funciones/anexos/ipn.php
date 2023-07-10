<?php 
include_once 'paypal.php'; 
include_once '../config.php'; 

$fecha = date('Y-m-d');
$hora = date('H:i:s');
setlocale(LC_TIME, "spanish");
date_default_timezone_set('America/Santo_Domingo'); 

$raw_post_data = file_get_contents('php://input'); 
$raw_post_array = explode('&', $raw_post_data); 
$myPost = array(); 
foreach ($raw_post_array as $keyval) { 
$keyval = explode ('=', $keyval); 
if (count($keyval) == 2) 
$myPost[$keyval[0]] = urldecode($keyval[1]); 
} 

// Read the post from PayPal system and add 'cmd' 
$req = 'cmd=_notify-validate'; 
if(function_exists('get_magic_quotes_gpc')) { 
$get_magic_quotes_exists = true; 
} 
foreach ($myPost as $key => $value) { 
if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
$value = urlencode(stripslashes($value)); 
} else { 
$value = urlencode($value); 
} 
$req .= "&$key=$value"; 
} 

/* 
* Post IPN data back to PayPal to validate the IPN data is genuine 
* Without this step anyone can fake IPN data 
*/ 
$paypalURL = PAYPAL_URL; 
$ch = curl_init($paypalURL); 
if ($ch == FALSE) { 
return FALSE; 
} 
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $req); 
curl_setopt($ch, CURLOPT_SSLVERSION, 6); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1); 

// Set TCP timeout to 30 seconds 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name')); 
$res = curl_exec($ch); 

/* 
* Inspect IPN validation result and act accordingly 
* Split response headers and payload, a better way for strcmp 
*/  
$tokens = explode("\r\n\r\n", trim($res)); 
$res = trim(end($tokens)); 
if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) { 

$fecha = date('Y-m-d');
$hora = date('H:i:s');

// Retrieve transaction info from PayPal 
$sesion = $_POST['custom'];
$paymentID = $_POST['txn_id'];
$payerID = $_POST['payer_email'];
$token = $_POST['pay_key'];
$valor = $_POST['quantity1'];
$precio = $_POST['mc_gross'];
$producto = $_POST['item_name1'];
$currency = $_POST['mc_currency'];
$estado = $_POST['payment_status'];

$prevPayment = $con->query("SELECT txn_id FROM pcu_pagos WHERE txn_id = '".$txn_id."'"); 
if($prevPayment->num_rows > 0){ 
exit(); 
}else{ 

$sql = $con->query("SELECT * FROM usuarios WHERE ID = '".$sesion."'");
$datos = $sql->fetch_array(MYSQLI_ASSOC);
$usuario = $datos['Username'];

// Insert transaction data into the database 
$insert = $con->query("INSERT INTO pcu_pagos (producto,txn_id,usuario,precio,moneda,valor,estado) VALUES('".$producto."','".$paymentID."','".$sesion."','".$precio."','".$currency."','".$valor."','".$estado."')");

$insert1 = $con->query("INSERT INTO pcu_historialac (usuarior, usuarioe, tipo, ac, fecha, hora) VALUES ('$usuario', 'PayPal', '2', '0', '$fecha', '$hora')");

$insert2 = $con->query("INSERT INTO pcu_historialac (usuarior, usuarioe, tipo, ac, fecha, hora) VALUES ('PayPal', '$usuario', '2', '$valor', '$fecha', '$hora')");

$insert3 = $con->query("UPDATE usuarios SET monedas=monedas+".$valor." WHERE ID = '".$sesion."'");

$insert4 = mysqli_query($con, "INSERT INTO pcu_notificaciones (user1, user2, tipo, leido, fecha, hora) VALUES ('PayPal', '".$usuario."', 'te ha enviado ".$valor." AC', '0', '".$fecha."', '".$hora."')");

} 

} 
?>