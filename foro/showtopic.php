<?php
include '../funciones/lib.php';
include 'views/_lib.php';
?>
<?php
if($_GET['s'] <> ""){
$noticia = mysqli_query($con, "SELECT * FROM aor_temas WHERE id = '$_GET[s]'");
if($notc = mysqli_fetch_array($noticia)){
$idtema = $notc['id'];
$natema = $notc['nombre'];
$miembrofac = $notc['faccion'];
$contraseña = $notc['contraseña'];
$contraseñae = $notc['contraseñae'];
echo '';
}else{
}
}
?>

<?php
if(isset($_SESSION["usuario"])) {
$vista_real = mysqli_query($con, "SELECT * FROM aor_vistas WHERE fecha = '$fecha' AND idtema = '$_GET[s]' AND idusuario = '$iduser'");
if(mysqli_num_rows($vista_real) == 0) {
$insert_real = mysqli_query($con, "INSERT INTO aor_vistas (idtema, idusuario, fecha) VALUES ('$_GET[s]','$iduser','$fecha')");
}
} else {
$vista_real_v = mysqli_query($con, "SELECT * FROM aor_vistas WHERE fecha = '$fecha' AND idtema = '$_GET[s]' AND idusuario = '$ip'");
if(mysqli_num_rows($vista_real_v) == 0) {
$insert_real_v = mysqli_query($con, "INSERT INTO aor_vistas (idtema, idusuario, fecha) VALUES ('$_GET[s]','$ip','$fecha')");
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?=$notc['nombre']?> | <?=$onombre?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php include "../paginas/_head.php"; ?>
<link rel="stylesheet" type="text/css" href="<?=$todoh?>/foro/estilos/css/main.css">
<link rel="stylesheet" type="text/css" href="<?=$todoh?>/foro/estilos/css/fonts.min.css">
<script src="https://cdn.tiny.cloud/1/oacfwr1n8ixdyeq3tz4vmz7ylealzfpzsb4ccjf33pululpy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="<?=$todoh?>/foro/estilos/js/lazysizes.min.js" async=""></script>
</head>
<!-- FIN -->

<?php 
if(isset($_SESSION["usuario"])) {
include '../paginas/_headerlog.php';
} else {
include '../paginas/_header.php';
}
?>

<?php
$noticias = mysqli_query($con, "SELECT * FROM aor_temas WHERE id = '$_GET[s]'");
if($not1 = mysqli_fetch_array($noticias)){

$hora = $not1['hora'];
$newDate = date("H:i", strtotime($hora));

$autorx = $not1['idusuario'];
$ueditado = $not1['ueditado'];

$feditado = $not1['feditado'];
$heditado = $not1['heditado'];

$idcategor = $not1['idlider'];
$nombretema = $not1['nombre'];

$newDateh = date("H:i d-m-Y", strtotime($feditado,$heditado));
} 
?>

<?php
$sqlB = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$autorx'");
$usuariox = mysqli_fetch_array($sqlB); 
$rol = $usuariox['Admin'];
$typerankx = $usuariox['Typerank'];  
$esvip = $usuariox['vip'];
$nombrec = $usuariox['Username'];
$idu = $usuariox['ID'];
$fmostrar = $usuariox['mostrar'];
?>

<?php
$sqlFac = mysqli_query($con, "SELECT * FROM characters WHERE Username = '$nombrec'");
$usuariofac = mysqli_fetch_array($sqlFac); 
$idmiembro = $usuariofac['FactionRank'];
$faction = $usuariofac['Faction'];
$skin = $usuariofac['Skin'];
$personaje = $usuariofac['Personaje'];
?>

<!-- CUERPO -->
<?php if(mysqli_num_rows($noticia) > 0) { ?>

<div class="row">
<div style="padding-left:0px;" class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<!-- BREAD -->
<nav aria-label="breadcrumb">
<ol style="padding:0px;background-color:transparent;margin-bottom:0px;float:left;" class="breadcrumb">
<li class="breadcrumb-item"><a href="index">Foros</a></li>

<?php 
$sqlB = mysqli_query($con, "SELECT * FROM aor_temas WHERE id = '$idtema'");
$categoriax = mysqli_fetch_array($sqlB); 

$idtemaa = $categoriax['id'];
$forox = $categoriax['idlider'];

$sqlForo = mysqli_query($con, "SELECT * FROM aor_foros WHERE id = '$forox'");
$xforos = mysqli_fetch_array($sqlForo);

$idforo = $xforos['id'];
$categoriaf = $xforos['idcategoria'];
$idforor = $xforos['idforo'];

$sqlA = mysqli_query($con, "SELECT * FROM aor_categorias WHERE id = '$categoriaf'");
$categoria = mysqli_fetch_array($sqlA);     
?>

<li class="breadcrumb-item"><a href="index"><?=$categoria['nombre']?></a></li>

<?php if($idforor > 0) { ?>

<?php 
$sqlsForos = mysqli_query($con, "SELECT * FROM aor_foros WHERE id = '$idforor'");
$suforosx = mysqli_fetch_array($sqlsForos);    
$idfororr = $suforosx['idforo'];
?>

<?php if($idfororr > 0) { ?>

<?php 
$sqlsForos = mysqli_query($con, "SELECT * FROM aor_foros WHERE id = '$idfororr'");
$suforos = mysqli_fetch_array($sqlsForos);    
?>

<li class="breadcrumb-item"><a href="showforum?s=<?=$suforos['id']?>-<?=$suforos['nombre']?>"><?=$suforos['nombre']?></a></li>

<?php } else { } ?>

<li class="breadcrumb-item"><a href="showforum?s=<?=$suforos['id']?>-<?=$suforos['nombre']?>"><?=$suforosx['nombre']?></a></li>

<?php } else { } ?>

<li class="breadcrumb-item"><a href="showforum?s=<?=$xforos['id']?>-<?=$xforos['nombre']?>"><?=$xforos['nombre']?></a></li>

<li class="breadcrumb-item active" aria-current="page"><?=limitar_cadena($notc['nombre'], 25, '...');?></li>

</ol>  

<form class="w-search">
<div style="float:right;margin-top:-5px" class="form-group with-button">
<input class="form-control" type="text" placeholder="Buscar en el foro...">
<button>
<i class="fa fa-search"></i>
</button>
</div>
</form>

</nav>

<br><br>
<!-- FIN -->

<div class="ui-block responsive-flex">
<div class="ui-block-title">
<div class="h6 title"><b style="font-size:16px">Tema:</b> <a style="font-weight:100;font-size:15px" href="showtopic?s=<?=$not1['id']?>-<?=$not1['nombre']?>"><?=$notc['nombre']?></a></div>
<div class="align-right">
<?php if($not1['cerrado'] != 0) { ?>
<button type="button" style="background:#eb4d4b !important;border-color:#eb4d4b !important;" class="btn btn-primary">Tema cerrado</button>
<?php } else { ?>
<a href="#contenido1" class="btn btn-success">Responder este tema</a>
<?php } ?>

</div>
</div>
</div>
</div>
</div>

<!-- PRINCIPAL -->
<div class="row">
<div style="padding-left:0px;" class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div style="border: 1px solid #e9e9e9;border-radius:2px;" class="ui-block responsive-flex">
<div style="padding:8px 14px;background:#1d68f1;border-radius:2px;" class="ui-block-title">
<div style="font-size:12px;color:white"><?=$not1['fecha']?>, <?=$newDate?></div>
<div style="font-size:12px;color:white;float:right;">#<?=$not1['id']?></div>
</div>

<!-- CONTENIDO -->
<div class="row">


<!-- USUARIO -->
<div style="padding-left:0px;flex: 0 0 21%;max-width: 21%;margin-bottom:20px;" class="col-lg-3">

<div style="padding:15px;text-align:center;margin-top:10px" class="author">
<div style="width:160px;margin-left:20%">   
<div class="author-thumb">  

<?php
$usuarioen = mysqli_query($con, "SELECT tiempo FROM pcu_onlines WHERE eid = '".$usuariox['ID']."'");
$enlinea = mysqli_fetch_array($usuarioen);
$user_online1 = $enlinea['tiempo'];
$this_date = date('U');
if ($user_online1>($this_date-60)) {
$user_online1 = '0';
} else {
$user_online1 = '1';
}
?>

<?php if($user_online1 != 1) {?>
<span style="border:0px;top:69px;left:56px;width:17px !important;height:17px !important;border:3px solid white;" class="icon-status online" data-toggle="tooltip" data-placement="top" title="Conectado"></span>
<?php } else if($user_online1 != 0) { ?>
<span style="border:0px;top:69px;left:56px;width:17px !important;height:17px !important;border:3px solid white;" class="icon-status disconected" data-toggle="tooltip" data-placement="top" title="Desconectado"></span>
<?php } ?> 

<a href="<?=$todo?>/perfil?idu=<?=$usuariox['ID']?>&sec=muro">

<?php if($fmostrar == 0) { ?>
<img style="width:85px;height:85px;margin-bottom:9px;object-fit:cover;background:url('../estilos/img/avatars/defect.jpg');" src="../estilos/img/avatars/<?=$usuariox['avatar']?>?nocache=<?=$versiones?>" class="shadow-sm"> 
<?php } else { ?>
<img style="width:85px;height:85px;margin-bottom:9px;object-fit:cover;background:url('../estilos/img/avatars/defect.jpg');" src="../estilos/img/skins/<?=$skin?>.jpg?nocache=<?=$versiones?>" class="shadow-sm">     
<?php } ?>

</a>
</div>
<div class="author-content">

<?php if($fmostrar == 0) { ?>
<a href="<?=$todo?>/perfil?idu=<?=$usuariox['ID']?>&sec=muro" class="h6 author-name"><?php $quitargion=str_replace("_"," ",$usuariox['Username']); echo(''.$quitargion.'') ?></a>
<?php } else { ?>
<a href="<?=$todo?>/perfil?idu=<?=$usuariox['ID']?>&sec=muro" class="h6 author-name"><?php $quitargion=str_replace("_"," ",$personaje); echo(''.$quitargion.'') ?></a>
<?php } ?>

<!--
<?php 
if(isset($_SESSION['usuario'])) {
if($id != $_SESSION['usuario']) {
echo '<a href="../mensajes?usuario='.$idu.'" style="border-radius:1px;font-weight:600" class="btn btn-info btn-sm">MP</a>'; 
}
} else {
echo '';
}
?>
-->

<?php include "views/showtopic/roles.php"; ?>

<?php include "views/showtopic/facciones.php"; ?>

<?php if($esvip == 1) { ?>
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;color:#fff;border:0px;font-weight:100" class="badge badge-warning">VIP</span>
<?php } ?>

<?php include "views/showtopic/mensajes.php"; ?>

<span style="width:100%;margin-bottom:7px;border-radius:2px;border:0px;font-weight:100" class="badge badge-primary"><?=$onombre?></span>

<div style="border: 1px solid #e9e9e9;padding: 20px 20px;padding:5px;" class="country">

<p style="text-align:left;margin-bottom:0px;font-size:12px;">Fecha de ingreso: <span style="float:right"><?=$usuariox['RegisterDate']?></span></p> <br> 

<?php
$sql = "SELECT * FROM aor_mensajes WHERE idusuario = '$autorx'";
$tmens = $con->query($sql);
$totalmensaj = mysqli_num_rows($tmens);
$nmens = number_format($totalmensaj);
?>  

<?php
$sql = "SELECT * FROM aor_gracias WHERE idusuario2 = '$autorx'";
$tgracs = $con->query($sql);
$totalgracs = mysqli_num_rows($tgracs);
$ngracs = number_format($totalgracs);
?>  

<p style="text-align:left;margin-bottom:0px;font-size:12px;">Mensajes: <span style="float:right"><?=$nmens?></span></p>
<p style="text-align:left;margin-bottom:0px;font-size:12px;">Veces agradecido: <span style="float:right"><?=$ngracs?></span></p>    
<p style="text-align:left;margin-bottom:0px;font-size:12px;">País: <span style="float:right"><img style="width:20px;height:20px;" src="<?=$todoh?>/estilos/img/banderas/<?=$usuariox['pais']?>.png" data-toggle="tooltip" data-placement="top" title="<?php echo(getCountryFromIP($usuariox['IP'], "name"));?>"></span></p>     

</div>

<!-- PERSONAJES -->
<div style="border: 1px solid #e9e9e9;padding:5px;height: 60px;" class="country mt-2">

<p style="text-align:left;margin-bottom:0px;font-size:12px;">Personajes: <br>

<div style="width:250px" class="ml-3 mt-1">
<div class="row">

<?php 
$sqlPersonajes = mysqli_query($con, "SELECT * FROM characters WHERE Username = '$nombrec'");
while($personajes = mysqli_fetch_array($sqlPersonajes)){      
?>

<img style="width:25px;height:25px;object-fit:cover;" src="../estilos/img/skins/<?=$personajes['Skin']?>.jpg" class="rounded-circle" data-toggle="tooltip" data-placement="top" title="<?=$personajes['Personaje']?>">

<?php } ?>

</div>
</div>
</p> 
</div>
<!-- FIN -->    

</div>
</div>
</div>
</div>
<!-- FIN -->

<div style="border-left: 1px solid #e9e9e9;flex: 0 0 78%;max-width: 78%;margin-bottom:20px;" class="col-lg-9">


<!-- CONTENIDO -->
<div style="padding:15px" class="posts">
<div style="font-size:15px;color:#000;font-weight:bold;"><?=$not1['nombre']?></div>

<?php if($miembrof == $miembrofac) { ?>

<a style="float:right;font-size:15px;margin-top:-20px" href="edittopic?e=<?=$_GET[s]?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i></a>
<a style="float:right;font-size:15px;margin-top:-20px;margin-right:15px" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-page-break" data-toggle="tooltip" data-placement="top" title="Mover"></i></a>

<?php } else { ?>

<?php 
if($rango > 5) {
echo '<a style="float:right;font-size:15px;margin-top:-20px;margin-left:15px;cursor:pointer" class="text-danger" data-toggle="modal" data-target="#Borrar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Borrar"></i></a>';
} 

if($rango > 5) {
echo '<a style="float:right;font-size:15px;margin-top:-20px;" href="edittopic?e='.$_GET[s].'"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i></a>';
} else {
if($autorx != $iduser) { } else {
echo '<a style="float:right;font-size:15px;margin-top:-20px" href="edittopic?e='.$_GET[s].'"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i></a>';
}
}

if($rango > 5) {
echo '<a style="float:right;font-size:15px;margin-top:-20px;margin-right:15px" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-page-break" data-toggle="tooltip" data-placement="top" title="Mover"></i></a>';
} 
?>

<div class="modal fade" id="Borrar" tabindex="-1" aria-labelledby="BorrarLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body">
<h4 style="text-align:center;">¿Estás seguro?</h4>
</div>

<?php
if(isset($_POST['borrartema'])) {
$borrar = mysqli_query($con, "DELETE FROM aor_temas WHERE id = '".$idtema."'");
$borrar1 = mysqli_query($con, "DELETE FROM aor_mensajes WHERE idtema = '".$idtema."'");
if($borrar) {echo "<script>Swal.fire({title: '¡Tema borrado con éxito!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
    window.location = 'showforum?s=".$idforor."';});</script>";}
}
?>  

<form style="float:right" method="POST" action="">
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
<button type="submit" name="borrartema" class="btn btn-danger">Confirmar</button>
</div>
</form>

</div>
</div>
</div>

<?php } ?>

<?php include "views/showtopic/foros.php"; ?>

<hr style="margin-top:5px;">

<?=htmlspecialchars_decode($notc['contenido'], ENT_NOQUOTES)?>

</div>

<div style="overflow: auto; height: 340px;border-top: 1px solid rgba(0,0,0,.1);padding:10px;margin-top:60px;display:none<?php echo strip_tags($usuariox['Firma'],'<ul><li><p><div></div>');?> ">
<?=$usuariox['Firma'];?> 
</div>

<!-- FIN -->

<!-- EDICIÓN -->
<br><br>

<div style="bottom:0;position:absolute;width:100%" class="row">
<div style="margin-bottom:0px;" class="col-lg-6">

<?php
$sqlEditado = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$ueditado'");
$editado = mysqli_fetch_array($sqlEditado); 

if($editado != 0) {
?>

<div style="font-style: italic;font-size:11.20px;color:#000;margin-top:10px;">Última edición por <?php $quitargion=str_replace("_"," ",$editado['Username']); echo(''.$quitargion.'') ?>; <?=strftime("%d %B de %Y a las %R", strtotime($newDateh));?></div>

<?php } else {} ?>

</div>
<!-- FIN -->


<!-- DAR GRACIAS -->
<div class="col-lg-6">

<form action="" method="POST">

<?php
if(isset($_POST['agradecer'])) {
$add = mysqli_query($con, "INSERT INTO aor_gracias (idusuario,idusuario2,idtema) values ('$iduser','$autorx','$idtema')");
if($add) {echo '<script>window.location="showtopic?s='.$not1['id'].'-'.$not1['nombre'].'"</script>';}
}
?>

<?php 
if(isset($_SESSION['usuario'])) {
if($autorx != $iduser) {

$sqlA = mysqli_query($con, "SELECT * FROM aor_gracias WHERE idusuario = '$iduser' AND idtema = '$idtema'");
$sqlA = mysqli_fetch_array($sqlA);

$seguido = $idtema;
$seguidor = $sqlA['idtema'];

if($sqlA) {     
if($seguido != $seguidor) { 
echo '';    
} 
} else {
echo '<button type="submit" style="border-radius:2px;font-weight:600;border: 1px solid #e9e9e9;color:#000 !important;margin-top:5px;float:right" class="btn btn-sm" name="agradecer"><i class="fa fa-thumbs-up"></i> Dar gracias</button>';
} 
echo ''; 
} 
} else {
echo '';
}
?>

</form>

</div>
<!-- FIN -->

</div>
</div>
<!-- FIN -->


<!-- DAR GRACIAS #2 -->
<?php
$sql = "SELECT * FROM aor_gracias WHERE idtema = '$idtema'";
$tgracias = $con->query($sql);
$totalgracias = mysqli_num_rows($tgracias);

if($totalgracias > 0) { 
?>  

<div class="col-lg-12">
<div class="container">
<div style="padding:15px;border: 1px solid #e9e9e9;margin-bottom:20px;" class="posts">
<h6 style="color:#000;font-size:14px">Los siguientes <?=$totalgracias?> usuarios agradecieron a <?php $quitargion=str_replace("_"," ",$usuariox['Username']); echo(''.$quitargion.'') ?> por este mensaje:</h6>    
<hr>

<div class="row">
<div style="margin-left:15px;">
    
<?php
$sgracias = $con->query("SELECT * FROM aor_gracias WHERE idtema = '$idtema'");
while($gracias = $sgracias->fetch_array()) {

$idusuario = $gracias['idusuario'];

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$idusuario'");
$usuariog = mysqli_fetch_array($sqlA);  
$usuariogg = $usuariog['Username'];

$gracias = mysqli_query($con, "SELECT * FROM characters WHERE Username = '$usuariogg'");
$pjg = mysqli_fetch_array($gracias); 
?>  

<?php if($fmostrar == 0) { ?>
<a class="ml-1" href="../perfil?idu=<?=$usuariog['ID']?>&sec=muro"> 
<img style="width:25px;height:25px;border-radius:50%;object-fit:cover;background:url('../estilos/img/avatars/defect.jpg');" src="../estilos/img/avatars/<?=$usuariog['avatar']?>?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="top" title="<?php $quitargion=str_replace("_"," ",$usuariog['Username']); echo(''.$quitargion.'') ?>"> 
</a>
<?php } else { ?>
 <a class="ml-1" href="../perfil?idu=<?=$usuariog['ID']?>&sec=muro"> 
<img style="width:25px;height:25px;border-radius:50%;object-fit:cover;background:url('../estilos/img/avatars/defect.jpg');" src="../estilos/img/skins/<?=$pjg['Skin']?>.jpg?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="top" title="<?php $quitargion=str_replace("_"," ",$pjg['Personaje']); echo(''.$quitargion.'') ?>"> 
</a>
<?php } ?>

<?php } ?>

</div>
</div>

</div>
</div>
</div>
<?php } ?>  
<!-- FIN -->

</div>
</div>
</div>

<?php include "views/showtopic/respuestas.php"; ?>

<?php include "views/showtopic/respuesta.php"; ?>

</div>
<!-- FIN -->


<!-- PAGINACIÓN -->

<!-- RESPUESTAS --
<div class="title mb-3">

<?php 
$sql = "SELECT * FROM aor_mensajes WHERE idtema = '$idtema'";
$rows = $con->query($sql);
$mensajes = mysqli_num_rows($rows);
?>

<h4 class="m-0">Respuestas <small class="text-muted">(<?=$mensajes?>)</small></h4>
</div>

<br>



<!-- FIN -->

<a style="background: #000;" class="back-to-top" href="#">
<img src="<?=$todoh?>/foro/estilos/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>

<?php } else { ?>

<a href="javascript: history.go(-1)" style="margin-top:0px;margin-left: -14px;" class="btn btn-outline-info"><i class="fa fa-arrow-left mr-1"></i> Volver</a> <br>

<img style="text-align:center;margin:auto;width: 213px;margin-top: 150px;border-radius:10px;margin-left: 470px;" src="<?=$todo?>/estilos/img/errores/temas.png">
<h5 style="color:#93a3b2;text-align:center;margin-top:40px !important;margin:auto;width:100%;margin-bottom:200px">El tema que estás buscando no existe.</h5>

<?php } ?>

<!-- FIN -->
<?php include "../paginas/_footer.php"; ?>

</div>
</div>
</div>

</body>
</html>