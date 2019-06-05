<?php
include 'config.php';
session_start();

$pr_type = $_GET['type'];
 if($pr_type == 'consumable'){
    echo 'bh~';
}else if($pr_type != 'consumable'){
    $sql_signatory = mysql_query("SELECT * from pr_signatory WHERE pr_type LIKE '%$pr_type%'") or die(mysql_error());
    $row_signatory = mysql_fetch_array($sql_signatory);
    $sql_user = mysql_query("SELECT * from users WHERE user_id = '".$row_signatory['user_id']."'") or die(mysql_error());
    $row_user = mysql_fetch_array($sql_user);
    if(mysql_num_rows($sql_signatory) == 0){
        echo 'LLR~Lorna Regala';  
    }else{
        echo $row_user['name'].'~'.$row_user['fullname'];
    }
}