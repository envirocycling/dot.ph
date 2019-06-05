<?php
$con = mysql_connect("localhost", "efi_purchasing", "Hesoyams18");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("efi_purchasing", $con);
?>
