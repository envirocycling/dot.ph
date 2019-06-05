<?php
session_start();
include('../../../connect.php');

$emp_num = $_POST['emp_num'];

$chk_emp = mysql_query("SELECT * from employees WHERE emp_num ='$emp_num'") or die(mysql_error());
$chk_empdeac = mysql_query("SELECT * from employees_request WHERE emp_num ='$emp_num' and type ='deactivate'") or die(mysql_error());

if(mysql_num_rows($chk_emp) == 1){
    if(mysql_num_rows($chk_empdeac) == 0){
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
    $date_hired = $row_emp['date_hired'];
    $date_start = $row_emp['date_start'];
    $date_regularization = $row_emp['date_regularization'];
    $company_id = $row_emp['company_id'];
    $branch_id = $row_emp['branch_id'];
    $position_id = $row_emp['position_id'];
    $status_id = $row_emp['status_id'];
    $stayin = $row_emp['stayin'];
    $tin = $row_emp['tin'];
    $sss_no = $row_emp['sss_no'];
    $phic_no = $row_emp['phic_no'];
    $hdmf_no = $row_emp['hdmf_no'];
    
    mysql_query("INSERT INTO employees_request (emp_num ,firstname, middlename, lastname, birthdate, st_brgy, town_city, province, contact_no, date_hired, date_start, company_id, branch_id, position_id, status_id, stayin, tin, sss_no, phic_no, hdmf_no, civil_status, type)
        VALUES ('$emp_num','$firstname', '$middlename', '$lastname', '$birthdate', '$st_brgy', '$town_city', '$province', '$contact_no', '$date_hired', '$date_start', '$company_id','$branch_id', '$position_id', '$status_id', '$stayin', '$tin', '$sss_no', '$phic_no', '$hdmf_no','$civil_status','deactivate') ") or die (mysql_error());
  
    }
}