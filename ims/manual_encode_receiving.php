<style>
    #button{
        font-size: 20px;
        height: 30px;
        width: 100px;
    }
</style>
<?php
include 'config.php';
session_start();
$branch = $_SESSION['user_branch'];
$date = $_POST['date'];
$count = $_POST['count'];
$ctr = 0;
echo "<center>";
echo "<h2>Encode Receiving in ".$branch."</h2>";
echo "<h2>Date: ".$date."</h2>";
echo "<form action='manual_encode_exec.php' method='POST'>";
echo "<input type='hidden' name='date' value='".$date."'>";
echo "<input type='hidden' name='count' value='".$count."'>";
echo "<table border='1'>";
echo "<tr>";
echo "<td align='center'><b>Supplier Name</b></td>";
echo "<td align='center'><b>Priority Number</b></td>";
echo "<td align='center'><b>Wp_Grade</b></td>";
echo "<td align='center'><b>Weight</b></td>";
echo "<td align='center'><b>Remarks</b></td>";
echo "<td align='center'><b>Mc Percentage</b></td>";
echo "<td align='center'><b>Mc_Weight</b></td>";
echo "<td align='center'><b>Plate Number</b></td>";
echo "</tr>";
while ($ctr < $count) {
    echo "<tr>";
    echo "<td><select name='supplier_id".$ctr."' id='combobox' >";
    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive'");
    while ($rs_sup = mysql_fetch_array($sql_sup)) {
        echo "<option value='".$rs_sup['supplier_id']."_".$rs_sup['supplier_name']."'>".$rs_sup['supplier_id']."_".$rs_sup['supplier_name']."</option>";
    }
    echo "</select></td>";
    echo "<td><input type='text' name='priority".$ctr."' value=''></td>";
    echo "<td><input type='text' name='wp_grade".$ctr."' value=''></td>";
    echo "<td><input type='text' name='weight".$ctr."' value=''></td>";
    echo "<td><input type='text' name='remarks".$ctr."' value=''></td>";
    echo "<td><input type='text' name='mc_percentage".$ctr."' value=''></td>";
    echo "<td><input type='text' name='mc_weight".$ctr."' value=''></td>";
    echo "<td><input type='text' name='plate_number".$ctr."' value=''></td>";
    echo "</tr>";
    $ctr++;
}
echo "<tr>";
echo "<td colspan='8' align='center'><br><input type='submit' id='button' name='submit' value='Submit'><br><br></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "</center>";
?>
