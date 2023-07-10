<?php
include 'funciones/lib.php';
include 'funciones/anexos/recaptcha.php';
?>

<?php
function validarCadenaRegistro($cadena)
{ 
if(strlen($cadena) < 2 || strlen($cadena) > 34)
{ 
return false; 
} 
$permitidos = " abcdefghijklmnopqrstuvwxyzñABCDEFGHIJKLMNOPQRSTUVWXYZÑ0123456789áóéúí_-@.!¡"; 
for ($i=0; $i<strlen($cadena); $i++)
{
if (strpos($permitidos, substr($cadena,$i,1))===false)
{
return false; 
}
}
return true; 
}
?>

<?php
function validarCadenaPJ($cadena)
{ 
if(strlen($cadena) < 2 || strlen($cadena) > 34)
{ 
return false; 
} 
$permitidos = "abcdefghijklmnopqrstuvwxyzñABCDEFGHIJKLMNOPQRSTUVWXYZÑáóéúí"; 
for ($i=0; $i<strlen($cadena); $i++)
{
if (strpos($permitidos, substr($cadena,$i,1))===false)
{
return false; 
}
}
return true; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Crear una cuenta</title>
<script src="https://www.google.com/recaptcha/api.js?hl=es" async defer></script>
<?php include "paginas/_head.php"; ?>
<script src="estilos/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="estilos/js/jquery.easing.min.js" type="text/javascript"></script>
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
<div style="max-width:1073px" class="container">

<?php
$fechax = date('Y/m/d, H:i');

if(isset($_POST['registrar'])) {

$passcode	= $con->real_escape_string($_POST["passcode"]);	
$csrf		= $con->real_escape_string($_POST["csrf"]);

require_once 'funciones/anexos/googleLib/GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$secret = $ga->createSecret();	

$email = secureData($con->real_escape_string($_POST['email']));
$usuario = secureData($con->real_escape_string($_POST['usuario']));
$sexo = secureData($con->real_escape_string($_POST['sexo']));
$contrasena = secureData($con->real_escape_string(md5($_POST['contrasena'])));
$repcontrasena = secureData($con->real_escape_string(md5($_POST['repcontrasena'])));

$nombrepj = secureData($con->real_escape_string($_POST['nombrepj']));
$apellidopj = secureData($con->real_escape_string($_POST['apellidopj']));
$gender = secureData($con->real_escape_string($_POST['gender']));
$skin = secureData($con->real_escape_string($_POST['skin']));

$nombrecompleto = $nombrepj.'_'.$apellidopj;

$comprobarusuario = mysqli_num_rows(mysqli_query($con, "SELECT * FROM usuarios WHERE Username = '$usuario'"));

$comprobarnombrepj = mysqli_num_rows(mysqli_query($con, "SELECT * FROM characters WHERE Personaje = '$nombrecompleto'"));

$comprobaremail = mysqli_num_rows(mysqli_query($con, "SELECT * FROM usuarios WHERE Email = '$email'"));

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

if($csrf == $_SESSION["token"]) {

if($comprobarusuario >= 1) { ?>

<div class="alert alert-warning" style="border-radius:1px;" role="alert">El nombre de usuario está en uso, por favor seleccione otro</div>

<?php } else {

if($comprobarnombrepj >= 1) { ?>

<div class="alert alert-warning" style="border-radius:1px;" role="alert">El nombre del personaje ya está en uso</div>

<?php } else {		

if($comprobaremail >= 1) { ?>

<div class="alert alert-warning" style="border-radius:1px;" role="alert">El email ya está en uso por favor seleccione otro o verifique si tiene una cuenta</div>

<?php } else {

if($contrasena != $repcontrasena) { ?>

<div class="alert alert-danger" style="border-radius:1px;" role="alert">Las contraseñas no coinciden</div>

<?php } else {

if(validarCadenaUsuario($usuario) == true && validarCadenaRegistro($email) == true && validarCadenaPJ($nombrepj) == true && validarCadenaPJ($apellidopj) == true && validarCadenaRegistro($contrasena) == true && validarCadenaRegistro($repcontrasena) == true)
{	

if($recaptcha) {

$insertar = mysqli_query($con, "INSERT INTO usuarios (Email,RegisterDate,LoginDate,Username,avatar,banner,sexo,Password,tema,googlecode,IP,enlazado,pjenlazado) values ('$email','$fechax','$fechax','$usuario','defect.jpg','defect.Array','$sexo','$contrasena','claro','$secret','$ip','1','$nombrecompleto')");	

switch($_POST['gender']) 
{
case 1:
$insertar1 = mysqli_query($con, "INSERT INTO characters (Username,Personaje,Created,Gender,Skin) values ('$usuario','$nombrecompleto','0','$gender','299')");	
break;
case 2:
$insertar2 = mysqli_query($con, "INSERT INTO characters (Username,Personaje,Created,Gender,Skin) values ('$usuario','$nombrecompleto','0','$gender','56')");	
break;
}

echo "<script>Swal.fire({title: '¡Cuenta creada correctamente!',icon: 'success',timer: 4500,showConfirmButton: false}).then(function() {
window.location = 'login';});</script>";
// FIN REGISTRO

// INICIO DE SESIÓN AUTOMÁTICO
$query = mysqli_query($con, "SELECT * FROM usuarios WHERE Username = '$usuario' AND Password = '$contrasena'");
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

$sql = mysqli_query($con, "INSERT INTO pcu_sesiones (ip, pais, nombrepais, usuario, fecha) values ('$ip', '$paiss', '$nombrepais', '$usuariosx', '$fecha')");	

if($row['2fa'] == 1) {
echo '<script>window.location="login-2fa"</script>'; 
} else {echo '<script>window.location="index"</script>'; } 

}
}
}
}
}
// FIN 

// WARNINGS REGISTRO
} else { echo '<div class="alert alert-warning" style="border-radius:1px;" role="alert">Completa la verificación</div>'; }

} else { echo '<div class="alert alert-warning" style="border-radius:1px;" role="alert">¡Carácteres invalidos!</div>'; }

}

}

}

}

}

}
?>

<form class="msform" action="" method="POST">

<!-- progressbar -->
<ul style="margin-left:60px;color:white" class="progressbar">
<li class="active">Usuario</li>
<li>Personaje</li>
<li>Completado</li>
</ul>
<!-- fieldsets -->

<fieldset>
<h2 class="fs-title">Usuario del PCU</h2>
<h3 class="fs-subtitle">Paso 1:</h3>
<input type="text" name="usuario" style="border-radius:1px;border-color: #e1e1e1;" class="form-control" value="<?=$_POST['usuario']; ?>" placeholder="Usuario" required>

<input type="hidden" name="csrf" value="<?php print $_SESSION["token"]; ?>" >

<!--
<input type="text" name="nombre" style="border-radius:1px;border-color: #e1e1e1;" class="form-control" value="<?=$_POST['nombre']; ?>" pattern="[A-Za-z_-0-9]{1,20}" placeholder="Nombre completo" required>
-->

<input type="email" name="email" style="border-radius:1px;border-color: #e1e1e1;" class="form-control" value="<?=$_POST['email']; ?>" placeholder="Correo electrónico" required>

<input type="password" name="contrasena" style="border-radius:1px;border-color: #e1e1e1;" class="form-control" value="<?=$_POST['contraseña']; ?>" placeholder="Contraseña" required>

<input type="password" name="repcontrasena" style="border-radius:1px;border-color: #e1e1e1;" class="form-control" value="<?=$_POST['contraseña']; ?>" placeholder="Repita la contraseña" required>

<select class="custom-select mb-2" name="sexo" style="border-radius:2px;border-color: #e1e1e1;font-size: 13px;" required>
<option selected="">Selecciona..</option>
<option value="H">Hombre</option>
<option value="M">Mujer</option>
</select>

<input type="button" name="next" class="next action-button btn-block" style="margin:0" value="Siguiente">
</fieldset>
<!-- FIN USUARIO -->

<fieldset>
<h2 class="fs-title">Personaje</h2>
<h3 class="fs-subtitle">Paso 2:</h3>

<div class="row">

<input type="text" name="nombrepj" style="border-radius:1px;border-color: #e1e1e1;width:43.85%" class="form-control ml-3" value="<?=$_POST['nombrepj']; ?>" placeholder="Nombre" required> 

<input type="text" name="apellidopj" style="border-radius:1px;border-color: #e1e1e1;width:43.85%" class="form-control ml-2" value="<?=$_POST['apellidopj']; ?>" placeholder="Apellido" required>

</div>

<select class="custom-select mb-2" name="gender" style="border-radius:2px;border-color: #e1e1e1;font-size: 13px;" required>
<option selected="">Selecciona..</option>
<option value="1">Hombre</option>
<option value="2">Mujer</option>
</select>

<input type="button" name="previous" class="previous action-button" value="Anterior" />
<input type="button" name="next" style="float:right" class="next action-button" value="Siguiente" />
</fieldset>
<!-- FIN PERSONAJE -->

<fieldset>
<h2 class="fs-title">Finalizar registro</h2>
<h3 class="fs-subtitle">Paso 3:</h3>

<!--
<input name="referido" style="border-radius:1px;border-color: #e1e1e1;" class="form-control" placeholder="Referido #">
-->

<div class="form-group">
<div class="position-relative icon-form-control">
<div class="g-recaptcha" data-sitekey="6LdbvxYUAAAAAFUhu2qCiuPcNb8LiM0uUzUI5AQo"></div>
</div>
</div>

<div class="form-group">
<div class="custom-control custom-switch">	
<input type="checkbox" class="custom-control-input custom1" id="customSwitch1" name="check" required>
<label class="custom-control-label" for="customSwitch1"> Acepto los <a href="#">términos y condiciones</a></label>
</div>
</div>

<input type="button" name="previous" class="previous action-button" value="Anterior" />
<input type="submit" name="registrar" style="float:right" class="action-button" value="Crear cuenta" />
</fieldset>
</form>

<!--
<div class="row justify-content-center align-items-center d-flex">	
<div style="margin-top:10px;margin-bottom:20px;max-width:379.32px" class="col-lg-4 mx-auto">
<div style="border-radius:5px;" class="osahan-login p-4 bg-white">	

<form name="reg" action="" method="POST">

<div class="form-group">
<label class="mb-1">Usuario</label>
<div class="position-relative icon-form-control">
<input type="text" name="usuario" style="border-radius:1px;border-color: #e1e1e1;" class="form-control" value="<?=$_POST['usuario']; ?>" pattern="[A-Za-z_-0-9]{1,20}">
<input type="hidden" name="csrf" value="<?php print $_SESSION["token"]; ?>" >
</div>
</div>

<div class="form-group">
<label class="mb-1">Nombre completo</label>
<div class="position-relative icon-form-control">
<input type="text" name="nombre" style="border-radius:1px;border-color: #e1e1e1;" class="form-control" value="<?=$_POST['nombre']; ?>" pattern="[A-Za-z_-0-9]{1,20}">
</div>
</div>

<div class="form-group">
<label class="mb-1">Email</label>
<div class="position-relative icon-form-control">
<input type="email" name="email" style="border-radius:1px;border-color: #e1e1e1;" class="form-control" value="<?=$_POST['email']; ?>" pattern="[A-Za-z_-0-9]{1,20}">
</div>
</div>

<div class="form-group">
<label class="mb-1">Contraseña</label>
<div class="position-relative icon-form-control">
<input type="password" name="contrasena" style="border-radius:1px;border-color: #e1e1e1;" class="form-control" pattern="[A-Za-z_-0-9]{1,20}">
</div>
</div>

<div class="form-group">
<label class="mb-1">Repita la contraseña</label>
<div class="position-relative icon-form-control">
<input type="password" name="repcontrasena" style="border-radius:1px;border-color: #e1e1e1;" class="form-control" pattern="[A-Za-z_-0-9]{1,20}">
</div>
</div>

<div class="form-group">
<label>Sexo</label>
<select class="custom-select" name="sexo" style="border-radius:2px;border-color: #e1e1e1;">
<option selected="">Selecciona..</option>
<option value="H">Hombre</option>
<option value="M">Mujer</option>
</select>
</div>

<div class="form-group">
<label>Idioma</label>
<select class="custom-select" name="idioma" style="border-radius:2px;border-color: #e1e1e1;">
<option selected="">Selecciona..</option>
<option value="es">Español</option>
<option value="en">Inglés</option>
</select>
</div>


<div class="form-group">
<div class="position-relative icon-form-control">
<div class="g-recaptcha" data-sitekey="6LdbvxYUAAAAAFUhu2qCiuPcNb8LiM0uUzUI5AQo"></div>
</div>
</div>

<div class="form-group">
<div class="custom-control custom-switch">	
<input type="checkbox" class="custom-control-input custom1" id="customSwitch1" name="check" required>
<label class="custom-control-label" for="customSwitch1"> Acepto los <a href="#">términos y condiciones</a></label>
</div>
</div>

<button class="btn btn-info btn-block" style="border-radius:1px;font-weight:600" name="registrar" type="submit"> Crear </button>
</form>

</div>
</div>
</div>
<!-- FIN -->

</div>
</div>

<script src="estilos/js/registro.js"></script>

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</body>
</html>