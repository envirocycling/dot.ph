<?php

date_default_timezone_set("Asia/Singapore");
session_start();
include('../../../connect.php');

$emp_num = $_POST['emp_num'];
$chk_emp = mysql_query("SELECT * from employees WHERE emp_num ='$emp_num'") or die(mysql_error());

if (mysql_num_rows($chk_emp) == 1) {
    $reason = $_POST['reason'];
    $date_separated = date('Y-m-d', strtotime($_POST['date_separated']));
    $row_emp = mysql_fetch_array($chk_emp);
    $emp_num = mysql_real_escape_string($row_emp['emp_num']);
    $firstname = mysql_real_escape_string($row_emp['firstname']);
    $middlename = mysql_real_escape_string($row_emp['middlename']);
    $lastname = mysql_real_escape_string($row_emp['lastname']);
    $birthdate = $row_emp['birthdate'];
    $st_brgy = mysql_real_escape_string($row_emp['st_brgy']);
    $town_city = mysql_real_escape_string($row_emp['town_city']);
    $province = mysql_real_escape_string($row_emp['province']);
    $contact_no = $row_emp['contact_no'];
    $civil_status = $row_emp['civil_status'];
    $spouse = mysql_real_escape_string($row_emp['spouse']);
    $children = mysql_real_escape_string($row_emp['children']);
    $mother = mysql_real_escape_string($row_emp['mother']);
    $father = mysql_real_escape_string($row_emp['father']);
    $gender = $row_emp['gender'];
    $tertiary = mysql_real_escape_string($row_emp['tertiary']);
    $secondary = mysql_real_escape_string($row_emp['secondary']);
    $elementary = mysql_real_escape_string($row_emp['elementary']);
    $date_hired = $row_emp['date_hired'];
    $date_start = $row_emp['date_start'];
    $date_regularization = $row_emp['date_regularization'];
    $company_id = $row_emp['company_id'];
    $branch_id = $row_emp['branch_id'];
    $position_id = $row_emp['position_id'];
    $other_positionId = $row_emp['other_positionId'];
    $rank_id = $row_emp['rank_id'];
    $status_id = $row_emp['status_id'];
    $stayin = $row_emp['stayin'];
    $tin = $row_emp['tin'];
    $tax_code = $row_emp['tax_code'];
    $sss_no = $row_emp['sss_no'];
    $phic_no = $row_emp['phic_no'];
    $hdmf_no = $row_emp['hdmf_no'];
    $sketch = $row_emp['sketch'];
    $dependents = mysql_real_escape_string($row_emp['dependents']);
    $dependentsHi = mysql_real_escape_string($row_emp['dependentsHi']);
    $emergency = mysql_real_escape_string($row_emp['emergency']);
    $training_must_attended = mysql_real_escape_string($row_emp['training_must_attended']);
    $date_updated = date('Y-m-d');

    if (mysql_query("INSERT INTO employees_deactivated (emp_num ,firstname, middlename, lastname, birthdate, st_brgy, town_city, province, contact_no, date_hired, date_start, company_id, branch_id, position_id, status_id, stayin, tin, sss_no, phic_no, hdmf_no, civil_status, gender, tertiary, secondary, elementary, date_regularization, rank_id, tax_code, sketch, dependents, emergency, date_updated, reason, date_separated, spouse, children, mother, father, other_positionId, dependentsHi, training_must_attended)
        VALUES ('$emp_num','$firstname', '$middlename', '$lastname', '$birthdate', '$st_brgy', '$town_city', '$province', '$contact_no', '$date_hired', '$date_start', '$company_id','$branch_id', '$position_id', '$status_id', '$stayin', '$tin', '$sss_no', '$phic_no', '$hdmf_no','$civil_status', '$gender', '$tertiary', '$secondary', '$elementary', '$date_regularization', '$rank_id', '$tax_code', '$sketch', '$dependents', '$emergency', '$date_updated', '$reason', '$date_separated', '$spouse', '$children', '$mother', '$father', '$other_positionId', '$dependentsHi', '$training_must_attended') ") or die(mysql_error())) {

        $to = '';
        $sql_accounting = mysql_query("SELECT * from users WHERE status='' and dep_id='2' and user_type='4'") or die(mysql_error());
        $row_accouting = mysql_fetch_array($sql_accounting);
        $sql_supervisor = mysql_query("SELECT * from users WHERE status='' and user_type='3' and branch_id LIKE '%($branch_id)%' ORDER BY user_id ASC") or die(mysql_error());
        $row_supervisor = mysql_fetch_array($sql_supervisor);
        $sql_treasury = mysql_query("SELECT * from users WHERE status='' and dep_id='4' and user_type='4'") or die(mysql_error());
        $row_treasury = mysql_fetch_array($sql_treasury);
        $sql_hr = mysql_query("SELECT * from users WHERE status='' and dep_id='3' and user_type='1'") or die(mysql_error());
        $row_hr = mysql_fetch_array($sql_hr);
        $sql_it = mysql_query("SELECT * from users WHERE status='' and user_type='0' and dep_id='1'") or die(mysql_error());
        $row_it = mysql_fetch_array($sql_it);
        $sql_gm = mysql_query("SELECT * from users WHERE status='' and user_type='2'") or die(mysql_error());
        $row_gm = mysql_fetch_array($sql_gm);

        $sql_company = mysql_query("SELECT * from company WHERE company_id='$company_id' and type='1'") or die(mysql_error());
        if (mysql_num_rows($sql_company) > 0) {
            mysql_query("INSERT INTO form_clearance (emp_num, accounting_num, supervisor_num, treasury_num, hr_num, it_num, gm_num) 
                VALUES('$emp_num', '" . $row_accouting['emp_num'] . "', '" . $row_supervisor['emp_num'] . "', '" . $row_treasury['emp_num'] . "', '" . $row_hr['emp_num'] . "', '" . $row_it['emp_num'] . "', '" . $row_gm['emp_num'] . "')") or die(mysql_error());

            $sql_emailAccounting = mysql_query("SELECT * from email WHERE department = 'accounting' and status=''") or die(mysql_error());
            while ($row_emailAccounting = mysql_fetch_array($sql_emailAccounting)) {
                $to .= $row_emailAccounting['email'] . ',';
            }
            
            $sql_emailAccounting = mysql_query("SELECT * from email WHERE department = 'bh' and status='' and emp_num='" . $row_supervisor['emp_num'] . "'") or die(mysql_error());
            while ($row_emailAccounting = mysql_fetch_array($sql_emailAccounting)) {
                $to .= $row_emailAccounting['email'] . ',';
            }
            
            $sql_emailIt = mysql_query("SELECT * from email WHERE department = 'it' and status='' and emp_num='" . $row_it['emp_num'] . "'") or die(mysql_error());
            $row_emailit = mysql_fetch_array($sql_emailIt);
                $to .= $row_emailit['email'] . ',';
            
            $sql_emailHR = mysql_query("SELECT * from email WHERE department = 'hr' and status='' and emp_num='".$row_hr['emp_num']."'") or die(mysql_error());
            while ($row_emailHR = mysql_fetch_array($sql_emailHR)) {
                $to .= $row_emailHR['email'] . ',';
            }
            
            $fullname = $firstname . ' ' . $lastname;

            $subject = "MMS CLEARANCE OF " . $fullname;
            $message = "Good day Ma'am/Sir \r\n You have clearance to approve. Please Login http://mmsv2.efi.net.ph/.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
            $headers = "From: envirocyclingfiberincorporated@efi.net.ph";
            mail($to, $subject, $message, $headers);
        }

        mysql_query("DELETE from employees WHERE emp_num='$emp_num'") or die(mysql_error());
        echo '<script>
            window.opener.location.href="../view_employee.php?status=active&active=view&http=200";
            close();
        </script>';
    } else {
        echo '<script>
            window.opener.location.href="../view_employee.php?status=active&active=view&http=400";
            close();
        </script>';
    }
} else {
    echo '<script>
            window.opener.location.href="../view_employee.php?status=active&active=view&http=400";
            close();
        </script>';
}