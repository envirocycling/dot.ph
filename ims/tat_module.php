<?php

include("config.php");
$counter=0;
$parameter= $_POST['parameter'];
$branch=$_POST['branch'];
$tat_details=preg_split("/[|]/",$parameter);
array_pop($tat_details);

foreach ($tat_details as $var) {
    $tat_detailslvl2=preg_split("/[+]/",$var);
    $reference=$tat_detailslvl2[0];
    $date=$tat_detailslvl2[1];
    $supplier=$tat_detailslvl2[2];
    $no_of_grades=$tat_detailslvl2[3];
    $actual_weight=$tat_detailslvl2[4];
    $arrival=$tat_detailslvl2[5];
    $start=$tat_detailslvl2[6];
    $finish=$tat_detailslvl2[7];
    $queue_time=$tat_detailslvl2[8];
    $unloading_time=$tat_detailslvl2[9];
    $total_time=$tat_detailslvl2[10];

    if(mysql_query("INSERT INTO tat (reference,date,supplier_id,no_of_grades,actual_weight,arrival,start,finish,queue_time,unloading_time,total_time,branch)
                                VALUES('$reference','$date','$supplier','$no_of_grades','$actual_weight','$arrival','$start','$finish','$queue_time','$unloading_time','$total_time','$branch')")) {
        $counter++;
    }

}
echo "<script>";
echo "alert('$counter records has been inserted successfully...');";
echo "window.history.back();";
echo "</script>";

?>