<?php
include("config.php");
$counter = 0;
$parameter = $_POST['parameter'];
$branch = $_POST['branch'];
$date = $_POST['date'];
if ($from > $to) {
    echo "<script>";
    echo "alert('Error you input a wrong range of dates!!');";
    echo "</script>";
} else {
    echo $date;
    $paper_buying_details=preg_split("/[|]/",$parameter);
    array_pop($paper_buying_details);
    echo "<table border = 1>";
    echo "<th class='data'>Date Recevied</th>";
    echo "<th class='data'>Priority Number</th>";
    echo "<th class='data'>Supplier ID</th>";
    echo "<th class='data'>Supplier Name</th>";
    echo "<th class='data'>Plate Number</th>";
    echo "<th class='data'>WP Grade</th>";
    echo "<th class='data'>Corrected Weight</th>";
    echo "<th class='data'>Unit Cost</th>";
    echo "<th class='data'>Paper Buying</th>";

    mysql_query("DELETE from paper_buying where date_received='$date' and branch='$branch' and notes !='manually_encoded';");

    include('config.php');
    $insert_count=0;
    $actual_count=0;
    $delete_checker=0;
    foreach ($paper_buying_details as $var) {
        $paper_buying_detailslvl2=preg_split("/[+]/",$var);
        $date_received=$paper_buying_detailslvl2[0];
        $date_received=date("Y/m/d",strtotime($date_received));
        $priority_number=$paper_buying_detailslvl2[1];
        $supplier_id=$paper_buying_detailslvl2[2];
        $supplier_name=$paper_buying_detailslvl2[3];
        $plate_number=$paper_buying_detailslvl2[4];
        $wp_grade=$paper_buying_detailslvl2[5];
        $corrected_weight=$paper_buying_detailslvl2[6];
        $unit_cost=$paper_buying_detailslvl2[7];
        $paper_buying=$paper_buying_detailslvl2[8];
        $date_to_delete=$date_received;

        echo "<tr>";
        echo "<td>";
        echo  $date_received;
        echo "</td>";
        echo "<td>";
        echo  $priority_number;
        echo "</td>";
        echo "<td>";
        echo  $supplier_id;
        echo "</td>";
        echo "<td>";
        echo  $supplier_name;
        echo "</td>";
        echo "<td>";
        echo  $plate_number;
        echo "</td>";
        echo "<td>";
        echo $wp_grade;
        echo "</td>";
        echo "<td>";
        echo $corrected_weight;
        echo "</td>";
        echo "<td>";
        echo $unit_cost;
        echo "</td>";
        echo "<td>";
        echo $paper_buying;
        echo "</td>";
        echo "</tr>";

        if(mysql_query("INSERT INTO paper_buying(date_received,priority_number,supplier_id,supplier_name,plate_number,wp_grade,corrected_weight,unit_cost,paper_buying,branch,notes,date_uploaded)
                                      VALUES('$date_received','$priority_number','$supplier_id','$supplier_name','$plate_number','$wp_grade','$corrected_weight','$unit_cost','$paper_buying','$branch','','".date("Y/m/d")."')
        ")) {
            $insert_count++;
        }
        $actual_count++;

    }

    "</table>";

    echo "<script>";
    echo "alert('$insert_count out of $actual_count has been inserted successfully...');";
    echo "</script>";

    ?>

<button onclick="javascript:window.history.back();">Back</button>

    <?php

}

?>