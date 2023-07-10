<?php
include 'funciones/lib.php';

if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == $iduser) { } else { header("Location: ".$todo."/salir"); exit; }

if(isset($_GET['leido'])) {
$leido = mysqli_real_escape_string($con, $_GET['leido']);
$usuariod = mysqli_real_escape_string($con, $_GET['usuario']);

$tchats = mysqli_query($con, "SELECT * FROM pcu_chats WHERE de = '$usuariod' OR para = '".$_SESSION['id']."'");
$tc = mysqli_fetch_array($tchats);
if($tc['de'] != $_SESSION['id']) {
$update = mysqli_query($con, "UPDATE pcu_chats SET leido = '1' WHERE de = '$usuariod' OR para = '".$_SESSION['id']."'");
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Mensajes</title>
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
<section style="margin-left:-13px" class="account-page">

<!-- CONVERSACIONES -->
<div class="row">

<div class="col-lg-3">
<div class="bg-white p-3 sidebar-widget mb-4" style="border-radius:3px;height:700px">
<a href="mensajes" style="color:#000">
<h5 style="margin-top:-1px;margin-bottom:10px;">Conversaciones</h5>		
</a>

<div style="overflow: auto; height: 340px;">

<?php
$chats = mysqli_query($con, "SELECT * FROM pcu_cchats WHERE de = '".$_SESSION['id']."' OR para = '".$_SESSION['id']."' order by id_cch desc");
while($ch = mysqli_fetch_array($chats)) { 

if($ch['de'] == $_SESSION['id']) {$var = $ch['para'];} elseif ($ch['para'] == $_SESSION['id']) {$var = $ch['de'];}
$usere = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$var'");
$us = mysqli_fetch_array($usere);

$chat = mysqli_query($con, "SELECT * FROM pcu_chats WHERE id_cch = '".$ch['id_cch']."' ORDER BY id_cha desc limit 1");
$cha = mysqli_fetch_array($chat);
$fechac = $cha["fecha"];
$horac = $cha["hora"];
$date = "$fechac,$horac";
$fecha2 = preg_replace('/:[0-9][0-9][0-9]/','/:[0-9][0-9][0-9]/',$date);
$time = strtotime($fecha2);
$time2 = dateDiff($time,time());

?>
<div class="nav nav-pills flex-column lavalamp">
<a class="nav-link active" style="margin-bottom:3px;" href="mensajes?usuario=<?=$var;?>&leido=1">
<img style="width:20px;height:20px;object-fit:cover;border-radius:50%" src="estilos/img/avatars/<?=$us['avatar'];?>?nocache=<?=$versiones?>">	
<span><?=$us['Username']; ?></span>
<span style="float:right">
<?php if($cha['leido'] == 0) { ?>
<i style="color:yellow" class="fas fa-star" data-toggle="tooltip" data-placement="top" title="No leído"></i>
<?php } else { ?>
<i style="color:white" href="#" class="far fa-star" data-toggle="tooltip" data-placement="top" title="Leído"></i>
<?php } ?>
</span>
</a>
</div>
<?php } ?>
</div>
</div>
</div>
<!-- FIN -->

<!-- MENSAJES -->
<div class="col-lg-9">
<div id="mensajes" class="bg-white">

<?php if($_GET['usuario'] == 0) { ?>		
<?php } elseif($iduser != $usuariod) { ?>
<div class="bg-white shadow-sm" style="height: 50px;display:none<?=$_GET['usuario']?>;margin-bottom:3px">
<div class="container">
<?php
$users = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '{$_GET['usuario']}'");
while($usx = mysqli_fetch_assoc($users))
{
$xiduser = $usx['ID'];	
$xusuario = $usx['Username'];
$xavatar = $usx['avatar'];
}
?>

<a href="perfil?idu=<?=$xiduser;?>&sec=muro">
<img style="width:30px;height:30px;object-fit:cover;border-radius:50%;margin-top:11px;margin-left:7px;" src="estilos/img/avatars/<?=$xavatar;?>?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="top" title="Perfil">	
</a>
<div style="font-weight:600;margin-left:45px;color:#000;margin-top:-28px;"><?=$xusuario;?></div>

<!--
<form method="POST" action="" style="display: inline;">
<?php
if(isset($_POST['vaciar'])) {
$borrar = mysqli_query($con, "UPDATE c_chats SET de = '0', para = '0' WHERE de = '".$_SESSION['usuario']."' OR para = '".$_SESSION['usuario']."'");
$borrar = mysqli_query($con, "UPDATE chats SET de = '0', para = '0' WHERE de = '".$_SESSION['usuario']."' OR para = '".$_SESSION['usuario']."'");
if($borrar) {echo '<script>window.location="mensajes"</script>';}
}
?>	

<button type="submit" name="vaciar" style="font-weight:600;margin-right:10px;float:right;font-size:18px;background:transparent;border:0px;padding:0px;" data-toggle="tooltip" data-placement="top" title="Borrar"><a href="#" style="color:#3bead2;"><i class="fal fa-trash"></i></a></button>
</form>
-->

<!--
<span style="font-weight:600;margin-right:10px;float:right;font-size:18px;margin-top:5px;" data-toggle="tooltip" data-placement="top" title="Las conversaciones se borran en 2 meses automáticamente!"><a href="#"><i class="fa fa-info-circle"></i></a></span>
-->

<div style="font-weight:600;margin-right:20px;float:right;font-size:18px;margin-top:-22px;" data-toggle="tooltip" data-placement="top" title="Reportar"><a href="#"><i class="fa fa-bug text-danger"></i></a></div>

</div>
</div>
<?php } ?>

<div style="padding:1px;overflow: auto; height: 588px;" class="card-body">
<br>
<?php
$user = mysqli_real_escape_string($con, $_GET['usuario']);
$sess = $_SESSION['id'];
$chats = mysqli_query($con, "SELECT * FROM pcu_chats WHERE de = '$user' AND para = '$sess' OR de = '$sess' AND para = '$user' order by id_cha");
while($ch = mysqli_fetch_array($chats)) { 
$fechac = $ch["fecha"];
$horac = $ch["hora"];
$date = "$fechac,$horac";
$fecha2 = preg_replace('/:[0-9][0-9][0-9]/','/:[0-9][0-9][0-9]/',$date);
$time = strtotime($fecha2);
$time2 = dateDiff($time,time());

if($ch['de'] == $user) {$var = $user;} else {$var = $sess;}
$usere = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$var'");
$us = mysqli_fetch_array($usere);
?>

<?php if($ch['de'] == $user) { ?>

<?php
$usuarioen = mysqli_query($con, "SELECT tiempo FROM pcu_onlines WHERE eid = '".$us['ID']."'");
$enlinea = mysqli_fetch_array($usuarioen);
$user_online = $enlinea['tiempo'];
$this_date = date('U');
if ($user_online>($this_date-60)) {
$user_online = '0';
} else {
$user_online = '1';
}
?>

<div style="margin-bottom:2px;padding:.15rem 1.25rem" class="alert alert-light">
<div class="clearfix">

<div style="float:left" class="dropdown-list-image">

<a href="perfil?idu=<?=$us['ID']?>&sec=muro">
<img class="rounded-circle" style="object-fit:cover;height:30px;width:30px;" src="estilos/img/avatars/<?=$us['avatar'];?>?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="top" title="<?=$us['Username'];?>">
<?php if($user_online != 1) {?>
<div class="status-indicator bg-success" style="top:21px;right:8px" data-toggle="tooltip" data-placement="top" title="Conectado"></div>
<?php } else if($user_online != 0) { ?>
<div class="status-indicator bg-danger" style="top:21px;right:8px" data-toggle="tooltip" data-placement="top" title="Desconectado"></div>
<?php } ?>	
</a>
</div>

<span style="float:left;margin-left:-3px;background:#f5f6f8;color:#312f2f;width:610px;height:auto;padding:8px;border-radius:2px;" data-toggle="tooltip" data-placement="top" title="hace <?=$time2;?>">
<p style="float:left"><?=secureData($ch['mensaje']);?></p>
</span>	
</div>

</div>

<?php } elseif ($ch['para'] == $user) { ?>

<div style="margin-bottom:2px;padding:.15rem 1.25rem" class="alert alert-light">
<div class="clearfix">

<?php
$usuarioen = mysqli_query($con, "SELECT tiempo FROM pcu_onlines WHERE eid = '".$us['ID']."'");
$enlinea = mysqli_fetch_array($usuarioen);
$user_online1 = $enlinea['tiempo'];
$this_date = date('U');
if ($user_online1>($this_date-60)) {
$user_online1 = '0';
} else {
$user_online1 = '1';
}
?>

<div style="float:right" class="dropdown-list-image">

<a href="perfil?idu=<?=$us['ID']?>&sec=muro">
<img class="rounded-circle" style="object-fit:cover;height:30px;width:30px;" src="estilos/img/avatars/<?=$us['avatar'];?>?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="top" title="<?=$us['Username'];?>">
<?php if($user_online1 != 1) {?>
<div class="status-indicator bg-success" style="top:21px;left:-2px;" data-toggle="tooltip" data-placement="top" title="Conectado"></div>
<?php } else if($user_online1 != 0) { ?>
<div class="status-indicator bg-danger" style="top:21px;left:-2px;" data-toggle="tooltip" data-placement="top" title="Desconectado"></div>
<?php } ?>	
</a>
</div>

<span style="float:right;margin-right:8px;background:#f5f6f8;color:#312f2f;width:610px;height:auto;padding:8px;border-radius:2px;" data-toggle="tooltip" data-placement="top" title="hace <?=$time2;?>">
<p style="float:right"><?=secureData($ch['mensaje']);?></p>
</span>
</div>

</div>

<?php } ?>

<?php } ?>

<br>

</div>
</div>

<?php
if(isset($_GET['usuario'])) {
$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '{$_GET['usuario']}'");
$sqlA = mysqli_fetch_array($sqlA);
$usuariopara = $sqlA['Username'];
}
?>

<?php
if(isset($_POST['enviar'])) {

$infochr = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$_GET[usuario]'");
if(mysqli_num_rows($infochr) > 0) {	

$mensaje = secureData(mysqli_real_escape_string($con, $_POST['mensaje']));
$de = $_SESSION['id'];
$para = mysqli_real_escape_string($con, $_GET['usuario']);
$notif1 = "te ha enviado un <a href='".$todo."/mensajes?usuario=".$iduser."&leido=1'>mensaje</a>";
$notif = base64_encode($notif1);

if($mensaje) {

$comprobar = mysqli_query($con, "SELECT * FROM pcu_cchats WHERE de = '$de' AND para = '$para' OR de = '$para' AND para = '$de'");
$com = mysqli_fetch_array($comprobar);
if(mysqli_num_rows($comprobar) == 0) {
$insert = mysqli_query($con, "INSERT INTO pcu_cchats (de,para) VALUES ('$de','$para')");
$siguiente = mysqli_query($con, "SELECT id_cch FROM c_chats WHERE de = '$de' AND para = '$para' OR de = '$para' AND para = '$de'");
$si = mysqli_fetch_array($siguiente);
$insert2 = mysqli_query($con, "INSERT INTO pcu_chats (id_cch,de,para,mensaje,fecha,hora,leido) VALUES ('".$si['id_cch']."','$de','$para','$mensaje','".$fecha."','".$hora."','0')");
if($insert) {echo '<script>window.location="mensajes?usuario='.$para.'"</script>';} 
$insertn = mysqli_query($con, "INSERT INTO pcu_notificaciones (user1, user2, tipo, leido, fecha, hora) VALUES ('".$usuario."', '".$usuariopara."', '".$notif."', '0', '".$fecha."', '".$hora."')");
} else  {
$insert3 = mysqli_query($con, "INSERT INTO pcu_chats (id_cch,de,para,mensaje,fecha,hora,leido) VALUES ('".$com['id_cch']."','$de','$para','$mensaje','".$fecha."','".$hora."','0')");
if($insert3) {echo '<script>window.location="mensajes?usuario='.$para.'"</script>';} 
$insertn = mysqli_query($con, "INSERT INTO pcu_notificaciones (user1, user2, tipo, leido, fecha, hora) VALUES ('".$usuario."', '".$usuariopara."', '".$notif."', '0', '".$fecha."', '".$hora."')");
}

} else {echo "<script>Swal.fire({title: 'Escribe una respuesta!',icon: 'warning',timer: 2500,showConfirmButton: false})</script>";}

} else {echo "<script>Swal.fire({title: 'El usuario no existe!',icon: 'error',timer: 2500,showConfirmButton: false})</script>";}

}
?>

<?php if($_GET['usuario'] == 0) { ?>	
<div class="card-footer bg-white" style="padding:10px;border-radius:1px;border:0px;height:61px"></div>	
<?php } elseif($iduser != $usuariod) { ?>
<div class="card-footer bg-white" style="padding:10px;border-radius:1px;">
<form action="" method="post" accept-charset="utf-8">
<div class="input-group">	
<input type="text" style="border-radius:1px;border-color: #e1e1e1;" name="mensaje" placeholder="Escribe un mensaje <?php if($_GET['usuario']) { echo 'para @'.$usuariopara.''; } ?>" class="form-control" required>
<span class="input-group-btn">	
<input type="submit" name="enviar" style="border-radius:1px;height:42px;" class="btn btn-info btn-flat">	
</span>
</div>
</form>

</div>
<?php } ?>

</div>
</div>
<!-- FIN -->

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</div>
</section>

<script>
$('#mensajes').scrollTop($('#mensajes')[0].scrollHeight); 
</script>

</body>
</html>
