<?php
session_start();
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');

$action = $_POST['action'];
$branch_data = '';
$user_id = $_SESSION['user_id'];
$date = date('Y/m/d H:i');

if($action == 'edit'){
    $branch_id = $_POST['branch_id'];
    
    $sql_branch = mysql_query("SELECT * from branches WHERE branch_id = '$branch_id'") or die(mysql_error());
    $row_branch = mysql_fetch_array($sql_branch);
    echo $branch_data = $row_branch['branch_name'].'~'.$row_branch['company_id'];
}else if($action == 'update'){
    $branch_id = $_POST['branch_id'];
    $company_name = $_POST['company_name'];
    $branch_name = mysql_real_escape_string($_POST['branch_name']);
   
    mysql_query("UPDATE branches SET branch_name = '$branch_name', company_id = '$company_name', user_id='$user_id', date_updated='$date' WHERE branch_id = '$branch_id'") or die(mysql_error());
}else if($action == 'save'){
    $company_name = $_POST['company_name'];
    $branch_name = str_replace("ampersand","&",(mysql_real_escape_string($_POST['branch_name'])));
    $branch_name = str_replace("**","�",$branch_name);
    $branch_name = str_replace("(*)","�",$branch_name);
    
  mysql_query("INSERT INTO branches (branch_name,company_id,user_id,date_updated) VALUES ('$branch_name','$company_name','$user_id','$date')") or die(mysql_error());  
}