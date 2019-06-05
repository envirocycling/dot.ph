<?php
include 'config.php';

$que = $_GET['sup_id'];
$details = preg_split("[/]", $que);
$sup_id = $details[0];
$sup_name = $details[1];
$grade = $details[2];
$del_id = $details[3];
$total = 0;
$total_wl = 0;
$total_onp = 0;
$total_cbs = 0;
$total_occ = 0;
$total_mw = 0;
$total_cb = 0;

$sql = mysql_query("SELECT * FROM incentive_scheme WHERE del_id='$del_id'");
$rs = mysql_fetch_array($sql);
$start_date = $rs['start_date'];
$end_date = $rs['end_date'];
?>

<style>
    #example{
        border-width: 50%;
        width: 100%;
    }
    #header{
        background-color: gray;
    }
    #total{
        background-color: yellow;
    }
</style>
<h2>View <?php echo $sup_id . "-" . $sup_name . " in " . $grade; ?></h2>

<?php
//if ($grade == 'all_grades') {
//    echo "<h4>LCWL</h4>";
//    echo "<table id='example' border='1'>";
//    echo "<thead id='header'>";
//    echo "<th>Date</th>";
//    echo "<th>Price</th>";
//    echo "<th>WEIGHT</th>";
//    echo "</thead>";
//    $sql = mysql_query("SELECT * FROM sup_deliveries WHERE supplier_id='$sup_id' and wp_grade='LCWL' and date_delivered>='$start_date' and date_delivered<='$end_date'");
//    while ($rs = mysql_fetch_array($sql)) {
//        echo "<tr>";
//        echo "<td>" . $rs['date_delivered'] . "</td>";
//        $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='LCWL' and supplier_id='$sup_id' and date_received>='$start_date' and date_received<='$end_date'");
//        $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//        if (!empty($rs_paper_buying['unit_cost'])) {
//            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//        } else {
//            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='LCWL' and supplier_id='$sup_id' and date_received<='$start_date'");
//            $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//        }
//        $total_wl+=$rs['weight'];
//        echo "<td>" . $rs['weight'] . "</td>";
//        echo "</tr>";
//    }
//    echo "<tr id='total'>";
//    echo "<td>!Total!</td>";
//    echo "<td></td>";
//    echo "<td>$total_wl</td>";
//    echo "</table>";
//    echo "<br>";
//    echo "<h4>ONP</h4>";
//    echo "<table id='example' border='1'>";
//    echo "<thead id='header'>";
//    echo "<th>Date</th>";
//    echo "<th>Price</th>";
//    echo "<th>WEIGHT</th>";
//    echo "</thead>";
//    $sql = mysql_query("SELECT * FROM sup_deliveries WHERE supplier_id='$sup_id' and wp_grade='ONP' and date_delivered>='$start_date' and date_delivered<='$end_date'");
//    while ($rs = mysql_fetch_array($sql)) {
//        echo "<tr>";
//        echo "<td>" . $rs['date_delivered'] . "</td>";
//        $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='ONP' and supplier_id='$sup_id' and date_received>='$start_date' and date_received<='$end_date'");
//        $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//        if (!empty($rs_paper_buying['unit_cost'])) {
//            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//        } else {
//            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='ONP' and supplier_id='$sup_id' and date_received<='$start_date'");
//            $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//        }
//        $total_onp+=$rs['weight'];
//        echo "<td>" . $rs['weight'] . "</td>";
//        echo "</tr>";
//    }
//    echo "<tr id='total'>";
//    echo "<td>!Total!</td>";
//    echo "<td></td>";
//    echo "<td>$total_onp</td>";
//    echo "</table>";
//    echo "<br>";
//    echo "<h4>CBS</h4>";
//    echo "<table id='example' border='1'>";
//    echo "<thead id='header'>";
//    echo "<th>Date</th>";
//    echo "<th>Price</th>";
//    echo "<th>WEIGHT</th>";
//    echo "</thead>";
//    $sql = mysql_query("SELECT * FROM sup_deliveries WHERE supplier_id='$sup_id' and wp_grade='CBS' and date_delivered>='$start_date' and date_delivered<='$end_date'");
//    while ($rs = mysql_fetch_array($sql)) {
//        echo "<tr>";
//        echo "<td>" . $rs['date_delivered'] . "</td>";
//        $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='CBS' and supplier_id='$sup_id' and date_received>='$start_date' and date_received<='$end_date'");
//        $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//        if (!empty($rs_paper_buying['unit_cost'])) {
//            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//        } else {
//            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='CBS' and supplier_id='$sup_id' and date_received<='$start_date'");
//            $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//        }
//        $total_cbs+=$rs['weight'];
//        echo "<td>" . $rs['weight'] . "</td>";
//        echo "</tr>";
//    }
//    echo "<tr id='total'>";
//    echo "<td>!Total!</td>";
//    echo "<td></td>";
//    echo "<td>$total_cbs</td>";
//    echo "</table>";
//    echo "<br>";
//    echo "<h4>OCC</h4>";
//    echo "<table id='example' border='1'>";
//    echo "<thead id='header'>";
//    echo "<th>Date</th>";
//    echo "<th>Price</th>";
//    echo "<th>WEIGHT</th>";
//    echo "</thead>";
//
//    $sql = mysql_query("SELECT * FROM sup_deliveries WHERE supplier_id='$sup_id' and wp_grade='OCC' and date_delivered>='$start_date' and date_delivered<='$end_date'");
//    while ($rs = mysql_fetch_array($sql)) {
//        echo "<tr>";
//        echo "<td>" . $rs['date_delivered'] . "</td>";
//        $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='OCC' and supplier_id='$sup_id' and date_received>='$start_date' and date_received<='$end_date'");
//        $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//        if (!empty($rs_paper_buying['unit_cost'])) {
//            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//        } else {
//            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='OCC' and supplier_id='$sup_id' and date_received<='$start_date'");
//            $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//        }
//        $total_occ+=$rs['weight'];
//        echo "<td>" . $rs['weight'] . "</td>";
//        echo "</tr>";
//    }
//    echo "<tr id='total'>";
//    echo "<td>!Total!</td>";
//    echo "<td></td>";
//    echo "<td>$total_occ</td>";
//    echo "</table>";
//    echo "<br>";
//    echo "<h4>MW</h4>";
//    echo "<table id='example' border='1'>";
//    echo "<thead id='header'>";
//    echo "<th>Date</th>";
//    echo "<th>Price</th>";
//    echo "<th>WEIGHT</th>";
//    echo "</thead>";
//    $sql = mysql_query("SELECT * FROM sup_deliveries WHERE supplier_id='$sup_id' and wp_grade='MW' and date_delivered>='$start_date' and date_delivered<='$end_date'");
//    while ($rs = mysql_fetch_array($sql)) {
//        echo "<tr>";
//        echo "<td>" . $rs['date_delivered'] . "</td>";
//        $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='MW' and supplier_id='$sup_id' and date_received>='$start_date' and date_received<='$end_date'");
//        $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//        if (!empty($rs_paper_buying['unit_cost'])) {
//            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//        } else {
//            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='MW' and supplier_id='$sup_id' and date_received<='$start_date'");
//            $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//        }
//        $total_mw+=$rs['weight'];
//        echo "<td>" . $rs['weight'] . "</td>";
//        echo "</tr>";
//    }
//    echo "<tr id='total'>";
//    echo "<td>!Total!</td>";
//    echo "<td></td>";
//    echo "<td>$total_mw</td>";
//    echo "</table>";
//    echo "<br>";
//    echo "<h4>CHIPBOARD</h4>";
//    echo "<table id='example' border='1'>";
//    echo "<thead id='header'>";
//    echo "<th>Date</th>";
//    echo "<th>Price</th>";
//    echo "<th>WEIGHT</th>";
//    echo "</thead>";
//    $sql = mysql_query("SELECT * FROM sup_deliveries WHERE supplier_id='$sup_id' and wp_grade='CHIPBOARD' and date_delivered>='$start_date' and date_delivered<='$end_date'");
//    while ($rs = mysql_fetch_array($sql)) {
//        echo "<tr>";
//        echo "<td>" . $rs['date_delivered'] . "</td>";
//        $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='CHIPBOARD' and supplier_id='$sup_id' and date_received>='$start_date' and date_received<='$end_date'");
//        $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//        if (!empty($rs_paper_buying['unit_cost'])) {
//            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//        } else {
//            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='CHIPBOARD' and supplier_id='$sup_id' and date_received<='$start_date'");
//            $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//        }
//        $total_cb+=$rs['weight'];
//        echo "<td>" . $rs['weight'] . "</td>";
//        echo "</tr>";
//    }
//    echo "<tr id='total'>";
//    echo "<td>!Total!</td>";
//    echo "<td></td>";
//    echo "<td>$total_cb</td>";
//    echo "</table>";
//    $total_all = $total_wl + $total_onp + $total_cbs + $total_occ + $total_mw + $total_cb;
//    echo "<br>";
//    echo "<h2>Actual Deliveries :" . $total_all . "</h2>";
//} else {
?>

<?php
echo "<table id='example' border='1'>";
echo "<thead id='header'>";
echo "<th>Date</th>";
echo "<th>WP Grade</th>";
echo "<th>Price</th>";
echo "<th>Weight</th>";
echo "</thead>";
if ($grade=='all_grades') {
    $sql = mysql_query("SELECT * FROM sup_deliveries WHERE supplier_id='$sup_id' and date_delivered>='$start_date' and date_delivered<='$end_date' order by wp_grade,date_delivered;");
} else {
    $sql = mysql_query("SELECT * FROM sup_deliveries WHERE supplier_id='$sup_id' and wp_grade='$grade' and date_delivered>='$start_date' and date_delivered<='$end_date' order by wp_grade,date_delivered;");
}
while ($rs = mysql_fetch_array($sql)) {
    echo "<tr>";
    echo "<td>" . $rs['date_delivered'] . "</td>";
    echo "<td>" . $rs['wp_grade'] . "</td>";
    $total+=$rs['weight'];
    if ($rs['wp_grade']=='OCC') {
        $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='OCC' or wp_grade='LCOCC') and supplier_id='$sup_id' and date_received>='$start_date' and date_received<='$end_date' ORDER BY date_received DESC");
    } else if ($rs['wp_grade']=='CHIPBOARD' || $row['wp_grade']=='CB') {
        $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='CB' or wp_grade='CHIPBOARD') and supplier_id='$sup_id' and date_received>='$start_date' and date_received<='$end_date' ORDER BY date_received DESC");
    } else if ($rs['wp_grade']=='CBS') {
        $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='CBS' or wp_grade='LCCBS') and supplier_id='$sup_id' and date_received>='$start_date' and date_received<='$end_date' ORDER BY date_received DESC");
    } else {
        $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='".$rs['wp_grade']."' and supplier_id='$sup_id' and date_received>='$start_date' and date_received<='$end_date' ORDER BY date_received DESC");
    }
    $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
    if (!empty($rs_paper_buying['unit_cost'])) {
        echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
    } else {
        if ($rs['wp_grade']=='OCC') {
            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='OCC' or wp_grade='LCOCC') and supplier_id='$sup_id' and date_received<='$start_date' ORDER BY date_received DESC");
        }  else if ($rs['wp_grade']=='CHIPBOARD') {
            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='CB' or wp_grade='CHIPBOARD') and supplier_id='$sup_id' and date_received<='$start_date' ORDER BY date_received DESC");
        } else if ($rs['wp_grade']=='CBS') {
            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='CBS' or wp_grade='LCCBS') and supplier_id='$sup_id' and date_received<='$start_date' ORDER BY date_received DESC");
        } else {
            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='".$rs['wp_grade']."' and supplier_id='$sup_id' and date_received<='$start_date' ORDER BY date_received DESC");
        }
        $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
        echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
    }
    echo "<td>" . $rs['weight'] . "</td>";
    echo "</tr>";
}
echo "<tr id='total'>";
echo "<td>!Total!</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>$total</td>";
echo "</table>";
echo "<br>";

?>



