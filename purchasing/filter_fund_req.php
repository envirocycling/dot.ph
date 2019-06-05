<?php
session_start();
$type=$_POST['type'];
$_SESSION['fund_req_type']=$type;
header("location:".$_SERVER['HTTP_REFERER']);


?>