<?php
session_start();
include('../../../connect.php');
include('process_loading.php');

$date_submitted = $_POST['date_submitted'];
$emp_num = $_POST['emp_num'];
$branch_id = $_POST['branch'];
$position_id = $_POST['position_box'];
$class = $_POST['class'];
$temp_date1 = $_POST['date1'];
$temp_date2 = $_POST['date2'];
$per_date = $_POST['date3'];
$type_intial = $_POST['type'];
$type = $type_intial.'~'.$_POST[$type_intial.'_box'];
$bh_id = $_POST['bh_box'];
$in_house = $_POST['in_house'];
$transportation = $_POST['transportation'];
$rate = $_POST['rate'];
$approved_id = $_POST['approved_id'];

$sql_emp = mysql_query("SELECT * from employees WHERE emp_num='$emp_num'") or die(mysql_error());
$row_emp = mysql_fetch_array($sql_emp);

$sql_verifier = mysql_query("SELECT * from users WHERE user_id='".$_SESSION['user_id']."'") or die(mysql_error());
$row_verifier = mysql_fetch_array($sql_verifier);
$verfied_id = $row_verifier['emp_num'];

if(mysql_query("INSERT INTO manpower_movement (date_submitted, emp_num, branch_id, position_id, class, temp_date1, temp_date2, per_date, type, bh_id, in_house, transportation, change_rate, verified_id, approved_id, status, company_id)
                 VALUES ('$date_submitted', '$emp_num', '".$row_emp['branch_id']."', '$position_id', '$class', '$temp_date1', '$temp_date2', '$per_date', '$type', '$bh_id', '$in_house', '$transportation', '$rate' ,'$verfied_id', '$approved_id', 'pending', '".$row_emp['company_id']."')") or die(mysql_error())){
 
                 echo '<script>
                        window.top.location.href="../register_empmovement.php?active=register&http=200";
                </script>';
}else{
    echo '<script>
            window.top.location.href="../register_empmovement.php?active=register&http=400";
        </script>';
}