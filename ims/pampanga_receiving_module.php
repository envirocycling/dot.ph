<?php include("config.php");
$counter=0;
$parameter= $_POST['parameter'];
$branch="PAMPANGA";
$receiving_details=preg_split("/[|]/",$parameter);
array_pop($receiving_details);
echo "<table border = 1>";
echo "<th>Supplier ID</th>";
echo "<th>WP Grade</th>";
echo "<th>Weight</th>";
echo "<th>Branch Delivered</th>";
echo "<th>Date Delivered</th>";
echo "<th>Month Delivered</th>";
echo "<th>Year Delivered</th>";

$date_to_delete="";
$branch_to_delete=$branch;
foreach ($receiving_details as $var) {
    $receiving_detailslvl2=preg_split("/[+]/",$var);
    $date_to_delete=$receiving_detailslvl2[5];

    break;
}
$date_to_delete=date("Y/m",strtotime($date_to_delete));

mysql_query("DELETE FROM sup_deliveries where date_delivered like '%$date_to_delete%' and branch_delivered like '%$branch%'");

foreach ($receiving_details as $var) {
    $receiving_detailslvl2=preg_split("/[+]/",$var);

    $supplier_id=$receiving_detailslvl2[0];
    $wp_grade=$receiving_detailslvl2[2];
    $supplier_name= $receiving_detailslvl2[1];
    if($wp_grade=='LCWL' || $wp_grade=='CHIPBOARD' ) {
        $wp_grade=$wp_grade;
    }else {
        $wp_grade=substr($wp_grade,2);

    }
    $weight=$receiving_detailslvl2[3];

    $date=$receiving_detailslvl2[5];

    $month_delivered=date("F",strtotime($receiving_detailslvl2[6]));
    $year_delivered=date("Y",strtotime($receiving_detailslvl2[7]));
    $day_delivered=date("j",strtotime($date));



    echo "<tr>";
    echo "<td>";
    echo $supplier_id;
    echo "</td>";
    echo "<td>";
    echo  $wp_grade;
    echo "</td>";
    echo "<td>";
    echo  $weight;
    echo "</td>";
    echo "<td>";
    echo  $branch;
    echo "</td>";
    echo "<td>";
    echo  $date;
    echo "</td>";
    echo "<td>";
    $month_delivered=date("F",strtotime($date));
    echo $month_delivered;
    echo "</td>";
    echo "<td>";
    $year_delivered=date("Y",strtotime($date));
    echo $year_delivered;
    echo "</td>";
    echo "</tr>";
    $query2="SELECT * FROM supplier_details where supplier_id='$supplier_id'";
    $result2=mysql_query($query2);
    $row2 = mysql_fetch_array($result2);


    if(mysql_query("INSERT INTO sup_deliveries(supplier_id,supplier_name,supplier_type,bh_in_charge,wp_grade,weight,branch_delivered,date_delivered,month_delivered,year_delivered,day_delivered)                                VALUES('$supplier_id','".$row2['supplier_name']."','".$row2['classification']."','".$row2['bh_in_charge']."','$wp_grade','$weight','$branch','$date','$month_delivered','$year_delivered','$day_delivered')")) {

        $counter++;

    }

}


"</table>";

echo "<script>";
echo "alert('$counter records has been inserted successfully...');";
echo "window.history.back();";
echo "</script>";

?>