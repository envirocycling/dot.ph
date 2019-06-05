<?php
$m = $_POST['month'];
$ms = explode('-',$m);
$month=$ms[1];
$month2=$ms[0];
$id=$_POST['plate'].'-'.$month.'-'.$month2;

header("Location: trip_new.php?id=$id");
?>