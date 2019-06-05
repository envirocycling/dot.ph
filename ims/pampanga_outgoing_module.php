<?php include("config.php");
$counter=0;
$parameter= $_POST['parameter'];
$branch="Pampanga";
$receiving_details=preg_split("/[|]/",$parameter);
array_pop($receiving_details);
echo "<table border = 1>";
echo "<th>DR Number</th>";
echo "<th>Date</th>";
echo "<th>Supplier</th>";
echo "<th>Plate Number</th>";
echo "<th>WP Grade</th>";
echo "<th>Weight</th>";
echo "<th>Branch</th>";
$date_to_delete="";
$branch_to_delete=$branch;
foreach ($receiving_details as $var) {
    $receiving_detailslvl2=preg_split("/[+]/",$var);
    $date_to_delete=$receiving_detailslvl2[1];

    break;
}
$date_to_delete=date("Y/m",strtotime($date_to_delete));

mysql_query("DELETE FROM outgoing where date like '%$date_to_delete%' and branch='$branch'");


foreach ($receiving_details as $var) {
    $receiving_detailslvl2=preg_split("/[+]/",$var);
    $dr_number=$receiving_detailslvl2[0];
    $date=$receiving_detailslvl2[1];
    $supplier=$receiving_detailslvl2[2];
    $plate_no=$receiving_detailslvl2[3];
    $wp_grade=$receiving_detailslvl2[4];
    $weight=$receiving_detailslvl2[5];

    echo "<tr>";
    echo "<td>";
    echo $dr_number;
    echo "</td>";
    echo "<td>";
    echo $date;
    echo "</td>";
    echo "<td>";
    echo $supplier;
    echo "</td>";
    echo "<td>";
    echo $plate_no;
    echo "</td>";
    echo "<td>";
    echo $wp_grade;
    echo "</td>";
    echo "<td>";

    echo $weight;
    echo "</td>";
    echo "<td>";

    echo $branch;
    echo "</td>";
    echo "</tr>";


    if(mysql_query("INSERT INTO outgoing(str,date,trucking,plate_number,wp_grade,weight,branch)
                                VALUES('$dr_number','$date','$supplier','$plate_no','$wp_grade','$weight','$branch')")) {
        $counter++;
    }





}


"</table>";
/*
echo "<script>";
echo "alert('$counter records has been inserted successfully...');";
echo "window.history.back();";
echo "</script>";
*/
?>