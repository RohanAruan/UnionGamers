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
<title>Personajes | AOR</title>
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
<h4 style="font-weight:600" class="m-0">Enlazar personaje</h4>
</div>
<!-- FIN -->	

<?php
if(isset($_POST['actualizar']))
{

$usuariox = secureData(mysqli_real_escape_string($con, $_POST['usuariox']));

$recaptcha = $_POST["g-recaptcha-response"];

$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
'secret' => '6LeqTQgUAAAAAPXMgO4Xx1mSzsH0k2nBHkZ005zi',
'response' => $recaptcha
);

$options = array(
'http' => array (
'method' => 'POST',
'content' => http_build_query($data)
)
);

if($usuariox) {

if(validarCadena($usuariox) == true) {     

$queryx = mysqli_query($con, "SELECT * FROM usuarios WHERE pjenlazado = '$usuariox'");
if(mysqli_num_rows($queryx) == $usuariox) {	

$query = mysqli_query($con, "SELECT * FROM characters WHERE Personaje = '$usuariox'");
if(mysqli_num_rows($query) == 1) {

$sql = mysqli_query($con, "UPDATE characters SET CodigoPJ = '$codigos' WHERE Personaje = '$usuariox'");

$sql = mysqli_query($con, "UPDATE usuarios SET enlazado='2', pjenlazado='$usuariox' WHERE ID = '".$_SESSION['usuario']."'");

while($row = mysqli_fetch_assoc($query))
{ 

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
$mail->Password = '^5TS6o0oXs^D';                         // Password SMTP
$mail->SMTPSecure = 'ssl';       
$mail->Timeout       =   60; // set the timeout (seconds)
$mail->SMTPKeepAlive = true; // don't close the connection between messages                     // Activar seguridad TLS
$mail->Port = 465;                                    // Puerto SMTP

$mail->setFrom('no-responder@uniongamers.org');      // Mail del remitente
$mail->addAddress($email);     // Mail del destinatario

$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->FromName= 'Union Gamers';
$mail->Subject = 'Verificación de enlace de su personaje';  // Asunto del mensaje
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
<p style="font-family: Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;color:#000;text-align:left;font-size: 17px;color:#4f545c;">Se ha solicitado una autorización para enlazar su personaje de SAMP, este es el código de activación que deberá colocar en el panel.
</p>

<p style="justify-content: center;align-items: center;font-size:21px;padding:5px;border:1px solid rgba(0,0,0,.125)">'.$codigos.'</p>

<p style="font-family: Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;color:#000;text-align:left;font-size: 17px;color:#4f545c;font-weight: 500;"><b>Importante:</b> Si usted no ha solicitado ningún enlace de personaje a su cuenta del panel, por favor póngase en contacto con la administración <a href="mailto:soporte@uniongamers.org">soporte@uniongamers.org</a></p>

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
echo "<script>Swal.fire({title: '¡Código enviado al correo!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
window.location = 'enlazar';});</script>";
$mail->SmtpClose();
} catch (Exception $e) {
echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
}
}

} else { echo "<script>Swal.fire({title: '¡No existe ningún usuario con ese nombre!',icon: 'error',timer: 2500,showConfirmButton: false});</script>";}
} else { echo "<script>Swal.fire({title: '¡Este personaje ya está enlazado con otro usuario!',icon: 'error',timer: 2500,showConfirmButton: false});</script>";}
} else { echo "<script>Swal.fire({title: 'Caracteres inválidos',icon: 'error',timer: 2500,showConfirmButton: false})</script>";}
} else { echo "<script>Swal.fire({title: '¡Rellena todos los campos!',icon: 'error',timer: 2500,showConfirmButton: false});</script>";}

}
?>

<?php if($enlazado == 0) { ?>

<div class="alert alert-info" style="border-radius:1px;" role="alert"><b>¡Importante!</b> <br>Luego de hacer el proceso, revise el correo electrónico del personaje para completar el enlace.</div>

<form role="form" method="post" action="" enctype="multipart/form-data">
<div style="border-radius:4px" class="p-4 bg-white">
<div class="row gutter-1">

<div class="col-md-12">
<div class="form-group">
<label>Personaje</label>
<input type="text" style="border-radius:3px;border-color: #e1e1e1;width:60%" name="usuariox" class="for-control">
</div>
</div>

</div>

<button style="border-radius:3px;" type="submit" name="actualizar" class="btn btn-info">Enlazar</button>
<a href="enlazar" class="btn btn-light">Cancelar</a> 

</div>

</form>
<?php } ?>

<?php if($enlazado == 1) { ?>

<div style="border-radius:4px" class="p-4 bg-white">
<div class="row gutter-1 p-1">

<!--
<h6 style="font-weight:600;margin-bottom:15px;">SAMP</h6>-->

<div class="col-md-12">
<div style="background:#4825f5;padding:8px 15px;border-radius:6px;">
<img class="rounded-circle mr-2" style="object-fit:cover;width:32px;height:32px;" src="<?=$todo?>/estilos/img/skins/<?=$Sropa?>.jpg" alt="" data-toggle="tooltip" data-placement="bottom" title="<?=$Susuario?>">
<span style="color:white;font-weight:600;"><?php $quitargion=str_replace("_"," ",$Susuario); echo(''.$quitargion.'') ?></span>

<?php
if(isset($_POST['desenlazar'])) {
$borrar = mysqli_query($con, "UPDATE usuarios SET enlazado='0', pjenlazado='0' WHERE ID = '".$_SESSION['usuario']."'");
if($borrar) {echo '<script>window.location="enlazar"</script>';}
}
?>

<form style="float:right;margin-top:5px" method="POST" action="">
<button type="submit" style="background:transparent;border:0px" name="desenlazar" data-toggle="tooltip" data-placement="bottom" title="Desenlazar personaje">
<i style="font-size:19px;color:#fff" class="fa fa-user-times"></i> 
</button>
</form>

<span style="float:right;margin-top:5px" class="mr-2" data-toggle="tooltip" data-placement="bottom" title="¡Enlazado!"><i style="font-size:22px;color:#fff;" class="fa fa-check-circle"></i>
</span>

<span style="float:right;margin-top:4px" class="mr-3" data-toggle="tooltip" data-placement="bottom" title="SAMP">
<img style="object-fit:cover;width:22px;height:22px;border-radius:50%;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIclHyzkxY9JTTGH7uP-vTGI2-wcIBlTh5dA&usqp=CAU">
</span>

</div>
</div>

</div>
</div>
<?php } ?>

<?php if($enlazado == 2) { ?>

<?php
if(isset($_POST['terminar']))
{

$codigo = mysqli_real_escape_string($con, $_POST['codigo']);

if($codigo) {
$query = mysqli_query($con, "SELECT * FROM characters WHERE CodigoPJ = '$codigo'");
if(mysqli_num_rows($query) == 1)
{	

$sql = mysqli_query($con, "UPDATE usuarios SET enlazado = '1', pjenlazado = '$pjenlazado' WHERE ID = '{$_SESSION['usuario']}'");

if($sql) {echo "<script>Swal.fire({title: '¡Enlazado correctamente!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
window.location = 'enlazar';});</script>";}

}
else
{
echo '<div class="alert alert-danger" style="border-radius:6px;" role="alert">¡Código incorrecto!</div>';
}
}
}
?>

<div class="alert alert-info" style="border-radius:1px;" role="alert"><b>¡Importante!</b> <br>Luego de hacer el proceso, revise el correo electrónico del personaje para completar el enlace.</div>

<center>
<form role="form" method="post" action="" enctype="multipart/form-data">
<div style="border-radius:6px" class="p-4 bg-white">
<div class="row gutter-1">

<?php 
$sqlA = mysqli_query($con, "SELECT * FROM characters WHERE Personaje = '$pjenlazado'");
$formu = mysqli_fetch_array($sqlA);   	
?>  

<img class="rounded-circle" style="object-fit:cover;width:100px;height:100px;margin-left:42.40%;border:4px solid #185ADB" src="<?=$todo?>/estilos/img/skins/<?=$formu['Skin']?>.jpg" alt="" data-toggle="tooltip" data-placement="bottom" title="<?=$formu['Personaje']?> (Nivel <?=$formu['Level']?>)">

<div class="col-md-12">
<div style="margin-top:20px;margin-left:-25px" class="form-group">
<label>Código</label>
<input type="text" style="border-radius:3px;border-color: #e1e1e1;width:200px;" name="codigo" class="for-control">
</div>
</div>

</div>
</div>

<?php
if(isset($_POST['cancelar'])) {
$add = mysqli_query($con, "UPDATE usuarios SET enlazado = '0', pjenlazado = '' WHERE ID = '$iduser'");
if($add) {echo '<script>window.history.back();</script>';}
}
?>

<div class="text-right mt-4">
<button name="cancelar" class="btn btn-link">Cancelar</button> <button style="border-radius:3px;" type="submit" name="terminar" class="btn btn-info">Completar</button>
</div>
</form>
</center>

<?php } ?>

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
