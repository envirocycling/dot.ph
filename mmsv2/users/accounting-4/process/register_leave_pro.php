<?php

include('../../../connect.php');
include('process_loading.php');

$emp_num = $_POST['emp_num'];
$date_submitted = $_POST['date_submitted'];
$branch = $_POST['branch'];
$position = $_POST['position'];
$date_affected1 = $_POST['date_affected1'];
$date_affected2 = $_POST['date_affected2'];
$no_days = $_POST['no_days'];
$leave_type = $_POST['leave_type'];
@$cs_date1 = $_POST['cs_date1'];
@$cs_date2 = $_POST['cs_date2'];
@$os_date = $_POST['os_date'];
@$specify = $_POST['specify'];
@$reliever1 = $_POST['reliever1'];
@$reliever2 = $_POST['reliever2'];
$reason = mysql_real_escape_string($_POST['reason']);
$supervisor = $_POST['supervisor'];
@$head = $_POST['head'];
$manager = $_POST['manager'];
@$department = $_POST['department'];
@$accounting_manager = $_POST['accounting_manager'];
if ($manager == $supervisor) {
    $status = 'pending to gm';
} else {
    $status = 'pending to supervisor';
}
$head_status = '';

if (empty($reliever1)) {
    $r1_status = 'none';
} else {
    $r1_status = 'pending';
    $status = 'pending to reliever';
}
if (empty($reliever2)) {
    $r2_status = 'none';
} else {
    $r2_status = 'pending';
    $status = 'pending to reliever';
}
if (@$accounting_manager != 'N/A') {
    $head_status = 'pending';
}
if ($leave_type == 'Vacation Leave' || $leave_type == 'Sick Leave') {
    $validate = 0;
} else {
    $validate = 1;
}
//p = pending , 00=cancel, 0=disapproved, 1=approved
if (mysql_query("INSERT INTO leaves (emp_num, date_submitted, branch_id, position_id, date_affected1, date_affected2, no_days, leave_type, cs_date1, cs_date2, os_date, specify, reason, reliever1_id, reliever2_id, supervisor_id, manager_id, status, reliever1_status, reliever2_status, supervisor_status, manager_status, head_status, validated)
        VALUES ('$emp_num', '$date_submitted', '$branch', '$position', '$date_affected1', '$date_affected2', '$no_days', '$leave_type', '$cs_date1', '$cs_date2', '$os_date', '$specify', '$reason', '$reliever1', '$reliever2', '$supervisor', '$manager', '$status', '$r1_status', '$r2_status', 'pending', 'pending','$head_status' , '$validate')") or die(mysql_error())) {
    
    if ($status == 'pending to supervisor') {
        $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '$emp_num' ") or die(mysql_error());
        $row_emp = mysql_fetch_array($sql_emp);
        $str_count = strlen($row_emp['middlename']) - 1;
        $fullname = ucwords($row_emp['firstname'] . ' ' . substr($row_emp['middlename'], 0, -$str_count) . '. ' . $row_emp['lastname']);
        
        $sql_emailTo = mysql_query("SELECT * from email WHERE department = 'accounting' and status='' and emp_num='$supervisor'") or die(mysql_error());
        $row_emailTo = mysql_fetch_array($sql_emailTo);
        $to = $row_emailTo['email'];
        
        $subject = "MMMS: Leave Request of " . $fullname;
        $message = "Good day Ma'am/Sir \r\n You have leave request to approve.\r\n\n Please Login here http://mmsv2.efi.net.ph/ to do more action.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
        $headers = "From: envirocyclingfiberincorporated@efi.net.ph";
        mail($to, $subject, $message, $headers);
        
        
        $sql_emailTo = mysql_query("SELECT * from email WHERE department = 'it' and status=''") or die(mysql_error());
        $row_emailTo = mysql_fetch_array($sql_emailTo);
        $to = $row_emailTo['email'];
        
        $subject = "MMMS: Leave Request of " . $fullname;
        $message = "Good day Ma'am/Sir \r\n You have leave request to approve.\r\n\n Please Login here http://mmsv2.efi.net.ph/ to do more action.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
        $headers = "From: envirocyclingfiberincorporated@efi.net.ph";
        mail($to, $subject, $message, $headers);
    }
    
    
    echo '<script>
                location.replace("../view_leave.php?status=sent&active=view&http=201");
        </script>';
} else {
    echo '<script>
                location.replace("../register_leave.php?active=register&http=400");
        </script>';
}

/*echo "INSERT INTO leaves (emp_num, date_submitted, branch, date_affected1, date_affected2, no_days, leave_type, cs_date1, cs_date2, os_date, specify, reason, reliever1, reliever2, supervisor, manager, status)
        VALUES ('$emp_num', '$date_submitted', '$branch', '$date_affected1', '$date_affected2', '$no_days', '$leave_type', '$cs_date1', '$cs_date2', '$specify', '$reason', '$reliever1', '$reliever2', '$supervisor', '$manager', '0')"; 
 */