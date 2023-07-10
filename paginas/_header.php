<?php 
$link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$todo = htmlspecialchars('https://', $link, ENT_QUOTES, 'UTF-8');
?>
<link data-n-head="true" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<body>

<!-- MENÚ 2 -->
<div class="loading-bar"></div>

<!-- MENÚ -->
<nav style="height:52px;box-shadow: 0 1px 2px rgb(0 0 0 / 10%);background:#185ADB !important" class="navbar navbar-expand navbar-dark bg-<?=$tema?> osahan-nav-top p-0 px-2">
<div style="max-width:1210px;" class="container">

<!--
<div class="dropdown">
<a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i style="font-size:22px;color:#e8e8e8ba;margin-left:14px;" class="far fa-ellipsis-v" data-toggle="tooltip" data-placement="bottom" title="Menú"></i>	
<div style="margin-top:10px	" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
<a class="dropdown-item" href="#"><i style="color:#1d68f1" class="fas fa-question-circle mr-1"></i> FAQ</a>
<a class="dropdown-item" href="#"><i style="color:#1d68f1" class="fas fa-bug mr-1"></i> Soporte</a>
<a class="dropdown-item" href="#"><i style="color:#1d68f1" class="fas fa-user-circle mr-1"></i> ¿Quiénes somos?</a>
</div>
</a>	
</div>
-->

<a id="alert" class="navbar-brand mr-4" href="<?=$todo?>/index">
<img style="width:61px;height:auto;margin-top:-1px;margin-left:5px;" src="<?=$todo?>/estilos/img/logo.png" alt="">
</a>

<!-- FIN -->

<ul class="navbar-nav mr-auto d-flex align-items-center">

<!-- BUSCAR -->
<li class="nav-item no-arrow mr-5">
<a class="nav-link nav-icon search-open" href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Buscar">
<i style="font-size:18px" class="fal fa-search"></i>
</a>
</li>

<div class="search-inline">
<form>
<input type="text" class="form-control" placeholder="Buscar...">
<button type="submit">
<i style="font-size:18px" class="fa fa-search"></i>
</button>
<a href="javascript:void(0)" class="search-close">
<i style="font-size:20px;margin-top: 18px;" class="fal fa-times"></i>
</a>
</form>
</div>
<!-- FIN -->

<li class="nav-item mr-2">
<a class="nav-link nav-menu nav-link-new" href="foro">Foro (SAMP)</a>
</li>

<li class="nav-item dropdown mr-2">
<a class="nav-link nav-menu nav-link-new" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Herramientas
</a>

<div style="height:auto;width:185px;" class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="navbarDropdown">

<a class="dropdown-item header-menu" href="<?=$todo?>/updates">
<i style="font-size:18px;" class="fal fa-construction mr-3"></i> Actualizaciones
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>/reportes">
<i style="font-size:18px;" class="fal fa-bug mr-3"></i> Reportes
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>/s">
<i style="font-size:18px" class="fal fa-link mr-3"></i> Acortar URL
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>/muro">
<i style="font-size:18px" class="fal fa-heart mr-3"></i> Muro
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>">
<i style="font-size:18px" class="fal fa-store mr-3"></i> Tienda (OOC)
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>">
<i style="font-size:18px;" class="fal fa-bags-shopping mr-3"></i> Tienda (IC)
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>">
<i style="font-size:18px;" class="fal fa-briefcase mr-3"></i> Empleos
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>">
<i style="font-size:18px;" class="fal fa-building mr-3"></i> Empresas
</a>

<a class="dropdown-item header-menu" href="<?=$todo?>">
<i style="font-size:18px;" class="fal fa-piggy-bank mr-3"></i> Bancos
</a>

</div>
</li>

</ul>

<ul class="navbar-nav ml-auto d-flex align-items-center">


<!-- BUSCAR MOVIL --
<li class="nav-item dropdown no-arrow d-sm-none">
<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="feather-search mr-2"></i>
</a>
<div class="dropdown-menu dropdown-menu-right p-3 shadow-sm animated--grow-in" aria-labelledby="searchDropdown">
<form class="form-inline mr-auto w-100 navbar-search" accept-charset="UTF-8" method="POST" action="buscar">
<div class="input-group">
<input type="text" name='PalabraClave' id="search" class="form-control border-0 shadow-none" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2">
<div class="input-group-append">
<button class="btn" type="submit">
<i class="feather-search"></i>
</button>
</div>
</div>
</form>
</div>
</li>
<!-- FIN -->

<!-- CREAR POST --
<li class="nav-item no-arrow mx-1">
<a class="nav-link" href="crear" data-toggle="tooltip" data-placement="bottom" title="Crear Post">
<i style="color:#c6c6c6;font-size:18px" class="fad fa-layer-plus"></i>
</a>
</li>
<!-- FIN -->


<!-- USUARIO -->
<li class="nav-item no-arrow ml-1 mr-2">
<a class="btn nav-link-new" href="<?=$todo?>/login">
Ingresar
</a>
</li>

<li class="nav-item no-arrow ml-1 mr-2">
<a class="btn btn-light" style="border-radius:2px;" href="<?=$todo?>/registro">
<i class="fal fa-sign-out mr-1"></i> Crear cuenta
</a>
</li>

<!-----
<li class="nav-item no-arrow ml-1 mr-1">
<a class="nav-link pr-0" role="button" id="Cuenta" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span class="pr-0 mr-2" style="font-weight:400"><?php $quitargion=str_replace("_"," ",$usuario); echo(''.$quitargion.'') ?></span> <span><i style="font-size:9px" class="fal fa-chevron-down"></i></span>
</a>
</li>
<!---->

<!--
<li class="nav-item dropdown mr-2">
<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i style="font-size:19px" class="fal fa-stream"></i>
</a>

<div style="height:auto;" class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="navbarDropdown">

<a class="dropdown-item header-menu" type="button" id="fullscr">
<i style="font-size:15px" class="fal fa-expand mr-3"></i> Pantalla completa
</a>

<a class="dropdown-item header-menu" type="button" id="fullscr">
<i style="font-size:15px" class="fal fa-tools mr-3"></i> Fallos del panel
</a>

<div class="dropdown-divider"></div>

<a class="dropdown-item header-menu" type="button" id="fullscr">
<i style="font-size:15px" class="fal fa-wrench mr-3"></i> Sugerencias técnicas
</a>

</div>
</li>
-->

</ul>
</div>
</nav>

<section>
<div style="max-width: 1201px;" class="container">