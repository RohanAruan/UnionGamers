<?php 
$sqlRoles = mysqli_query($con, "SELECT * FROM aor_roles WHERE id = '$rango'");
$roles = mysqli_fetch_array($sqlRoles);
$idrango = $roles['id'];   	
?>

<?php if($idrango == 7 && $typerankf == 1) { ?> 
<span style="border-radius:2px;font-weight:600;padding: .25rem .3rem;background:<?=$roles['color']?> !important;border:0px;" class="btn btn-secondary btn-sm"><?=$roles['nombre']?></span>
<?php } elseif($idrango == 7 && $typerankf == 2) { ?>
<span style="border-radius:2px;font-weight:600;padding: .25rem .3rem;background:#822727 !important;border:0px;" class="btn btn-secondary btn-sm">Programador</span>	
<?php } ?>

<?php if($idrango == 6) { ?> 
<span style="border-radius:2px;font-weight:600;padding: .25rem .3rem;background:<?=$roles['color']?> !important;border:0px;" class="btn btn-secondary btn-sm"><?=$roles['nombre']?></span>
<?php } ?>

<?php if($idrango == 5) { ?> 
<span style="border-radius:2px;font-weight:600;padding: .25rem .3rem;background:<?=$roles['color']?> !important;border:0px;" class="btn btn-secondary btn-sm"><?=$roles['nombre']?></span>
<?php } ?>

<?php if($idrango == 4) { ?> 
<span style="border-radius:2px;font-weight:600;padding: .25rem .3rem;background:<?=$roles['color']?> !important;border:0px;" class="btn btn-secondary btn-sm"><?=$roles['nombre']?></span>
<?php } ?>

<?php if($idrango == 3) { ?> 
<span style="border-radius:2px;font-weight:600;padding: .25rem .3rem;background:<?=$roles['color']?> !important;border:0px;" class="btn btn-secondary btn-sm"><?=$roles['nombre']?></span>
<?php } ?>

<?php if($idrango == 2) { ?> 
<span style="border-radius:2px;font-weight:600;padding: .25rem .3rem;background:<?=$roles['color']?> !important;border:0px;" class="btn btn-secondary btn-sm"><?=$roles['nombre']?></span>
<?php } ?>

<?php if($idrango == 1) { ?> 
<span style="border-radius:2px;font-weight:600;padding: .25rem .3rem;background:<?=$roles['color']?> !important;border:0px;" class="btn btn-secondary btn-sm"><?=$roles['nombre']?></span>
<?php } ?>

<?php if($idrango == 0) { ?> 
<span style="border-radius:2px;font-weight:600;padding: .25rem .3rem;" class="btn btn-secondary btn-sm">Usuario</span>
<?php }?>