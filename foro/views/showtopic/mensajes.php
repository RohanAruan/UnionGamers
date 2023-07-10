<?php
$sql = "SELECT * FROM aor_mensajes WHERE idusuario = '$autorx'";
$tplacas = $con->query($sql);
$nplacas = mysqli_num_rows($tplacas);
?>	

<?php 
if($nplacas >= 1500) {
echo ' <span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:#000080 !important;border:0px;font-weight:100" class="badge badge-primary">Rubí</span>';	
}
elseif($nplacas >= 1000) {
echo ' <span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:#1034a6 !important;border:0px;font-weight:100" class="badge badge-primary">Diamante</span>';	
}
elseif($nplacas >= 800) {
echo ' <span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:#0f52ba !important;border:0px;font-weight:100" class="badge badge-primary">Platino</span>';	
}
elseif($nplacas >= 650) {
echo ' <span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:#6593f5 !important;border:0px;font-weight:100" class="badge badge-primary">Oro</span>';	
}
elseif($nplacas >= 450) {
echo ' <span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:#57a0d3 !important;border:0px;font-weight:100" class="badge badge-primary">Élite</span>';	
}
elseif($nplacas >= 350) {
echo ' <span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:#4682b4 !important;border:0px;font-weight:100" class="badge badge-primary">Experto</span>';	
}
elseif($nplacas >= 200) {
echo ' <span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:#89cff0 !important;border:0px;font-weight:100" class="badge badge-primary">Avanzado</span>';	
}
elseif($nplacas >= 50) {
echo ' <span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:#73c2fb !important;border:0px;font-weight:100" class="badge badge-primary">Regular</span>';	
}
elseif($nplacas >= 0) {
echo ' <span style="width:100%;margin-bottom:0.50px;border-radius:2px;background:gray !important;border:0px;font-weight:100" class="badge badge-primary">Inexperto</span>';	
}
?>