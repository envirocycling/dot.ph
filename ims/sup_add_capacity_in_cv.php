<?php
@session_start();
include 'config.php';
mysql_query("INSERT INTO supplier_capacity (`supplier_id`, `wp_grade`, `capacity`, `updated_by`, `date_effective`, `date_updated`)
    VALUES ('".$_POST['id']."','".$_POST['wp_grade']."','".$_POST['capacity']."','".$_SESSION['username']."','".date("Y/m/d")."','".date("Y/m/d")."')");
?>