<?php
session_start();
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');

$date_submitted = $_POST['date_submitted'];
$company_id = $_POST['company'];
$emp_num = $_POST['emp_num'];
$branch_id = $_POST['branch_id'];
$violation = mysql_real_escape_string($_POST['violation']);
$date_committed = $_POST['date_committed'];
$description = mysql_real_escape_string($_POST['description']);
$submitted_by = $_SESSION['user_id'];
$submitted_date = date('Y/m/d H:i');
$type = @$_POST['del_type'].'~'.mysql_real_escape_string(@$_POST['report_number']);
$report_id = explode('-',@$_POST['report_number']);
if($type == '~'){
    $type = '';
}
if(empty($report_id[0])){
    $report_idVal = 0;
}else{
    $report_idVal = $report_id[0];
}
if(mysql_query("INSERT INTO delinquency (date_submitted, company_id, emp_num, branch_id, violation, date_committed, description, status, submitted_by, submitted_date, type)
        VALUES('$date_submitted', '$company_id', '$emp_num', '$branch_id', '$violation', '$date_committed', '$description', 'pending', '$submitted_by', '$submitted_date', '$type')")){
    
    $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '$emp_num' ") or die(mysql_error());
    $row_emp = mysql_fetch_array($sql_emp);
    $str_count = strlen($row_emp['middlename']) - 1;
    $fullname = ucwords($row_emp['firstname'].' '.substr($row_emp['middlename'],0,-$str_count).'. '.$row_emp['lastname']);
    
    $sql_email = mysql_query("SELECT * from email WHERE emp_num = '$submitted_by' ") or die(mysql_error());
    $row_email = mysql_fetch_array($sql_email);
    
    $sql_last_del = mysql_query("SELECT max(d_id) as d_id from delinquency");
    $row_lastdel = mysql_fetch_array($sql_last_del);
    $d_id = $row_lastdel['d_id'];
    
    mysql_query("UPDATE incident_accident SET del_id='$d_id' WHERE report_id ='$report_idVal'") or die(mysql_error());
    
    $to = 'reynaldo_caridaoan@efi.net.ph';
    $subject = "Delinquency Report of:" . $fullname;
    $message = "Good day Ma'am/Sir \r\n Please click the link below to see the full details of the report \r\n" . "http://mms.efi.net.ph/viewFormDelinquency.php?id=" . $d_id . "\r\n\n Thank you.. \r\n\n Note: Please use Google Chrome, Mozilla Firefox or Opera to view it properly...\r\n\n";
    $from = $row_email['email'];
    $headers = "From:" . $from . "\r\n";
    mail($to, $subject, $message, $headers);
    
    echo '<script>
            window.top.location.href="../view_delinquency.php?status=active&active=view&http=200";
    </script>';
}else{
   echo '<script>
            window.top.location.href="../register_delinquency.php?active=register&http=400";
    </script>'; 
}
