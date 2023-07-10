<?php 
define('PAYPAL_ID', 'sb-ygwyw12479818@business.example.com'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
 
define('PAYPAL_RETURN_URL', 'https://ageofrol.com/orden.php'); 
define('PAYPAL_CANCEL_URL', 'https://ageofrol.com/cancel.php'); 
define('PAYPAL_NOTIFY_URL', 'https://ageofrol.com/funciones/anexos/ipn.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
 
// Database configuration 
define('DB_HOST', '198.50.222.112'); 
define('DB_USERNAME', 'remote'); 
define('DB_PASSWORD', '3315117552Le1!!!'); 
define('DB_NAME', 'roleplay'); 
 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
?>