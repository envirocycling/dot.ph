<?php
include("config.php");
$result=mysql_query("SELECT * from sup_deliveries where day_delivered=''");
while($row=mysql_fetch_array($result)){
    $del_id=$row['del_id'];
    $date_delivered=$row['date_delivered'];
    $day=date("j", strtotime($date_delivered));
    mysql_query("UPDATE sup_deliveries set day_delivered='$day' where del_id=$del_id");
}

?>