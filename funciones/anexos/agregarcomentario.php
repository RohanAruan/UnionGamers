<?php
error_reporting(E_ALL);
include 'funciones/config.php';

$registro = date('Y-m-d H:i:s');

if($_POST['enviar'])

{
if($_POST['idestado'])
{	
if($_POST['autor'])
{	
if($_POST['comentario'])
{
if($_POST['fecha'])
{
if($_POST['hora'])
{
$idestado = mysqli_real_escape_string($con, $_POST['idestado']);
$autor   = mysqli_real_escape_string($con, $_POST['autor']);
$comentario   = mysqli_real_escape_string($con, $_POST['comentario']);
$fecha    = mysqli_real_escape_string($con, $_POST['fecha']);
$hora    = mysqli_real_escape_string($con, $_POST['hora']);

$sql = mysqli_query($con, "INSERT INTO comentarios (idestado, usuario, usuarior, comentario, fecha, hora) VALUES ('$idestado','$autor','$idperfil','$comentario','$fecha','$hora')");
echo '<script type="text/javascript">function redireccionar(){window.location.assign("");} 
setTimeout ("redireccionar()", 1); //tiempo expresado en milisegundos
</script>';
}
}
else
{
echo '<div class="alert alert-danger" role="alert">Escribe algo!</div>';
}
}
else
{
echo '<div class="alert alert-danger" role="alert">¡Coloca una descripción!</div>';
}
}
else
{
echo '<label for="upload" style="border-radius:3px" class="file-upload__label bg-red">Te faltó la altura.</label>';
}
}
else
{
echo '<label for="upload" style="border-radius:3px" class="file-upload__label bg-red">No colocaste el peso del personaje.</label>';
}
}
?>