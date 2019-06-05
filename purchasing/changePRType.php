<?php
$id=$_POST['request_id'];
$type=$_POST['type'];
include ("config.php");
if($type=='for hr') {
    mysql_query("UPDATE requests set type='$type' ,justification='PPE' where request_id='$id'");
}else {
    mysql_query("UPDATE requests set type='$type' where request_id='$id'");
}
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>