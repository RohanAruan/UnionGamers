<?php
$id = mysqli_real_escape_string($con, $_GET['id']);
?>

<center>
<?php
$fotosa = mysqli_query($con, "SELECT * FROM albumes WHERE usuario = '$id' ORDER BY id_alb asc");
while($fot=mysqli_fetch_array($fotosa))
{
$fotalb = mysqli_query($con, "SELECT ruta FROM fotos WHERE album = '$fot[id_alb]' ORDER BY id_fot DESC");
$fotal = mysqli_fetch_array($fotalb);
?>
<a href="?id=<?php echo $id;?>&album=<?php echo $fot[id_alb]; ?>&perfil=albumes"><img style="object-fit:cover;" src="estilos/img/<?php echo $fotal['ruta'];?>" width="19%"> </a>
<br>
<?php echo $fot['nombre']; ?>
<?php
}
?>
</center>