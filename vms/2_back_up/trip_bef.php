<?php
$m = $_POST['month'];
$ms = explode('-',$m);
$month_num=$ms[1];
$month2=$ms[0];
$year = $ms[0];
$month = date('F',strtotime($m));
$id=$_POST['plate'].'-'.$month.'-'.$month_num.'-'.$year;

header("Location: trip_new.php?id=$id&page=trip");
?>