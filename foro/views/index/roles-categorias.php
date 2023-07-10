<!-- CATEGORÍA SOLO PARA ADMINISTRADORES -->
<div class="ui-block">

<table class="forums-table">

<thead>

<tr>

<th style="font-weight:bold;font-size:15px;line-height:1;" class="forum">
<?=$row['nombre']?>
</th>

<th  class="forum">
</th>

<th class="forum">
<a data-toggle="collapse" href="#collapseExample<?=$idcategoria?>" role="button" aria-expanded="true" aria-controls="collapseExample<?=$idcategoria?>">
<i onclick="myFunction(this)" style="float:right;font-size:16.70px;font-weight:700;color:#d1d2d5;transition: 0.3s all linear;" class="aca fa fa-chevron-down"></i>	
</a>
</th>

</tr>

</thead>

<!-- AQUI SOLAMENTE MOSTRAMOS FOROS/SUBFOROS CON PERMISOS DEL STAFF -->
<tbody class="collapse show" id="collapseExample<?=$idcategoria?>">

<?php include "views/index/roles-tipo.php"; ?>

</tbody>
<!-- FIN -->

</table>

</div>
<!-- FIN -->