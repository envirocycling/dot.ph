<?php
include 'config.php';
$log_id = $_POST['log_id'];
$sql_chk = mysql_query("SELECT * from `paper_buying` WHERE log_id='$log_id'");
$row_chk = mysql_fetch_array($sql_chk);
if(strtoupper($row_chk['branch']) == 'PAMPANGA'){
    mysql_query("UPDATE `paper_buying` SET ref_no='',status='',date_billed='' WHERE log_id='$log_id'");
}else{
    mysql_query("UPDATE `paper_buying` SET dr_number='',status='',date_billed='' WHERE log_id='$log_id'");
}

?>