<?php
include 'config.php';
mysql_query("UPDATE paper_buying SET status='".$_POST['type']."',date_billed='".date("Y/m/d")."' WHERE log_id='".$_POST['id']."'");
?>