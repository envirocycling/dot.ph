<?php
session_start();
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');

$company_id = $_POST['company_id'];
$date_updated = date('Y/m/d H:i');
$branch_id = $_POST['branch_id'];
$position_id = $_POST['position_id'];

if($company_id > 0){
    mysql_query("UPDATE company SET status='deleted', date_updated='$date_updated', user_id='".$_SESSION['user_id']."' WHERE company_id='$company_id'") or die (mysql_error());
}else if($branch_id > 0){
   mysql_query("UPDATE branches SET status='deleted', date_updated='$date_updated', user_id='".$_SESSION['user_id']."' WHERE branch_id='$branch_id'") or die (mysql_error()); 
}else if($position_id > 0){
   mysql_query("UPDATE positions SET status='deleted', date_updated='$date_updated', user_id='".$_SESSION['user_id']."' WHERE p_id='$position_id'") or die (mysql_error()); 
}

