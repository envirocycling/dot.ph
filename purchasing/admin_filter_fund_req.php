<?php
session_start();
$status=$_POST['status'];
$_SESSION['fund_req_status']=$status;
header("location:".$_SERVER['HTTP_REFERER']);


?>