<style>
.language_selector {
width: 300px;
background-color: #fff;
color: #495057;
line-height: 25px;
border: 1px solid #ced4da;
font-size: 14px;
padding: 0 10px;
cursor: pointer;
border-radius: 2px;
padding: .375rem .75rem;
font-size: 1rem;
font-weight: 400;
line-height: 1.5;
}

.languages {
display: none;
position: absolute;
margin: 0;
background: #fff;
width: 300px;
}

.languages > li {
width: auto;
background: #fff;
line-height: 25px;
font-size: 14px;
padding: 0 10px;
cursor: pointer;
}

.languages > li:hover {
background: #aaa;
}
</style>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Mover tema</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">

<div class="form-group">
<label for="exampleFormControlSelect1">Foros</label>

<br>

<form action="" method="POST">

<div style="text-align:left;" class="language_selector">Mover A</div>

<ul style="overflow: auto; height:400px;" name="foro" class="languages">

<?php
$sqlA = mysqli_query($con, "SELECT * FROM aor_categorias WHERE id");
while($categoria = $sqlA->fetch_array()) {
$idcat = $categoria['id'];	
?>

<li style="font-weight:bold;"><?=$categoria['nombre']?></li>

<?php  
$forosx = $con->query("SELECT * FROM aor_foros WHERE idforo = '0' AND idcategoria = '$idcat'");

while($foros = $forosx->fetch_array()) {

$idforo = $foros['id'];
$tipo = $foros['tipo'];
?>

<li style="" data-value="<?=$foros['id']?>" onclick="window.location.href='views/showtopic/mover?s=<?=$_GET[s]?>&idf=<?=$foros['id']?>'"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> <?=$foros['nombre']?></li>

<?php
$subforosx = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo'");
while($sforos = $subforosx->fetch_array()) {
$idforo0 = $sforos['id'];
?>

<li style="margin-left:10px;" onclick="window.location.href='views/showtopic/mover?s=<?=$_GET[s]?>&idf=<?=$sforos['id']?>'"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> <?=$sforos['nombre']?></li>

<?php
$subforosx0 = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo0'");
while($sforos0 = $subforosx0->fetch_array()) {
$idforo1 = $sforos0['id'];
?>

<li style="margin-left:25px;" onclick="window.location.href='views/showtopic/mover?s=<?=$_GET[s]?>&idf=<?=$sforos0['id']?>'"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> <?=$sforos0['nombre']?></li>

<?php
$subforosx1 = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo1'");
while($sforos1 = $subforosx1->fetch_array()) {
$idforo2 = $sforos1['id'];
?>

<li style="margin-left:40px;" onclick="window.location.href='views/showtopic/mover?s=<?=$_GET[s]?>&idf=<?=$sforos1['id']?>'"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> <?=$sforos1['nombre']?></li>

<?php
$subforosx2 = $con->query("SELECT * FROM aor_foros WHERE idforo = '$idforo2'");
while($sforos2 = $subforosx2->fetch_array()) {
$idforo3 = $sforos2['id'];
?>

<li style="margin-left:55px;" onclick="window.location.href='views/showtopic/mover?s=<?=$_GET[s]?>&idf=<?=$sforos2['id']?>'"><span><img style="margin-top: 7px;margin-right: 3px;" src="img/separador.png"></span> <?=$sforos2['nombre']?></li>

<?php } ?>

<?php } ?>

<?php } ?>

<?php } ?>

<?php } ?>

<?php } ?>

</ul>

</div>
</div>

</form>

</div>
</div>
</div>

<script>
var trigger = $('.language_selector');
var list = $('.languages');

trigger.click(function() {
trigger.toggleClass('active');
list.slideToggle(200);
});

// this is optional to close the list while the new page is loading
list.click(function() {
trigger.click();
});
</script>