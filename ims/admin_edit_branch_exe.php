<?php
include ("config.php");
$branch_id=$_POST['branch_id'];
$branch_name=$_POST['branch_name'];
mysql_query("UPDATE branches set branch_name='$branch_name' where branch_id='$branch_id'");

header("Location:".$_SERVER['HTTP_REFERER']);
?>