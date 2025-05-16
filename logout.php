<?php
session_start(); 
session_unset(); 
session_destroy();
session_start(); 
$_SESSION['localisation'] = 'idex.php';
header("Location: idex.php");
exit();
?>
