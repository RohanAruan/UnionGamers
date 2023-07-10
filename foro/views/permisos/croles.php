<?php 
$sqlRoles = mysqli_query($con, "SELECT * FROM aor_roles WHERE id = '$rol'");
$roles = mysqli_fetch_array($sqlRoles);
$idrango = $roles['id'];   	
?>

<?php if($idrango == 7 && $typerankx == 1) { ?> 
<?=$roles['color'];?>
<?php } elseif($idrango == 7 && $typerankx == 2) { ?>
#822727
<?php } ?>

<?php if($idrango == 6) { ?> 
<?=$roles['color'];?>
<?php } ?>

<?php if($idrango == 5) { ?> 
<?=$roles['color'];?>
<?php } ?>

<?php if($idrango == 4) { ?> 
<?=$roles['color'];?>
<?php } ?>

<?php if($idrango == 3) { ?> 
<?=$roles['color'];?>
<?php } ?>

<?php if($idrango == 2) { ?> 
<?=$roles['color'];?>
<?php } ?>

<?php if($idrango == 1) { ?> 
<?=$roles['color'];?>
<?php } ?>

<?php if($idrango == 0) { ?> 
#000
<?php }?>