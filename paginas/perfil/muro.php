<?php 
if(isset($_GET['id_pub']))
{
$idpub = mysqli_real_escape_string($con, $_GET['id_pub']); 
}
?>

<?php
if(isset($_POST['publicar'])) 
{
$publicacion = secureData(mysqli_real_escape_string($con, $_POST['publicacion']));

if($publicacion) {

if(validarCadena($publicacion) == true) {

$subir = mysqli_query($con, "INSERT INTO pcu_publicaciones (usuario,usuario2,fecha,hora,contenido) values ('$iduser','$id','".$fecha."','".$hora."','$publicacion')");

if($id == $iduser) {} else {
$notif1 = "comentó en tu <a href='".$todo."/perfil?idu=".$id."'>muro</a>";
$notif = base64_encode($notif1);

$notificacion = mysqli_query($con, "INSERT INTO pcu_notificaciones (user1, user2, tipo, leido, fecha, hora) VALUES ('$usuario', '$usernm', '".$notif."', '0', '$fecha', '$hora')");
}

if($subir) {echo '<script>window.location="perfil?idu=<?=$use["Username"]?>&sec=muro"</script>';}

} else {echo "<script>Swal.fire({title: '¡Carácteres invalidos!',icon: 'warning',timer: 2500,showConfirmButton: false})</script>";}

} else {echo "<script>Swal.fire({title: 'Escribe una respuesta!',icon: 'warning',timer: 2500,showConfirmButton: false})</script>";}

}      
?> 

<!-- TITULO -->
<div class="d-flex align-item-center title mb-3">
<h5 style="font-weight:600" class="m-0">Muro</h5>
<div class="ml-auto d-flex align-items-center">
<div class="ml-2">

<?php
if($privadax == 0) { 
?>
<button class="btn btn-sm btn-outline-info" style="border-radius:2px;font-weight:600" type="submit" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Público
</button>	
<?php } else { ?>
<button class="btn btn-sm btn-outline-info" style="border-radius:2px;font-weight:600" type="submit" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Privado
</button>
<?php } ?>	

</div>
</div>
</div>

<?php 
$sqlA = mysqli_query($con, "SELECT * FROM pcu_seguidores WHERE seguidor = '$iduser' AND seguido = '$id'");
$sqlA = mysqli_fetch_array($sqlA);

$seguido = $sqlA['seguido'];
$seguidor = $sqlA['seguidor'];

if($seguido == $seguidor) { 
?>

<!-- EL MURO ESTÁ PRIVADO -->
<?php if($_GET['idu'] != $iduser) { ?>

<!-- EL MURO NO ESTÁ PRIVADO -->
<?php 
if($privadax != 1) { 
?>		
<!-- FIN -->	

<div class="p-2 bg-white mb-4">
<form style="margin-bottom:40px" action="" method="post" enctype="multipart/form-data">
<textarea style="margin-bottom:10px;border-radius:2px;border:0;font-size:12px;" name="publicacion" onkeypress="return validarn(event)" class="form-control" cols="200" rows="3" placeholder="Dile algo a @<?=$use['Username']?>" required></textarea>

<input type="submit" name="publicar" style="float:right;border-radius:2px;margin-left:10px;box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);font-size: 0.80rem;" class="btn btn-info btn-flat btn-sm" value="Publicar">

<a href="perfil?idu=<?=$id?>&sec=muro">
<img style="float:right;border-radius:50%;width:30px;height:30px;" src="estilos/img/avatars/<?=$avatar?>">
</a>

<!--
<div class="custom-file">
<input type="file" name="foto" style="border-radius:2px;box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);color:#fff;font-size: 0.80rem;background:#2ea1fc" class="custom-file-input" id="customFileLang" lang="es"/>
<label class="custom-file-label btn btn-info btn-sm" style="background:#1d68f1;color:#fff;font-weight:600;border-radius:2px;" for="customFileLang">Subir foto</label>
</div>
-->

</form> 
</div>

<?php } else { ?>
<!-- FIN -->

<h5 style="color:#93a3b2;text-align:center;margin-top:50px !important;margin:auto;width:100%;margin-bottom:60px">El muro de este perfil está privado</h5>	

<?php } ?>	

<?php } else { ?>
<!-- FIN -->

<div class="p-2 bg-white mb-4">
<form style="margin-bottom:40px" action="" method="post" enctype="multipart/form-data">
<textarea style="margin-bottom:10px;border-radius:2px;border:0;font-size:12px;" name="publicacion" onkeypress="return validarn(event)" class="form-control" cols="200" rows="3" placeholder="Dile algo a @<?=$use['Username']?>" required></textarea>

<input type="submit" name="publicar" style="float:right;border-radius:2px;margin-left:10px;box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);font-size: 0.80rem;" class="btn btn-info btn-flat btn-sm" value="Publicar">

<a href="perfil?idu=<?=$id?>&sec=muro">
<img style="float:right;border-radius:50%;width:30px;height:30px;" src="estilos/img/avatars/<?=$avatar?>">
</a>

<!--
<div class="custom-file">
<input type="file" name="foto" style="border-radius:2px;box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);color:#fff;font-size: 0.80rem;background:#2ea1fc" class="custom-file-input" id="customFileLang" lang="es"/>
<label class="custom-file-label btn btn-info btn-sm" style="background:#1d68f1;color:#fff;font-weight:600;border-radius:2px;" for="customFileLang">Subir foto</label>
</div>
-->

</form> 
</div>

<?php } ?>

<?php } else { ?>

<div class="p-2 bg-white mb-4">
<form style="margin-bottom:40px" action="" method="post" enctype="multipart/form-data">
<textarea style="margin-bottom:10px;border-radius:2px;border:0;font-size:12px;" name="publicacion" onkeypress="return validarn(event)" class="form-control" cols="200" rows="3" placeholder="Dile algo a @<?=$use['Username']?>" required></textarea>

<input type="submit" name="publicar" style="float:right;border-radius:2px;margin-left:10px;box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);font-size: 0.80rem;" class="btn btn-info btn-flat btn-sm" value="Publicar">

<a href="perfil?idu=<?=$id?>&sec=muro">
<img style="float:right;border-radius:50%;width:30px;height:30px;" src="estilos/img/avatars/<?=$avatar?>">
</a>

<!--
<div class="custom-file">
<input type="file" name="foto" style="border-radius:2px;box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);color:#fff;font-size: 0.80rem;background:#2ea1fc" class="custom-file-input" id="customFileLang" lang="es"/>
<label class="custom-file-label btn btn-info btn-sm" style="background:#1d68f1;color:#fff;font-weight:600;border-radius:2px;" for="customFileLang">Subir foto</label>
</div>
-->

</form> 
</div>

<?php } ?>


<?php
$record_per_page = 20;
$pagina = '';
if(isset($_GET["pagina"]))
{
$pagina = $_GET["pagina"];
}
else
{
$pagina = 1;
}

$start_from = ($pagina-1)*$record_per_page;

$query = "SELECT * FROM pcu_publicaciones WHERE id_pub AND usuario2 = '{$_GET['idu']}' ORDER BY id_pub DESC LIMIT $start_from, $record_per_page";
$result = mysqli_query($con, $query);
?>
<?php
$query1 = mysqli_query($con, "SELECT * FROM pcu_publicaciones WHERE usuario2 = '{$_GET['idu']}'");
$result1 = mysqli_fetch_array($query1);
$autor = $result1['usuario2'];

if($autor == $id) {

while($row = mysqli_fetch_array($result)) {  	
$idusuario = $row['usuario'];	
$idpub = $row["id_pub"];

$fechap = $row["fecha"];
$horap = $row["hora"];
$date = "$fechap,$horap";
$fecha2 = preg_replace('/:[0-9][0-9][0-9]/','/:[0-9][0-9][0-9]/',$date);
$time = strtotime($fecha2);
$time2 = datediff($time,time());

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$idusuario'");
$usuario = mysqli_fetch_array($sqlA);     
?>

<?php
$usuarioen = mysqli_query($con, "SELECT tiempo FROM pcu_onlines WHERE eid = '".$usuario['ID']."'");
$enlinea = mysqli_fetch_array($usuarioen);
$user_online_m = $enlinea['tiempo'];
$this_date = date('U');
if ($user_online_m>($this_date-60)) {
$user_online_m = '0';
} else {
$user_online_m = '1';
}
?>

<!-- CUERPO DE AVATAR -->
<div id="<?=$idpub?>" style="padding:10px;margin-bottom:10px" class="bg-white">
<div class="media bg-white">

<div class="dropdown-list-image mr-3">
<a href="perfil?idu=<?=$usuario['ID']?>&sec=muro">
<img style="width:42px;height:42px;object-fit:cover" class="img-profile rounded-circle lazyload" loading="lazy" data-src="estilos/img/avatars/<?=$usuario['avatar']?>?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="top" title="Perfil">
</a>


<?php if($user_online_m != 1) { ?>
<div style="top: 29px;right: -4px;width:0.90rem;height:0.90rem;" class="status-indicator bg-success" data-toggle="tooltip" data-placement="top" title="Conectado"></div>
<?php } else if($user_online_m != 0) { ?>
<div style="top: 29px;right: -4px;width:0.90rem;height:0.90rem;" class="status-indicator bg-danger" data-toggle="tooltip" data-placement="top" title="Desconectado"></div>
<?php } ?>
</div>

<div class="media-body text-muted">
<a style="color:#000" href="perfil?idu=<?=$usuario['ID']?>&sec=muro">	
<h6 class="mt-0 text-dark"><?=$usuario['Username']?> 
</a>
<?php if($usuario['vmail'] == 1) { ?>
<i style="color:#55acee;font-size:15px;margin-left:-1px;padding-left:5px;" class="fa fa-check-circle fa-fw verified-badge" data-toggle="tooltip" data-placement="top" title="Verificado"></i>
<?php } ?>
<?php if($usuario['baneado'] != 0) { ?>
<i style="color:#f2353c;font-size:15px;margin-left:-4px;padding-left:5px;" class="fa fa-times-circle fa-fw verified-badge" data-toggle="tooltip" data-placement="top" title="Baneado"></i>
<?php } ?>
<?php if($usuario['vip'] != 0) {?>
<i style="color:#f1c40f;font-size:15px;margin-left:-4px;padding-left:5px;" class="fa fa-jedi fa-fw verified-badge" data-toggle="tooltip" data-placement="top" title="Membresía VIP"></i>
<?php } ?>
<?php if($usuario['simp'] == 1) {?>
<i style="color:#686de0;font-size:14px;padding-left:4px;" class="fa fa-head-vr fa-fw verified-badge" data-toggle="tooltip" data-placement="top" title="Simp"></i>
<?php } ?>
<small style="float:right">hace <?=$time2?></small>
</h6>
<?=$row['contenido']?>

<br>

<!-- ME GUSTAS -->
<?php
$sql = "SELECT * FROM pcu_likes WHERE post = '$idpub'";
$tlikes = $con->query($sql);
$totallikes = mysqli_num_rows($tlikes);
$totalikes = number_format($totallikes);
?> 

<?php
$query = mysqli_query($con, "SELECT * FROM pcu_likes WHERE post = '".$idpub."' AND usuario = ".$iduser."");

if(mysqli_num_rows($query) == 0) { ?>

<a href="perfil?idu=<?=$row['usuario2']?>&sec=muro&id_pub=<?=$idpub;?>" class="like" id="<?=$idpub;?>">
<div style="padding: .065rem .45rem;font-size: 0.6rem;" class="btn btn-info btn-sm"><i class="fal fa-heart"></i> Me encanta (<?=$totalikes?>)</div>
</a>

<?php } else { ?>

<a href="perfil?idu=<?=$row['usuario2']?>&sec=muro&id_pub=<?=$idpub;?>" class="like" id="<?=$idpub;?>">
<div style="padding: .075rem .55rem;font-size: 0.6rem;" class="btn btn-danger btn-sm"><i class="fa fa-heart"></i> Me encanta (<?=$totalikes?>)</div>
</a>

<?php } ?>
<!-- FIN -->

</div>
</div>
</div>

<?php } ?>
<!-- FIN -->

<br>

<ul style="justify-content: center;" class="pagination">
<?php
$page_query = "SELECT * FROM pcu_publicaciones WHERE usuario2 = '{$_GET['idu']}' ORDER BY id_pub DESC";
$page_result = mysqli_query($con, $page_query);

$sql = "SELECT * FROM pcu_publicaciones WHERE usuario2 = '{$_GET['idu']}'";
$rows = $con->query($sql);
$pagin = mysqli_num_rows($rows);

if($pagin > 10) { 

$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records/$record_per_page);
$start_loop = $pagina;
$diferencia = $total_pages - $pagina;
if($diferencia <= 5)
{
$start_loop = $total_pages - 5;
}
$end_loop = $start_loop + 4;
echo "
<li><a class='page-link' style='border-radius:1px;color:#fff;background:#1d68f1;border:0px' href='#'>Pagina ". $pagina ." de ". $total_pages ."</a></li>
";
if($pagina > 1)
{
echo "
<li><a class='page-link' style='border-radius:1px;color:#fff;background:#1d68f1;border:0px' href='perfil?id=".$_GET['id']."&perfil=muro&pagina=".($pagina - 1)."'>Anterior</a></li>
";
}
if($pagina <= $end_loop)
{
echo "
<li><a class='page-link' style='border-radius:1px;color:#fff;background:#1d68f1;border:0px' href='perfil?id=".$_GET['id']."&perfil=muro&pagina=".($pagina + 1)."'>Siguiente</a></li>
";
}
}
} else {
echo '<h5 style="color:#93a3b2;text-align:center;margin-top:120px !important;margin:auto;width:100%;margin-bottom:200px">No tiene comentarios</h5>';
} 
?>  
</ul>

