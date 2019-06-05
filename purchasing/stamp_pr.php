<?php
$request_id=$_GET['request_id'];
 $action=$_GET['action'];
include('config.php');


if(mysql_query("UPDATE requests set stamp='$action' where request_id=$request_id")) {
    header("Location:".$_SERVER['HTTP_REFERER']);
}else {
    echo "<script>";
    echo "alert('Failed to stamp PR...');";
    echo "window.history.back();";
    echo "</script>";
}

?>