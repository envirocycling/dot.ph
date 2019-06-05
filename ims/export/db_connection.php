<?php

$hostname = "localhost";
$username = "efi_ims";
$password = "Hesoyams18";
$database = "efi_ims";
 
 
$conn = mysql_connect("$hostname","$username","$password") or die(mysql_error());
mysql_select_db("$database", $conn);



?>
