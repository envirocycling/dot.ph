<?php
session_start();
include('../../../connect.php');

$emp_num = $_POST['emp_num'];

$chk_emp = mysql_query("SELECT * from employees WHERE emp_num ='$emp_num'") or die(mysql_error());

if(mysql_num_rows($chk_emp) == 1){
    mysql_query("DELETE from employees WHERE emp_num='$emp_num'") or die(mysql_error());
}
