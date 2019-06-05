<?php

$hostname = 'localhost';   
$dbname   = 'efi_db_manpower'; 
$username = 'efi_db_manpower';           
$password = 'Enviro101';            


mysql_connect($hostname, $username, $password) or DIE('Connection to host is failed, perhaps the service is down!');

mysql_select_db($dbname) or DIE('Database name is not available!');

?>
