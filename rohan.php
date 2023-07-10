<?php
include 'funciones/lib.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Invoice No: Inv-13248 | Canada Warez</title>
<?php include "paginas/_head.php"; ?>
</head>
<!-- FIN -->

<!-- CUERPO -->
<div class="row">				 
<!-- FIN -->

<?php
if(isset($_POST['enviar']))
{

$email = mysqli_real_escape_string($con, $_POST['email']);

require 'funciones/anexos/PHPMailer-master/src/Exception.php';
require 'funciones/anexos/PHPMailer-master/src/PHPMailer.php';
require 'funciones/anexos/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
$mail->SMTPDebug = 0;  // Sacar esta línea para no mostrar salida debug
$mail->isSMTP();
$mail->Host = 'berri.whc.ca';  // Host de conexión SMTP
$mail->SMTPAuth = true;
$mail->Username = 'info@canadawarez.ca';                 // Usuario SMTP
$mail->Password = 'A[sP;siGtX3R';                           // Password SMTP
$mail->SMTPSecure = 'ssl';       
$mail->Timeout       =   60; // set the timeout (seconds)
$mail->SMTPKeepAlive = true; // don't close the connection between messages                     // Activar seguridad TLS
$mail->Port = 465;                                    // Puerto SMTP

$mail->setFrom('info@canadawarez.ca');      // Mail del remitente
$mail->addAddress($email);     // Mail del destinatario

$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->FromName= 'Canada Warez';
$mail->Subject = 'Invoice No: Inv-13248 — Canada Warez';  // Asunto del mensaje
$mail->Body    = '<!DOCTYPE html>
<html>
<head>
</head>
<body style="font-family: Arial, sans-serif;">
<div style="background: linear-gradient(20deg, #e01214 50%, #fff 50%);;">
<div style="padding: 20px; max-width: 600px; margin: 0 auto;">
<center>
<div style="width:460px">
<div style="position: relative;
display: -ms-flexbox;
-ms-flex-direction: column;
flex-direction: column;
min-width: 0;
margin-top: 10px;
word-wrap: break-word;
background-color: #fff;
background-clip: border-box;
border: 1px solid rgba(0,0,0,.125);
border-radius: .25rem;  
border-bottom: 2px solid #e01214;
border-radius: 4px !important;
padding: 25px;" class="card">


<img style="width: 150px;margin-top: 31px;" src="https://canadawarez.ca/wp-content/uploads/2021/01/cropped-CANADAWAREZ-LOGO-SINFONDO-PNG.png">
<h2 style="color: #444444;">Hello Ferretería Ripoll Hermanos,</h2>
<p style="font-size: 16px; color: #444444;">
Please find attached Invoice #13228. Due Date is 2023-07-16.
</p>

<table style="width: 100%; margin: 20px 0; font-size: 16px; color: #444444;">
<tr>
<td>Invoice No:</td>
<td>#13228</td>
</tr>
<tr>
<td>Invoice Date:</td>
<td>2023-06-16</td>
</tr>
<tr>
<td>Due Date:</td>
<td>2023-07-16</td>
</tr>
<tr>
<td>Due Amount:</td>
<td>1330 CAD</td>
</tr>
</table>

<a href="https://canadawarez.ca/invoice/?id=13228&token=198a9f9f0ed24ef2d7b65268b2e6d4a6c20d4c8d" 
style="display: inline-block; font-size: 16px; color: #ffffff; background-color: #e01214; 
padding: 10px 20px; text-decoration: none; border-radius: 3px;">
Pay Online
</a>

<p style="font-size: 16px; color: #444444; margin-top: 20px;">
Thank you for your business.
</p>
<p style="font-size: 16px; color: #444444;">
Regards<br>
Canada Warez
</p>
</div>
</div>
</div>
</div>
</center>
</body>
</html>';   // Contenido del mensaje (acepta HTML)
// $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)

$mail->send();
echo "<script>Swal.fire({title: '¡Correo enviado!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
window.location = 'rohan';});</script>";
$mail->SmtpClose();
} catch (Exception $e) {
echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
}
}
?>

<div style="border-radius:4px" class="p-4 bg-white">
<div class="row gutter-1 p-1">

<!--
<h6 style="font-weight:600;margin-bottom:15px;">SAMP</h6>-->

<div class="col-md-12">

<form style="float:right;margin-top:5px" method="POST" action="">
<input type="email" name="email" placeholder="Email">
<input type="submit" name="enviar" value="Enviar">
</form>

</div>
</div>

</div>
</div>

<?php include "paginas/_footer.php";?>

</body>
</html>
