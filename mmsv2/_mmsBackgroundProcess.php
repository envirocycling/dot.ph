<?php
date_default_timezone_set("Asia/Manila");
include('connect.php');
$current_date = date('Y-m-d');
$currentYear = date('Y');
/*start manpower movement temporary due date*/
$sql_mmt = mysql_query("SELECT * from manpower_movement WHERE status='transferred' and temp_date2='$current_date' and type LIKE 'reassign~%'") or die (mysql_error());
while($row_mmt = mysql_fetch_array($sql_mmt)){
    $branchExp = explode('~',$row_mmt['type']);
    $branch = $branchExp[1];
    $sql_emp = mysql_query("SELECT * from users WHERE branch_id LIKE '%($branch)%' and status='' and user_type='3'") or die (mysql_error());
    $row_emp = mysql_fetch_array($sql_emp);
    
    $sql_branchEmail = mysql_query("SELECT * from email WHERE emp_num='".$row_emp['emp_num']."' and status=''") or die(mysql_error());
    $row_branchEmail = mysql_fetch_array($sql_branchEmail);
    
    $to = $row_branchEmail['email'];
    $cc = "CC: ";
    $sql_HrEmail = mysql_query("SELECT * from email WHERE department='hr' and status=''") or die(mysql_error());
        while($row_HrEmail = mysql_fetch_array($sql_branchEmail)){
            $cc .= $row_HrEmail['email'] . ',';
        }
}

$sql_entLeave = mysql_query("SELECT * from entitled_leaves WHERE year != '$currentYear' and year < '$currentYear' ");
while($row_entLeave = mysql_fetch_array($sql_entLeave)){
    $vl = $row_entLeave['vl'] + 1;
    $sl = $row_entLeave['sl'] + 1;
    
    mysql_query("UPDATE entitled_leaves SET vl='$vl', sl='$sl', year='$currentYear', date_updated='$current_date' WHERE entleave_id='".$row_entLeave['entleave_id']."'");
}

$itTo = '';
$sql_it = mysql_query("SELECT * from email WHERE department='it' and status=''");
while($row_it = mysql_fetch_array($sql_it)){
    $itTo .= $row_it['email'].', ';
}
$subject = 'Cron Tasks Scheduler';
$message = date('F d, Y h:i A').' Cron tasks schedule was successfully run.';
$headers = "From: envirocyclingfiberincorporated@efi.net.ph" . "\r\n";
mail($itTo, $subject, $message, $headers);
/*end manpower movement temporary due date*/

?>