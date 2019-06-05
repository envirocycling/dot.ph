<?php
include 'config.php';
$sql_check = mysql_query("SELECT * FROM `accounts_receivable` WHERE dr_number='".$_POST['dr_number']."' and wp_grade='".$_POST['wp_grade']."'");
$rs_num = mysql_num_rows($sql_check);

if ($rs_num >= '1') {
    mysql_query("UPDATE `accounts_receivable` SET `regular`='".$_POST['regular']."',`sundry`='".$_POST['sundry']."',`date_collected`='".$_POST['date_collected']."' WHERE dr_number='".$_POST['dr_number']."' and wp_grade='".$_POST['wp_grade']."'");
} else {
    mysql_query("INSERT INTO `accounts_receivable`(`dr_number`, `wp_grade`, `regular`, `sundry`, `date_collected`)
        VALUES ('".$_POST['dr_number']."','".$_POST['wp_grade']."','".$_POST['regular']."','".$_POST['sundry']."','".$_POST['date_collected']."')");
}

?>