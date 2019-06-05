<?php
session_start();
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');

$action = $_POST['action'];
$branch_data = '';
$user_id = $_SESSION['user_id'];
$date = date('Y/m/d H:i');

if($action == 'edit'){
    $rank_id = $_POST['rank_id'];
    
    $sql_position = mysql_query("SELECT * from rank WHERE r_id = '$rank_id'") or die(mysql_error());
    $row_position = mysql_fetch_array($sql_position);
    echo $branch_data = utf8_encode($row_position['description']);
}else if($action == 'update'){
    $rank_id = $_POST['r_id'];
    $rank = mysql_real_escape_string($_POST['rank']);
    $sql_chk = mysql_query("SELECT * from rank WHERE description='$rank' and status=''") or die(mysql_error());
    if(mysql_num_rows($sql_chk) <= 1 ){
        mysql_query("UPDATE rank SET description = '$rank' WHERE r_id = '$rank_id'") or die(mysql_error());
    }else{
        echo 'failed';
    }
    
}else if($action == 'save'){
    $rank = mysql_real_escape_string($_POST['rank']);
    
    $sql_chk = mysql_query("SELECT * from rank WHERE description='$rank' and status=''") or die(mysql_error());
   if(mysql_num_rows($sql_chk) == 0){
        mysql_query("INSERT INTO rank (description) VALUES ('$rank')") or die(mysql_error());  
   }else{
       echo 'failed';
   }
}