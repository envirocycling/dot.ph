<?php
include('../../../connect.php');

$sql_emp= mysql_query("SELECT * FROM employees WHERE emp_num = '".$_POST['emp_id']."'");
$row=mysql_fetch_array($sql_emp);

$sql_branch = mysql_query("SELECT * from branches WHERE branch_id = '".$row['branch_id']."'");
$row_branch = mysql_fetch_array($sql_branch);

$sql_position= mysql_query("SELECT * from positions WHERE p_id = '".$row['position_id']."'");
$row_position = mysql_fetch_array($sql_position);

$sql_company = mysql_query("SELECT * from company WHERE company_id = '".$row['company_id']."'");
$row_company = mysql_fetch_array($sql_company);

echo $data = $row_position['position'].'-'.$row_position['p_id'];
