<?php
session_start();
include('../../../connect.php');

$branch_dataX = '('.$_POST['branch_id'].')';

$sql_bh = mysql_query("SELECT * from users WHERE branch_id LIKE '%$branch_dataX%' and user_type='3' ") or die(mysql_error());
$row_bh = mysql_fetch_array($sql_bh);

$sql_data = mysql_query("SELECT * from employees WHERE emp_num = '".$row_bh['emp_num']."'") or die(mysql_error());
$row_data = mysql_fetch_array($sql_data);
$str_data = strlen($row_data['middlename']) - 1;
$fullname = ucwords($row_data['firstname'].' '.substr($row_data['middlename'],0,-$str_data).' '.$row_data['lastname']);
echo$bh_data = $fullname.'-'.$row_bh['emp_num'];