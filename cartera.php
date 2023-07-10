<?php
include 'funciones/lib.php';

if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == $iduser) { } else { header("Location: ".$todo."/salir"); exit; }

$pags = $_GET['pag'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Cartera</title>
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
<div class="row">				 

<?php include "paginas/_lateralu.php"; ?>


<!-- FIN -->
<div class="tab-content">

<!-- CARTERA -->
<div class="tab-pane fade <?=$pags == 'c' ? 'show active' : ''; ?>">

<!-- TITULO -->
<div class="d-flex align-item-center title mb-3">
<h4 style="font-weight:600" class="m-0">Cartera</h4>
</div>
<!-- FIN -->	

<div style="border-radius:4px;margin-bottom:20px;" class="p-4 bg-white">	

<div class="row gutter-1">

<div class="col-md-6">
<div style="text-align:center;" class="form-group"> 
<label style="font-size:14px;text-transform:uppercase;font-weight:600;" class="d-block"><img style="width:20px;height:20px;" class="mr-1" src="<?=$todo?>/estilos/img/ac.png" data-toggle="tooltip" data-placement="bottom" title="Age Coin"> Age Coins</label>

<div class="mb-2">

<?php if($monedas > 0) { ?>

<span style="font-size:30px"><?php echo number_format($monedas);?></span>

<?php } else { ?>

<div class="mb-4 mt-4">
<span style="font-size:15px;color:#93a3b2;text-align:center;">¡No tienes AC!</span>
</div>

<?php } ?>

</div>
</div>

<a href="<?=$todo?>/cartera/historial/1" class="btn btn-light btn-block">Historial</a>

</div>

<div class="col-md-6">
<a class="btn btn-light btn-block" style="float:right" href="<?=$todo?>/tiendaac">Comprar <i class="fal fa-coins ml-2"></i> </a>
<a class="btn btn-light btn-block" style="float:right" href="<?=$todo?>/#">Vender </a>
<a class="btn btn-info btn-block" style="float:right" href="<?=$todo?>/cartera/envios">Transferir <i class="fal fa-sync ml-2"></i></a>
</div>

</div>

</div>
</div>
<!-- FIN -->


<!-- ENVIOS -->
<div class="tab-pane fade <?=$pags == 'envios' ? 'show active' : ''; ?>">
<form role="form" method="post" action="" enctype="multipart/form-data">

<!-- TITULO -->
<div class="d-flex align-item-center title mb-3">
<h4 style="font-weight:600" class="m-0">Envios</h4>
</div>
<!-- FIN -->

<?php
function validarCadenaCoins($cadena)
{ 
if(strlen($cadena) < 1 || strlen($cadena) > 34)
{ 
return false; 
} 
$permitidos = "1234567890"; 
for ($i=0; $i<strlen($cadena); $i++)
{
if (strpos($permitidos, substr($cadena,$i,1))===false)
{
return false; 
}
}
return true; 
}
?>

<?php
if(isset($_POST['enviar']))
{
$recibidor = secureData(mysqli_real_escape_string($con, $_POST['recibidor']));
$moneda = secureData(mysqli_real_escape_string($con, $_POST['moneda']));

if($recibidor != $usuario){

if($moneda <= $monedas){ 

$comprobar = mysqli_num_rows(mysqli_query($con, "SELECT * FROM usuarios WHERE Username = '$recibidor'"));
if($comprobar != $recibidor){

if(validarCadenaUsuario($recibidor) == true && validarCadenaCoins($moneda) == true){    	

$sql1 = mysqli_query($con, "INSERT INTO pcu_historialac (usuarioe, usuarior, tipo, ac, fecha, hora) VALUES ('$usuario', '$recibidor', '0', '$moneda', '$fecha', '$hora')");

$sql2 = mysqli_query($con, "INSERT INTO pcu_historialac (usuarior, usuarioe, tipo, ac, fecha, hora) VALUES ('$usuario', '$recibidor', '1', '$moneda', '$fecha', '$hora')");

$sqle = mysqli_query($con, "UPDATE usuarios SET monedas = $monedas-$moneda WHERE ID = '{$_SESSION['usuario']}'");

$sql = mysqli_query($con, "UPDATE usuarios SET monedas=monedas+$moneda WHERE Username = '$recibidor'");

$insertn = mysqli_query($con, "INSERT INTO pcu_notificaciones (user1, user2, tipo, leido, fecha, hora) VALUES ('".$usuario."', '".$recibidor."', 'te ha enviado ".$moneda." AC', '0', '".$fecha."', '".$hora."')");

if($sql && $sqle && $sql1 && $sql2) 
{
echo "<script>Swal.fire({title: 'La transferencia se realizó con éxito',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {
window.location = '".$todo."/cartera/envios';});</script>";
}

} else {echo "<script>Swal.fire({title: 'Caracteres inválidos',icon: 'error',timer: 2500,showConfirmButton: false})</script>";}

} else {echo "<script>Swal.fire({title: '¡El usuario no existe!',icon: 'error',timer: 2500,showConfirmButton: false})</script>";}

} else {echo "<script>Swal.fire({title: '¡No tienes suficientes monedas!',icon: 'error',timer: 2500,showConfirmButton: false})</script>";}

} else {echo "<script>Swal.fire({title: '¡No puedes enviarte monedas a ti mismo!',icon: 'warning',timer: 2500,showConfirmButton: false})</script>";}

}
?>

<div style="border-radius:4px;margin-bottom:20px" class="p-4 bg-white">

<div class="row gutter-1">

<div class="col-md-7">

<div class="form-group"> 
<label for="username"><h6>Usuario (PCU)</h6></label> 
<input type="text" name="recibidor" class="for-control" required> 
</div>

<div class="form-group"> 
<label for="cardNumber"><h6>Cantidad</h6></label>
<div class="input-group"> 
<input type="number" name="moneda" class="for-control" min="1" required>
</div>
</div>

<div class="form-group"> 
<small class="text-muted">Tienes <img style="width:16px;height:16px;" class="mr-1" src="<?=$todo?>/estilos/img/ac.png" data-toggle="tooltip" data-placement="bottom" title="Age Coin"><span style="font-size:14px"><?php echo number_format($monedas);?></span> disponibles para enviar</small>
</div>

<button type="submit" name="enviar" id="load1" data-loading-text="<i class='fal fa-sync fa-spin ml-2'></i> Transfiriendo" class="btn btn-info">Transferir <span class="transferir"><i class="fal fa-sync ml-2 transferir"></i></span></button>

</div>

</div>
</center>

</div>

</form>
</div>
<!-- FIN -->


<!-- HISTORIAL -->
<div class="tab-pane fade <?=$pags == 'historial' ? 'show active' : ''; ?>">

<!-- TITULO -->
<div style="justify-content: space-between;" class="d-flex align-item-center title mb-3">
<h4 style="font-weight:600" class="m-0">Historial de pagos</h4>

<?php
$sql = "SELECT * FROM pcu_historialac WHERE id = id AND usuarioe = '$usuario'";
$rows = $con->query($sql);
$res = mysqli_num_rows($rows);

if($res > 0) { 
?>

<div class="btn btn-sm" style="float:right;border-radius:3px;border: 1px solid rgba(0,0,0,.125);"><?php if($res > 1) { echo ''.$res.' transacciones'; } else { echo ''.$res.' transacción'; } ?></div>
<?php } ?>

</div>
<!-- FIN -->	

<div style="border-radius:4px" class="p-3 bg-white">

<div class="row gutter-1">

<div class="col-md-12">
<div class="form-group mb-0"> 

<div style="border-radius:2px;" class="border border-gray-500 bg-gray-200 font-size-sm">

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

$query = "SELECT * FROM pcu_historialac WHERE usuarioe = '$usuario' ORDER BY id DESC, fecha ASC LIMIT $start_from, $record_per_page";
$result = mysqli_query($con, $query);

$queryx = mysqli_query($con, "SELECT * FROM pcu_historialac WHERE usuarioe = '$usuario' ORDER BY fecha DESC");
$res = mysqli_fetch_array($queryx); 
$autor = $res['usuarioe'];

if($autor == $usuario) {
?>

<table class="table">
<thead>
<tr>
<th scope="col">Transacción ID</th>
<th scope="col">Destinatario</th>
<th scope="col">Cantidad</th>
<th scope="col">Fecha</th>
</tr>
</thead>
<tbody>

<?php
while($row = mysqli_fetch_array($result)) {	 	
$usuarioe = $row['usuarioe'];
$usuarior = $row['usuarior'];
$tipo = $row['tipo'];

$fechap = $row["fecha"];	
$fecha = strftime("%d %b %Y", strtotime($fechap));

$sqlA = mysqli_query($con, "SELECT * FROM usuarios WHERE Username = '$usuarioe'");
$usuario1 = mysqli_fetch_array($sqlA);   	

$sqlB = mysqli_query($con, "SELECT * FROM usuarios WHERE Username = '$usuarior'");
$usuario2 = mysqli_fetch_array($sqlB);  
?> 

<tr>
<th scope="row">AORAC-<?=$row['id']?></th>
<td><img class="rounded-circle mr-1" style="width: 23px;height: 23px;object-fit:cover;" src="<?=$todo?>/estilos/img/avatars/<?=$usuario2['avatar']?>?nocache=<?=$versiones?>" alt="" data-toggle="tooltip" data-placement="bottom" title="<?=$usuario2['Username']?>"> 

<?php if($tipo == 0) {?> <?=$usuario2['Username']?> <?php } ?>
<?php if($tipo == 1) {?> <?=$usuario2['Username']?> <?php } ?>
<?php if($tipo == 2) {?> <?=$usuario2['Username']?> <?php } ?>

<small class="text-muted ml-1">(<?php if($tipo == 0) { echo 'Pago enviado'; }?><?php if($tipo == 1) { echo 'Pago recibido'; } ?><?php if($tipo == 2) { echo'Pago completado'; } ?>)</small></td>

<?php if($tipo == 0) { echo '<td class="text-danger">-'; } ?><?php if($tipo == 1) { echo '<td class="text-success">+'; } ?> <?php if($tipo == 2) { echo '<td class="text-success">+'; } ?> <?php echo number_format($row['ac']);?> AC</td>
<td><?=$fecha?></td>
</tr>

<?php } ?>

</tbody>
</table>

<?php } else { ?>

<h5 class="p-3" style="text-align:center;">No se ha realizado ningún pago.</h5>

<?php } ?>

</div>

<?php
$page_query = "SELECT * FROM pcu_historialac WHERE id = id AND usuarioe = '$usuario' ORDER BY fecha DESC";
$page_result = mysqli_query($con, $page_query);

$sql = "SELECT * FROM pcu_historialac WHERE id = id AND usuarioe = '$usuario'";
$rows = $con->query($sql);
$res = mysqli_num_rows($rows);

if($res > 10) { 
?>

<br>

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
<li><a class='page-link' style='border-radius:1px;color:#fff;background:#4825f5;border:0px' href='".$todo."/cartera/".$pags."/".($p - 1)."'>Anterior</a></li>
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
<li><a class='page-link' style='border-radius:1px;color:#fff;background:#4825f5;border:0px' href='".$todo."/cartera/".$pags."/".($p + 1)."'>Siguiente</a></li>
";
}
?>

</ul>

<?php } ?>

</div>

</div>
</div>
</div>

</div>
<!-- FIN -->


</div>


<!--
<div class="text-right mt-4">
<a href="opciones" class="btn btn-link">Cancelar</a>	
<button style="border-radius: .25rem;" type="submit" name="actualizar" class="btn btn-info mr-1">Actualizar perfil</button>
</div>
-->

</div>
<!-- FIN -->

</div>
<!-- FIN -->

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</div>
</section>

<script>
const span = document.querySelector('.transferir')
span.addEventListener('click', () => {
span.classList.remove('animate')
setTimeout(() => span.classList.add('animate'), 100)
})
</script>

</body>
</html>
