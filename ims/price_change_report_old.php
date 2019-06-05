<?php
include('templates/template.php');
if (!isset($_SESSION['username'])) {
    echo "<script>
window.location = 'index.php';
</script>";
}
include 'config.php';

$branch_array = array();

$sql_branch = mysql_query("SELECT * FROM branches");
while ($rs_branch = mysql_fetch_array($sql_branch)) {
    array_push($branch_array, $rs_branch['branch_name']);
}
?>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str) {
        new JsDatePick({
            useMode: 2,
            target: str,
            dateFormat: "%Y/%m/%d"

        });
    }
    ;
</script>

<script>
    $(window).load(function () {
        $(".editbox").hide();
        $("span").click(function () {
            var ID = $(this).attr('id');
            $("#addl_price_value_" + ID).hide(500);
            $("#addl_price_edit_" + ID).show(500);
            $("#expctd_vol_value_" + ID).hide(500);
            $("#expected_vol_edit_" + ID).show(500);
        });
        $("button").click(function () {
            var ID = $(this).attr('id');
            var splits = ID.split("_");

            var ID = splits[0] + '_' + splits[1];
            var branch = splits[1];
            var date = splits[2];
            var wp_grade = splits[3];
            $("#addl_price_edit_" + ID).hide(500);
            $("#addl_price_value_" + ID).show(500);
            $("#expected_vol_edit_" + ID).hide(500);
            $("#expctd_vol_value_" + ID).show(500);

            var addtl_price = $("#addtl_price_" + ID).val();
            var expctd_vol = $("#expected_vol_" + ID).val();

            $("#addl_price_value_" + ID).html(addtl_price);
            $("#expctd_vol_value_" + ID).html(expctd_vol);

            //            alert (branch+"_"+date+"_"+wp_grade);

            if (addtl_price != '' || expctd_vol != '') {
                //                alert('Successfully Save');
                var dataString = 'branch=' + branch + '&date=' + date + '&wp_grade=' + wp_grade + '&expctd_vol=' + expctd_vol + '&addtl_price=' + addtl_price;
                $.ajax({
                    type: "POST",
                    url: "save_weekly_target.php",
                    data: dataString,
                    cache: false
                });
            }

        });
    });
</script>

<style>
    table{
        font-size:10px;
        font-weight: bold;
    }
    th{
        width:500px;
    }
    #totalFooter{
        background-color: yellow;
        font-weight: bold;
    }
    .wt_avg{
        background-color: #dbeef3;
        font-weight: bold;
    }
    .eff_price_s{
        background-color: #ccc0da;
        font-weight: bold;
    }
    .eff_price_p{
        background-color: #92cddc;
        font-weight: bold;
        border-bottom: 1px solid black;
    }
    .tonnage{
        background-color: #ffffcc;
        font-weight: bold;
    }
    .weekly_target{
        background-color: #93cddd;
        font-weight: bold;
    }
    .weekly_target_cost{
        background-color: #8db4e3;
        font-weight: bold;
    }
    .monthly_target{
        background-color: #4bacc6;
        font-weight: bold;
    }
    .monthly_target_cost{
        background-color: #f79646;
        font-weight: bold;
    }
    .projection{
        background-color: #538ed5;
        font-weight: bold;
        border-bottom: 1px solid black;
    }
    .total_wo_pamp{
        background-color: yellow;
        font-weight: bold;
    }
    .total{
        background-color: #ffc000;
        font-weight: bold;
    }
    .left{
        font-weight: bold;
        text-align:left;
    }
    .ho {
        background-color: #6f92bb;
        font-weight: bold;
    }
    .ha {
        background-color: #03e4ff;
        font-weight: bold;
    }
</style>
<style>

    th{
        font-size: 12px;
        background-color:gray;
        color:white;
        padding:5px;
    }

    #weekly{
        background-color:#FFE6B2;
    }
    #TARGET{
        background-color:#FFEBC2;
        font-weight:bold;
    }
    #percentage{
        background-color:#FFF0D1;

    }
    td{
        font-size:11px;
        text-align:right;
        padding: 5px;
    }
    #left_header{
        background-color:#FFFAF0;
        font-size: 10px;
        text-align:left;
    }
    #view_brkdwn{
        font-size: 11px;
    }
    #static_size{
        width:200px;
        height:50px;

    }
    #price{
        background-color:#EBE0CC;
    }
    #branch{
        color:blue;
    }
    #branch_name{
        text-align:left;
    }
    #label{
        text-align:left;
    }
    .hidden{
        width: 10px;
    }
    #label2{
        background-color: #fff5e0;
    }
    #first{
        background-color: #FFFFCC;
        font-size: 10px;
        text-align:left;
    }
</style>
<script>
    function changegroup(val) {
        if (val == 'weekly') {
            document.getElementById('bef_af').disabled = false;
            document.getElementById('inputField2').disabled = true;
        } else {
            document.getElementById('bef_af').disabled = true;
            document.getElementById('inputField2').disabled = false;
        }
    }

    function view(val) {
        window.open("view_price_change_report.php?val=" + val, 'mywindow', 'width=1000,height=650');
    }
</script>
<div class="grid_4">

    <div class="box round first">
        <?php
//        if ($_SESSION['username'] == 'lonlon') {
        ?>
        <h2>Target & Performance</h2>
        <h6>Filtering Options</h6>
        <br>
        <form action="price_change_report.php" method="POST">
            Start Period: <input type='text'  id='inputField' name='start_date' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>
            End Period: <input type='text'  id='inputField2' name='end_date' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"> (End Period is not needed in weekly)<br>
            <?php
//            $dropdown = '';
//            $query = "SELECT * FROM branches ";
//            $result = mysql_query($query);
//            echo "Branch:";
//            $dropdown = "<select name='branch'>";
//            $dropdown .= "\r\n<option value=''>All Branch</option>";
//            while ($row = mysql_fetch_array($result)) {
//                $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
//            }
//            $dropdown .= "</select><br>";
//            echo $dropdown;

            $dropdown = '';
            $query = "SELECT * FROM wp_grades ";
            $result = mysql_query($query);
            echo "WP Grade:";
            $dropdown = "<select name='wp_grade'>";
//            $dropdown .= "\r\n<option value=''>All Grades</option>";
            while ($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['wp_grade']}'>" . strtoupper($row['wp_grade']) . "</option>";
            }
            $dropdown .= "</select><br>";
            echo $dropdown;
            ?>
            View by: <select name="group" onchange="changegroup(this.value)
                            ;">
                <option value="monthly">Monthly</option>
                <option value="weekly">Weekly</option>
                <option value="daily">Daily</option>
            </select><br>
            If Weekly: <input id="bef_af" type="text" name="bef_af" value="" size="8"  disabled="true"> (shows the week before and after)<br>
            <input type="submit" name="submit" value="Generate Report">
        </form>
        <?php
//        } else {
//
//            echo "<h4>This Report is Under Maintenance.</h4>";
//        }
        ?>
    </div>

</div>
<?php
if (isset($_POST['submit'])) {
    ?>
    <div class="grid_10">

        <div class="box round first">

            <h2>Target & Performance <?php
                $_POST['wp_grade'] = strtoupper($_POST['wp_grade']);

                echo "from " . $_POST['start_date'] . " to " . $_POST['end_date'] . " in ";
                if ($_POST['wp_grade'] == '') {
                    echo "All Grades.";
                } else {
                    echo $_POST['wp_grade'];
                }

                echo " in All Branches";
                ?></h2>
            <br>
            <table>
                <?php
                $weight_avg = array();
                $total_tonnage = array();
                echo "<thead>";
                echo "<th>Branch</th>";
                echo "<th></th>";
                foreach ($branch_array as $branch) {
                    echo "<th>$branch</th>";
                }

                if ($_POST['group'] == 'weekly') {
                    echo "<th>Total w/o Pamp</th>";
                }

                echo "<th>Total</th>";
                echo "</thead>";
                if ($_POST['group'] == 'monthly') {
                    foreach ($branch_array as $branch) {
                        $start_q = $_POST['start_date'];
                        $breaker_date = $_POST['end_date'];
                        while ($start_q <= $breaker_date) {
                            $start_date = date('Y/m/', strtotime($start_q));
                            $start_date = $start_date . "01";
                            $end_date = date('Y/m/t', strtotime($start_q));
                            $total = 0;
                            $total_prod = 0;
                            if ($_POST['wp_grade'] == "LCWL") {
                                $sql_query = mysql_query("SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' or paper_buying.wp_grade like '%WL Flexo%') and  branch like '%$branch%' and date_received >='$start_date' and date_received <='$end_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc");
                            } else if ($_POST['wp_grade'] == "ONP") {
                                $sql_query = mysql_query("SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' or paper_buying.wp_grade='NPB' or paper_buying.wp_grade='OPD') and  branch like '%$branch%' and date_received >='$start_date' and date_received <='$end_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc");
                            } else if ($_POST['wp_grade'] == "MW") {
                                $sql_query = mysql_query("SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' or paper_buying.wp_grade='CORETUBE') and  branch like '%$branch%' and date_received >='$start_date' and date_received <='$end_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc");
                            } else if ($_POST['wp_grade'] == "CHIPBOARD") {
                                $sql_query = mysql_query("SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' or paper_buying.wp_grade='CB') and  branch like '%$branch%' and date_received >='$start_date' and date_received <='$end_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc");
                            } else {
                                $sql_query = mysql_query("SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' and  branch like '%$branch%' and date_received >='$start_date' and date_received <='$end_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc");
                            }
                            while ($rs_query = mysql_fetch_array($sql_query)) {
                                $prod = $rs_query['unit_cost'] * $rs_query['sum(corrected_weight)'];
                                $total_prod+=$prod;
                                $total+=$rs_query['sum(corrected_weight)'];
                            }
//                            echo "<br>";
                            $month_q = date('F', strtotime($start_q));
                            $year_q = date('Y', strtotime($start_q));
                            $weight_avg[$branch][$month_q][$year_q] = $total_prod / $total;
                            $total_tonnage[$branch][$month_q][$year_q] = $total / 1000;
                            $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                        }
                    }

                    $start_q = $_POST['start_date'];
                    while ($start_q <= $breaker_date) {
                        $total_per = 0;
                        $month_v = date('M', strtotime($start_q));
                        $month_q = date('F', strtotime($start_q));
                        $year_q = date('Y', strtotime($start_q));
                        echo "<tr class='tonnage'>";
                        echo "<td class='left'>" . strtoupper($month_v) . "-" . $year_q . "</td>";
                        echo "<td>Actual (MT)</td>";
                        foreach ($branch_array as $branch) {
//                            $ton = $total_tonnage[$branch][$month_q][$year_q];
                            $total_per += $total_tonnage[$branch][$month_q][$year_q];
                            echo "<td>" . number_format($total_tonnage[$branch][$month_q][$year_q], 2) . "</td>";
                        }
                        echo "<td class='total'>" . number_format($total_per, 2) . "</td>";
                        echo "</tr>";

                        echo "<tr class='wt_avg'>";
                        echo "<td></td>";
                        echo "<td class='left'>Actual Cost</td>";
                        foreach ($branch_array as $branch) {
                            echo "<td>" . number_format($weight_avg[$branch][$month_q][$year_q], 2) . "</td>";
                        }
                        echo "<td class='total'></td>";
                        echo "</tr>";
                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                    }
                }

                if ($_POST['group'] == 'weekly') {
                    $start_date = $_POST['start_date'];
                    $breaker_date = date('Y/m/d', strtotime("+7 days", strtotime($start_date)));
                    $bef_af = $_POST['bef_af'];
                    if ($bef_af > 0) {
                        $mul = $bef_af * 7;
                        $start_date = date('Y/m/d', strtotime("-$mul days", strtotime($start_date)));
                        $breaker_date = date('Y/m/d', strtotime("+$mul days", strtotime($breaker_date)));
                    }

                    $c = 1;

                    $weekly_total_avg_wo_pamp = array();
                    $weekly_total_avg = array();
                    $target_per_branch_weekly = array();
                    $total_target_per_branch_weekly = array();
                    $target_cost_per_branch_weekly = array();
                    $target_per_branch_monthly = array();
                    $target_cost_per_branch_monthly = array();
                    $projection = array();

                    $tot_amount_cost = array();
                    $daily_sales_ton = array();
                    $buying = array();

                    foreach ($branch_array as $branch) {
                        $start_q = $start_date;
                        while ($start_q <= $breaker_date) {
                            $total_prod = 0;
                            $total = 0;
                            $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
                            if ($_POST['wp_grade'] == "LCWL") {
                                $sql_query = mysql_query("SELECT wp_grade,(unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' and  branch like '%$branch%' and date_received >='$start_q' and date_received <='$end_q'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc");
                            } else if ($_POST['wp_grade'] == "ONP") {
                                $sql_query = mysql_query("SELECT wp_grade,(unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' or paper_buying.wp_grade='NPB' or paper_buying.wp_grade='OPD') and  branch like '%$branch%' and date_received >='$start_q' and date_received <='$end_q'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc");
                            } else if ($_POST['wp_grade'] == "MW") {
                                $sql_query = mysql_query("SELECT wp_grade,(unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' or paper_buying.wp_grade='CORETUBE') and  branch like '%$branch%' and date_received >='$start_q' and date_received <='$end_q'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc");
                            } else if ($_POST['wp_grade'] == "CHIPBOARD") {
                                $sql_query = mysql_query("SELECT wp_grade,(unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' or paper_buying.wp_grade='CB') and  branch like '%$branch%' and date_received >='$start_q' and date_received <='$end_q'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc");
                            } else {
                                $sql_query = mysql_query("SELECT wp_grade,(unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' and  branch like '%$branch%' and date_received >='$start_q' and date_received <='$end_q'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc");
                            }
                            $ppr_buy = 0;

                            $sql_price = mysql_query("SELECT * FROM tipco_prices WHERE branch='$branch' and wp_grade='" . $_POST['wp_grade'] . "' and date_effective<='$end_q' ORDER BY date_effective DESC");
                            $rs_price = mysql_fetch_array($sql_price);

                            while ($rs_query = mysql_fetch_array($sql_query)) {
                                if ($rs_query['unit_cost'] > $rs_price['price']) {
                                    $spc_price = $rs_query['unit_cost'] - $rs_price['price'];
                                    $ppr_buy += ($spc_price * $rs_query['sum(corrected_weight)']);
                                }
                                $prod = $rs_query['unit_cost'] * $rs_query['sum(corrected_weight)'];
                                $total_prod+=$prod;
                                $total+=$rs_query['sum(corrected_weight)'];
                            }

                            $tot_amount_cost[$branch][$start_q][$end_q] += $ppr_buy;

                            $sql_buying = mysql_query("SELECT * FROM tipco_buying WHERE wp_grade='" . $_POST['wp_grade'] . "' and date_effective<='$end_q' ORDER BY date_effective DESC");
                            $rs_buying = mysql_fetch_array($sql_buying);

                            $buying[$branch][$start_q][$end_q] = $rs_buying['price'];

                            $wp = $_POST['wp_grade'];
                            if ($wp != 'LCWL' && $wp != 'CHIPBOARD') {
                                $wp = "LC" . $wp;
                            }
                            

                            $sql_daily_sales = mysql_query("SELECT sum(weight) FROM actual WHERE branch='$branch' and wp_grade='$wp' and date>='$start_q' and date<='$end_q'");
                            $rs_daily_sales = mysql_fetch_array($sql_daily_sales);
                            $daily_sales_ton[$branch][$start_q][$end_q] = $rs_daily_sales['sum(weight)'];

                            $weight_avg[$branch][$start_q][$end_q] = $total_prod / $total;
                            $total_tonnage[$branch][$start_q][$end_q] = $total / 1000;

                            $sql_target = mysql_query("SELECT * FROM weekly_target WHERE branch='$branch' and wp_grade like '%" . $_POST['wp_grade'] . "%' and date_effective='$end_q'");
                            $rs_target = mysql_fetch_array($sql_target);
                            $target_per_branch_weekly[$branch][$start_q][$end_q] = $rs_target['target'];

                            $target_cost_per_branch_weekly[$branch][$start_q][$end_q] = $rs_target['unit_cost'];

                            $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
                        }



                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_date)));
                        $breaker_date_q = date('Y/m/d', strtotime("+1 month", strtotime($breaker_date)));
                        while ($start_q <= $breaker_date_q) {
                            $month = date("Y/m", strtotime($start_q));
                            $start = $month . "/01";
                            $end = date("Y/m/t", strtotime($start_q));
                            $sql_projection = mysql_query("SELECT target FROM monthly_target WHERE wp_grade like '%" . $_POST['wp_grade'] . "%' and branch='$branch' and month='$month'");
                            $rs_projection = mysql_fetch_array($sql_projection);
                            $projection[$branch][$month] = $rs_projection['target'];
                            $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                        }
                    }

                    $start_q = $start_date;
                    while ($start_q <= $breaker_date) {
                        $overall_prod = 0;
                        $overall_total = 0;
                        $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
                        $sql_query = mysql_query("SELECT (unit_cost) as unit_cost,sum(corrected_weight),branch FROM paper_buying where paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' and date_received >='$start_q' and date_received <='$end_q' and unit_cost >0  group by unit_cost,branch order by sum(corrected_weight) desc, unit_cost asc");
                        while ($rs_query = mysql_fetch_array($sql_query)) {
                            if ($rs_query['branch'] == 'Pampanga') {
                                $prod = $rs_query['unit_cost'] * $rs_query['sum(corrected_weight)'];
                            } else {
                                $prod = ($rs_query['unit_cost'] + 0.80) * $rs_query['sum(corrected_weight)'];
                            }
                            $overall_prod+=$prod;
                            $overall_total+=$rs_query['sum(corrected_weight)'];
                        }
                        $weekly_total_avg[$start_q][$end_q] = $overall_prod / $overall_total;
                        $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
                    }

                    $start_q = $start_date;
                    while ($start_q <= $breaker_date) {
                        $overall_prod = 0;
                        $overall_total = 0;
                        $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
                        $sql_query = mysql_query("SELECT (unit_cost) as unit_cost,sum(corrected_weight),branch FROM paper_buying where paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' and  branch!='Pampanga' and date_received ='$end_q' and unit_cost >0  group by unit_cost,branch order by sum(corrected_weight) desc, unit_cost asc");
                        while ($rs_query = mysql_fetch_array($sql_query)) {
                            $prod = $rs_query['unit_cost'] * $rs_query['sum(corrected_weight)'];
                            $overall_prod+=$prod;
                            $overall_total+=$rs_query['sum(corrected_weight)'];
                        }
                        $weekly_total_avg_wo_pamp[$start_q][$end_q] = $overall_prod / $overall_total;
                        $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
                    }

                    $start_q = $start_date;
                    $month_check = date("Y/m", strtotime($start_date));
                    while ($start_q <= $breaker_date) {
                        $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
                        $month_to_check = date("Y/m", strtotime($start_q));
                        if ($month_to_check > $month_check) {
                            $month = date("M", strtotime($start_q));
                            $month_p = date("Y/m", strtotime($start_q));
                            $year = date("Y", strtotime($start_q));
                            echo "<tr class='projection'>";
                            echo "<td class='left'>$month - $year</td>";
                            echo "<td class='left'>Projection</td>";
                            $ct = 1;
                            foreach ($branch_array as $branch) {
                                if ($ct % 2) {
                                    echo "<td class='ho'>";
                                } else {
                                    echo "<td class='ha'>";
                                }
                                echo round($projection[$branch][$month_p] / 4, 2) . "</td>";
                                $ct++;
                            }
                            echo "<td class='total_wo_pamp'></td>";
                            echo "<td class='total'></td>";
                            echo "</tr>";
                            $month_check = $month_to_check;
                        }
                        $total_target = 0;
                        $total_target_wo_pamp = 0;
                        echo "<tr class='weekly_target'>";
                        echo "<td class='left'>" . $start_q . "-" . $end_q . "</td>";
                        echo "<td class='left'>Target (MT)</td>";
                        $ct = 1;
                        foreach ($branch_array as $branch) {
                            if (!empty($target_per_branch_weekly[$branch][$start_q][$end_q])) {
                                if ($branch != 'Pampanga') {
                                    $total_target_wo_pamp+=$target_per_branch_weekly[$branch][$start_q][$end_q];
                                }
                                $total_target+=$target_per_branch_weekly[$branch][$start_q][$end_q];
                                if ($ct % 2) {
                                    echo "<td class='ho'>";
                                } else {
                                    echo "<td class='ha'>";
                                }
                                if ($_SESSION['usertype'] == 'Super User') {
                                    echo "<span id = '" . $c . "_" . $branch . "' class = 'text'>";
                                    echo "<div id = 'expctd_vol_value_" . $c . "_" . $branch . "'>" . $target_per_branch_weekly[$branch][$start_q][$end_q] . "</div>";
                                    echo "</span>";
                                    echo "<div id = 'expected_vol_edit_" . $c . "_" . $branch . "' class = 'editbox'>";
                                    echo "<input class = 'marketing' id = 'expected_vol_" . $c . "_" . $branch . "' value = '" . $target_per_branch_weekly[$branch][$start_q][$end_q] . "' size = '4'>";
                                } else {
                                    echo $target_per_branch_weekly[$branch][$start_q][$end_q];
                                }
                                echo "</td>";
                            } else {
                                if ($ct % 2) {
                                    echo "<td class='ho'>";
                                } else {
                                    echo "<td class='ha'>";
                                }
                                if ($_SESSION['usertype'] == 'Super User') {
                                    echo "<span id = '" . $c . "_" . $branch . "' class = 'text'>";
                                    echo "<div id = 'expctd_vol_value_" . $c . "_" . $branch . "'>0</div>";
                                    echo "</span>";
                                    echo "<div id = 'expected_vol_edit_" . $c . "_" . $branch . "' class = 'editbox'>";
                                    echo "<input class = 'marketing' id = 'expected_vol_" . $c . "_" . $branch . "' value = '' size = '4'>";
                                } else {
                                    echo "0";
                                }
                                echo "</td>";
                            }
                            $ct++;
                        }
                        echo "<td class='total_wo_pamp'>" . round($total_target_wo_pamp, 2) . "</td>";
                        echo "<td class='total'>" . round($total_target, 2) . "</td>";
                        echo "</tr>";
                        $total_avg = 0;
                        $total_avg_wo_pamp = 0;
                        echo "<tr class='weekly_target_cost'>";
                        echo "<td class='left'></td>";
                        echo "<td class='left'>Target Cost</td>";
                        $ct = 1;
                        foreach ($branch_array as $branch) {
                            if (!empty($target_cost_per_branch_weekly[$branch][$start_q][$end_q])) {
                                if ($branch != 'Pampanga') {
                                    $total_avg_wo_pamp+=($target_cost_per_branch_weekly[$branch][$start_q][$end_q] * $target_per_branch_weekly[$branch][$start_q][$end_q]) * 1000;
                                }
                                $total_avg+=($target_cost_per_branch_weekly[$branch][$start_q][$end_q] * $target_per_branch_weekly[$branch][$start_q][$end_q]) * 1000;
                                if ($ct % 2) {
                                    echo "<td class='ho'>";
                                } else {
                                    echo "<td class='ha'>";
                                }
                                if ($_SESSION['usertype'] == 'Super User') {
                                    echo "<span id='" . $c . "_" . $branch . "' class='text'>";
                                    echo "<div id='addl_price_value_" . $c . "_" . $branch . "'>" . round($target_cost_per_branch_weekly[$branch][$start_q][$end_q], 2) . "</div>";
                                    echo "</span>";
                                    echo "<div id='addl_price_edit_" . $c . "_" . $branch . "' class='editbox'>";
                                    echo "<input class='marketing' id='addtl_price_" . $c . "_" . $branch . "' value='" . round($target_cost_per_branch_weekly[$branch][$start_q][$end_q], 2) . "' size='4'>";
                                    echo "<button id='" . $c . "_" . $branch . "_" . $end_q . "_" . $_POST['wp_grade'] . "'>Save</button></div>";
                                } else {
                                    echo round($target_cost_per_branch_weekly[$branch][$start_q][$end_q], 2);
                                }
                                echo "</td>";
                            } else {
                                if ($ct % 2) {
                                    echo "<td class='ho'>";
                                } else {
                                    echo "<td class='ha'>";
                                }
                                if ($_SESSION['usertype'] == 'Super User') {
                                    echo "<span id='" . $c . "_" . $branch . "' class='text'>";
                                    echo "<div id='addl_price_value_" . $c . "_" . $branch . "'>0</div>";
                                    echo "</span>";
                                    echo "<div id='addl_price_edit_" . $c . "_" . $branch . "' class='editbox'>";
                                    echo "<input class='marketing' id='addtl_price_" . $c . "_" . $branch . "' value='' size='4'>";
                                    echo "<button id='" . $c . "_" . $branch . "_" . $end_q . "_" . $_POST['wp_grade'] . "'>Save</button></div>";
                                } else {
                                    echo "0";
                                }
                                echo "</td>";
                            }
                            $ct++;
                        }

                        echo "<td class='total_wo_pamp'>" . round($total_avg_wo_pamp / ($total_target_wo_pamp * 1000), 2) . "</td>";
                        echo "<td class='total'>" . round($total_avg / ($total_target * 1000), 2) . "</td>";
                        echo "</tr>";

                        $total_per = 0;
                        $total_per_pamp = 0;
                        echo "<tr class='tonnage'>";
                        echo "<td class='left'></td>";
                        echo "<td class='left'>Actual (MT)</td>";
                        $ct = 1;
                        foreach ($branch_array as $branch) {
                            if ($branch != 'Pampanga') {
                                $total_per_pamp += $total_tonnage[$branch][$start_q][$end_q];
                            }
                            $total_per += $total_tonnage[$branch][$start_q][$end_q];
                            if ($ct % 2) {
                                echo "<td class='ho'";
                            } else {
                                echo "<td class='ha'";
                            }
                            echo "id='" . $branch . "_" . $_POST['wp_grade'] . "_" . $start_q . "_" . $end_q . "' onclick='view(this.id);'>" . round($total_tonnage[$branch][$start_q][$end_q], 2) . "</td>";
                            $ct++;
                        }
                        echo "<td class='total_wo_pamp'>" . round($total_per_pamp, 2) . "</td>";
                        echo "<td class='total'>" . round($total_per, 2) . "</td>";
                        echo "</tr>";

                        echo "<tr class='wt_avg'>";
                        echo "<td class='left'></td>";
                        echo "<td class='left'>Actual Cost</td>";
                        $ct = 1;
                        foreach ($branch_array as $branch) {
                            if ($ct % 2) {
                                echo "<td class='ho'>";
                            } else {
                                echo "<td class='ha'>";
                            }
                            echo round($weight_avg[$branch][$start_q][$end_q], 2) . "</td>";
                            $ct++;
                        }

                        echo "<td class='total_wo_pamp'>" . round($weekly_total_avg_wo_pamp[$start_q][$end_q], 2) . "</td>";
                        echo "<td class='total'>" . round($weekly_total_avg[$start_q][$end_q], 2) . "</td>";
                        echo "</tr>";



                        echo "<tr class='eff_price_s'>";
                        echo "<td class='left'></td>";
                        echo "<td class='left'>Effective Cost(Sales)</td>";
                        $ct = 1;
                        $a = 0;
                        $total_eff_price_s = 0;
                        foreach ($branch_array as $branch) {
                            $t = round($tot_amount_cost[$branch][$start_q][$end_q], 2);
                            $mt = round($daily_sales_ton[$branch][$start_q][$end_q], 2);
                            $b = round($buying[$branch][$start_q][$end_q], 2);
                            $cost = round(($t + ($mt * $b)) / $mt, 2);

                            $a+=($total_tonnage[$branch][$start_q][$end_q] * $cost);
                            $total_eff_price_s = $a / $total_per;
                            if ($ct % 2) {
                                echo "<td class='ho'>";
                            } else {
                                echo "<td class='ha'>";
                            }
                            echo $cost . "</td>";
                            $ct++;
                        }
                        echo "<td class='total_wo_pamp'></td>";
                        echo "<td class='total'>" . round($total_eff_price_s, 2) . "</td>";
                        echo "</tr>";

                        echo "<tr class='eff_price_p'>";
                        echo "<td class='left'></td>";
                        echo "<td class='left'>Effective Cost(Purchase)</td>";
                        $ct = 1;
                        $a = 0;
                        $total_eff_price_p = 0;
                        foreach ($branch_array as $branch) {
                            $t = round($tot_amount_cost[$branch][$start_q][$end_q], 2);
                            $mt = round($total_tonnage[$branch][$start_q][$end_q] * 1000, 2);
                            $b = round($buying[$branch][$start_q][$end_q], 2);
                            $cost = round(($t + ($mt * $b)) / $mt, 2);

                            $a+=($total_tonnage[$branch][$start_q][$end_q] * $cost);
                            $total_eff_price_p = $a / $total_per;
                            if ($ct % 2) {
                                echo "<td class='ho'>";
                            } else {
                                echo "<td class='ha'>";
                            }
                            echo $cost . "</td>";
                            $ct++;
                        }
                        echo "<td class='total_wo_pamp'></td>";
                        echo "<td class='total'>" . round($total_eff_price_p, 2) . "</td>";
                        echo "</tr>";

                        $c++;
                        $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
                    }
                }

                if ($_POST['group'] == 'daily') {

                    $breaker_date = $_POST['end_date'];
                    foreach ($branch_array as $branch) {

                        $start_q = $_POST['start_date'];
                        while ($start_q <= $breaker_date) {

                            if ($_POST['wp_grade'] == "LCWL") {
                                $sql_query = mysql_query("SELECT sum(paper_buying),sum(corrected_weight) FROM paper_buying where paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' and  branch like '%$branch%' and date_received ='$start_q'");
                            } else if ($_POST['wp_grade'] == "ONP") {
                                $sql_query = mysql_query("SELECT sum(paper_buying),sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' or paper_buying.wp_grade='NPB' or paper_buying.wp_grade='OPD') and  branch like '%$branch%' and date_received ='$start_q'");
                            } else if ($_POST['wp_grade'] == "MW") {
                                $sql_query = mysql_query("SELECT sum(paper_buying),sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' or paper_buying.wp_grade='CORETUBE') and  branch like '%$branch%' and date_received ='$start_q'");
                            } else if ($_POST['wp_grade'] == "CHIPBOARD") {
                                $sql_query = mysql_query("SELECT sum(paper_buying),sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' or paper_buying.wp_grade='CB') and  branch like '%$branch%' and date_received ='$start_q'");
                            } else {
                                $sql_query = mysql_query("SELECT sum(paper_buying),sum(corrected_weight) FROM paper_buying where paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' and  branch like '%$branch%' and date_received ='$start_q'");
                            }

                            $rs_query = mysql_fetch_array($sql_query);
                            $weight_avg[$branch][$start_q] = $rs_query['sum(paper_buying)'] / $rs_query['sum(corrected_weight)'];
                            $total_tonnage[$branch][$start_q] = $rs_query['sum(corrected_weight)'] / 1000;
                            $start_q = date('Y/m/d', strtotime("+1 day", strtotime($start_q)));
                        }
                    }



                    $start_q = $_POST['start_date'];
                    while ($start_q <= $breaker_date) {

                        $total_per = 0;
                        echo "<tr class='tonnage'>";
                        echo "<td class='left'>" . $start_q . "</td>";
                        echo "<td>Actual (MT)</td>";
                        foreach ($branch_array as $branch) {
                            $total_per += $total_tonnage[$branch][$start_q];
                            echo "<td>" . number_format($total_tonnage[$branch][$start_q], 2) . "</td
                        >";
                        }
                        echo "
                        <td class='total'>" . number_format($total_per, 2) . "</td>";
                        echo "</tr>";

                        echo "<tr class='wt_avg'>";
                        echo "<td></td>";
                        echo "<td class='left'>Actual Cost</td>";
                        foreach ($branch_array as $branch) {
                            echo
                            "<td>" . number_format($weight_avg[$branch][$start_q], 2) . "</td>";
                        }
                        echo "
            <td class='total'></td>";
                        echo "</tr>";
                        $start_q = date('Y/m/d', strtotime("+1 day", strtotime(
                                                $start_q)));
                    }
                }
                ?>
            </table>
        </div>

    </div>

    <?php
}
?>

<div class=


     "clear">

</div>

<div class="clear">

</div>

