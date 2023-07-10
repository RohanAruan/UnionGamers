<?php
$record_per_page = 10;
$p = '';
if(isset($_GET["p"]))
{
$p = $_GET["p"];
}
else
{
$p = 1;
}

$start_from = ($p-1)*$record_per_page;

$mensajess = mysqli_query($con, "SELECT * FROM aor_mensajes WHERE idtema = '".$idtema."' ORDER BY fecha LIMIT $start_from, $record_per_page");
while($respuestas = mysqli_fetch_array($mensajess)) {

$idmensj = $respuestas['id'];
$idtemar = $respuestas['idtema'];

if($idtema == $idtemar) {

$horax = $respuestas['hora'];
$newDateRr = date("H:i", strtotime($horax));

$autorx = $respuestas['idusuario'];
$idcategor = $respuestas['idlider'];
$nombretema = $respuestas['nombre'];
} 
?>

<?php
$sqlB = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$autorx'");
$usuariox = mysqli_fetch_array($sqlB); 
$rol = $usuariox['Admin'];
$esvip = $usuariox['vip'];
$typerankx = $usuariox['Typerank'];  
$nombrec = $usuariox['Username'];
$iduserc = $usuariox['ID'];
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
<div style="padding-left:0px;" class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

<div style="border: 1px solid #e9e9e9;border-radius:2px;" class="ui-block responsive-flex">
<div style="padding:8px 14px;background:#1d68f1;border-radius:2px;" class="ui-block-title">
<div style="font-size:12px;color:white"><?=$respuestas['fecha']?>, <?=$newDateRr?></div>
<div style="font-size:12px;color:white;float:right;">#<?=$respuestas['id']?></div>
</div>

<!-- CONTENIDO -->
<div class="row">

<!-- USUARIO -->
<div style="padding-left:0px;flex: 0 0 21%;max-width: 21%;margin-bottom:20px;" class="col-lg-3">

<div style="padding:15px;text-align:center;margin-top:10px" class="author">
<div style="width:160px;margin-left:20%">	
<div class="author-thumb">	

<?php
$usuarioen = mysqli_query($con, "SELECT tiempo FROM pcu_onlines WHERE eid = '".$iduserc."'");
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

<a href="../perfil?idu=<?=$usuariox['ID']?>&sec=muro">

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
<div style="padding:10px;margin-top:5px;" class="posts">

<?php 
if($rango > 5) {
echo '<a style="float:right;font-size:15px;cursor:pointer;margin-left:15px;" class="text-danger" data-toggle="modal" data-target="#BorrarMensaje"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Borrar"></i></a>';
} 
if($rango > 5) {
echo '<a style="float:right;font-size:15px;cursor:pointer" href="editanswer?e='.$_GET[s].'"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i></a>';
} else {
if($autorx != $iduser) { } else {
echo '<a style="float:right;font-size:15px;cursor:pointer" href="editanswer?e='.$_GET[s].'"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i></a>';
}  
}
?>

<a style="color:white;float:right;font-size:11px;cursor:pointer;margin-right:15px;margin-top:-3px" class="btn btn-primary btn-sm">Responder</a>

<?php include "views/showtopic/foros.php"; ?>

<?=$respuestas['mensaje']?>

<div style="overflow: auto; height: 340px;border-top: 1px solid rgba(0,0,0,.1);padding:10px;margin-top:60px;display:none<?php echo strip_tags($usuariox['Firma'],'<ul><li><p><div></div>');?> ">
<?=$usuariox['Firma'];?> 
</div>

</div>
</div>

</div>
</div>
<?php } ?>

<?php
$page_query = "SELECT * FROM aor_mensajes WHERE idtema = '".$idtemar."' ORDER BY fecha DESC";
$page_result = mysqli_query($con, $page_query);

$sql = "SELECT * FROM aor_mensajes WHERE idtema = '".$idtemar."'";
$rows = $con->query($sql);
$res = mysqli_num_rows($rows);

if($res > 10) { 
?>

<ul style="justify-content: center;" class="pagination">

<?php
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records/$record_per_page);
$start_loop = $p;
$diferencia = $total_pages - $p;
if($diferencia <= 5)
{
$start_loop = $total_pages - 5;
}
$end_loop = $start_loop + 4;
echo "
<li><a class='page-link' style='border-radius:1px;color:#fff;background:#4825f5;border:0px' href='#'>Pagina ". $p ." de ". $total_pages ."</a></li>
";
if($p > 1)
{
echo "
<li><a class='page-link' style='border-radius:1px;color:#fff;background:#4825f5;border:0px' href='".$todo."/foro/showtopic?s=".$not1['id']."-".$not1['nombre']."&p=".($p - 1)."'>Anterior</a></li>
";
}
///for($i=$start_loop; $i<=$end_loop; $i++)
//{     
//echo "
//<li><a class='page-link' style='border-radius:1px;color:#fff;background:#4825f5;border:0px' href='".$todo."/cartera/".$pags."/".$i."'>".$i."</a></li>
//";
//}
if($p <= $end_loop)
{
echo "
<li><a class='page-link' style='border-radius:1px;color:#fff;background:#4825f5;border:0px' href='".$todo."/foro/showtopic?s=".$not1['id']."-".$not1['nombre']."&p=".($p + 1)."'>Siguiente</a></li>
";
}
?>

</ul>

<?php } ?>

</div>
<!-- FIN -->

<div class="modal fade" id="BorrarMensaje" tabindex="-1" aria-labelledby="BorrarMensajeLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body">
<h4 style="text-align:center;">¿Estás seguro?</h4>
</div>

<?php
if(isset($_POST['borrarmens'])) {
$borrarmensaje = mysqli_query($con, "DELETE FROM aor_mensajes WHERE id = '".$idmensj."' AND idusuario = '$iduser'");
if($borrarmensaje) {echo "<script>Swal.fire({title: '¡Respuesta borrada con éxito!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
    window.location = 'showtopic?s=".$idtema."-".$natema."';});</script>";}
}
?>  

<form style="float:right" method="POST" action="">
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
<button type="submit" name="borrarmens" class="btn btn-danger">Confirmar</button>
</div>
</form>

</div>
</div>
</div>