<?php 
$sqlRoles = mysqli_query($con, "SELECT * FROM aor_roles WHERE id = '$rol'");
$roles = mysqli_fetch_array($sqlRoles);
$idrango = $roles['id'];   	
?>

<?php if($idrango == 7 && $typerankx == 1) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$roles['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$roles['nombre']?></span>
<?php } elseif($idrango == 7 && $typerankx == 2) { ?>
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:#822727 !important;border:0px;font-weight:100" class="badge badge-primary">Programador</span>	
<?php } ?>

<?php if($idrango == 6) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$roles['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$roles['nombre']?></span>
<?php } ?>

<?php if($idrango == 5) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$roles['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$roles['nombre']?></span>
<?php } ?>

<?php if($idrango == 4) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$roles['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$roles['nombre']?></span>
<?php } ?>

<?php if($idrango == 3) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$roles['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$roles['nombre']?></span>
<?php } ?>

<?php if($idrango == 2) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$roles['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$roles['nombre']?></span>
<?php } ?>

<?php if($idrango == 1) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$roles['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$roles['nombre']?></span>
<?php } ?>

<?php if($idrango == 0) { ?> 
<?php }?>