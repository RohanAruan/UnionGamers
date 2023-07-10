<?php
$sqlLogs = mysqli_query($con, "SELECT * FROM aor_logs WHERE idforo = '$idforo'"); 
$logs = mysqli_fetch_array($sqlLogs); 
$visto = $logs['visto'];
?>

<tr>
<td class="forum topics-1">
<div class="forum-item">
<?php if($visto != 0) { ?>	
<img style="width:45px;height:45px;margin-top:3px;" src="<?=$todoh?>/foro/img/iconos/<?=$foros['icono']?>.png" alt="forum">
<?php } else { ?>
<img style="width:45px;height:45px;opacity: 0.2;margin-top:3px;" src="<?=$todoh?>/foro/img/iconos/<?=$foros['icono']?>.png" alt="forum">
<?php } ?>

<div style="padding-left: 10px;" class="content">

<?php if($tipo != 0) { ?>

<?php
if(isset($_POST['visitamas'])) {
mysqli_query($con, "UPDATE aor_visitas SET redireccion = redireccion + 1 WHERE idforo = '$idforo'");
mysqli_query($con, "INSERT aor_visitas SET redireccion = redireccion + 1, idforo='$idforo'");
echo '<script>window.location="'.$foros["redireccion"].'"</script>';
}
?>

<?php 
$sql = "SELECT * FROM aor_visitas WHERE idforo = '$idforo'";
$tvisitas = $con->query($sql);
$visitas = mysqli_num_rows($tvisitas);
$nvisitas = number_format($visitas);
?>	

<form action="" method="POST">
<button type="submit" name="visitamas" style="color:#000;font-size:18px;line-height:20px;font-weight:400;border: 1px white !important;background:transparent;padding:0px;"><?=$foros['nombre']?> <small style="padding-left:10px;font-style: italic;" class="text-muted">(<?=$nvisitas?> redirecciones)</small></button>
</form>

<?php } else { ?>
<a href="showforum?s=<?=$foros['id']?>-<?=$foros['nombre']?>" style="color:#000;font-size:18px;line-height:20px;font-weight:400;"><?=$foros['nombre']?> 

<?php
$sql = "SELECT * FROM aor_onlines WHERE idforo = '$idforo'";
$tviendo = $con->query($sql);
$totalviendo = mysqli_num_rows($tviendo);
 
if($totalviendo != 0) {
?>	

<small style="font-style: italic;padding-left:10px;" class="text-muted">(<?=$totalviendo;?> viendo)</small>
<?php } ?>

</a>
<?php } ?>

<p style="margin-bottom:1px;">
<?php
$subforosx = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo'");
if(mysqli_num_rows($subforosx) > 0) { 
?>

<span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span>
<span>
<?php 
while($subforos = $subforosx->fetch_array()) {
$idsub = $subforos['id'];
?>

<small><a style="font-size:12px;" href="showforum?s=<?=$subforos['id']?>-<?=$subforos['nombre']?>"><?=$subforos['nombre']?></a>,</small> 

<?php } ?>
</span>
</p>

<p class="text"><?=$foros['descripcion']?></p>

</div>
</div>
</td>

<?php
$sqlSubs = "SELECT * FROM aor_temas WHERE idlider = '$idsub'";
$temass = $con->query($sqlSubs);
$totaltemass = mysqli_num_rows($temass);
$ntemass = number_format($totaltemass);
}
?>

<?php if($tipo != 0) { ?>

<?php } else { ?>

<?php
$sql = "SELECT * FROM aor_temas WHERE idlider = '$idforo'";
$temas = $con->query($sql);
$totaltemas = mysqli_num_rows($temas);
$ntemas = number_format($totaltemas);
?>	

<?php
$sql = "SELECT * FROM aor_mensajes WHERE idlider = '$idforo'";
$mensajes = $con->query($sql);
$totalmens = mysqli_num_rows($mensajes);
$nmens = number_format($totalmens);
?>	

<td class="topics topics-2">

<div class="row">

<div class="col-lg-6" style="border-right: 1px solid #bfc1c5;text-align:center;margin-left:-10px;padding-left:10px">
<p style="margin-bottom:0px;font-weight:400 !important;font-size:11px;text-align:center;color:#9ba5c0">Temas</p>
<p style="margin-bottom:0px;"><span style="margin-bottom:0px;font-size:17px;text-align:center;color:#000;"><?=$ntemas + $ntemass?></span></p>  
</div>

<div style="text-align:center;" class="col-lg-6">
<p style="margin-bottom:0px;font-weight:400 !important;font-size:11px;text-align:center;color:#9ba5c0">Mensajes</p>
<p style="margin-bottom:0px;"><span style="margin-bottom:0px;font-size:17px;text-align:center;color:#000;"><?=$nmens?></span>
</p>
</div>

</div>

</td>

<?php
$sql = mysqli_query($con, "SELECT * FROM aor_mensajes WHERE idlider = '$idforo' ORDER BY fecha DESC");
$mensajes = mysqli_fetch_array($sql); 

$idusuario = $mensajes['idusuario'];
$idtema = $mensajes['idtema'];
$fecham = $mensajes['fecha'];
$newDateM = date("d-m-Y", strtotime($fecham));

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$idusuario'");
$usuario = mysqli_fetch_array($sqlA);  
$rol = $usuario['Admin']; 	

$sqlB = mysqli_query($con, "SELECT * FROM aor_temas WHERE id = '$idtema'");
$temas = mysqli_fetch_array($sqlB); 

if($mensajes > 0) { 
?>	

<td class="freshness">

<div style="width:250px" class="author-freshness">

<span><img style="width:40px;height:40px;border-radius:50%;float:left;margin-top:3px;" src="../estilos/img/avatars/<?=$usuario['avatar']?>?nocache=<?=$versiones?>" alt="author"></span>

<div style="padding-left: 52px;">
<a href="showtopic?s=<?=$temas['id']?>-<?=$temas['nombre']?>" style="color:#38a9ff;white-space: nowrap;font-size:14px;" title="<?=$temas['nombre']?>"><span style="color:<?=$temas['prefijoc']?>;font-weight:500;text-transform:uppercase;"><?=$temas['prefijo']?></span> <?=limitar_cadena($temas['nombre'], 20, '...');?></a> 

<p style="margin-bottom:0px;">
Por <a href="../perfil?id=<?=$usuario['Username']?>" style="color:<?php include "views/permisos/croles.php"; ?> !important;"><?php $quitargion=str_replace("_"," ",$usuario['Username']); echo(''.$quitargion.'') ?></a>,
<time class="entry-date updated" style="font-size:14px" datetime="<?=$fecha?>"><?=strftime("%d de %B", strtotime($newDateM));?></time>
</p>
</div>


</div>

</td>
</tr>

<?php } else { ?>	

<td style="text-align:center;" class="freshness">
<div class="author-freshness">
<span class="h6 title">No hay mensajes</span>
</div>
</td>

</tr>
<?php } ?>

<?php } ?>