<?php
include 'funciones/config.php';

$secret = $_SESSION['secret'];
$auth 	= $_SESSION['email'];

require_once 'funciones/anexos/googleLib/GoogleAuthenticator.php';
$ga 		= new GoogleAuthenticator();
$qrCodeUrl 	= $ga->getQRCodeGoogleUrl($auth, $secret,'Age Of Rol');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>2FA activada | <?=$onombrec?></title>
<?php include "paginas/_head.php"; ?>
<style>
body {
background: url('estilos/img/mantenimiento.jpg') !important;
}
</style>
</head>
<!-- FIN -->

<?php include 'paginas/_header.php';?>

<!-- Login -->
<div class="login">
<div style="max-width:1073px;" class="container">
<div class="row justify-content-center align-items-center d-flex">	
<div style="margin-top:50px;margin-bottom:20px;max-width:379.32px" class="col-lg-4 mx-auto">
<div style="border-radius:5px;" class="osahan-login p-4 bg-white">	

<form name="reg" action="" method="POST">

<?php
$checkResult = "";
if($_POST['code']){
$code = $con->real_escape_string($_POST['code']);	
$secret = $_SESSION['secret'];


$ga = new GoogleAuthenticator();
$checkResult = $ga->verifyCode($secret, $code, 2);    // 2 = 2*30sec clock tolerance

//print "checkResult".$checkResult."<br/>";
//print "secret= ". $secret."<br>";
//print "code= ". $code."<br>";


if($checkResult){
$_SESSION['googlecode']	= $code;
echo '<script>window.location="index"</script>'; 
exit;

} 
else{
echo "<script>Swal.fire({title: 'Error',icon: 'error',timer: 2500,showConfirmButton: false}).then(function() {
    window.location = 'login-2fa';});</script>";
exit;
}

}

?>

<div class="form-group">
<label class="mb-1">Código Google 2FA</label>	
<div class="position-relative icon-form-control">
<input type="text" name="code" id="code" class="for-control" autocomplete="off" value="" required>
</div>
</div>

<button class="btn btn-info btn-block" style="border-radius:2px;font-weight:600" type="submit"> Validar </button>
</form>

</div>
</div>
</div>
<!-- FIN -->

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</div>
</div>

</body>
</html>