


<?php
include("config.php");

$branch_id=$_GET['branch_id'];
mysql_query("DELETE from branches where branch_id='$branch_id'");
header("Location:".$_SERVER['HTTP_REFERER']);

?>