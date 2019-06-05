<?php
date_default_timezone_set("Asia/Singapore");
session_start();
include('../../../connect.php');

$emp_num = $_POST['emp_num'];
$chk_emp = mysql_query("SELECT * from employees WHERE emp_num ='$emp_num'") or die(mysql_error());

if(mysql_num_rows($chk_emp) == 1){
    $reason = $_POST['reason'];
    $date_separated= date('Y-m-d',strtotime($_POST['date_separated']));
    $row_emp = mysql_fetch_array($chk_emp);
    $emp_num = $row_emp['emp_num'];
    $firstname = $row_emp['firstname'];
    $middlename = $row_emp['middlename'];
    $lastname = $row_emp['lastname'];
    $birthdate = $row_emp['birthdate'];
    $st_brgy = $row_emp['st_brgy'];
    $town_city = $row_emp['town_city'];
    $province = $row_emp['province'];
    $contact_no = $row_emp['contact_no'];
    $civil_status = $row_emp['civil_status'];
    $gender = $row_emp['gender'];
    $tertiary = $row_emp['tertiary'];
    $secondary = $row_emp['secondary'];
    $elementary = $row_emp['elementary'];
    $date_hired = $row_emp['date_hired'];
    $date_start = $row_emp['date_start'];
    $date_regularization = $row_emp['date_regularization'];
    $company_id = $row_emp['company_id'];
    $branch_id = $row_emp['branch_id'];
    $position_id = $row_emp['position_id'];
    $rank_id = $row_emp['rank_id'];
    $status_id = $row_emp['status_id'];
    $stayin = $row_emp['stayin'];
    $tin = $row_emp['tin'];
    $tax_code= $row_emp['tax_code'];
    $sss_no = $row_emp['sss_no'];
    $phic_no = $row_emp['phic_no'];
    $hdmf_no = $row_emp['hdmf_no'];
    $sketch = $row_emp['sketch'];
    $dependents = $row_emp['dependents'];
    $emergency = $row_emp['emergency'];
    $date_updated = date('Y-m-d');
    
    if(mysql_query("INSERT INTO employees_deactivated (emp_num ,firstname, middlename, lastname, birthdate, st_brgy, town_city, province, contact_no, date_hired, date_start, company_id, branch_id, position_id, status_id, stayin, tin, sss_no, phic_no, hdmf_no, civil_status, gender, tertiary, secondary, elementary, date_regularization, rank_id, tax_code, sketch, dependents, emergency, date_updated, reason, date_separated)
        VALUES ('$emp_num','$firstname', '$middlename', '$lastname', '$birthdate', '$st_brgy', '$town_city', '$province', '$contact_no', '$date_hired', '$date_start', '$company_id','$branch_id', '$position_id', '$status_id', '$stayin', '$tin', '$sss_no', '$phic_no', '$hdmf_no','$civil_status', '$gender', '$tertiary', '$secondary', '$elementary', '$date_regularization', '$rank_id', '$tax_code', '$sketch', '$dependents', '$emergency', '$date_updated', '$reason', '$date_separated') ") or die (mysql_error())){
        mysql_query("DELETE from employees WHERE emp_num='$emp_num'") or die(mysql_error());
        echo '<script>
            window.opener.location.href="../view_employee.php?status=active&active=view&http=200";
            close();
        </script>';
    }else{
       echo '<script>
            window.opener.location.href="../view_employee.php?status=active&active=view&http=400";
            close();
        </script>'; 
    }
  
}else{
   echo '<script>
            window.opener.location.href="../view_employee.php?status=active&active=view&http=400";
            close();
        </script>';  
}