<?php

session_start();
include('../../../connect.php');
include('process_loading.php');

echo $id = $_GET['id'];
echo $emp = $_GET['emp'];
echo $action = $_GET['action'];
if($action == 'att') {
    mysql_query("UPDATE training_seminar_attachment SET file_name='0' WHERE tns_id='$id' and emp_num LIKE '(".$emp.")'") or die(mysql_error());
}else{
     mysql_query("UPDATE training_seminar_attachment SET cert_name='0 WHERE tns_id='$id' and emp_num LIKE '(".$emp.")'") or die(mysql_error());
}