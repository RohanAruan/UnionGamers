<?php 
$link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$todo = htmlspecialchars('https://', $link, ENT_QUOTES, 'UTF-8');
?>
<div class="col-lg-3">

<!-- MENÚ --
<div class="card my-4">
<h6 style="padding: .45rem 0.60rem;background:white;letter-spacing: 1px;text-transform:uppercase;font-size:11px;border:0px" class="card-header">Menú</h6>
<div class="card-body">

</div>
</div>
<!-- FIN -->

<!-- TOP'S -->

<!-- FIN -->

<!-- BUSCAR --
<form style="box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;border-radius:1px" class="d-none d-sm-inline-block form-inline mr-auto my-4 navbar-search">
<div class="input-group">
<input type="text" style="border-radius:2px" class="form-control shadow-none border-0" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2">
<div class="input-group-append">
<button class="btn btn-info" style="border-radius:2px" type="button">
<i style="font-size:15px" class="far fa-search"></i>
</button>
</div>
</div>
</form>
<!-- FIN -->

<!-- PUBLICACIONES --
<div class="card my-4">
<h6 style="padding: .45rem 0.60rem;background:white;letter-spacing: 1px;text-transform:uppercase;font-size:11px;border:0px" class="card-header">Últimos post</h6>
<div style="margin-top:-5px;padding: 5px 1.25rem;" class="card-body">
<div class="row">

<?php
$query = "SELECT * FROM entradas,categorias WHERE id = entrada_categoria AND entrada_publica = '1' ORDER BY entrada_id LIMIT 12";
$result = mysqli_query($con, $query);
?>
<?php
while($entrada = mysqli_fetch_array($result)){	
?>  
<a href="#">
<span style="font-size:14px;background:#f7f7f7;font-weight:600;padding:0px 6px;margin-bottom:2px;"><i style="font-size:14px;color:#1d68f1" class="fas fa-file-alt"></i> <?=$entrada['entrada_autor']?> subió <?=$entrada['entrada_titulo']?></span>
</a>
<?php
}
?>

</div>
</div>
</div>
<!-- FIN -->

<!-- COMENTARIOS --
<div class="card my-4">
<h6 style="padding: .45rem 0.60rem;background:white;letter-spacing: 1px;text-transform:uppercase;font-size:11px;border:0px" class="card-header">Últimos comentarios</h6>
<div style="margin-top:-5px;padding: 5px 1.25rem;" class="card-body">
<div class="row">

<?php
$query = "SELECT * FROM entradas,categorias WHERE id = entrada_categoria AND entrada_publica = '1' ORDER BY entrada_id LIMIT 12";
$result = mysqli_query($con, $query);
?>
<?php
while($entrada = mysqli_fetch_array($result)){	
?>  
<a href="#">
<span style="font-size:14px;background:#f7f7f7;padding:0px 6px;font-weight:600;margin-bottom:2px;width:100%"><i style="font-size:12px;color:#1d68f1" class="fas fa-comment"></i> <?=$entrada['entrada_autor']?> comentó en <?=$entrada['entrada_titulo']?></span>
</a>
<?php
}
?>

</div>
</div>
</div>
<!-- FIN -->

<!--
<div class="d-flex align-item-center title mb-3 mt-5">
<h5 class="m-0 font-weight-normal">Related News
</h5>
<div class="ml-auto d-flex align-items-center">
<div class="dropdown ml-2">
<button class="btn btn-sm btn-outline-dark">
View All
</button>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<div class="osahan-card">
<a href="news-single.html">
<img class="img-fluid" src="https://askbootstrap.com/preview/jarda/light/img/slider/2.png" alt="">
<div class="bg-primary text-center p-1 text-white">Puzzle</div>
<div class="osahan-card-body mt-3">
<h6 class="text-dark mb-1">Skaters Added to Star-Studded Tony Hawk’s™ Pro Skater™</h6>
<p class="m-0 text-muted"><i class="feather-user text-muted"></i> Mandeep Games • 23h ago</p>
</div>
</a>
</div>
</div>
<div class="col-lg-12">
<div class="osahan-card">
<a href="news-single.html">
<img class="img-fluid" src="https://askbootstrap.com/preview/jarda/light/img/slider/5.jpg" alt="">
<div class="bg-primary text-center p-1 text-white">Free Now</div>
<div class="osahan-card-body mt-3">
<h6 class="text-dark mb-1">Pre-Order Surgeon Simulator 2 Now for Closed Beta Access & Exclusive Content</h6>
<p class="m-0 text-muted"><i class="feather-user text-muted"></i> Mandeep Games • 23h ago</p>
</div>
</a>
</div>
</div>
<div class="col-lg-12">
<div class="osahan-card">
<a href="news-single.html">
<img class="img-fluid" src="https://askbootstrap.com/preview/jarda/light/img/slider/1.jpg" alt="">
<div class="bg-primary text-center p-1 text-white">Free Now</div>
<div class="osahan-card-body mt-3">
<h6 class="text-dark mb-1">Simulator 2 Now for Closed Beta Access & Exclusive Content</h6>
<p class="m-0 text-muted"><i class="feather-user text-muted"></i> Mandeep Games • 23h ago</p>
</div>
</a>
</div>
</div>
</div>
-->

</div>
<!-- FIN -->
