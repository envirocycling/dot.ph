<?php
session_start();
$_SESSION['isall']='no';
$_SESSION['bales_to_pack']=array();
header('Location:bale_list.php');
?>
