<?php
$noticia = mysqli_query($con, "SELECT * FROM entradas,categorias WHERE entrada_categoria=id");

if($_GET['post'] <> ""){
$noticias = mysqli_query($con, "SELECT * FROM entradas,categorias WHERE entrada_id = '$_GET[post]'");
if($not = mysqli_fetch_array($noticias)){
}else{
echo "
<br>
<div class='alert alert-danger' role='alert'>
<i style='top:4px;font-size:18px;' class='material-icons'>error</i><b>RR</b> | La entrada no existe!
</div>";
}
}
?>