<?php

session_start();
date_default_timezone_set("Asia/Singapore");

include('iconnect.php');

$emp_num = $_POST['emp'];
$sql_empData = mysqli_query($con, "SELECT * from employees WHERE emp_num='$emp_num'");
$row_empData = mysqli_fetch_array($sql_empData);

$date = date('Y-m-d');
$company_id = $row_empData['company_id'];
$position_id = $row_empData['position_id'];
$branch_id = $row_empData['branch_id'];
$dep_id = $_POST['dep_id'];
$description = mysql_real_escape_string($_POST['description']);
$supervisor_num = $_POST['supervisor_num'];
$supervisor_position = $_POST['supervisor_position'];
$delinquency = $_POST['delinquency'];

if (mysqli_query($con, "INSERT INTO nte (date_submitted, company_id, emp_num, position_id, branch_id, dep_id, description, supervisor_num, supervisor_position) 
    VALUES('$date', '$company_id', '$emp_num', '$position_id', '$branch_id', '$dep_id', '$description', '$supervisor_num', '$supervisor_position')")) {
    $sql_max = mysqli_query($con, "SELECT max(nte_id) as nte_id from nte");
    $row_max = mysqli_fetch_array($sql_max);
    mysqli_query($con, "UPDATE delinquency SET nte='".$row_max['nte_id']."' WHERE d_id='$delinquency'");
    mysqli_close($con);
    echo '<script>
            window.top.location.href="../view_delinquency.php?status=active&active=view&http=201";
    </script>';
} else {
    mysqli_close($con);
    echo '<script>
            window.top.location.href="../register_nte.php?status=active&active=view&http=400";
    </script>';
}
