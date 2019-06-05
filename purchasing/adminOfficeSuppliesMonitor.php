<?php include("templates/template.php"); ?>
<style>
    table td{
        font-size: 12px;
        border-bottom:solid;
        border-width:1px;
        padding:5px;
    }
    #items{
        color:gray;
        font-size:8px;
    }
</style>
<?php
$date = date("Y/m/d");
$date = date("Y/m", strtotime("-1 month", strtotime($date)));
$date = $date."/01";
include("config.php");
$sql = mysql_query("SELECT * FROM branches");
while ($rs = mysql_fetch_array($sql)) {
    echo '<div class="grid_10">';
    echo '<div class="box round first">';
    echo '<h2>Office Supply ' . $rs['branch_name'] . '</h2>';
    echo '<table class="data display datatable" id="example">';
    echo "<thead>";
    echo "<th>ID</th>";
    echo "<th>Date</th>";
    echo "<th>Canvasser</th>";
    echo "<th>Branch</th>";
    echo "<th>Items</th>";
    echo "</thead>";
    $query = mysql_query("SELECT * FROM requests where type='office supplies' and status ='Delivered' and branch='" . $rs['branch_name'] . "' and date>='$date'");
    while ($row = mysql_fetch_array($query)) {
        if ($row['request_id'] % 2 == '1') {
            echo "<tr id='odd'>";
        } else {
            echo "<tr id='even'>";
        }
        echo "<td class='data'>" . $row['request_id'] . "</td>";
        echo "<td class='data'>" . $row['date'] . "</td>";
        echo "<td class='data'>" . $row['canvasser'] . "</td>";
        echo "<td>" . $row['branch'] . "</td>";
        echo "<td>";


        if (!empty($row['qty1']) && !empty($row['um1']) && !empty($row['desc1'])) {
            echo $row['qty1'] . $row['um1'] . ":" . $row['desc1'] . "<br>";
        }
        if (!empty($row['qty2']) && !empty($row['um2']) && !empty($row['desc2'])) {
            echo $row['qty2'] . $row['um2'] . ":" . $row['desc2'] . "<br>";
        }
        if (!empty($row['qty3']) && !empty($row['um3']) && !empty($row['desc3'])) {
            echo $row['qty3'] . $row['um3'] . ":" . $row['desc3'] . "<br>";
        }
        if (!empty($row['qty4']) && !empty($row['um4']) && !empty($row['desc4'])) {
            echo $row['qty4'] . $row['um4'] . ":" . $row['desc4'] . "<br>";
        }
        if (!empty($row['qty5']) && !empty($row['um5']) && !empty($row['desc5'])) {
            echo $row['qty5'] . $row['um5'] . ":" . $row['desc5'] . "<br>";
        }
        if (!empty($row['qty6']) && !empty($row['um6']) && !empty($row['desc6'])) {
            echo $row['qty6'] . $row['um6'] . ":" . $row['desc6'] . "<br>";
        }
        if (!empty($row['qty7']) && !empty($row['um7']) && !empty($row['desc7'])) {
            echo $row['qty7'] . $row['um7'] . ":" . $row['desc7'] . "<br>";
        }
        if (!empty($row['qty8']) && !empty($row['um8']) && !empty($row['desc8'])) {
            echo $row['qty8'] . $row['um8'] . ":" . $row['desc8'] . "<br>";
        }
        if (!empty($row['qty9']) && !empty($row['um9']) && !empty($row['desc9'])) {
            echo $row['qty9'] . $row['um9'] . ":" . $row['desc9'] . "<br>";
        }
        if (!empty($row['qty10']) && !empty($row['um10']) && !empty($row['desc10'])) {
            echo $row['qty10'] . $row['um10'] . ":" . $row['desc10'] . "<br>";
        }
        if (!empty($row['qty11']) && !empty($row['um11']) && !empty($row['desc11'])) {
            echo $row['qty11'] . $row['um11'] . ":" . $row['desc11'] . "<br>";
        }
        if (!empty($row['qty12']) && !empty($row['um12']) && !empty($row['desc12'])) {
            echo $row['qty12'] . $row['um12'] . ":" . $row['desc12'];
        }
        echo "</td>";
        echo "</tr>";
    }
    echo '</table>';

    echo '</div>';
    echo '</div>';
}
?>




<div class="clear">
</div>