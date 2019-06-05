<?php
session_start();
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');

$action = $_POST['action'];
$branch_data = '';
$user_id = $_SESSION['user_id'];
$date = date('Y/m/d H:i');

if($action == 'edit'){
    $entleave_id = $_POST['entleave_id'];
    
    $sql_entleave_id= mysql_query("SELECT * from entitled_leaves WHERE entleave_id = '$entleave_id'") or die(mysql_error());
    $row_entleave_id = mysql_fetch_array($sql_entleave_id);
    echo $leave_data = $row_entleave_id['emp_num'].'~'.$row_entleave_id['vl'].'~'.$row_entleave_id['sl'].'~'.date('Y/m/d', strtotime($row_entleave_id['date_effective']));
}else if($action == 'update'){
    $date_effective = $_POST['date_effective'];
    $date_range = date('Y/m/d', strtotime('+6 month', strtotime($_POST['date_effective'])));
    $employee = str_replace("ampersand","&",(mysql_real_escape_string($_POST['employee'])));
    $employee = str_replace("**","ñ",$employee);
    $employee = str_replace("(*)","Ñ",$employee);
    if(mysql_query("UPDATE entitled_leaves SET emp_num = '$employee', vl='".$_POST['vl']."', sl='".$_POST['sl']."', date_effective='$date_effective', user_id='$user_id', date_updated='$date', date_range='$date_range' WHERE entleave_id = '".$_POST['id']."'") or die(mysql_error())){
    }else{
        echo 'failed';
    }
    
}else if($action == 'save'){
    $date_effective = $_POST['date_effective'];
    $date_range = date('Y/m/d', strtotime('+6 month', strtotime($_POST['date_effective'])));
    $employee = str_replace("ampersand","&",(mysql_real_escape_string($_POST['employee'])));
    $employee = str_replace("**","ñ",$employee);
    $employee = str_replace("(*)","Ñ",$employee);
    
   if(mysql_query("INSERT INTO entitled_leaves (emp_num, vl, sl, date_effective, user_id, date_updated, date_range) VALUES ('$employee', '".$_POST['vl']."', '".$_POST['sl']."', '$date_effective', '$user_id', '$date', '$date_range')") or die(mysql_error())){  
   }else{
       echo 'failed';
   }
}