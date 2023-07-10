<?php 
session_start();
unset($_SESSION["usuario"]); 
unset($_SESSION['googleCode']);
unset($_SESSION['email']);
unset($_SESSION['secret']);
unset($_SESSION['token']);
echo "<script>window.location='login';</script>";      
?>
