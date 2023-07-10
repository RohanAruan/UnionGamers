<?php
include 'funciones/lib.php';

if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == $iduser) { } else { header("Location: ".$todo."/salir"); exit; }

$pag = $_GET['sec'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title><?=$Susuario;?> | AOR</title>
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

<!-- MENÚ LATERAL -->
<div style="padding-left:0px" class="col-lg-12 mb-2">
<div style="border-radius:4px;" class="box box-widget widget-user">
<img src="<?=$todo?>/estilos/img/4.jpeg" style="object-fit:cover;width:100%;height:109px;" class="widget-user-header">

<div style="top: 64px;" class="widget-user-image">
<img class="img-profile rounded-circle" style="object-fit:cover;width:90px;height:90px;" src="<?=$todo?>/estilos/img/skins/<?=$Sropa?>.jpg?nocache=<?=$versiones?>">
<?php if($user_online != 1) {?>
<div style="top: 67px;right: 9px;" class="status-indicator bg-success" data-toggle="tooltip" data-placement="top" title="Conectado"></div>
<?php } else if($user_online != 0) { ?>
<div style="top: 67px;right: 9px;" class="status-indicator bg-danger" data-toggle="tooltip" data-placement="top" title="Desconectado"></div>
<?php } ?>	
</div>

<div class="box-footer">
<div class="row">

<div class="col-sm-12">
<div class="description-block">
<h5 style="font-weight: 700;font-size:18px;" class="description-header mb-2"><?php $quitargion=str_replace("_"," ",$Susuario); echo(''.$quitargion.'');?>
</h5>

<div style="float:right;margin-top:-109px;margin-right:-25px">

<button type="submit" style="border-radius:50%;margin-top:5px;font-weight:600;width:50px;height:50px;font-size:17px;" class="btn btn-info btn-sm" name="dejarseguir" data-toggle="tooltip" data-placement="top" title="Configuración"><i style="top:5px" class="fa fa-cog"></i></button>

<div style="margin-bottom:5px"></div>
<a href="mensajes?usuario='.$id.'" style="border-radius:50%;font-weight:600;width:50px;height:50px;padding:0.80rem 0.5rem;font-size:18px;" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Sanciones"><i class="fa fa-ban"></i></a>

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

<a class="nav-link nav-sub <?=$pag == 'cuenta' ? 'active' : ''; ?>" href="?sec=cuenta">
<i class="far fa-user mr-1 icon <?=$pag == 'cuenta' ? 'active11' : 'active12'; ?>"></i> Cuenta</a>

<a class="nav-link nav-sub <?=$pag == 'propiedades' ? 'active' : ''; ?>" href="?sec=propiedades">
<i class="far fa-building mr-1 icon <?=$pag == 'propiedades' ? 'active11' : 'active12'; ?>"></i> Propiedades</a>

<a class="nav-link nav-sub <?=$pag == 'faccion' ? 'active' : ''; ?>" href="?sec=faccion">
<i class="far fa-user-tie mr-1 icon <?=$pag == 'faccion' ? 'active11' : 'active12'; ?>"></i> Facción</a>

<a class="nav-link nav-sub <?=$pag == 'banco' ? 'active' : ''; ?>" href="?sec=banco">
<i class="far fa-university mr-1 icon <?=$pag == 'banco' ? 'active11' : 'active12'; ?>"></i> Banco</a>

<a class="nav-link nav-sub <?=$pag == 'nombre' ? 'active' : ''; ?>" href="?sec=nombre">
<i class="far fa-signature mr-1 icon <?=$pag == 'nombre' ? 'active11' : 'active12'; ?>"></i> Nombre</a>

<a class="nav-link nav-sub <?=$pag == 'transaccciones' ? 'active' : ''; ?>" href="?sec=transacciones">
<i class="far fa-receipt mr-1 icon <?=$pag == 'transaccciones' ? 'active11' : 'active12'; ?>"></i> Transacciones</a>

</div>
</div>

</div>
<!-- FIN -->

<!-- PÁGINAS ANEXADAS -->
<div class="col-lg-9">

<div class="tab-content">
<div class="tab-pane fade <?=$pag == 'cuenta' ? 'show active' : ''; ?>">
<?php include "paginas/personaje/cuenta.php"; ?>
</div>
<div class="tab-pane fade <?=$pag == 'propiedades' ? 'show active' : ''; ?>">
<?php include "paginas/personaje/propiedades.php"; ?>	
</div>
<div class="tab-pane fade <?=$pag == 'faccion' ? 'show active' : ''; ?>">
<?php include "paginas/personaje/faccion.php"; ?>	
</div>
<div class="tab-pane fade <?=$pag == 'banco' ? 'show active' : ''; ?>">
<?php include "paginas/personaje/banco.php"; ?>	
</div>
<div class="tab-pane fade <?=$pag == 'nombre' ? 'show active' : ''; ?>">
<?php include "paginas/personaje/nombre.php"; ?>	
</div>
<div class="tab-pane fade <?=$pag == 'transacciones' ? 'show active' : ''; ?>">
<?php include "paginas/personaje/transaccciones.php"; ?>	
</div>
</div>

</div>
<!-- FIN -->

</div>
<!-- FIN -->

<!-- FOOTER -->
<?php include "paginas/_footer.php"; ?>

</div>
</section>

<script type="text/javascript" src="estilos/js/likes.js"></script>

</body>
</html>
