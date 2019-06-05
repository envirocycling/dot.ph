<?php
session_start();
include('config.php');
foreach($_SESSION['to_update_array'] as $value) {

    $var2=preg_split("[~]",$value);
    $str=$var2[0];
    $outgoing_date=$var2[1];
    mysql_query("UPDATE bales set date='$outgoing_date' where str_no='$str'");


}


?>