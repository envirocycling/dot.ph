<?php
include("config.php");

    $date = date("Y/m/d");
    $start_year = date("Y", strtotime($date));
    $supplier_id = $_POST['supplier_id'];
    $truck_id = $_POST['truck_id'];
    $que = preg_split("[/]",$_POST['month']);
    $month = $que[0];

    $from_volume = $start_year."/".$month."/01";
    $starting_volume = $start_year."/".$_POST['month'];

    $sql = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$supplier_id' and date_delivered>='$from_volume' and date_delivered<='$starting_volume'");
    $rs = mysql_fetch_array($sql);
    $start_volume_weight = $rs['sum(weight)'];

    mysql_query("UPDATE truck_rent SET starting_volume='$start_volume_weight',starting_volume_date='$starting_volume' WHERE truck_id='$truck_id'");
    echo "<script>";
    echo "alert('Updated successfully...');";
    echo "window.close();";
    echo "</script>";


?>