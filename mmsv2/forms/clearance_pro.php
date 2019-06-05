<?php

include('../connect.php');
$statusActor = $_GET['statusActor'];
$remarksActor = $_GET['remarksActor'];
$status = $_GET['status'];
$remarks = html_entity_decode((htmlentities($_GET['remarks'])));
$emp_num = $_GET['emp_num'];
$date = date('Y-m-d');
$init = explode('_', $remarksActor);
$dateActor = $init[0] . '_date';

if ($statusActor == 'gm_status') {
    mysql_query("UPDATE form_clearance SET $statusActor='$status', gm_date='$date' WHERE emp_num='$emp_num'") or die(mysql_error());

    $sql_emp = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '$emp_num' ") or die(mysql_error());
    $row_emp = mysql_fetch_array($sql_emp);
    $str_count = strlen($row_emp['middlename']) - 1;
    $fullname = ucwords($row_emp['firstname'] . ' ' . substr($row_emp['middlename'], 0, -$str_count) . '. ' . $row_emp['lastname']);

    $to = '';
    $sql_emailHR = mysql_query("SELECT * from email WHERE department = 'hr' and status=''") or die(mysql_error());
    while ($row_emailHR = mysql_fetch_array($sql_emailHR)) {
        $to .= $row_emailHR['email'] . ',';
    }

    $subject = "MMS CLEARANCE OF " . $fullname;
    $message = "Good day Ma'am/Sir \r\n Clearance of $fullname is already approved to release his/her final payment. Please Login http://mmsv2.efi.net.ph/.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
    $headers = "From: envirocyclingfiberincorporated@efi.net.ph";
    mail($to, $subject, $message, $headers);
} else {
    mysql_query("UPDATE form_clearance SET $statusActor='$status', $remarksActor='$remarks', $dateActor='$date' WHERE emp_num='$emp_num'") or die(mysql_error());
    $sql_chk = mysql_query("SELECT * form_clearance WHERE emp_num='$emp_num' and accounting_status='cleared' and supervisor_status='cleared' and treasury_status='cleared' and hr_status='cleared' and it_status='cleared'") or die(mysql_error());

    if(mysql_num_rows($sql_chk) > 0) {
        $sql_emailGM = mysql_query("SELECT * from email WHERE department = 'gm' and status=''") or die(mysql_error());
        while ($row_emailGM= mysql_fetch_array($sql_emailGM)) {
            $to = $row_emailGM['email'];
        }
        
        $subject = "MMS CLEARANCE OF " . $fullname;
        $message = "Good day Ma'am/Sir \r\n Clearance of $fullname is already approved to release his/her final payment. Please Login http://mmsv2.efi.net.ph/.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
        $headers = "From: envirocyclingfiberincorporated@efi.net.ph";
        mail($to, $subject, $message, $headers);
    }
}