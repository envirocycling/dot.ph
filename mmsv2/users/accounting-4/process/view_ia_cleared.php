<?php
include('../../../connect.php');
    
$report_id  = $_GET['report_id'];

if(mysql_query("UPDATE incident_accident SET status='cleared' WHERE report_id='$report_id'") or die(mysql_error())){    
    echo '201';
}else{
    echo '400';
}