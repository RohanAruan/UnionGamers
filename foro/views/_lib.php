<?php
if(isset($_SESSION["usuario"])) {

// USUARIO
$z_user_id = mysqli_query($con, "SELECT eid FROM aor_onlines WHERE eid = '$iduser'");
$o_user_id = mysqli_fetch_array($z_user_id);
$user_id = $o_user_id['eid'];
$this_date = date('U');

if ($user_id) {
mysqli_query($con, "UPDATE aor_onlines SET tiempo='$this_date', idforo='$_GET[s]', idtema='0' WHERE eid = '$iduser'");
} else {
mysqli_query($con, "INSERT aor_onlines SET eid = '$iduser', idforo='$_GET[s]', tiempo = '$this_date'");
}
// FIN

} else {

// VISITANTE 
$z_user_id = mysqli_query($con, "SELECT eid FROM aor_onlines WHERE eid = '$ip'");
$o_user_id = mysqli_fetch_array($z_user_id);
$user_id = $o_user_id['eid'];
$this_date = date('U');

if ($user_id) {
mysqli_query($con, "UPDATE aor_onlines SET tiempo='$this_date', idforo='$_GET[s]', idtema='0' WHERE eid = '$ip'");
} else {
mysqli_query($con, "INSERT aor_onlines SET eid = '$ip', idforo='$_GET[s]', tiempo = '$this_date'");
}
// FIN

}
?>

<?php
$sqlB = mysqli_query($con, "SELECT * FROM aor_grupos WHERE id = '$miembro'");
$smiembros = mysqli_fetch_array($sqlB); 
$miembrof = $smiembros['faccion'];
?>
