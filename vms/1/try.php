<?php

$hostname = '192.168.10.201';   
$dbname   = 'db_efi_truck_report'; 
$username = 'root';           
$password = '';            


mysql_connect($hostname, $username, $password) or DIE('Connection to host is failed, perhaps the service is down!');

mysql_select_db($dbname) or DIE('Database name is not available!');

$sql = mysql_query("Select * from tbl_users") or die (mysql_error());
while ($row = mysql_fetch_array($sql)){
echo $row['Name'].'<br/>';
}
?>
