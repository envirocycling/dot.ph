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
$type = @$_POST['del_type'] . '~' . mysql_real_escape_string(@$_POST['report_number']);
$report_id = explode('-', @$_POST['report_number']);
if ($type == '~') {
    $type = '';
}
if (empty($report_id[0])) {
    $report_idVal = 0;
} else {
    $report_idVal = $report_id[0];
}
if (mysql_query("INSERT INTO delinquency (date_submitted, company_id, emp_num, branch_id, violation, date_committed, description, status, submitted_by, submitted_date, type)
        VALUES('$date_submitted', '$company_id', '$emp_num', '$branch_id', '$violation', '$date_committed', '$description', 'pending', '$submitted_by', '$submitted_date', '$type')")) {

    $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '$emp_num' ") or die(mysql_error());
    $row_emp = mysql_fetch_array($sql_emp);
    $str_count = strlen($row_emp['middlename']) - 1;
    $fullname = ucwords($row_emp['firstname'] . ' ' . substr($row_emp['middlename'], 0, -$str_count) . '. ' . $row_emp['lastname']);

    $sql_last_del = mysql_query("SELECT max(d_id) as d_id from delinquency");
    $row_lastdel = mysql_fetch_array($sql_last_del);
    $d_id = $row_lastdel['d_id'];

    mysql_query("UPDATE incident_accident SET del_id='$d_id' WHERE report_id ='$report_idVal'") or die(mysql_error());

    $sql_company = mysql_query("SELECT * from company WHERE company_id='$company_id' and type=1") or die(mysql_error());

    if (mysql_num_rows($sql_company) == 0) {
        $sql_emailTo = mysql_query("SELECT * from email WHERE emp_num = '$company_id' and status='' and department='agency'") or die(mysql_error());
        $row_emailTo = mysql_fetch_array($sql_emailTo);
        $to = $row_emailTo['email'];

        $sql_emailCC = mysql_query("SELECT * from email WHERE department = 'hr' and status=''") or die(mysql_error());
        $row_emailCC = mysql_fetch_array($sql_emailCC);
        $cc = "CC: " . $row_emailCC['email'] . ',';

        $sql_emailManager = mysql_query("SELECT * from email WHERE department = 'manager' and status=''") or die(mysql_error());
        $row_emailManager = mysql_fetch_array($sql_emailManager);
        $cc .= $row_emailManager['email'] . ',';
    } else {
        $sql_emailCC = mysql_query("SELECT * from email WHERE department = 'manager' and status=''") or die(mysql_error());
        $row_emailCC = mysql_fetch_array($sql_emailCC);
        $cc = "CC: " . $row_emailCC['email'] . ',';
        
        $sql_bh = mysql_query("SELECT * from users WHERE status='' and branch_id LIKE '%(" . $branch_id . ")%' and user_type='3'") or die(mysql_error());
        while ($row_bh = mysql_fetch_array($sql_bh)) {
            $sql_emailBH = mysql_query("SELECT * from email WHERE emp_num = '".$row_bh['emp_num']."' and status=''") or die(mysql_error());
            $row_emailBH = mysql_fetch_array($sql_emailBH);
            $cc .= $row_emailBH['email'] . ',';
        }

        $sql_emailTo = mysql_query("SELECT * from email WHERE department = 'hr' and status=''") or die(mysql_error());
        $row_emailTo = mysql_fetch_array($sql_emailTo);
        $to = $row_emailTo['email'];
    }
    
    $subject = "DELINQUENCY REPORT OF " . $fullname;
    $message = "Good day Ma'am/Sir \r\n Click this link to view " . "http://mmsv2.efi.net.ph/users/viewing-page/view_emp_delinquency.php?d_id=" . $d_id . ".\r\n\n Please Login here http://mmsv2.efi.net.ph/ to do more action.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
    $headers = "From: envirocyclingfiberincorporated@efi.net.ph" . "\r\n" . $cc;
    mail($to, $subject, $message, $headers);

    echo '<script>
            window.top.location.href="../view_delinquency.php?status=active&active=view&http=200";
    </script>';
} else {
    echo '<script>
            window.top.location.href="../register_delinquency.php?active=register&http=400";
    </script>';
}
