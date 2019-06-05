<?php

include("config.php");
$request_id = $_GET['request_id'];
mysql_query("UPDATE requests set date_approved='" . date("Y/m/d h:i a") . "',status='approved',stamp='' where request_id=$request_id");
header("Location: llrPrintPr.php?request_id=$request_id");
?>
