<?php

include ('config.php');

$sup_id = addslashes($_REQUEST['sup_id']);

$image = mysql_query("SELECT image FROM supplier_details WHERE supplier_id='$sup_id'");
$image = mysql_fetch_assoc($image);
$image = $image['image'];

header("Content-type: image/jpeg");

echo $image;

?>