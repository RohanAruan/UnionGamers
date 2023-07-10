<?php
$sql = "SELECT * FROM pcu_seguidores WHERE seguido = '{$_GET['idu']}'";
$rows = $con->query($sql);
$totalsegs = mysqli_num_rows($rows);
?>	

<!-- TITULO -->
<div class="d-flex align-item-center title mb-3">
<h5 style="font-weight:600" class="m-0">Seguidores</h5>
<div class="ml-auto d-flex align-items-center">

<?php if(mysqli_num_rows($rows) > 0) { ?>	
<div class="ml-2">	
<button style="border-radius:3px;font-weight:600;margin-right:-5px;" class="btn btn-sm btn-info" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<?=$totalsegs?> seguidores
</button>
</div>
<?php } ?>

</div>
</div>
<!-- FIN -->

<div style="margin-left:5px">
<div class="row">

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

$query = "SELECT * FROM pcu_seguidores WHERE seguido = '$id' ORDER BY id_segui DESC LIMIT $start_from, $record_per_page";
$result = mysqli_query($con, $query);
?>
<?php
$query1 = mysqli_query($con, "SELECT * FROM pcu_seguidores WHERE seguido = '$id'");
$result1 = mysqli_fetch_array($query1);
$autor = $result1['seguido'];

if($autor == $id) {

while($row = mysqli_fetch_array($result)) {  
$idusuarios = $row['seguidor'];	

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$idusuarios'");
$usuario = mysqli_fetch_array($sqlA);   
$rango = $usuario['Admin'];  
$typerankf = $usuario['Typerank'];  
$paisx = $usuario['pais'];  
?>

<div style="width:196px;padding-left:10px;margin-bottom:10px">

<div class="bg-white inner-profile text-white p-2 widget text-center sombra"> 
<center>
<div style="margin-left:-40px;margin-bottom:40px;margin-top:10px;" class="dropdown-list-image">
<a href="perfil?idu=<?=$row['seguidor']?>&sec=muro">
<img style="width:80px;height:80px;object-fit:cover" class="img-profile rounded-circle lazyload" loading="lazy" data-src="estilos/img/avatars/<?=$usuario['avatar']?>?nocache=<?=$versiones?>" data-toggle="tooltip" data-placement="top" title="Perfil">
</a>

<?php
$usuarioen = mysqli_query($con, "SELECT tiempo FROM pcu_onlines WHERE eid = '".$usuario['ID']."'");
$enlinea = mysqli_fetch_array($usuarioen);
$user_online_u = $enlinea['tiempo'];
$this_date = date('U');
if ($user_online_u>($this_date-60)) {
$user_online_u = '0';
} else {
$user_online_u = '1';
}
?>

<?php if($user_online_u != 1) {?>
<div style="top: 63px;right: -34px;width:1.05rem;height:1.15rem;" class="status-indicator bg-success" data-toggle="tooltip" data-placement="top" title="Conectado"></div>
<?php } else if($user_online_u != 0) { ?>
<div style="top: 63px;right: -34px;width:1.05rem;height:1.15rem;" class="status-indicator bg-danger" data-toggle="tooltip" data-placement="top" title="Desconectado"></div>
<?php } ?>	
</div>	
</center>

<a href="perfil?idu=<?=$usuario['ID']?>&sec=muro">
<h5 class="mb-1 mt-1 py-1 text-dark"><?=$usuario['Username']?> 
<?php if($usuario['vmail'] != 0) {?>
<i style="color:#55acee;font-size:17px;padding-left:2px;" class="fa fa-check-circle fa-fw verified-badge" data-toggle="tooltip" data-placement="top" title="Verificado"></i>
<?php } ?>
<?php if($usuario['baneado'] != 0) {?>
<i style="color:#f2353c;font-size:17px;padding-left:2px;" class="fa fa-times-circle fa-fw verified-badge" data-toggle="tooltip" data-placement="top" title="Baneado"></i>
<?php } ?>
<?php if($usuario['vip'] != 0) {?>
<i style="color:#f1c40f;font-size:16px;padding-left:2px;" class="fa fa-jedi fa-fw verified-badge" data-toggle="tooltip" data-placement="top" title="Membresía VIP"></i>
<?php } ?>
<?php if($usuario['simp'] == 1) {?>
<i style="color:#686de0;font-size:16px;padding-left:4px;" class="fa fa-head-vr fa-fw verified-badge" data-toggle="tooltip" data-placement="top" title="Simp"></i>
<?php } ?>
</h5>
</a>

<?php include "funciones/anexos/rangos.php"; ?>

<img src="estilos/img/banderas/<?=$paisx;?>.png" style="width:47px;height:27px;object-fit:cover" data-toggle="tooltip" data-placement="top" title="<?php echo(getCountryFromIP($usuario['IP'], "name"));?>">

</div>
</div>

<?php } ?>

</div>
</div>

<br>

<!-- PAGINACIÓN -->
<ul style="justify-content: center;" class="pagination">
<?php
$page_query = "SELECT * FROM pcu_seguidores WHERE seguido = '$id' ORDER BY seguido DESC";
$page_result = mysqli_query($con, $page_query);

$sql = "SELECT * FROM pcu_seguidores WHERE seguido = '$id'";
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
<li><a class='page-link' style='border-radius:1px;color:#fff;background:#1d68f1;border:0px' href='perfil?idu=".$_GET['idu']."&perfil=seguidores&pagina=".($pagina - 1)."'>Anterior</a></li>
";
}
if($pagina <= $end_loop)
{
echo "
<li><a class='page-link' style='border-radius:1px;color:#fff;background:#1d68f1;border:0px' href='perfil?idu=".$_GET['idu']."&perfil=seguidores&pagina=".($pagina + 1)."'>Siguiente</a></li>
";
}
}
} else {
echo '</div></div><h5 style="color:#93a3b2;text-align:center;margin-top:120px !important;margin:auto;width:100%;margin-bottom:200px">No tiene seguidores</h5>';
}
?>  
</ul>