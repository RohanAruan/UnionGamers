<?php
include 'funciones/lib.php';

if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == $iduser) { } else { header("Location: ".$todo."/salir"); exit; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Seguridad</title>
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

<?php include "paginas/_lateralu.php"; ?>
<!-- FIN -->


<!-- TITULO -->
<div class="d-flex align-item-center title mb-3">
<h4 style="font-weight:600" class="m-0">Seguridad</h4>
</div>
<!-- FIN -->    


<!-- VERIFICACIÓN POR EMAIL -->
<form role="form" method="post" action="" enctype="multipart/form-data">

<?php
if($vmail == 0) { 
if(isset($_POST['verificar']))
{

$sql = mysqli_query($con, "UPDATE usuarios SET vmail = '2' WHERE ID = '".$_SESSION['usuario']."'");

set_time_limit(60);
require 'funciones/anexos/PHPMailer-master/src/Exception.php';
require 'funciones/anexos/PHPMailer-master/src/PHPMailer.php';
require 'funciones/anexos/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
$mail->SMTPDebug = 0;  // Sacar esta línea para no mostrar salida debug
$mail->isSMTP();
$mail->Host = 'mail.uniongamers.org';  // Host de conexión SMTP
$mail->SMTPAuth = true;
$mail->Username = 'no-responder@uniongamers.org';                 // Usuario SMTP
$mail->Password = '^5TS6o0oXs^D';                           // Password SMTP
$mail->SMTPSecure = 'ssl';       
$mail->Timeout       =   60; // set the timeout (seconds)
$mail->SMTPKeepAlive = true; // don't close the connection between messages                     // Activar seguridad TLS
$mail->Port = 465;                                    // Puerto SMTP

$mail->setFrom('no-responder@uniongamers.org');      // Mail del remitente
$mail->addAddress($email);     // Mail del destinatario

$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->FromName= 'Union Gamers';
$mail->Subject = 'Proceso de verificación de cuenta';  // Asunto del mensaje
$mail->Body    = '<!DOCTYPE html>
<html lang="es">
<head>
<title>Código para enlazar PJ | Union Gamers</title>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background-color: #e1e1e1; margin: 0 !important; padding: 0 !important;">
<div style="background: linear-gradient(20deg, #154a98 50%, #fff 50%);;">
<center>
<br>

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
border-bottom: 2px solid #0652DD;
border-radius: 4px !important;" class="card">

<center>
<div style="object-fit: cover;height:120px;">
<img style="width:140px;margin-left:3%;margin-top:-10px" src="https://uniongamers.org/estilos/img/logo1.png">
</div>
</center>

<div style="margin-bottom:20px;"></div>

<div style="padding: 0px 17px 28px !important;font-size: 15px;font-weight: 300 !important;flex: 1 1 auto;min-height: 1px;" class="card-body">
<p style="font-family: Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;font-weight: 500;font-size: 20px;text-align:center;color:#000"><b>Hola,</b> '.$usuario.'</p>
<p style="font-family: Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;color:#000;text-align:left;font-size: 17px;color:#4f545c;">Se ha solicitado una autorización para verificar su cuenta, continúe con el proceso presionando en el botón.
</p>

<a href="https://uniongamers.org/seguridad?v=3"" style="cursor:pointer;text-decoration:none !important;color:white !important;">
<p style="justify-content: center;align-items: center;font-size:21px;padding:5px;border:1px solid #233167;background:#233167">Verificar</p></a>

<p style="font-family: Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;color:#000;text-align:left;font-size: 17px;color:#4f545c;font-weight: 500;"><b>Importante:</b> Si usted no ha solicitado ninguna verificación a su cuenta del panel, por favor póngase en contacto con la administración <a href="mailto:soporte@uniongamers.org">soporte@uniongamers.org</a></p>

</p>

</div>

<div style="padding: .75rem 1.25rem;" class="card-footer text-muted">
<p style="color: #4f545c;font-weight:600;text-align:left;font-size:14px;">— Equipo de UG.</p>
</div>

</div>
</div>
</b>
<br>
</div>

</body>
</html>';   // Contenido del mensaje (acepta HTML)
// $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)

$mail->send();
echo "<script>Swal.fire({title: '¡Verificación enviada al correo!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
window.location = 'seguridad';});</script>";
$mail->SmtpClose();
} catch (Exception $e) {
echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
}
}
}
?>

<?php 
if($vmail == 2) { 
if(isset($_POST['reenviar']))
{

$sql = mysqli_query($con, "UPDATE usuarios SET vmail = '2' WHERE ID = '".$_SESSION['usuario']."'");

set_time_limit(60);
require 'funciones/anexos/PHPMailer-master/src/Exception.php';
require 'funciones/anexos/PHPMailer-master/src/PHPMailer.php';
require 'funciones/anexos/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
$mail->SMTPDebug = 0;  // Sacar esta línea para no mostrar salida debug
$mail->isSMTP();
$mail->Host = 'mail.uniongamers.org';  // Host de conexión SMTP
$mail->SMTPAuth = true;
$mail->Username = 'no-responder@uniongamers.org';                 // Usuario SMTP
$mail->Password = '^5TS6o0oXs^D';                            // Password SMTP
$mail->SMTPSecure = 'ssl';       
$mail->Timeout       =   60; // set the timeout (seconds)
$mail->SMTPKeepAlive = true; // don't close the connection between messages                     // Activar seguridad TLS
$mail->Port = 465;                                    // Puerto SMTP

$mail->setFrom('no-responder@uniongamers.org');      // Mail del remitente
$mail->addAddress($email);     // Mail del destinatario

$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->FromName= 'Union Gamers';
$mail->Subject = 'Proceso de verificación de cuenta';  // Asunto del mensaje
$mail->Body    = '<!DOCTYPE html>
<html lang="es">
<head>
<title>Código para enlazar PJ | Union Gamers</title>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background-color: #e1e1e1; margin: 0 !important; padding: 0 !important;">
<div style="background: linear-gradient(20deg, #154a98 50%, #fff 50%);;">
<center>
<br>

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
border-bottom: 2px solid #0652DD;
border-radius: 4px !important;" class="card">

<center>
<div style="object-fit: cover;height:120px;">
<img style="width:140px;margin-left:3%;margin-top:-10px" src="https://uniongamers.org/estilos/img/logo1.png">
</div>
</center>

<div style="margin-bottom:20px;"></div>

<div style="padding: 0px 17px 28px !important;font-size: 15px;font-weight: 300 !important;flex: 1 1 auto;min-height: 1px;" class="card-body">
<p style="font-family: Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;font-weight: 500;font-size: 20px;text-align:center;color:#000"><b>Hola,</b> '.$usuario.'</p>
<p style="font-family: Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;color:#000;text-align:left;font-size: 17px;color:#4f545c;">Se ha solicitado una autorización para verificar su cuenta, continúe con el proceso presionando en el botón.
</p>

<a href="https://uniongamers.org/seguridad?v=3"" style="cursor:pointer;text-decoration:none !important;color:white !important;">
<p style="justify-content: center;align-items: center;font-size:21px;padding:5px;border:1px solid #233167;background:#233167">Verificar</p></a>

<p style="font-family: Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;color:#000;text-align:left;font-size: 17px;color:#4f545c;font-weight: 500;"><b>Importante:</b> Si usted no ha solicitado ninguna verificación a su cuenta del panel, por favor póngase en contacto con la administración <a href="mailto:soporte@uniongamers.org">soporte@uniongamers.org</a></p>

</p>

</div>

<div style="padding: .75rem 1.25rem;" class="card-footer text-muted">
<p style="color: #4f545c;font-weight:600;text-align:left;font-size:14px;">— Equipo de UG.</p>
</div>

</div>
</div>
</b>
<br>
</div>

</body>
</html>';   // Contenido del mensaje (acepta HTML)
// $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)

$mail->send();
echo "<script>Swal.fire({title: '¡Verificación enviada al correo!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
window.location = 'seguridad';});</script>";
$mail->SmtpClose();
} catch (Exception $e) {
echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
}
}
}
?>

<?php 
$verificacion = $_GET['v'];

if($verificacion == 3) { 
$sql = mysqli_query($con, "UPDATE usuarios SET vmail = '1' WHERE ID = '$iduser'");
?>

<script>Swal.fire({title: '¡Verificación con éxito!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
window.location = 'seguridad';});</script>

<?php } ?>

<div style="border-radius:4px;margin-bottom:0px;padding: 25px 25px 0px;height:auto;" class="bg-white">    

<div class="row gutter-1">

<div class="col-md-12">
<div class="form-group">
<label>Estado de cuenta <?php if($vmail == 1) { ?><span class="badge badge-success ml-1">Verificada</span> <?php } elseif($vmail == 0 || $vmail == 2) { ?> <span class="badge badge-warning ml-1">No verificada</span> <?php } ?></label>
<p style="font-size:12px;margin-top:-5px" class="mb-2 text-muted">Si no verificas tu cuenta, no podrás disfrutar de todo el contenido.</p>

<?php if($vmail == 0) { ?>
<input type="submit" class="btn btn-outline-warning" name="verificar" style="width:60%;" value="Solicitar verificación">
<?php } ?>

<?php if($vmail == 2) { ?>
<button class="btn btn-warning" style="width:60%;">Revisa tu correo</button> <input type="submit" name="reenviar" class="btn btn-outline-warning" value="Reenviar">
<?php } ?>

</div>
</div>

</div>

</div>
<br>
</form>
<!-- FIN -->


<!-- CUERPO -->
<div style="border-radius:4px" class="p-4 bg-white">    

<div class="row gutter-1">

<div class="col-md-12">
<div class="form-group">
<label>Email</label>

<form role="form" method="post" action="" enctype="multipart/form-data">

<?php
if(isset($_POST['actualizar']))
{
$email = secureData(mysqli_real_escape_string($con, $_POST['email']));

$comprobar = mysqli_num_rows(mysqli_query($con, "SELECT * FROM usuarios WHERE Email = '$email' AND ID != '{$_SESSION['usuario']}'"));
if($comprobar == 0){

if(validarCadena($email) == true){      

$sql = mysqli_query($con, "UPDATE usuarios SET Email = '$email'  WHERE ID = '{$_SESSION['usuario']}'");

if($sql) {echo "<script>Swal.fire({title: 'El correo se cambió con éxito',icon: 'success',timer: 2500,showConfirmButton: false})</script>";}

} else {echo "<script>Swal.fire({title: 'Caracteres inválidos',icon: 'error',timer: 2500,showConfirmButton: false})</script>";}

} else {echo "<script>Swal.fire({title: 'El correo está en uso',icon: 'error',timer: 2500,showConfirmButton: false})</script>";}

}
?>

<div class="row">
<div class="col-lg-8">
<input type="email" style="border-radius:2px;border-color: #e1e1e1;" name="email" class="for-control" value="<?=$email;?>" <?php if($ban['baneado'] == 1) { echo 'readonly'; } ?>> 
</div>

<div class="col-lg-4">
<button style="border-radius:2px;padding: .385rem .95rem;" type="submit" name="actualizar" class="btn btn-info">Cambiar email</button>
</div>

</div>
</form>

</div>
<hr>
</div>
</div>

<form role="form" method="post" action="" enctype="multipart/form-data">

<?php include "funciones/anexos/contraseña.php"; ?> 

<div class="row gutter-1">

<div class="col-md-12">
<div class="form-group">
<label>Contraseña</label>
<input type="password" style="border-radius:2px;border-color: #e1e1e1;width:60%;" name="nueva" class="for-control">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Repetir</label>
<input type="password" style="border-radius:2px;border-color: #e1e1e1;width:60%;" name="nueva2" class="for-control">
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Contraseña actual</label>
<input type="password" style="border-radius:2px;border-color: #e1e1e1;width:60%;" name="viejaa" class="for-control">
</div>
</div>

<div class="text-left ml-3 mt-2">
<input type="submit" name="cambiar" style="border-radius:2px;" value="Cambiar contraseña" class="btn btn-info">
</div>
</div>
</form>

<hr>

<form name="reg" method="post" style="width:100%" action="" enctype="multipart/form-data">

<?php
if(isset($_POST['tfaform']))
{

$tfa = secureData($con->real_escape_string($_POST['tfa']));

if($tfa == 1) {

$sql = mysqli_query($con, "UPDATE usuarios SET 2fa = '1' WHERE ID = '{$_SESSION['usuario']}'");

session_start();
$_SESSION['usuario'] = $iduser;
$_SESSION['id'] = $iduser;  

if($sql) {echo "<script>Swal.fire({title: 'Doble autentificación activada',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
window.location = 'seguridad';});</script>";}

} else { 

$sql = mysqli_query($con, "UPDATE usuarios SET 2fa = '0' WHERE ID = '{$_SESSION['usuario']}'");

if($sql) {echo "<script>Swal.fire({title: 'Doble autentificación desactivada',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
window.location = 'seguridad';});</script>";}

}

}
?>

<?php if($twfa == 0) { ?>

<div style="width:100%;background:#f7f7f7;border-radius:4px;" class="col-md-12">
<div style="padding: 20px 5px;" class="form-group">
<label style="font-weight:600;">Google Authenticator <small style="font-weight:600;color:red" class="ml-2"><i class="fal fa-times mr-1"></i> No configurado</small></label><br>
<small class="text-muted">Deberá instalar la aplicación Google Authenticator en su teléfono inteligente. Cuando necesitemos que verifique su identidad, ingresará el código que aparece en la aplicación.</small><br>

<input type="hidden" name="tfa" value="1" />

<button type="button" style="border-radius:2px;padding: .525rem .85rem;" class="btn btn-info btn-sm mt-2" data-toggle="modal" data-target="#Auth">Habilitar</button>

</div>
</div>

<?php } else { ?>

<div style="width:100%;background:#f7f7f7;border-radius:4px;" class="col-md-12">
<div style="padding: 20px 5px;" class="form-group">
<label style="font-weight:600;">Google Authenticator <small style="font-weight:600;color:green" class="ml-2"><i class="fal fa-check mr-1"></i> Habilitado</small></label><br>
<small class="text-muted">Deberá instalar la aplicación Google Authenticator en su teléfono inteligente. Cuando necesitemos que verifique su identidad, ingresará el código que aparece en la aplicación.</small><br>

<input type="hidden" name="tfa" value="0" />

<input type="submit" name="tfaform" style="border-radius:2px;padding: .525rem .85rem;" class="btn btn-info btn-sm mt-2" value="Deshabilitar">

</div>
</div>

<?php } ?>

</form>

<!-- AUTH -->
<div class="modal fade" id="Auth" tabindex="-1" aria-labelledby="AuthLabel" aria-hidden="true">
<div style="border-radius:2px;" class="modal-dialog shadow-sm">
<div style="height:auto;border-bottom: 2px solid #0652DD;" class="modal-content">
<div style="border:0px;padding: 1rem 1rem;">
<i style="font-size:18px" class="fal fa-arrow-left mr-2" type="button" data-dismiss="modal" aria-label="Cerrar"></i> 
<span style="font-size:19px;font-weight:bold;">Configurar la verificación de su cuenta</span>
</div>

<div class="modal-body">

<?php
$secret = $_SESSION['secret'];
$user   = $_SESSION['email'];

require_once 'funciones/anexos/googleLib/GoogleAuthenticator.php';
$ga         = new GoogleAuthenticator();
$qrCodeUrl  = $ga->getQRCodeGoogleUrl($email, $secret,'Age Of Rol');
?>

<p style="text-align:center;margin-top:-10px">Para proteger la seguridad de su cuenta, configure Google Authenticator. Ingrese los detalles a continuación en su aplicación de Google Authenticator, luego ingrese su código de verificación.</p>

<form name="reg" action="" method="POST">

<?php
$checkResult="";
if($_POST['code']){
$code = $con->real_escape_string($_POST['code']);   
$secret = $_SESSION['secret'];

require_once 'funciones/anexos/googleLib/GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$checkResult = $ga->verifyCode($secret, $code, 2);    // 2 = 2*30sec clock tolerance

//print "checkResult".$checkResult."<br/>";
//print "secret= ". $secret."<br>";
//print "code= ". $code."<br>";


if($checkResult){
$_SESSION['googlecode'] = $code;
$sql = mysqli_query($con, "UPDATE usuarios SET 2fa = '1' WHERE ID = '{$_SESSION['usuario']}'");
echo "<script>Swal.fire({title: 'Doble autentificación activada',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
window.location = 'seguridad';});</script>"; 
exit;

} 
else{
echo "<script>Swal.fire({title: 'El código que ingresó no es válido. Asegúrese de ingresar el código correcto desde la aplicación de su teléfono inteligente. El código cambiará cada 30 segundos.',icon: 'error',timer: 2500,showConfirmButton: false}).then(function() {
window.location = 'seguridad';});</script>";
exit;
}

}

?>

<div class="form-group">
<div class="position-relative icon-form-control">
<img style="margin-left: 27%;" src='<?php echo $qrCodeUrl; ?>'/>
</div>
</div>

</div>

<div class="modal-footer">

<div style="width:100%" class="form-group"> 
<div class="position-relative icon-form-control">
<input type="text" name="code" id="code" class="for-control" autocomplete="off" value="" required>
</div>
</div>

<button class="btn btn-info btn-block" style="border-radius:2px;font-weight:600" type="submit"> Verificar código </button>


</div>

</div>
</div>
</div>
<!-- FIN -->

</div>
<!-- FIN -->

</div>
</div>
<!-- FIN -->

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</div>
</section>

</body>
</html>
