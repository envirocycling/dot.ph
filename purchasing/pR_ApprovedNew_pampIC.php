<?php
date_default_timezone_set("Asia/Manila");
@session_start();
include 'config.php';
$id = $_GET['request_id'];
$status = $_GET['stat'];

if (!isset($_SESSION['name'])) {
    echo "<script>
alert('Session Expired......');
window.location = 'index.php';
</script>";	
}else{
	mysql_query("UPDATE requests SET status='$status', date_approved='".date('Y/m/d h:i A')."' WHERE request_id='$id'");
    echo "<script>
alert('Successfully...');
window.location = 'home.php';
</script>";
}
?>