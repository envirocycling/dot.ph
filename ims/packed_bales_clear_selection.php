<?php
session_start();
$_SESSION['is_unpack_all']='no';
$_SESSION['bales_to_unpack']=array();
header('Location:out_bales.php');
?>
