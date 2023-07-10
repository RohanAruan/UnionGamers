<?php 
$sqlFacciones = mysqli_query($con, "SELECT * FROM factions WHERE factionID = '$faction'");
$facciones = mysqli_fetch_array($sqlFacciones);	
?>

<span style="width:100%;margin-bottom:0.50px;border-radius:2px;border:0px;font-weight:100;background: #<?=$facciones['factionColorP']?> !important" class="badge badge-primary"><?=$facciones['factionName']?></span>

<?php if($idmiembro == 15) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank15']?></span>
<?php } ?>

<?php if($idmiembro == 14) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank14']?></span>
<?php } ?>

<?php if($idmiembro == 13) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank13']?></span>
<?php } ?>

<?php if($idmiembro == 12) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank12']?></span>
<?php } ?>

<?php if($idmiembro == 11) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank11']?></span>
<?php } ?>

<?php if($idmiembro == 10) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank10']?></span>
<?php } ?>

<?php if($idmiembro == 9) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank9']?></span>
<?php } ?>

<?php if($idmiembro == 8) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank8']?></span>
<?php } ?>

<?php if($idmiembro == 7) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank7']?></span>
<?php } ?>

<?php if($idmiembro == 6) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank6']?></span>
<?php } ?>

<?php if($idmiembro == 5) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank5']?></span>
<?php } ?>

<?php if($idmiembro == 4) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank4']?></span>
<?php } ?>

<?php if($idmiembro == 3) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank3']?></span>
<?php } ?>

<?php if($idmiembro == 2) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank2']?></span>
<?php } ?>

<?php if($idmiembro == 1) { ?> 
<span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:<?=$facciones['color']?> !important;border:0px;font-weight:100" class="badge badge-primary"><?=$facciones['factionRank1']?></span>
<?php } ?>

<?php if($idmiembro == 0) { ?> 
<?php }?>
