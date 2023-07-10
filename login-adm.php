<?php

include 'funciones/anexos/recaptcha.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Acceder</title>
<script src="https://www.google.com/recaptcha/api.js?hl=es" async defer></script>
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
	
<?php
if(isset($_POST['login']))
{
require_once 'funciones/anexos/googleLib/GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$secret = $ga->createSecret();	

$usuario = secureData($con->real_escape_string($_POST['usuario']));
$usuario = strip_tags($_POST['usuario']);
$usuario = trim($_POST['usuario']);

$csrf	 = secureData($con->real_escape_string($_POST["csrf"]));

$contrasena = secureData($con->real_escape_string(md5($_POST['contrasena'])));
$contrasena = strip_tags(md5($_POST['contrasena']));
$contrasena = trim(md5($_POST['contrasena']));

$recaptcha = $_POST["g-recaptcha-response"];

$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
'secret' => '6LdbvxYUAAAAAFUhu2qCiuPcNb8LiM0uUzUI5AQo',
'response' => $recaptcha
);

$options = array(
'http' => array (
'method' => 'POST',
'content' => http_build_query($data)
)
);

$query = mysqli_query($con, "SELECT * FROM usuarios WHERE Username = '$usuario' OR pjenlazado = '$usuario' AND Password = '$contrasena'");
$contar = mysqli_num_rows($query);

if($contar == 1) {

while($row = mysqli_fetch_array($query)) 
{	

if(validarCadena($usuario) == true && validarCadena($contrasena) == true) {

if($usuario = $row['Username'] && $contrasena = $row['Password'] && $recaptcha) {

if($csrf == $_SESSION["token"]) {

$_SESSION['email'] = $row['Email'];
$_SESSION['secret'] = $row['googlecode'];
$usuariosx = $row['ID'];
$_SESSION['usuario'] = $row['ID'];
$_SESSION['id'] = $row['ID'];	

if($row['yalog'] == 0) {
$add = mysqli_query($con, "UPDATE usuarios SET googlecode = '$secret', yalog = '1' WHERE ID = '$usuariosx'");
}

$sql = mysqli_query($con, "INSERT INTO pcu_sesiones (ip, pais, nombrepais, usuario, fecha) values ('$ip', '$paiss', '$nombrepais', '$usuariosx', '$fecha')");	

if($row['2fa'] == 1 && $row['Admin'] == 7) {
echo '<script>window.location="login-2fa"</script>'; 
} else {echo '<script>window.location="index"</script>'; } 

} else { echo '<div class="alert alert-danger" style="border-radius:1px;" role="alert">Falla!</div>'; } 

} else { echo '<div class="alert alert-danger" style="border-radius:1px;" role="alert">Completa la verificación!</div>'; } 

} else { echo '<div class="alert alert-danger" style="border-radius:1px;" role="alert">¡Carácteres invalidos!</div>'; } 

} 

} else { echo '<div class="alert alert-danger" style="border-radius:1px;" role="alert">Los datos ingresados no son correctos!</div>'; }

}
?>

<!--
<div id="contenedor_carga" class="text-center">
<div class="spinner-border" style="margin-top:30px;" role="status">
<span id="carga" class="sr-only">Loading...</span>
</div>
</div>
-->

<form action="" method="POST">

<div class="form-group">
<label class="mb-1">Usuario</label>
<div class="position-relative icon-form-control">
<input type="text" name="usuario" style="border-radius:1px;border-color: #e1e1e1;" class="form-control" value="<?=$_POST['usuario']; ?>">
<input type="hidden" name="csrf" value="<?php echo $_SESSION["token"];?>" >
<input type="hidden" name="passcode" value="<?php echo $passcode; ?>" >
</div>
</div>

<div class="form-group">
<div class="ocultotexto">		
<label class="mb-1">Contraseña</label>
<div class="position-relative icon-form-control">
<input type="password" name="contrasena" id="password" style="border-radius:1px;border-color: #e1e1e1;" class="form-control">
<span>Mostrar</span>
</div>
</div>
</div>

<div class="form-group">
<div class="position-relative icon-form-control">
<div class="g-recaptcha" data-sitekey="6LdbvxYUAAAAAFUhu2qCiuPcNb8LiM0uUzUI5AQo"></div>
</div>
</div>

<button class="btn btn-info btn-block " style="border-radius:1px;font-weight:600" name="login" type="submit"> Acceder </button>

<hr style="border: 1px solid #f2f2f2;">

<div class="text-center mt-3 pb-3">
<p style="font-size:14px" class="text-muted">¿No tienes cuenta?</p>
<a href="registro" class="btn btn-outline-info btn-block" style="border-radius:1px;font-weight:600"> Regístrate </a>
</div>

<div class="py-3 d-flex align-item-center">
<a style="font-size:13px" href="#">Olvidé la contraseña</a>
</div>
</form>

</div>
</div>
</div>
<!-- FIN -->


<script>
document.querySelector('.ocultotexto span').addEventListener('click', e => {
const passwordInput = document.querySelector('#password');
if (e.target.classList.contains('show')) {
e.target.classList.remove('show');
e.target.textContent = 'Ocultar';
passwordInput.type = 'text';
} else {
e.target.classList.add('show');
e.target.textContent = 'Mostrar';
passwordInput.type = 'password';
}
});
</script>

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</div>
</div>

</body>
</html>