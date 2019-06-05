<?php
include('config.php');
$val = $_GET['val'];
$que = preg_split("[_]", $val);
?>
<script type='text/javascript' src='jquery-1.3.2.min.js'></script>
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/setup.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<style>
    #example{
        border-width:50%;
    }
    .total {
        background-color: yellow;
        font-weight: bold;
    }
</style>
<?php
$ngayon = date('F d, Y');
echo "<h2><u>$que[0]</u> " . $que[1] . "  Paper Buying as of : <u><b><i>" . $que[2] . " - " . $que[3] . "</i></b></u></h2>";
?>
<?php
include 'config.php';

$start_q = date("Y/m/d", strtotime("-21 days", strtotime($que[2])));
$end_date = $que[3];

$supplier_id_array2 = array ();
$supplier_name = array ();
$supplier_target = array ();
$supplier_unit_cost = array ();

$sql_sup_del = mysql_query("SELECT supplier_id,supplier_name FROM paper_buying WHERE date_received>='$start_q' and date_received<='$end_date' and branch='$que[0]' GROUP BY supplier_id");
while ($rs_sup_del = mysql_fetch_array($sql_sup_del)) {
    array_push($supplier_id_array2,$rs_sup_del['supplier_id']);
    $supplier_name[$rs_sup_del['supplier_id']]=$rs_sup_del['supplier_name'];
}

//$sql_sup  = mysql_query("SELECT supplier_details.supplier_id,supplier_details.supplier_name,sup_buying_price.expected_volume FROM supplier_details INNER JOIN sup_buying_price ON supplier_details.supplier_id=sup_buying_price.supplier_id WHERE sup_buying_price.wp_grade='$que[1]' and sup_buying_price.date_effective='$que[3]' and supplier_details.branch='$que[0]'");
//while ($rs_sup = mysql_fetch_array($sql_sup)) {
//    array_push($supplier_id_array2,$rs_sup['supplier_id']);
//    $supplier_name[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];
//    $supplier_target[$rs_sup['supplier_id']]=$rs_sup['expected_volume'];
//}


$supplier_id_array = array_unique($supplier_id_array2);
$del_week = array();

$end_date = $que[3];
foreach ($supplier_id_array as $supplier_id) {
    $start_q = date("Y/m/d", strtotime("-21 days", strtotime($que[2])));
    while($start_q < $end_date) {
        $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
        $query = mysql_query("SELECT sum(corrected_weight) FROM paper_buying WHERE supplier_id='$supplier_id' and branch='$que[0]' and wp_grade like '$que[1]%' and date_received>='$start_q' and date_received<='$end_q' ORDER BY date_received DESC LIMIT 1");
        $rs = mysql_fetch_array($query);
        $del_week[$supplier_id][$start_q][$end_q]=$rs['sum(corrected_weight)'];
        $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
    }
    $sql_uc = mysql_query("SELECT unit_cost FROM paper_buying WHERE supplier_id='$supplier_id' and date_received<='$end_date' and wp_grade like '" . $que[1] . "%' and branch='$que[0]' ORDER BY date_received DESC");
    $rs_uc = mysql_fetch_array($sql_uc);
    $supplier_unit_cost[$supplier_id]=$rs_uc['unit_cost'];
}

?>


<center>
    <table class="data display datatable" id="example">
        <?php

        $start_q = date("Y/m/d", strtotime("-21 days", strtotime($que[2])));
        $end_date = $que[3];
        echo "<thead>";
        echo '<tr class="data">';
        echo "<th class='data'>Supplier_id</th>";
        echo "<th class='data'>Supplier_Name</th>";
//        echo "<th class='data'>Target Volume</th>";
        while($start_q < $end_date) {
            $end_q = date('Y/m/d', strtotime("+6days", strtotime($start_q)));
            $day_start = date("M d, Y", strtotime($start_q));
            $day_end = date("M d, Y", strtotime($end_q));
            echo "<th class='data'>$day_start-$day_end</th>";
            $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
        }
        echo "<th class='data'>Unit Cost</th>";
        echo "<th class='data'>Var on prev week</th>";
        echo "</tr>";
        echo "</thead>";
        $total = array ();
        $prod = 0;
        $total_prod = 0;
        $total_target = 0;


        foreach ($supplier_id_array as $supplier_id) {
            echo "<tr class='data'>";
            echo "<td class='data'>" . $supplier_id . "</td>";
            echo "<td class='data'>" . $supplier_name[$supplier_id] . "</td>";
            $total_target+=$supplier_target[$supplier_id];
//            echo "<td class='data'>$supplier_target[$supplier_id]</td>";

            $start_q = date("Y/m/d", strtotime("-21 days", strtotime($que[2])));
            while($start_q < $end_date) {
                $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
                $total[$start_q][$end_q]+=$del_week[$supplier_id][$start_q][$end_q]/1000;
                echo "<td class='data'>".round($del_week[$supplier_id][$start_q][$end_q]/1000,2)."</td>";
                $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
            }
            echo "<td class='data'>$supplier_unit_cost[$supplier_id]</td>";
            $prod+=$supplier_unit_cost[$supplier_id]*$del_week[$supplier_id][$que[2]][$que[3]];
            echo "<td class='data'>".round($del_week[$supplier_id][$que[2]][$que[3]]-$del_week[$supplier_id][date("Y/m/d", strtotime("-7 days", strtotime($que[2])))][date("Y/m/d", strtotime("-7 days", strtotime($que[3])))],2)."</td>";
            echo "</tr>";
        }

        echo "<tr class='total'>";
        echo "<td>!TOTAL!</td>";
        echo "<td></td>";
//        echo "<td>$total_target</td>";
        $start_q = date("Y/m/d", strtotime("-21 days", strtotime($que[2])));
        while($start_q < $end_date) {
            $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
            echo "<td>".round($total[$start_q][$end_q],2)."</td>";
            $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
        }
//        echo "<td>".$prod/$total[$que[2]][$que[3]]."</td>";
        echo "<td></td>";
        echo "<td>".round($total[$que[2]][$que[3]]-$total[date("Y/m/d", strtotime("-7 days", strtotime($que[2])))][date("Y/m/d", strtotime("-7 days", strtotime($que[3])))],2)."</td>";
        echo "</tr>";
        ?>
    </table>
</center>