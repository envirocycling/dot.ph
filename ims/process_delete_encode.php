<?php
include("config.php");
$id = $_POST['id'];
$target = $_POST['target'];

if($target == 'actual'){
	mysql_query("DELETE from island_group_target WHERE log_id='$id'");
}else{
	mysql_query("DELETE from island_price_target WHERE log_id='$id'");
}
?>