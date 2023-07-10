<?php
function dateDiff($from,$to) {
$diff = $to - $from;
$info = array();
if($diff>31556926) {
// Años
$info['año(s)'] = ($diff - ($diff%31556926))/31556926;
$diff = $diff%31556926;
}
elseif($diff>2629743) {
// Meses
$info['mes(es)'] = ($diff - ($diff%2629743))/2629743;
$diff = $diff%2629743;
}
elseif($diff>604800) {
// Semanas
$info['semana(s)'] = ($diff - ($diff%604800))/604800;
$diff = $diff%604800;
}
elseif($diff>86400) {
// Dias
$info['dia(s)'] = ($diff - ($diff%86400))/86400;
$diff = $diff%86400;
}
elseif($diff>3600) {
// Horas
$info['hora(s)'] = ($diff - ($diff%3600))/3600;
$diff = $diff%3600;
}
elseif($diff>60) {
// Minutos
$info['minuto(s)'] = ($diff - ($diff%60))/60;
$diff = $diff%60;
}
elseif($diff>0) {
// Segundos
$info['segundo(s)'] = $diff;
}
$f = '';
foreach($info as $k=>$v) {
if($v>0) $f .= "$v $k, ";
}
return substr($f,0,-2);
}
?>