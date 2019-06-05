<?php
session_start();
$type=$_POST['type'];
$_SESSION['check_req_type']=$type;
header("location:".$_SERVER['HTTP_REFERER']);


?>