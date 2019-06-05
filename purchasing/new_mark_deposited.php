<?php

@session_start();
include("config.php");
if (isset($_GET['id'])) {
    if ($_GET['type'] == 'check') {
        mysql_query("UPDATE check_req SET deposited_by='" . $_SESSION['name'] . "',deposited_date='" . date("Y/m/d") . "' WHERE log_id='" . $_GET['id'] . "'");
        echo "<script>";
        echo "alert('Processed Successfully...');";
        echo "location.replace('new_approve_check_requisition.php');";
        echo "</script>";
    }
    if ($_GET['type'] == 'cash') {
        mysql_query("UPDATE cash_req SET deposited_by='" . $_SESSION['name'] . "',deposited_date='" . date("Y/m/d") . "' WHERE log_id='" . $_GET['id'] . "'");
        echo "<script>";
        echo "alert('Processed Successfully...');";
        echo "location.replace('new_approve_check_requisition.php');";
        echo "</script>";
    }
}
?>