<?php session_start();?>
<?php
include ('config.php');
$del_id=$_GET['del_id'];
$key = array_search($del_id, $_SESSION['receiving_del_ids']);
if (false !== $key) {
    unset($_SESSION['receiving_del_ids'][$key]);
}else {
    array_push($_SESSION['receiving_del_ids'],$del_id);
}









?>