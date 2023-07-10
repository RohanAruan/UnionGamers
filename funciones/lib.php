<?php
include 'config.php';
error_reporting(0);	

include 'anexos/fecha.php';
?>



<!-- DATOS DEL USUARIO --> 
<?php
$auth = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '{$_SESSION['usuario']}'");
while($authdatos = mysqli_fetch_assoc($auth))
{
$twfa = $authdatos['2fa'];
}

if($twfa == 1) {

$googlecode = $_SESSION['secret'];
if(!isset($_SESSION['googlecode'])):
header("location:login-2fa");
exit();
endif;

$users = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '{$_SESSION['usuario']}' AND googlecode = '".$googlecode."'");
while($datos = mysqli_fetch_assoc($users))
{
$iduser = $datos['ID'];	
$nombre = $datos['nombre'];	
$usuario = $datos['Username'];
$clave = $datos['Password'];
$sexo = $datos['sexo'];
$email = $datos['Email'];
$vmail = $datos['vmail'];
$avatar = $datos['avatar'];
$banner = $datos['banner'];
$idioma = $datos['idioma'];
$nacimiento = $datos['nacimiento'];
$rango = $datos['Admin'];
$grupousuario = $datos['GrupoUsuario'];
$grupofaccion = $datos['GrupoFaccion'];
$grupoempresa = $datos['GrupoEmpresa'];
$pais = $datos['pais'];
$notificaciones = $datos['notificaciones'];
$verificado = $datos['verificado'];
$baneado = $datos['baneado'];
$tema = $datos['tema'];
$muro = $datos['privada'];
$vip = $datos['vip'];
$enlazado = $datos['enlazado'];
$pjenlazado = $datos['pjenlazado'];
$mostrar = $datos['mostrar'];
$monedas = $datos['monedas'];
$twfa = $datos['2fa'];
$yalog = $datos['yalog'];
}

} else { 

$users = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '{$_SESSION['usuario']}'");
while($datos = mysqli_fetch_assoc($users))
{
$iduser = $datos['ID'];	
$nombre = $datos['nombre'];	
$usuario = $datos['Username'];
$clave = $datos['Password'];
$sexo = $datos['sexo'];
$email = $datos['Email'];
$vmail = $datos['vmail'];
$avatar = $datos['avatar'];
$banner = $datos['banner'];
$idioma = $datos['idioma'];
$nacimiento = $datos['nacimiento'];
$rango = $datos['Admin'];
$miembro = $datos['Miembro'];
$grupousuario = $datos['GrupoUsuario'];
$grupofaccion = $datos['GrupoFaccion'];
$grupoempresa = $datos['GrupoEmpresa'];
$pais = $datos['pais'];
$notificaciones = $datos['notificaciones'];
$verificado = $datos['verificado'];
$baneado = $datos['baneado'];
$tema = $datos['tema'];
$muro = $datos['privada'];
$vip = $datos['vip'];
$enlazado = $datos['enlazado'];
$pjenlazado = $datos['pjenlazado'];
$mostrar = $datos['mostrar'];
$monedas = $datos['monedas'];
$twfa = $datos['2fa'];
}
}
?>


<?php
$Susers = mysqli_query($con, "SELECT * FROM characters WHERE Personaje = '$pjenlazado'");
while($Sdatos = mysqli_fetch_assoc($Susers))
{
$Siduser = $Sdatos['ID'];	
$Sropa = $Sdatos['Skin'];	
$Susuario = $Sdatos['Personaje'];
$Ssexo = $Sdatos['Gender'];
$Semail = $Sdatos['Email'];
$Snivel = $Sdatos['Level'];
$Sexp = $Sdatos['Exp'];
$Sedad = $Sdatos['Age'];
$Svida = $Sdatos['Health'];
$Schaleco = $Sdatos['ArmorStatus'];
$Sfechanaci = $Sdatos['Birthdate'];
$Sciudad = $Sdatos['Country'];
$Sbaneado = $Sdatos['Baneado'];
$Svip = $Sdatos['vip'];
$Sonline = $Sdatos['Online'];
$Sfecharegistro = $Sdatos['uRegDate'];
$Sultimaconexion = $Sdatos['UltimaConexion'];
$Sbaneado = $Sdatos['FueBan'];
$Smuerto = $Sdatos['uDeath'];
}

$sqlB = mysqli_query($con, "SELECT * FROM characters WHERE ID = '$Siduser'");
$staff = mysqli_fetch_array($sqlB); 
$Srango = $staff['Admin'];
?>
<!-- FIN --> 



<!-- DISPOSITIVO QUE USA --> 
<?php
$agent = $_SERVER['HTTP_USER_AGENT']; 
?>
<!-- FIN --> 



<!-- MANTENIMIENTO --> 
<?php
if($rango == 7) { } else {

$popciones = mysqli_query($con, "SELECT * FROM pcu_opciones WHERE id");
$pop = mysqli_fetch_array($popciones); 
$mantenimiento = $pop['mantenimiento'];

if($mantenimiento == 1) { 
header('Location: https://uniongamers.org/mantenimiento');
}
}
?>
<!-- FIN --> 



<!-- PCU OPCIONES --> 
<?php
$db = mysqli_query($con, "SELECT * FROM pcu_opciones WHERE ID = '1'");
$opciones = mysqli_fetch_array($db);
$onombre = $opciones['nombre'];
$omoneda = $opciones['moneda'];
$oip = $opciones['ip'];
$onombrec = $opciones['nombre-corto'];
$oversion = $opciones['version'];
?>

<?php
date_default_timezone_set('Canada/Atlantic'); 
$fecha = date('Y-m-d');
$hora = date('H:i:s');
setlocale(LC_TIME, "spanish");
?>
<!-- FIN --> 



<!-- USUARIOS EN LINEA --> 
<?php
$z_user_id = mysqli_query($con, "SELECT eid FROM pcu_onlines WHERE eid = '$iduser'");
$o_user_id = mysqli_fetch_array($z_user_id);
$user_id = $o_user_id['eid'];
$this_date = date('U');

if ($user_id) {
mysqli_query($con, "UPDATE pcu_onlines SET tiempo='$this_date' WHERE eid = '$iduser'");
} else {
mysqli_query($con, "INSERT pcu_onlines SET eid='$iduser', tiempo='$this_date'"); 
}
?>

<?php
$usuarioen = mysqli_query($con, "SELECT tiempo FROM pcu_onlines WHERE eid = '$iduser'");
$enlinea = mysqli_fetch_array($usuarioen);
$user_online = $enlinea['tiempo'];
$this_date = date('U');
if ($user_online>($this_date-60)) {
$user_online = '0';
} else {
$user_online = '1';
}
?>

<?php
// ACTUALIZAR POR INACTIVIDAD
$usuarioen = mysqli_query($con, "SELECT * FROM aor_onlines WHERE eid");
$enlinea = mysqli_fetch_array($usuarioen);
$idt = $enlinea['tiempo'];
if($idt>($this_date-600)) {
$idt = '0';
} else {
$idt = mysqli_query($con, "UPDATE aor_onlines SET tiempo = '$this_date', idforo='0', idtema='0' WHERE eid");
}
// FINAL 
?>
<!-- FIN --> 



<!-- RAND --> 
<?php
$versiones = rand(1,3005);
$codigos = rand(1,300500);
?>
<!-- FIN --> 



<!-- USUARIO BANEADO --> 
<?php 
$baneo = mysqli_query($con, "SELECT baneado FROM usuarios WHERE ID = '$Siduser'");
$ban = mysqli_fetch_array($baneo);
?>
<!-- FIN --> 



<!--
<?php 
function isAdmin(){
$con = mysqli_connect('127.0.0.1','root','','agerp');
$query = mysqli_query($con, "SELECT level_admin_age FROM cuentas WHERE ID = '{$_SESSION['usuario']}'");
if(mysqli_affected_rows($con)){
if($row = mysqli_fetch_array($query)){
return $row['level_admin_age'];
}
}
} 
?>
-->



<!-- LIMITAR CARACTERES --> 
<?php
function limitar_cadena($cadena, $limite, $sufijo){
if(strlen($cadena) > $limite){
return substr($cadena, 0, $limite) . $sufijo;
}
return $cadena;
}
?> 
<!-- FIN --> 



<!-- DIRECCIÓN IP --> 
<?php
include("anexos/geoiploc.php"); 
if(empty($_POST['checkip'])) {
$ip = $_SERVER["REMOTE_ADDR"]; 
} else {
$ip = $_POST['checkip']; 
}
?> 
<!-- FIN --> 



<!-- BANDERA Y PAÍS --> 
<?php 
if(isset($_SESSION["usuario"])) {

$paiss = getCountryFromIP($ip, "code"); 
$nombrepais = getCountryFromIP($ip, "name");

mysqli_query($con, "UPDATE usuarios SET pais='$paiss', IP='$ip' WHERE ID = '$iduser'");
}
?>
<!-- FIN --> 



<!-- VALIDAR CADENA --> 
<?php
function validarCadena($cadena)
{ 
if(strlen($cadena) < 2 || strlen($cadena) > 34)
{ 
return false; 
} 
$permitidos = "abcdefghijklmnopqrstuvwxyzñABCDEFGHIJKLMNOPQRSTUVWXYZÑ0123456789áóéúí_-@.öÖüäëïÄËÏÜ 123467890"; 
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
<!-- FIN --> 



<!-- ACCESO A CDN --> 
<?PHP
header('Access-Control-Allow-Origin: https://ufusql2chp4jv.ageofrol.com');
?>

<?php $todoh = 'https://uniongamers.org'; ?>
<!-- FIN --> 



<?php
function validarCadenaUsuario($cadena)
{ 
if(strlen($cadena) < 2 || strlen($cadena) > 34)
{ 
return false; 
} 
$permitidos = "abcdefghijklmnopqrstuvwxyzñABCDEFGHIJKLMNOPQRSTUVWXYZÑ0123456789_-@.123467890"; 
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
function validarCadenaContra($cadena)
{ 
if(strlen($cadena) < 2 || strlen($cadena) > 34)
{ 
return false; 
} 
$permitidos = "abcdefghijklmnopqrstuvwxyzñABCDEFGHIJKLMNOPQRSTUVWXYZÑ0123456789+!"; 
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
$pagx =basename($_SERVER['SCRIPT_NAME']);
?>



<!-- SEGURIDAD VULNERABILIDADES --> 
<?php
function secureData($var) {
$var = strip_tags($var);
$var = str_ireplace("SELECT *", "", $var);
$var = str_ireplace("INSERT INTO", "", $var);
$var = str_ireplace("DROP TABLE", "", $var);
$var = str_ireplace("TRUNCATE *", "", $var);
$var = str_ireplace("<iframe>", "", $var);
$var = str_ireplace("<script>", "", $var);
$var = str_ireplace("WHERE", "", $var);
$var = str_ireplace("ORDER BY", "", $var);
$var = str_ireplace("COPY","",$var);
$var = str_ireplace("DELETE","",$var);
$var = str_ireplace("DROP","",$var);
$var = str_ireplace("DUMP","",$var);
$var = str_ireplace(" OR ","",$var);
$var = str_ireplace("%","",$var);
$var = str_ireplace("LIKE","",$var);
$var = str_ireplace("--","",$var);
$var = str_ireplace("^","",$var);
$var = str_ireplace("[","",$var);
$var = str_ireplace("]","",$var);
$var = str_ireplace("\\","",$var);
$var = str_ireplace("=","",$var);
$var = str_ireplace("quot;", ' " ', $var);
return $var;
}
?>
<!-- FIN --> 

