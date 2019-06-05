<?php

$hostname = 'localhost';   
$dbname   = 'efi_ims'; 
$username = 'efi_ims';           
$password = 'Hesoyams18';            


mysql_connect($hostname, $username, $password) or DIE('Connection to host is failed, perhaps the service is down!');

mysql_select_db($dbname) or DIE('Database name is not available!');

?>
