<?php
$submit         = secureData(mysqli_real_escape_string($con, $_POST['cambiar']));
$contraactual   = secureData(mysqli_real_escape_string($con, $_POST['viejaa']));
$contranueva    = secureData(mysqli_real_escape_string($con, $_POST['nueva']));
$contranueva2   = secureData(mysqli_real_escape_string($con, $_POST['nueva2']));
$hashedPassword = md5($contranueva2); 
$actual         = md5($contraactual); 

if($submit)
{	 	
if($contraactual != $contranueva)
{		
if($contraactual || $contranueva || $contranueva2)
{
if($actual == $clave)
{
if($contranueva == $contranueva2)
{
if(validarCadenaContra($contraactual) == true && validarCadenaContra($contranueva) == true && validarCadenaContra($contranueva2) == true)
{	
$sql_update = mysqli_query($con, "UPDATE usuarios SET Password = '".$hashedPassword."' WHERE ID = '".$_SESSION['usuario']."'");

echo "<script>Swal.fire({title: 'Se cambió la contraseña, ingresa nuevamente!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
    window.location = '".$todo."/salir';});</script>";

} else {echo "<script>Swal.fire({title: '¡Caracteres inválidos!',icon: 'error',timer: 2500,showConfirmButton: false})</script>";}

} else {echo "<script>Swal.fire({title: '¡Las contraseñas no son iguales!',icon: 'error',timer: 2500,showConfirmButton: false})</script>"; }

} else {echo "<script>Swal.fire({title: '¡La contraseña actual es incorrecta!',icon: 'error',timer: 2500,showConfirmButton: false})</script>"; }

} else {echo "<script>Swal.fire({title: '¡Rellena todos los campos!',icon: 'error',timer: 2500,showConfirmButton: false})</script>";}

} else {echo "<script>Swal.fire({title: '¡La contraseña actual y la nueva, no pueden ser la misma!',icon: 'question',timer: 2500,showConfirmButton: false})</script>";}
}
?>