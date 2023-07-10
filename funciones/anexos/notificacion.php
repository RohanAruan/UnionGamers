<?php
if(isset($_POST["view"]))
{

session_start();
include '../config.php';
include 'fecha.php';

function is_base64($s) {
return (bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s);
}

$users = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '{$_SESSION['usuario']}'");
while($datos = mysqli_fetch_assoc($users))
{
$iduser = $datos['ID'];	
$nombre = $datos['nombre'];	
$usuario = $datos['Username'];
$clave = $datos['Password'];
$sexo = $datos['sexo'];
$email = $datos['Email'];
$vemail = $datos['vemail'];
$avatar = $datos['avatar'];
$banner = $datos['banner'];
$idioma = $datos['idioma'];
$nacimiento = $datos['nacimiento'];
$rango = $datos['admin'];
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

if($_POST["view"] != '')
{
$update_query = mysqli_query($con, "UPDATE pcu_notificaciones SET leido = 1 WHERE leido = '0' AND user2 = '".$usuario."'");
}

$sqlA = mysqli_query($con, "SELECT * FROM pcu_notificaciones WHERE user2 = '".$usuario."'");
$sqlA = mysqli_fetch_array($sqlA);
$output = '';
if($sqlA) {  	

$noti = mysqli_query($con, "SELECT * FROM pcu_notificaciones WHERE user2 = '".$usuario."' ORDER BY id_not DESC LIMIT 10");
while($not = mysqli_fetch_array($noti)) {
$fechap = $not["fecha"];
$horap = $not["hora"];
$date = "$fechap,$horap";
$fecha2 = preg_replace('/:[0-9][0-9][0-9]/','/:[0-9][0-9][0-9]/',$date);
$time = strtotime($fecha2);
$time2 = datediff($time,time());	

$query = "SELECT * FROM usuarios WHERE Username = '".$not['user1']."'";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
$valor = is_base64($not["tipo"]) ? base64_decode($not["tipo"]) : $not['tipo'];	
$output .= ' 
<div class="col-lg-12 mb-2">
<span style="width:40px;" class="n-icon"><img class="img-profile" style="width:40px;height:40px;object-fit:cover;border-radius:4px;" src="'.$todo.'/estilos/img/avatars/'.$row["avatar"].'?nocache=<?=$versiones?>"></span>

<span class="n-text"><a href="perfil?idu='.$row["ID"].'&sec=muro" style="font-weight:400;" class="ml-2">'.$row["Username"].'</a> 
'.$valor.'.
</span>

</div>
';
}
}  
} 
} elseif($notificaciones != 1) {
$output .= '<h5 style="color:#93a3b2;text-align:center;margin-left: 66%;width:100%;font-size: 90%;">No tienes notificaciones</h5>';
}

$query_1 = "SELECT * FROM pcu_notificaciones WHERE user2 = '".$usuario."' AND leido = '0'";
$result_1 = mysqli_query($con, $query_1);
$count = mysqli_num_rows($result_1);
$data = array(
'notification'   => $output,
'unseen_notification' => $count
);
echo json_encode($data);
}
?>