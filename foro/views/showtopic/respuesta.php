<script src="https://cdn.tiny.cloud/1/oacfwr1n8ixdyeq3tz4vmz7ylealzfpzsb4ccjf33pululpy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
selector: 'textarea',
plugins: 'emoticons media autosave preview autolink lists wordcount link image charmap print preview hr anchor pagebreak insertdatetime help',
toolbar_mode: 'floating',
toolbar: 'restoredraft media link image numlist bullist hr wordcount insertdatetime emoticons me do | alignleft aligncenter | alignright alignjustify | bullist numlist outdent indent | removeformat | help',
language_url : 'views/edittopic/es_ES.js',
language: 'es_ES',
menubar: false
});
</script>
<script>tinymce.init({selector:'textarea'});</script>

<?php
$fechaf = date('Y-m-d');
$horaf = date('H:i:s');

if(isset($_POST['crear']))
{
$contenido = secureData(mysqli_real_escape_string($con, $_POST['contenido']));

if($contenido) {

$sql = mysqli_query($con, "INSERT INTO aor_mensajes (idusuario,idlider,idsub,idtema,mensaje,fecha,hora) values ('$iduser','$forox','$idforor','$idtema','$contenido','$fechaf','$horaf')");

if($sql) {echo "<script>Swal.fire({title: '¡Respuesta enviada!',icon: 'success',timer: 2500,showConfirmButton: false}).then(function() {window.history.back();});</script>";}

} else {echo "<script>Swal.fire({title: '¡No hay ningún mensaje!',icon: 'error',timer: 2500,showConfirmButton: false});</script>";}

}
?>

<?php if($not1['cerrado'] == 1) { ?>

<div style="padding-left:0px;" class="col-lg-12 mb-4">
<div class="alert alert-danger alert-dismissible fade show" style="margin-bottom:15px;font-size: 14px;padding:.45rem 1.25rem !important;border-radius:2px;" role="alert">
<strong><i class="fa fa-info-circle mr-2"></i></strong> Este tema tiene las respuestas cerradas
</div>
</div>

<?php } elseif($not1['cerrado'] == 0 || $rango > 5) { ?>

<div style="padding-left:0px;" class="col-lg-12 mb-4">
<div style="border: 1px solid #e9e9e9;">
<div name="contenido1" id="contenido1" style="border-radius:2px;margin-bottom:0px;" class="statbox widget box">
<div class="widget-header">
<div class="row">
<div class="col-xl-12 col-md-12 col-sm-12 col-12">
<h6 class="pb-0 mr-3"><i style="font-size:17px;color:#185ADB" class="fa fa-reply mr-2 mt-2"></i> Respuesta rápida</h6>
</div>
</div>
</div>

<div style="padding: 15px 15px 15px 15px;" class="widget-content widget-content-area">
<div class="container-fluid">

<form method="POST" action="">
<div class="form-group">
<textarea class="form-control" style="height: 240px" minlength="6" name="contenido"></textarea>
</div>

<div class="text-right mt-4">
<input type="submit" name="crear" style="border-radius: 2px;width:190px" class="btn btn-outline-info mr-1" value="Enviar respuesta" onclick="limpia_texto(formulario_x)">
<a href="createanswer?c=<?=$notc['id']?>&idf=<?=$forox?>&idf1=<?=$idforor?>" style="border-radius: 2px;width:150px" class="btn btn-outline-info mr-1">Ir a Avanzado</a>
<button type="button" style="border-radius: 2px;width:130px" class="btn btn-outline-info" onclick="limpia_texto(formulario_x)">Cancelar</a>
</div>

</form>

</div>

</div>
</div>
</div>
</div>

<script>
function limpia_texto(formulario){
for (i=0;i<formulario.length;i++) {
var temp=formulario.elements[i];

if ((temp.type=="text"||temp.type=="textarea")) {
temp.value='';
}
}
}
</script>

<?php } ?>
