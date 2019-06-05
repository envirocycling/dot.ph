<?php

ini_set('max_execution_time', 1000);
include("config.php");

echo "<div align='center'>";
echo "<br><br><br>";
echo "<font color='Blue' size='30'>Saving Data to IMS</font>";
echo "<br>";
echo "<font color='Blue' size='30'>Please Wait</font>";
echo "<br>";
echo "<img src='images/ajax-loader.gif'>";
echo "</div>";

$counter = 0;
$ctr = $_POST['ctr'];
$c = 0;
$branch = $_POST['branch'];
$from = $_POST['from'];
$to = $_POST['to'];

mysql_query("DELETE from paper_buying where date_received>='$from' and date_received<='$to' and branch='$branch' and notes !='manually_encoded';");

$insert_count = 0;
$actual_count = 0;
$delete_checker = 0;
while ($c < $ctr) {
    $date_received = $_POST['date' . $c];
    $priority_number = $_POST['priority_no' . $c];
    $supplier_id = $_POST['supplier_id' . $c];
    $sql = mysql_query("SELECT supplier_name FROM supplier_details WHERE supplier_id='$supplier_id'");
    $rs = mysql_fetch_array($sql);
    $supplier_name = $rs['supplier_name'];
    $plate_number = $_POST['plate_number' . $c];
    $wp_grade = $_POST['wp_grade' . $c];
    if ($wp_grade == 'LCWL PADJ') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'CARDS') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CT') {
        $wp_grade = 'CORETUBE';
    }
    if ($wp_grade == 'CB') {
        $wp_grade = 'CHIPBOARD';
    }
    $corrected_weight = $_POST['corrected_weight' . $c];
    $unit_cost = $_POST['unit_cost' . $c];
    $paper_buying = $_POST['paper_buying' . $c];
    if ($wp_grade != 'OTHERS') {
        if (mysql_query("INSERT INTO paper_buying(date_received,priority_number,supplier_id,supplier_name,plate_number,wp_grade,corrected_weight,unit_cost,paper_buying,branch,notes)
                                      VALUES('$date_received','$priority_number','$supplier_id','$supplier_name','$plate_number','$wp_grade','$corrected_weight','$unit_cost','$paper_buying','$branch','')
    ")) {

            $insert_count++;
        }
    }
    $actual_count++;
    $c++;
}

"</table>";

echo "<script>";
echo "alert('$insert_count out of $actual_count has been inserted successfully...');";
echo "history.back();";
echo "</script>";
?>