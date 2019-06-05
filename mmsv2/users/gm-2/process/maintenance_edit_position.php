<?php
session_start();
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');

$action = $_POST['action'];
$branch_data = '';
$user_id = $_SESSION['user_id'];
$date = date('Y/m/d H:i');

if($action == 'edit'){
    $position_id = $_POST['position_id'];
    
    $sql_position = mysql_query("SELECT * from positions WHERE p_id = '$position_id'") or die(mysql_error());
    $row_position = mysql_fetch_array($sql_position);
    echo $branch_data = $row_position['position'];
}else if($action == 'update'){
    $position_id = $_POST['position_id'];
    $position = str_replace("ampersand","&",(mysql_real_escape_string($_POST['position'])));
    $position = str_replace("**","ñ",$position);
    $position = str_replace("(*)","Ñ",$position);
    $sql_chk = mysql_query("SELECT * from positions WHERE position='$position' and status=''") or die(mysql_error());
    if(mysql_num_rows($sql_chk) <= 1 ){
        mysql_query("UPDATE positions SET position = '$position', user_id='$user_id', date_updated='$date' WHERE p_id = '$position_id'") or die(mysql_error());
    }else{
        echo 'failed';
    }
    
}else if($action == 'save'){
    $position = str_replace("ampersand","&",(mysql_real_escape_string($_POST['position'])));
    $position = str_replace("**","ñ",$position);
    $position = str_replace("(*)","Ñ",$position);
    
    $sql_chk = mysql_query("SELECT * from positions WHERE position='$position' and status=''") or die(mysql_error());
   if(mysql_num_rows($sql_chk) == 0){
        mysql_query("INSERT INTO positions (position,user_id,date_updated) VALUES ('$position','$user_id','$date')") or die(mysql_error());  
   }else{
       echo 'failed';
   }
}