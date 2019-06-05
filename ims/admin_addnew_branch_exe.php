<?php


include ("config.php");
$branch_name=$_POST['branch_name'];
mysql_query("INSERT INTO branches (branch_name) values('$branch_name') ;");

header("Location:".$_SERVER['HTTP_REFERER']);

?>