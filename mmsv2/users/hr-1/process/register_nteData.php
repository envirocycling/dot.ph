<?php
date_default_timezone_set("Asia/Singapore");
include('iconnect.php');

$emp_num = $_GET['emp_num'];

$sql_empData = mysqli_query($con,"SELECT * from employees WHERE emp_num='$emp_num'");
$row_empData = mysqli_fetch_array($sql_empData);

$sql_company = mysqli_query($con,"SELECT * from company WHERE company_id = '".$row_empData['company_id']."'");
$row_company = mysqli_fetch_array($sql_company);

$sql_branch = mysqli_query($con,"SELECT * from branches WHERE branch_id = '".$row_empData['branch_id']."'");
$row_branch = mysqli_fetch_array($sql_branch);

$sql_position = mysqli_query($con,"SELECT * from positions WHERE p_id = '".$row_empData['position_id']."'");
$row_position= mysqli_fetch_array($sql_position);

$optVal = '<option value="" selected disabled>Choose Delinquecy Committed</option>';
$sql_delinquency =  mysqli_query($con,"SELECT * from delinquency WHERE emp_num='".$row_empData['emp_num']."' and nte='0'");
while($row_deliquency = mysqli_fetch_array($sql_delinquency)){
    $optVal .= '<option value="'.$row_deliquency['d_id'].'">'.date('Y/m/d', strtotime($row_deliquency['date_committed'])).' - '.$row_deliquency['violation'].'</option>';
}

echo utf8_encode(strtoupper($row_company['description'].'~'.$row_branch['branch_name'].'~'.$row_position['position'].'~'.$optVal));

mysqli_close($con);