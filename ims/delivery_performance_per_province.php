<?php
include("templates/template.php");
?>
<style>

    #total{
        background-color: yellow;
    }
    #prev{
        background-color: orange;
    }

</style>
<link href='notifCss/sNotify_1.css' rel='stylesheet' type='text/css' />
<?php
include("config.php");
$wp_array = array();
$supplier_array = array();
$deliveries_per_month = array();
$total_quota = 0;
$total_perf = 0;
$variance_notif_counter = 0;
$with_no_remarks_counter = 0;
?>
<script>
    function view(str) {
        window.open("view_delivery_performance_per_province.php?details=" + str, 'mywindow', 'width=1200,height=700');
    }
</script>
<?php
$start_date = $_POST['start_date'];
$breaker_date = $_POST['end_date'];
$filtering_grade = $_POST['wp_grade'];
$start_year = date("Y", strtotime($start_date));
$start_year2 = date("Y", strtotime($start_date));
$start_month = date("m", strtotime($start_date));
$start_day = date("d", strtotime($start_date));
$end_year = date("Y", strtotime($breaker_date));
$end_month = date("m", strtotime($breaker_date));
$end_day = date("d", strtotime($breaker_date));
$total_per_month = array();
$total_l6m = 0;
$total_perct = 0;
$total_tot_perct = 0;
$date_prev = date('Y/m/d', strtotime("-1 month", strtotime($breaker_date)));
$month_prev = date('F', strtotime($date_prev));
$year_prev = date('Y', strtotime($date_prev));
$sql_prov = mysql_query("Select * FROM supplier_details WHERE status!='inactive' GROUP BY province");
while ($rs_prov = mysql_fetch_array($sql_prov)) {
    $sql_del = mysql_query("SELECT sum(sup_deliveries.weight) FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE supplier_details.inter_branch='0' and sup_deliveries.wp_grade like '%$filtering_grade%' and supplier_details.province='" . $rs_prov['province'] . "' and supplier_details.status!='inactive' and sup_deliveries.month_delivered='$month_prev' and sup_deliveries.year_delivered='$year_prev'");
    $rs_del = mysql_fetch_array($sql_del);
    $total_perct+=$rs_del['sum(sup_deliveries.weight)'];
}
?>
<div class="grid_10" >
    <div class="box round first grid">
        <h2>Delivery Performance Per Province As of
            <?php
            echo $start_date . " to " . $breaker_date . " in ";
            if (!empty($filtering_grade)) {
                echo $filtering_grade;
            } else {
                echo "All Grades";
            }
            ?></h2>

        <table class="data display datatable" id="example" border="1">
            <?php
            echo "<thead>";
            echo "<th>Province</th>";
            $start_q = $start_date;
            while ($start_q <= $breaker_date) {
                $month_q = date('F', strtotime($start_q));
                $year_q = date('Y', strtotime($start_q));
                echo "<th>" . $month_q . " " . $year_q . "</th>";
                $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
            }

            echo "<th>Prev  Percentage</th>";
            echo "<th>Avg Last 6 Months</th>";
            echo "</thead>";



            $sql_prov = mysql_query("Select * FROM supplier_details WHERE status!='inactive' GROUP BY province");
            while ($rs_prov = mysql_fetch_array($sql_prov)) {

                $ctr_m = 0;
                $start_date = $_POST['start_date'];
                $breaker_date = $_POST['end_date'];
                $filtering_grade = $_POST['wp_grade'];
                echo "<tr id='" . $rs_prov['province'] . "_".$start_date."_".$breaker_date."_".$filtering_grade."' onclick='view(this.id);'>";
                if (!empty($rs_prov['province'])) {
                    echo "<td>" . $rs_prov['province'] . "</td>";
                } else {
                    echo "<td>UNKNOWN</td>";
                }

                $start_q = $start_date;
                while ($start_q <= $breaker_date) {
                    $month_q = date('F', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    $sql_del = mysql_query("SELECT sum(sup_deliveries.weight) FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE supplier_details.inter_branch='0' and sup_deliveries.wp_grade like '%$filtering_grade%' and supplier_details.province='" . $rs_prov['province'] . "' and supplier_details.status!='inactive' and sup_deliveries.month_delivered='$month_q' and sup_deliveries.year_delivered='$year_q'");
                    $rs_del = mysql_fetch_array($sql_del);
                    if (!empty($rs_del['sum(sup_deliveries.weight)'])) {
                        $total_per_month[$month_q . "_" . $year_q]+=$rs_del['sum(sup_deliveries.weight)'] / 1000;
                        echo "<td>" . round($rs_del['sum(sup_deliveries.weight)'] / 1000, 2) . "</td>";
                    } else {
                        echo "<td>0</td>";
                    }

                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }

                $sql_prev = mysql_query("SELECT sum(sup_deliveries.weight) FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE supplier_details.inter_branch='0' and sup_deliveries.wp_grade like '%$filtering_grade%' and supplier_details.province='" . $rs_prov['province'] . "' and supplier_details.status!='inactive' and sup_deliveries.month_delivered='$month_prev' and sup_deliveries.year_delivered='$year_prev'");
                $rs_prev = mysql_fetch_array($sql_prev);
                $total_tot_perct+=($rs_prev['sum(sup_deliveries.weight)'] / $total_perct) * 100;
                echo "<td id='prev'>" . round(($rs_prev['sum(sup_deliveries.weight)'] / $total_perct) * 100, 2) . "</td>";

                $start_q = date('Y/m/d', strtotime("-6 months", strtotime($breaker_date)));

                $total_avg_l6m = 0;
                $count = 0;

                while ($start_q < $breaker_date) {
                    $month_q = date('F', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    $sql_del = mysql_query("SELECT sum(sup_deliveries.weight) FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE supplier_details.inter_branch='0' and sup_deliveries.wp_grade like '%$filtering_grade%' and supplier_details.province='" . $rs_prov['province'] . "' and supplier_details.status!='inactive' and sup_deliveries.month_delivered='$month_q' and sup_deliveries.year_delivered='$year_q'");
                    $rs_del = mysql_fetch_array($sql_del);
                    if (!empty($rs_del['sum(sup_deliveries.weight)'])) {
                        $total_avg_l6m+=$rs_del['sum(sup_deliveries.weight)'] / 1000;
                        $count++;
                    }
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }

                if ($count == 6) {
                    $total_avg_l6m = $total_avg_l6m / 6;
                }
                if ($count == 5) {
                    $total_avg_l6m = $total_avg_l6m / 5;
                }
                if ($count == 4) {
                    $total_avg_l6m = $total_avg_l6m / 4;
                }
                if ($count == 3) {
                    $total_avg_l6m = $total_avg_l6m / 3;
                }
                if ($count == 2) {
                    $total_avg_l6m = $total_avg_l6m / 2;
                }
                if ($count == 1) {
                    $total_avg_l6m = $total_avg_l6m / 1;
                }
                $total_l6m+=$total_avg_l6m;

                echo "<td id='total'>" . round($total_avg_l6m, 2) . "</td>";
                echo "</tr>";
            }
            echo "<tr id='total'>";
            echo "<td>!TOTAL!</td>";

            $start_q = $start_date;
            while ($start_q <= $breaker_date) {
                $month_q = date('F', strtotime($start_q));
                $year_q = date('Y', strtotime($start_q));
                echo "<td id='total'>" . round($total_per_month[$month_q . "_" . $year_q], 2) . "</td>";
                $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
            }

            $l6m = date('Y/m/d', strtotime("-6 monthS", strtotime($breaker_date)));
            $l6m_end_date = date('Y/m/d', strtotime("-1 month", strtotime($breaker_date)));
            $l6m_total = 0;
            $start_q = $start_date;
            while ($start_q <= $l6m_end_date) {
                $month_q = date('F', strtotime($start_q));
                $year_q = date('Y', strtotime($start_q));
                $l6m_month = date('F', strtotime($l6m));
                $l6m_year = date('Y', strtotime($l6m));
                if ($l6m_month == $month_q && $l6m_year == $year_q) {
                    $l6m_total+=round($total_per_month[$month_q . "_" . $year_q], 2);
                    $l6m = date('Y/m/d', strtotime("+1 month", strtotime($l6m)));
                }
                $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
            }
            $l6m_total = $l6m_total / 6;
            echo "<td id='total'>" . round($total_tot_perct) . "</td>";
            echo "<td>" . round($l6m_total, 2) . "</td>";
            echo "</tr>";
            ?>

        </table>
    </div>
</div>


<div class="clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>