<?php

	$con = mysql_connect("sql109.xtreemhost.com", "xth_12246993", "hesoyams18");
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db("xth_12246993_quota", $con);
?>