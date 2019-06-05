<?php

$hostname = '192.168.10.200';   
$dbname   = 'efi_ims'; 
$username = 'root';           
$password = '';            


mysql_connect($hostname, $username, $password) or DIE('Connection to host is failed, perhaps the service is down!');

mysql_select_db($dbname) or DIE('Database name is not available!');

$select = mysql_query("SELECT * from users ") or die (mysql_error());
while($row = mysql_fetch_array($select)){
echo $row['user_id'];
}

?>
