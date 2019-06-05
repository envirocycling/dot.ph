<?php
include('../../../connect.php');

$emp_num = str_replace('(', '', rtrim($_GET['emp_num'], ')'));
$sql_pendingTNS = mysql_query("SELECT training_must_attended from employees WHERE emp_num='$emp_num'");
$row_pendingTNS = mysql_fetch_array($sql_pendingTNS);

//$slctOpt = '<option value="" selected></option>';
//$pendingTNS = explode('~', $row_pendingTNS['training_must_attended']);
//foreach($pendingTNS as $exVal){
//    $slctOpt .= '<option value='.utf8_encode($exVal).'>'.strtoupper(utf8_encode($exVal)).'</option>';
//}
echo utf8_encode($row_pendingTNS['training_must_attended']);

