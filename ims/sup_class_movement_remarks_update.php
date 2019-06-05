<?php
@session_start();
include 'config.php';
mysql_query("INSERT INTO `sup_class_movement_remarks`(`supplier_id`, `remarks`, `encoded_by`, `date`)
    VALUES ('".$_POST['id']."','".$_POST['remarks']."','".$_SESSION['username']."','".date("Y/m/d")."')");

?>