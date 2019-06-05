<?php

include ('config.php');

$user_id = addslashes($_REQUEST['user_id']);

$image = mysql_query("SELECT image FROM users WHERE user_id='$user_id'");
$image = mysql_fetch_assoc($image);
$image = $image['image'];

header("Content-type: image/jpeg");

echo $image;

?>