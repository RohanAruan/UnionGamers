<?php
include 'funciones/lib.php';

if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == $iduser) { } else { header("Location: ".$todo."/salir"); exit; }
?>
<?php
if(isset($_GET['idu']))
{
$id = $con->real_escape_string($_GET['idu']);
$pag = $_GET['sec'];

$infouser = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$id'");
$use = mysqli_fetch_array($infouser);
$baneadox = $use['baneado'];
$usernm = $use['Username'];
$privadax = $use['privada'];
$rangox = $use['Admin'];
$typerankx = $use['Admintipo'];
}

$infochr = mysqli_query($con, "SELECT * FROM characters WHERE Username = '$usernm'");
$char = mysqli_fetch_array($infochr);
$faction = $char['Faction'];

$comprobarlog = mysqli_query($con, "SELECT * FROM aor_logs WHERE idusuario = '$iduser' AND idperfil = '$id'");
$clog = mysqli_fetch_array($comprobarlog);
$clogsi = $clog['idusuario'];

if($id == $iduser) { } else {
if($clogsi == $iduser) { } else { $logs = mysqli_query($con, "INSERT INTO aor_logs (idusuario,idperfil,visto) values ('$iduser','$id','1')"); }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title><?=$use['Username'];?> | <?=$onombrec?></title>
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
<section style="padding-left:0px" class="account-page">

<div class="row">

<?php
$usuarioen = mysqli_query($con, "SELECT tiempo FROM pcu_onlines WHERE eid = '".$use['ID']."'");
$enlinea = mysqli_fetch_array($usuarioen);
$user_online1 = $enlinea['tiempo'];
$this_date = date('U');
if ($user_online1>($this_date-60)) {
$user_online1 = '0';
} else {
$user_online1 = '1';
}
?>	

<!-- MENÚ LATERAL -->
<?php if(mysqli_num_rows($infouser) > 0) { ?>

<div style="padding-left:0px" class="col-lg-12 mb-2">
<div style="border-radius:4px;" class="box box-widget widget-user">
<img src="<?=$todo?>/estilos/img/avatars/banners/<?=$use['banner']?>?nocache=<?=$versiones?>" style="object-fit:cover;width:100%;height:120px;" class="widget-user-header">

<div style="top: 74px;" class="widget-user-image">
<img class="img-profile rounded-circle" style="object-fit:cover;width:90px;height:90px;" src="<?=$todo?>/estilos/img/avatars/<?=$use['avatar']?>?nocache=<?=$versiones?>">
<?php if($user_online1 != 1) {?>
<div style="top: 67px;right: 9px;" class="status-indicator bg-success" data-toggle="tooltip" data-placement="top" title="Conectado"></div>
<?php } else if($user_online1 != 0) { ?>
<div style="top: 67px;right: 9px;" class="status-indicator bg-danger" data-toggle="tooltip" data-placement="top" title="Desconectado"></div>
<?php } ?>	
</div>

<div class="box-footer">
<div class="row">

<div class="col-sm-12">
<div class="description-block">
<h5 style="font-weight: 700;font-size:18px;" class="description-header mb-2"><?php if($mostrar == 0) { echo ''.$use['Username'].''; } else { $quitargion=str_replace("_"," ",$char['Personaje']); echo(''.$quitargion.''); } ?>
<?php if($use['vmail'] == 1) {?>
<i style="color:#55acee;font-size:17px;padding-left:4px;" class="fa fa-check-circle fa-fw verified-badge" data-toggle="tooltip" data-placement="top" title="Verificado"></i>
<?php } ?>
<?php if($use['baneado'] != 0) {?>
<i style="color:#f2353c;font-size:17px;" class="fa fa-times-circle fa-fw verified-badge " data-toggle="tooltip" data-placement="top" title="Baneado"></i>
<?php } ?>
<?php if($use['vip'] != 0) {?>
<i style="color:#f1c40f;font-size:16px;padding-left:4px;" class="fa fa-jedi fa-fw verified-badge" data-toggle="tooltip" data-placement="top" title="Membresía VIP"></i>
<?php } ?>
<?php if($use['simp'] == 1) {?>
<i style="color:#686de0;font-size:16px;padding-left:4px;" class="fa fa-head-vr fa-fw verified-badge" data-toggle="tooltip" data-placement="top" title="Simp"></i>
<?php } ?>
</h5>

<?php if($char['Online'] != 0) { ?>
<center>
<button type="button" style="text-transform:uppercase;font-size: 11px;" class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="Jugando con <?php $quitargion=str_replace("_"," ",$char['Personaje']); echo(''.$quitargion.'');?>">Jugando</button>
</center>
<?php } ?>

<div style="float:right;margin-top:-109px;margin-right:-25px">

<form action="" method="post">

<?php 
if(isset($_SESSION['usuario'])) {
if($id != $_SESSION['usuario']) {

$sqlA = mysqli_query($con, "SELECT * FROM pcu_seguidores WHERE seguidor = '$iduser' AND seguido = '$id'");
$sqlA = mysqli_fetch_array($sqlA);

$seguido = $sqlA['seguido'];
$seguidor = $sqlA['seguidor'];

if($sqlA) { 	
if($seguido != $seguidor) { 
echo '<button type="submit" style="border-radius:50%;margin-top:5px;font-weight:600;width:50px;height:50px;font-size:16px;" class="btn btn-danger btn-sm" name="dejarseguir" data-toggle="tooltip" data-placement="top" title="Dejar de seguir"><i class="fa fa-user-minus"></i></button>';	
} 
} else {
echo '<button type="submit" style="border-radius:50%;margin-top:5px;font-weight:600;width:50px;height:50px;font-size:16px;" class="btn btn-primary btn-sm" name="seguirdirecto" data-toggle="tooltip" data-placement="top" title="Seguir"><i class="fa fa-user-plus"></i></button>';
} 
echo ''; 
} 
} else {
echo '';
}
?>

<div style="margin-bottom:5px"></div>

</form>

<div style="margin-bottom:5px"></div>

<?php
if(isset($_POST['seguirdirecto'])) {
$add = mysqli_query($con, "INSERT INTO pcu_seguidores (seguidor,seguido,fecha) values ('$iduser','$id',now())");
if($add) {echo '<script>window.location="perfil?idu='.$id.'&sec=muro"</script>';}
$insert2 = mysqli_query($con, "INSERT INTO pcu_notificaciones (user1, user2, tipo, leido, fecha, hora) VALUES ('$usuario', '$usernm', 'te ha seguido', '0', '$fecha', '$hora')");
}
?>

<?php
if(isset($_POST['dejarseguir'])) {
$add = mysqli_query($con, "DELETE FROM pcu_seguidores WHERE seguidor = '$iduser' AND seguido = '$id' OR seguidor = '$iduser' AND seguido = '$id'");
if($add) {echo '<script>window.location="perfil?idu='.$id.'&sec=muro"</script>';}
}
?>

<?php 
if(isset($_SESSION['usuario'])) {
if($id != $_SESSION['usuario']) {
echo '<a href="mensajes?usuario='.$id.'" style="border-radius:50%;font-weight:600;width:50px;height:50px;padding:0.80rem 0.5rem;font-size:18px;" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Enviar mensaje"><i class="fa fa-comment"></i></a>'; 
}
} else {
echo '';
}
?>
</div>

</div>
</div>

</div>
</div>
</div>
</div>
<!-- FIN -->

<!-- WIDGET IZQUIERDOS -->
<div style="padding-left:0px" class="col-lg-3">

<div class="bg-white p-3 sidebar-widget mb-4">
<div class="nav nav-pills flex-column lavalamp">

<a class="nav-link nav-sub <?=$pag == 'muro' ? 'active' : ''; ?>" href="?idu=<?=$id;?>&sec=muro">
<i class="far fa-hashtag mr-1 icon <?=$pag == 'muro' ? 'active11' : 'active12'; ?>"></i> Muro</a>

<a class="nav-link nav-sub <?=$pag == 'posts' ? 'active' : ''; ?>" href="?idu=<?=$id;?>&sec=posts">
<i class="far fa-layer-group mr-1 icon <?=$pag == 'posts' ? 'active11' : 'active12'; ?>"></i> Temas</a>

<a class="nav-link nav-sub <?=$pag == 'comentarios' ? 'active' : ''; ?>" href="?idu=<?=$id;?>&sec=comentarios">
<i class="far fa-comment mr-1 icon <?=$pag == 'comentarios' ? 'active11' : 'active12'; ?>"></i> Respuestas</a>

<a class="nav-link nav-sub <?=$pag == 'seguidores' ? 'active' : ''; ?>" href="?idu=<?=$id;?>&sec=seguidores">
<i class="far fa-users mr-1 icon <?=$pag == 'seguidores' ? 'active11' : 'active12'; ?>"></i> Seguidores</a>

</div>
</div>

<?php
$sql = "SELECT * FROM aor_logs WHERE idperfil = '$id'";
$tvisitas = $con->query($sql);
$totalvisitas = mysqli_num_rows($tvisitas);
$visitas = number_format($totalvisitas);
?> 

<div style="border-radius:2px;border:0px" class="card">
<h5 style="background:#fff;font-size:13px;font-weight:600;text-transform:uppercase;border-bottom: 1px solid #e6ecf5;" class="card-header">Visitantes <span class="text-muted" style="font-size:11px;float:right;font-weight:100;text-transform:none;">(<?=$visitas?> visitas)</span></h5>

<div class="card-body">

<div style="margin-top:3px;" class="row">
<div style="margin-left:-9px;padding-right:0px" class="container">

<?php
$query1 = "SELECT * FROM aor_logs WHERE idperfil = '$id' AND idforo = '0' ORDER BY id DESC LIMIT 8";
$result1 = mysqli_query($con, $query1);

$query2 = mysqli_query($con, "SELECT * FROM aor_logs WHERE idperfil = '$id' AND idforo = '0'");
$result2 = mysqli_fetch_array($query2);	
$idperfilx = $result2['idperfil'];

if($idperfilx == $id) {

while($row = mysqli_fetch_array($result1)){	  	
$idlogx = $row['idusuario'];

$infolog = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$idlogx'");
$usuariolog = mysqli_fetch_array($infolog);	
?> 
<a class="ml-1" href="perfil?idu=<?=$usuariolog['ID']?>&sec=muro"> 
<img style="width:25px;height:25px;border-radius:50%;object-fit:cover" src="estilos/img/avatars/<?=$usuariolog['avatar']?>?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="top" title="<?php $quitargion=str_replace("_"," ",$usuariolog['Username']); echo(''.$quitargion.'') ?>"> 
</a>
<?php } ?>
<?php } else { echo '<small style="color:#93a3b2;">Nadie ha visitado este perfil</small>'; } ?>

</div>
</div>

</div>

</div>

</div>
<!-- FIN -->

<!-- PÁGINAS ANEXADAS -->
<div class="col-lg-6">

<div class="tab-content">
<div class="tab-pane fade <?=$pag == 'muro' ? 'show active' : ''; ?>">
<?php include "paginas/perfil/muro.php"; ?>
</div>
<div class="tab-pane fade <?=$pag == 'posts' ? 'show active' : ''; ?>">
<?php include "paginas/perfil/posts.php"; ?>	
</div>
<div class="tab-pane fade <?=$pag == 'comentarios' ? 'show active' : ''; ?>">
<?php include "paginas/perfil/comentarios.php"; ?>	
</div>
<div class="tab-pane fade <?=$pag == 'seguidores' ? 'show active' : ''; ?>">
<?php include "paginas/perfil/seguidores.php"; ?>	
</div>
</div>

</div>
<!-- FIN -->

<!-- WIDGETS DERECHOS -->
<div class="col-lg-3">

<?php
$sql = "SELECT * FROM pcu_seguidores WHERE seguido = '$id'";
$rows = $con->query($sql);
$totalsegu = mysqli_num_rows($rows);
?>	

<?php
$sql = "SELECT * FROM aor_mensajes WHERE idusuario = '$id'";
$tmens = $con->query($sql);
$totalmensaj = mysqli_num_rows($tmens);
$nmens = number_format($totalmensaj);
?>  

<?php
$sql = "SELECT * FROM aor_gracias WHERE idusuario2 = '$id'";
$tgracs = $con->query($sql);
$totalgracs = mysqli_num_rows($tgracs);
$ngracs = number_format($totalgracs);
?> 

<div style="border-radius:2px;border:0px" class="card">
<h5 style="background:#fff;font-size:13px;font-weight:600;text-transform:uppercase;border-bottom: 1px solid #e6ecf5;" class="card-header">Datos</h5>
<div class="card-body">
<p style="text-align:left;margin-bottom:4px;font-size:12px;">Fecha de ingreso: <span style="float:right"><?=$use['RegisterDate']?></span></p> 
<p style="text-align:left;margin-bottom:4px;font-size:12px;">Mensajes: <span style="float:right"><?=$nmens?></span></p> 
<p style="text-align:left;margin-bottom:4px;font-size:12px;">Veces agradecido: <span style="float:right"><?=$ngracs?></span></p>
<p style="text-align:left;margin-bottom:4px;font-size:12px;">Seguidores: <span style="float:right"><?=$totalsegu?></span></p>        
<p style="text-align:left;margin-bottom:10px;font-size:12px;">País: <span style="float:right"><img style="width:20px;height:20px;" src="estilos/img/banderas/<?=$use['pais']?>.png" data-toggle="tooltip" data-placement="top" title="<?php echo(getCountryFromIP($use['IP'], "name"));?>"></span></p>   

<div style="border: 1px solid #e6ecf5;padding:10px 10px 0px;margin-bottom:10px;">

<div class="row">

<div class="col-lg-7">
<p style="text-align:left;margin-bottom:0px;font-size:12px;border-right:2px solid #e6ecf5;">Personajes: 

<div style="width:250px" class="ml-3 mt-1">
<div class="row">

<?php 
$sqlPersonajes = mysqli_query($con, "SELECT * FROM characters WHERE Username = '$usernm'");
while($personajes = mysqli_fetch_array($sqlPersonajes)){      
?>

<img style="width:25px;height:25px;object-fit:cover;" src="estilos/img/skins/<?=$personajes['Skin']?>.jpg" class="rounded-circle" data-toggle="tooltip" data-placement="top" title="<?=$personajes['Personaje']?>">

<?php } ?>

</div>
</div>
</p>  
</div>

<?php 
$sqlFaccion = mysqli_query($con, "SELECT * FROM factions WHERE factionID = '$faction'");
$faccion = mysqli_fetch_array($sqlFaccion);     
?>

<?php if($faction == -1 || $faction == 0 ) {} else { ?>
<div class="col-lg-5">
<p style="text-align:right;margin-bottom:10px;font-size:12px;">Ocupación:

<div style="float:right" class="ml-3">
<div class="row">

<img style="width:20px;height:20px;" src="estilos/img/facciones/<?=$faccion['factionID']?>.png" data-toggle="tooltip" data-placement="top" title="<?=$faccion['factionName'];?>">

</div>
</div>
</p>  
</div>
<?php } ?>

</div>
</div>

<?php include "funciones/anexos/rango.php"; ?>

</div>
</div>

</div>
<!-- FIN -->

</div>
<!-- FIN -->

<?php } else { ?>
<a href="javascript: history.go(-1)" style="height: 37px;" class="btn btn-outline-info"><i class="fa fa-arrow-left mr-1"></i> Volver</a> <br>

<img style="text-align:center;margin:auto;width: 213px;margin-top: 150px;border-radius:10px;" src="estilos/img/errores/perfil.png">
<h5 style="color:#93a3b2;text-align:center;margin-top:40px !important;margin:auto;width:100%;margin-bottom:200px">El perfil que estás buscando no existe.</h5>

<?php } ?>

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</div>
</section>

<script type="text/javascript" src="estilos/js/likes.js"></script>

</body>
</html>
