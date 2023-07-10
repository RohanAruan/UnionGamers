<?php
$sql = "SELECT * FROM aor_temas WHERE idusuario = '{$_GET['idu']}' AND tipoadm = '0'";
$rows = $con->query($sql);
$totalposts = mysqli_num_rows($rows);
?>	

<!-- TITULO -->
<div class="d-flex align-item-center title mb-3">
<h5 style="font-weight:600" class="m-0">Temas</h5>
<div class="ml-auto d-flex align-items-center">

<?php if(mysqli_num_rows($rows) > 0) { ?>
<div class="ml-2">	
<button class="btn btn-sm btn-info" style="border-radius:2px;font-weight:600" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<?=$totalposts?> temas
</button>
</div>
<?php } ?>

</div>
</div>
<!-- FIN -->

<?php
function str_limit($value, $limit = 100, $end = '...'){
if (mb_strwidth($value, 'UTF-8') <= $limit) {
return $value;
}
return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
}
?>

<div style="margin-left:5px">
<div class="row">

<?php
$record_per_page = 30;
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

$query = "SELECT * FROM aor_temas WHERE id AND idusuario = '$id' AND tipoadm = '0' ORDER BY id DESC LIMIT $start_from, $record_per_page";
$result = mysqli_query($con, $query);
?>
<?php
$query1 = mysqli_query($con, "SELECT * FROM aor_temas WHERE idusuario = '$id'");
$result1 = mysqli_fetch_array($query1);
$autor = $result1['idusuario'];

if($autor == $id) {

while($row = mysqli_fetch_array($result)) {  
$cadena = $row['nombre'];	
$idusuario = $row['idusuario'];	

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE ID = '$idusuario'");
$usuario = mysqli_fetch_array($sqlA);     
?>

<div style="width:184.80px;margin-bottom:15px;margin-left:9px;border-radius:2px;" class="osahan-card">
<div class="sombra">
<a href="foro/showtopic?s=<?=$row['id']?>-<?=$row['nombre']?>">
<div style="background:#1d68f1 !important;font-weight:600;margin-bottom:1px;border-radius: .25rem;" class="bg-info col text-center p-1 text-white small"><?= str_limit($cadena, 27, "..") ?></div>
</a>

<div style="border-radius: .25rem;" class="bg-white col text-center p-1 text-dark small">
<a style="color:#000" href="perfil?idu=<?=$usuario['ID']?>&sec=muro">	
<img style="width:15px;height:15px;border-radius:50%;object-fit:cover" src="estilos/img/avatars/<?=$usuario['avatar']?>" data-toggle="tooltip" data-placement="top" title="Perfil"> <?=$usuario['Username']?>
</a>
</div>

</div>
</div>

<?php } ?>

</div>
</div>

<br>

<!-- PAGINACIÓN -->
<ul style="justify-content: center;" class="pagination">
<?php
$page_query = "SELECT * FROM aor_temas WHERE idusuario = '$id' AND tipoadm = '0' ORDER BY id DESC";
$page_result = mysqli_query($con, $page_query);

$sql = "SELECT * FROM aor_temas WHERE idusuario = '{$_GET['idu']}'";
$rows = $con->query($sql);
$pagin = mysqli_num_rows($rows);

if($pagin > 30) { 

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
<li><a class='page-link' style='border-radius:1px;color:#fff;background:#1d68f1;border:0px' href='perfil?idu=".$_GET['id']."&perfil=posts&pagina=".($pagina - 1)."'>Anterior</a></li>
";
}
if($pagina <= $end_loop)
{
echo "
<li><a class='page-link' style='border-radius:1px;color:#fff;background:#1d68f1;border:0px' href='perfil?idu=".$_GET['id']."&perfil=posts&pagina=".($pagina + 1)."'>Siguiente</a></li>
";
}
}
} else {
echo '</div></div><h5 style="color:#93a3b2;text-align:center;margin-top:120px !important;margin:auto;width:100%;margin-bottom:200px">No tiene temas</h5>';
}
?>  
</ul>