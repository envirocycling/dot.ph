<?php
session_start();
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');

$action = $_POST['action'];
$branch_data = '';
$user_id = $_SESSION['user_id'];
$date = date('Y/m/d H:i');

if($action == 'edit'){
    $company_id = $_POST['company_id'];
    
    $sql_company = mysql_query("SELECT * from company WHERE company_id = '$company_id'") or die(mysql_error());
    $row_company = mysql_fetch_array($sql_company);
    echo $company_data = $row_company['name'].'~'.$row_company['description'].'~'.$row_company['type'];
}else if($action == 'update'){
    $company_id = $_POST['company_id'];
    $company_name = mysql_real_escape_string($_POST['company_name']);
    $description = mysql_real_escape_string($_POST['description']);
    $type = $_POST['type'];
   
    mysql_query("UPDATE company SET name = '$company_name', description = '$description', type='$type', user_id='$user_id', date_updated='$date' WHERE company_id = '$company_id'") or die(mysql_error());
}else if($action == 'save'){
    $company_name = str_replace("ampersand","&",(mysql_real_escape_string($_POST['company_name'])));
    $description = str_replace("ampersand","&",(mysql_real_escape_string($_POST['description'])));
    $description = str_replace("**","ñ",$description);
    $description = str_replace("(*)","Ñ",$description);
    $company_name = str_replace("**","ñ",$company_name);
    $company_name = str_replace("(*)","Ñ",$company_name);
    $type = $_POST['type'];
    
  mysql_query("INSERT INTO company (name,description,type,user_id,date_updated) VALUES ('$company_name','$description','$type','$user_id','$date')") or die(mysql_error());  
}