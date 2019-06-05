<?php

session_start();
date_default_timezone_set("Asia/Singapore");

include('iconnect.php');

$emp_num = $_POST['emp'];
$sql_empData = mysqli_query($con, "SELECT * from employees WHERE emp_num='$emp_num'");
$row_empData = mysqli_fetch_array($sql_empData);

@$date = date('Y-m-d');
@$company_id = $row_empData['company_id'];
@$position_id = $row_empData['position_id'];
@$branch_id = $row_empData['branch_id'];
@$dep_id = $_POST['dep_id'];
@$description = mysql_real_escape_string($_POST['description']);
@$supervisor_num = $_POST['supervisor_num'];
@$supervisor_position = $_POST['supervisor_position'];
@$delinquency = $_POST['delinquency'];


if (mysqli_query($con, "INSERT INTO nte (date_submitted, company_id, emp_num, position_id, branch_id, dep_id, description) 
    VALUES('$date', '$company_id', '$emp_num', '$position_id', '$branch_id', '$dep_id', '$description')")) {
    $sql_max = mysqli_query($con, "SELECT max(nte_id) as nte_id from nte");
    $row_max = mysqli_fetch_array($sql_max);

    $sql_del = mysqli_query("SELECT * from delinquency WHERE d_id='$delinquency'");
    $row_del = mysqli_fetch_array($sql_del);
    $actions = mysqli_real_escape_string($row_del['action']) . '. Created Notice to Explain';
    if (strtotime($row_del['action_date']) < 1) {
        $aDate = date('Y-m-d');
    } else {
        $aDate = $row_del['action_date'];
    }

    $sql_emp = mysqli_query($con, "SELECT * from employees WHERE emp_num = '$emp_num' ");
    $row_emp = mysqli_fetch_array($sql_emp);
    $str_count = strlen($row_emp['middlename']) - 1;
    $fullname = ucwords($row_emp['firstname'] . ' ' . substr($row_emp['middlename'], 0, -$str_count) . '. ' . $row_emp['lastname']);

    $to = '';
    $sql_bh = mysql_query("SELECT * from users WHERE status='' and branch_id LIKE '%(" . $branch_id . ")%' and user_type='3'") or die(mysql_error());
    while ($row_bh = mysql_fetch_array($sql_bh)) {
        $sql_emailBH = mysql_query("SELECT * from email WHERE emp_num = '" . $row_bh['emp_num'] . "' and status=''") or die(mysql_error());
        $row_emailBH = mysql_fetch_array($sql_emailBH);
        $to .= $row_emailBH['email'] . ',';
    }

    $cc = "CC: ";
    $sql_emailCC = mysql_query("SELECT * from email WHERE department = 'hr' and status=''") or die(mysql_error());
    while ($row_emailCC = mysql_fetch_array($sql_emailCC)) {
        $cc .= $row_emailCC['email'] . ',';
    }

    $sql_emailTo = mysql_query("SELECT * from email WHERE emp_num = '$company_id' and status='' and department='agency'") or die(mysql_error());
    $row_emailTo = mysql_fetch_array($sql_emailTo);
    $cc .= $row_emailTo['email'];

    $subject = "DELINQUENCY REPORT OF " . $fullname;
    $message = "Good day Ma'am/Sir \r\n Agency was already created Notice to Explain. Kindly upload the NTE and Explanation Letter of employee with his/her signature.\r\n\n Please Login here http://mmsv2.efi.net.ph/ to do more action.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
    $headers = "From: envirocyclingfiberincorporated@efi.net.ph" . "\r\n" . $cc;
    mail($to, $subject, $message, $headers);

    mysqli_query($con, "UPDATE delinquency SET nte='" . $row_max['nte_id'] . "', action='created Notice to Explain', action_date='$aDate', implementation_status='pending to supervisor', status='action taken' WHERE d_id='$delinquency'");
    mysqli_close($con);
    echo '<script>
            window.top.location.href="../view_nte.php?status=active&active=view&http=201";
    </script>';
} else {
    mysqli_close($con);
    echo '<script>
            window.top.location.href="../register_nte.php?status=active&active=view&http=400";
    </script>';
}
