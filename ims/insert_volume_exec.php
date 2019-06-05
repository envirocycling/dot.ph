<?php
include("config.php");

    $date = date("Y/m/d");
    $start_year = date("Y", strtotime($date));
    $supplier_id = $_POST['supplier_id'];
    $branch = $_POST['branch'];
    $que = preg_split("[/]",$_POST['month']);
    $month = $que[0];

    $from_volume = $start_year."/".$month."/01";
    $starting_volume = $start_year."/".$_POST['month'];

    $sql = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$supplier_id' and branch_delivered='$branch' and date_delivered>='$from_volume' and date_delivered<='$starting_volume'");
    $rs = mysql_fetch_array($sql);
    $start_volume_weight = round($rs['sum(weight)']/1000,2);

    mysql_query("INSERT INTO `sup_starting_volume`(`supplier_id`, `starting_volume`, `starting_volume_date`, `branch`)
        VALUES ('$supplier_id','$start_volume_weight','$starting_volume','$branch')");
    echo "<script>";
    echo "alert('Updated successfully...');";
    echo "window.close();";
    echo "</script>";


?>