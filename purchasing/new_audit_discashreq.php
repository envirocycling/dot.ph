<?php
@session_start();
include("config.php");
if (isset($_GET['disapprove_id'])) {
    mysql_query("UPDATE cash_req SET status='disapproved',disapproved_by='" . $_SESSION['name'] . "' WHERE log_id='" . $_GET['disapprove_id'] . "'");
    echo "<script>";
    echo "alert('Disapprove Successfully...');";
    echo "window.history.back();";
    echo "</script>";
}
?>