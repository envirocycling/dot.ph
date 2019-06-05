<?php
include 'config.php';
mysql_query("UPDATE fund_req SET status='disapproved' WHERE log_id='".$_GET['rej_req_id']."'");
echo "<script>";
echo "alert('Successfully Disapproved.');";
echo "location.replace('fund_requisition.php');";
echo "</script>";
?>
