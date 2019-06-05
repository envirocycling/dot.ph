<?php

include("config.php");


$req_id = $_GET['request_id'];

mysql_query("UPDATE requests SET status='for canvass' where request_id='$req_id'");
header('Location: canvassing_home.php');

?>