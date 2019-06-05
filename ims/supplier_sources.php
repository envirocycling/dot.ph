<?php
ini_set('max_execution_time', 1000);
include("templates/template.php");

$sql_check = mysql_query("SELECT * FROM supplier_assessment WHERE volume like '%mt%'");
while ($rs_check = mysql_fetch_array($sql_check)) {
//    echo $rs_check['volume']."-".substr($rs_check['volume'],0,-2)."<br>";
}

?>
<style>
    .total{
        background-color: yellow;
    }
    .summary{
        border: 1px solid black;
        font-size: 15px;
        text-align: center;
    }
    .td{
        border: 1px solid black;
    }
</style>
<?php
include("config.php");

?>
<script>
    function openWindow(str) {
        var x = screen.width / 2 - 700 / 2;
        var y = screen.height / 2 - 450 / 2;
        window.open("view_supplier_assessment_delivery.php?sup_id=" + str, 'mywindow', 'width=600,height=600');
    }
</script>

<?php

?>

<?php
if (isset ($_POST['submit'])) {
    echo '<div class="grid_10" >';
    echo '<div class="box round first grid">';
    echo '<h2>Supplier Sources</h2>';
    $que = preg_split("[_]",$_POST['supplier_id']);
    $supplier_id = $que[0];
    $supplier_name = $que[1];
    $wp_grade = $_POST['wp_grade'];
    $type = $_POST['type'];
    $end_date = date("Y/m/d");
    $start_date = date('Y/m/d', strtotime("-6 months", strtotime($end_date)));
    $current_day = date("d", strtotime($end_date));
    $last_day_of_month = date("t", strtotime($end_date));
    $day_percentage = $current_day / $last_day_of_month;
    if ($wp_grade == '') {
        echo "<h4>Assessment of ".$supplier_name." in All Grades</h4>";
    } else {
        echo "<h4>Assessment of ".$supplier_name." in ".strtoupper($wp_grade)."</h4>";
    }
    if ($wp_grade != '') {

        echo '<table class="data display datatable" id="example" border="1">';
        echo "<thead>";
        echo "<th>Supplier</th>";
//                echo "<th>Capacity</th>";
        echo "<th>Volume</th>";
        $start_q = $start_date;
        while ($start_q <= $end_date) {
            $month_q = date('F', strtotime($start_q));
            $year_q = date('Y', strtotime($start_q));
            echo "<th>" . $month_q . " " . $year_q . "</th>";
            $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
        }

//                echo "<th>Tons were not getting</th>";
        echo "</thead>";


        $supid_array = array ();
        $sup_del = array ();
        $sup_capacity = array ();
        $sup_iden_del = array ();
        $sup_type = array ();
        $total_per_month = array();
        $sql_assessment = mysql_query("SELECT * FROM supplier_assessment WHERE deliver_to='$supplier_id' and wp_grade like '%$wp_grade%' and type like '%$type%' and status!='deleted' GROUP BY supplier_id ORDER BY date DESC");
        while ($rs_assessment = mysql_fetch_array($sql_assessment)) {
            array_push($supid_array,$rs_assessment['supplier_id']);
            $sup_iden_del[$rs_assessment['supplier_id']]=$rs_assessment['volume'];
            $sup_type[$rs_assessment['supplier_id']]=$rs_assessment['type'];
        }


        foreach ($supid_array as $sup_id) {
            $start_q = $start_date;
            while ($start_q <= $end_date) {
                $month_q = date('F', strtotime($start_q));
                $year_q = date('Y', strtotime($start_q));
                $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and wp_grade like '%$wp_grade%' and month_delivered='$month_q' and year_delivered='$year_q'");
                $rs_del = mysql_fetch_array($sql_del);
                $sup_del[$sup_id][$month_q][$year_q] = $rs_del['sum(weight)']/1000;
                $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
            }
        }
//                print_r ($supid_array);
//                $sup_id_array = array_unique($supid_array);
//                print_r ($sup_id_array);

        foreach ($supid_array as $sup_id) {
            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE supplier_id='$sup_id' and wp_grade like '%$wp_grade%' and date_effective<='$end_date' ORDER BY date_effective DESC");
            $rs_cap = mysql_fetch_array($sql_cap);
            $sup_capacity[$sup_id]=$rs_cap['capacity'];
        }



        $total_capacity = 0;
        $total_iden_del = 0;
        foreach ($supid_array as $sup_id) {
            $calculated_tons_we_are_not_getting=0;
            echo "<tr>";
            $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$sup_id'");
            $rs_sup = mysql_fetch_array($sql_sup);
            echo "<td>".$sup_id."_".$rs_sup['supplier_name']."</td>";
//                    echo "<td>$sup_capacity[$sup_id]</td>";
            $total_capacity+=$sup_capacity[$sup_id];
            echo "<td>$sup_iden_del[$sup_id]</td>";
            $total_iden_del+=$sup_iden_del[$sup_id];
            $start_q = $start_date;
            while ($start_q <= $end_date) {
                $month_q = date('F', strtotime($start_q));
                $year_q = date('Y', strtotime($start_q));
                echo "<td id='".$sup_id."_".$month_q."_".$year_q."_".$wp_grade."' onclick='openWindow(this.id);'>".$sup_del[$sup_id][$month_q][$year_q]."</td>";
//                        if (!empty($sup_del[$sup_id][$month_q][$year_q])) {
                $total_per_month[$month_q][$year_q]+=$sup_del[$sup_id][$month_q][$year_q];
//                        }
                $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
            }
            $month_d = date('F', strtotime($end_date));
            $year_d = date('Y', strtotime($end_date));
            $based_on_date_capacity = round($sup_capacity[$sup_id] * $day_percentage, 0);
            $calculated_tons_we_are_not_getting = round($based_on_date_capacity - $sup_del[$sup_id][$month_d][$year_d], 0);
//                    echo "<td>$calculated_tons_we_are_not_getting</td>";
            echo "</tr>";
        }
        echo "<tr class='total'>";
        echo "<td>!TOTAL!</td>";
//                echo "<td>$total_capacity</td>";
        echo "<td>$total_iden_del</td>";
        $start_q = $start_date;
        while ($start_q <= $end_date) {
            $month_q = date('F', strtotime($start_q));
            $year_q = date('Y', strtotime($start_q));
            echo "<td>".$total_per_month[$month_q][$year_q]."</td>";
            $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
        }
//                echo "<td></td>";
        echo "</tr>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
    } else {

        $grade_array = array('LCWL','ONP','CBS','OCC','MW','CHIPBOARD');
        echo "<table width='400' class='summary'>";

        echo "<thead>";
        echo "<th class='td'>WP Grade</th>";
//                echo "<th class='td'>Capacity</th>";
        echo "<th class='td'>Volume</th>";
        echo "</thead>";

        foreach ($grade_array as $wp_grade) {
            $supid_array = array ();
            $sup_del = array ();
            $sup_capacity_total = array ();
            $sup_iden_del_total = array ();
            $sql_assessment = mysql_query("SELECT * FROM supplier_assessment WHERE deliver_to='$supplier_id' and wp_grade like '%$wp_grade%' and type like '%$type%' and status!='deleted' GROUP BY supplier_id ORDER BY date DESC");
            while ($rs_assessment = mysql_fetch_array($sql_assessment)) {
                array_push($supid_array,$rs_assessment['supplier_id']);
                $sup_iden_del_total[$wp_grade]+=$rs_assessment['volume'];
            }
            foreach ($supid_array as $sup_id) {
                $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE supplier_id='$sup_id' and wp_grade like '%$wp_grade%' and date_effective<='$end_date' ORDER BY date_effective DESC");
                $rs_cap = mysql_fetch_array($sql_cap);
                $sup_capacity_total[$wp_grade]+=$rs_cap['capacity'];
            }
            echo "<tr>";
            echo "<td class='td'>$wp_grade</td>";
//                    if( !empty ($sup_capacity_total[$wp_grade])) {
//                        echo "<td class='td'>$sup_capacity_total[$wp_grade]</td>";
//                    } else {
//                        echo "<td class='td'>0</td>";
//                    }
            if (!empty ($sup_iden_del_total[$wp_grade])) {
                echo "<td class='td'>$sup_iden_del_total[$wp_grade]</td>";
            } else {
                echo "<td class='td'>0</td>";
            }
            echo "</tr>";
        }
//                echo "</table>";
//                echo "</td>";
//                echo "</tr>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        foreach ($grade_array as $wp_grade) {
            echo '<div class="grid_10" >';
            echo '<div class="box round first grid">';
            echo "<h2>".$wp_grade."</h2>";

            echo '<table class="data display datatable" id="example" border="1">';
            echo "<thead>";
            echo "<th>Supplier</th>";
//                    echo "<th>Capacity</th>";
            echo "<th>Volume</th>";
            echo "<th>Type</th>";

            $start_q = $start_date;
            while ($start_q <= $end_date) {
                $month_q = date('F', strtotime($start_q));
                $year_q = date('Y', strtotime($start_q));
                echo "<th>" . $month_q . " " . $year_q . "</th>";
                $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
            }

//                    echo "<th>Tons were not getting</th>";
            echo "</thead>";


            $supid_array = array ();
            $sup_del = array ();
            $sup_capacity = array ();
            $sup_type = array ();
            $sup_iden_del = array ();
            $total_per_month = array();
            $sql_assessment = mysql_query("SELECT * FROM supplier_assessment WHERE deliver_to='$supplier_id' and wp_grade like '%$wp_grade%' and type like '%$type%' and status!='deleted' GROUP BY supplier_id ORDER BY date DESC");
            while ($rs_assessment = mysql_fetch_array($sql_assessment)) {
                array_push($supid_array,$rs_assessment['supplier_id']);
                $sup_iden_del[$rs_assessment['supplier_id']]=$rs_assessment['volume'];
                $sup_type[$rs_assessment['supplier_id']]=$rs_assessment['type'];
            }


            foreach ($supid_array as $sup_id) {
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $month_q = date('F', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and wp_grade like '%$wp_grade%' and month_delivered='$month_q' and year_delivered='$year_q'");
                    $rs_del = mysql_fetch_array($sql_del);
                    $sup_del[$sup_id][$month_q][$year_q] = $rs_del['sum(weight)']/1000;
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }
            }
            $total_tons_not_getting = 0;
            foreach ($supid_array as $sup_id) {
                $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE supplier_id='$sup_id' and wp_grade like '%$wp_grade%' and date_effective<='$end_date' ORDER BY date_effective DESC");
                $rs_cap = mysql_fetch_array($sql_cap);
                $sup_capacity[$sup_id]=$rs_cap['capacity'];
            }
            $total_capacity = 0;
            $total_iden_del = 0;

            foreach ($supid_array as $sup_id) {
                $calculated_tons_we_are_not_getting=0;
                echo "<tr>";
                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$sup_id'");
                $rs_sup = mysql_fetch_array($sql_sup);
                echo "<td>".$sup_id."_".$rs_sup['supplier_name']."</td>";
//                        echo "<td>$sup_capacity[$sup_id]</td>";
                $total_capacity+=$sup_capacity[$sup_id];
                echo "<td>$sup_iden_del[$sup_id]</td>";
                $total_iden_del+=$sup_iden_del[$sup_id];
                $start_q = $start_date;
                echo "<td>$sup_type[$sup_id]</td>";
                while ($start_q <= $end_date) {
                    $month_q = date('F', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    echo "<td>".$sup_del[$sup_id][$month_q][$year_q]."</td>";
//                            if (!empty($sup_del[$sup_id][$month_q][$year_q])) {
                    $total_per_month[$month_q][$year_q]+=$sup_del[$sup_id][$month_q][$year_q];
//                            }
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }
                $month_d = date('F', strtotime($end_date));
                $year_d = date('Y', strtotime($end_date));
                $based_on_date_capacity = round($sup_capacity[$sup_id] * $day_percentage, 0);
                $calculated_tons_we_are_not_getting = round($based_on_date_capacity - $sup_del[$sup_id][$month_d][$year_d], 0);
//                        echo "<td>$calculated_tons_we_are_not_getting</td>";
                $total_tons_not_getting+=$calculated_tons_we_are_not_getting;
                echo "</tr>";
            }

            echo "<tr class='total'>";
            echo "<td>!TOTAL!</td>";
//                    echo "<td>$total_capacity</td>";
            echo "<td>$total_iden_del</td>";
            echo "<td></td>";
            $start_q = $start_date;
            while ($start_q <= $end_date) {
                $month_q = date('F', strtotime($start_q));
                $year_q = date('Y', strtotime($start_q));
                echo "<td>".$total_per_month[$month_q][$year_q]."</td>";
                $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
            }
//                    echo "<td>$total_tons_not_getting</td>";
            echo "</tr>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
        }
    }
}
?>

<div class="clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>