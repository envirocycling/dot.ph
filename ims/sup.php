<?php
include 'config.php';

$sql = mysql_query("SELECT * FROM supplier_details WHERE date_added!='' ORDER BY date_added ASC");
while ($rs = mysql_fetch_array($sql)){
    $date = $rs['date_added'];
    $month = date("F", strtotime($date));
    $day = date("d", strtotime($date));
    $year = date("Y", strtotime($date));
    echo $date."-".$month."-".$day."-".$year."<br>";
    mysql_query("UPDATE supplier_details SET month_added='$month', day_added='$day', year_added='$year' WHERE supplier_id='".$rs['supplier_id']."'");
}
?>