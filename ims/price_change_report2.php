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

    function view(val) {
        window.open("view_price_change_report.php?val=" + val, 'mywindow', 'width=1000,height=650');
    }
</script>
<style>
    body{
        background-color: #2e5e79;
    }
    .table{
        border: 1px solid black;
        font-size: 12px;
        font-weight: bold;
    }
    .table td{
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        border: 1px solid black;
    }
    .table th{
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        border: 1px solid black;
    }
    .header{
        font-size: 12px;
        font-weight: bold;
        background-color:gray;
        color:white;
        padding:5px;
        text-align: center;
    }
    .ha {
        background-color: #ffffcc;
        font-weight: bold;
    }
    .ho {
        background-color: #8db4e3;
        font-weight: bold;
    }
    .total_wo_pamp{
        background-color: yellow;
        font-weight: bold;
    }
    .total{
        background-color: #ffc000;
        font-weight: bold;
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

<div class="grid_4">

    <div class="box round first">
        <h2>Target & Performance</h2>
        <h6>Filtering Options</h6>
        <br>
        <form action="price_change_report2.php" method="POST">
            Start Target: <input type='text'  id='inputField' name='start_date' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>
            <?php
            $query = "SELECT * FROM wp_grades ";
            $result = mysql_query($query);
            echo "WP Grade:";
            $dropdown = "<select name='wp_grade'>";
            $dropdown .= "\r\n<option value=''>All Grades</option>";
            $dropdown .= "\r\n<option value=''>__________</option>";
            while ($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
            }
            $dropdown .= "</select><br>";
            echo $dropdown;
            ?>
            Weeks: <input id="bef_af" type="text" name="bef_af" value="" size="8"> (shows the week before and after)<br>
            <input type="submit" name="submit" value="Generate Report">
        </form>

    </div>

</div>
<?php
if (isset($_POST['submit'])) {
    ?>
    <div class="grid_16">

        <div class="box round first">

            <h2>Target & Performance <?php
                $_POST['wp_grade'] = strtoupper($_POST['wp_grade']);
                $start_date = $_POST['start_date'];
                $breaker_date = date('Y/m/d', strtotime("+7 days", strtotime($start_date)));
                $bef_af = $_POST['bef_af'];
                if ($bef_af > 0) {
                    $mul = $bef_af * 7;
                    $start_date = date('Y/m/d', strtotime("-$mul days", strtotime($start_date)));
                    $breaker_date = date('Y/m/d', strtotime("+$mul days", strtotime($breaker_date)));
                }
                echo "from $start_date to $breaker_date in ";
                if ($_POST['wp_grade'] == '') {
                    echo "All Grades.";
                } else {
                    echo $_POST['wp_grade'] . ".";
                }
                ?></h2>
            <br>
            <table class="table">
                <?php
                $weight_avg = array();
                $total_tonnage = array();

                $weekly_total_avg_wo_pamp = array();
                $weekly_total_avg = array();
                $target_per_branch_weekly = array();

                $target_cost_per_branch_weekly = array();
                $target_per_branch_monthly = array();
                $target_cost_per_branch_monthly = array();
                $projection = array();


                $total_target_per_branch_weekly = array();
                $total_tonnage_per_branch_weekly = array();
                $total_target_cost_per_branch_weekly = array();
                $total_tonnage_cost_per_branch_weekly = array();

                $total_target_per_branch_weekly_wo_pamp = array();
                $total_tonnage_per_branch_weekly_wo_pamp = array();
                $total_target_cost_per_branch_weekly_wo_pamp = array();
                $total_tonnage_cost_per_branch_weekly_wo_pamp = array();


                foreach ($branch_array as $branch) {
                    $start_q = $start_date;
                    while ($start_q <= $breaker_date) {
                        $total_prod = 0;
                        $total = 0;
                        $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
                        $sql_query = mysql_query("SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where paper_buying.wp_grade like '%" . $_POST['wp_grade'] . "%' and  branch like '%$branch%' and date_received >='$start_q' and date_received <='$end_q' and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc");
                        while ($rs_query = mysql_fetch_array($sql_query)) {
                            $prod = $rs_query['unit_cost'] * $rs_query['sum(corrected_weight)'];
                            $total_prod+=$prod;
                            $total+=$rs_query['sum(corrected_weight)'];
                        }
                        if ($total_prod == '0' || $total == '') {
                            $weight_avg[$branch][$start_q][$end_q] = 0;
                        } else {
                            $weight_avg[$branch][$start_q][$end_q] = $total_prod / $total;
                        }

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
                    if ($overall_prod == '0' || $overall_total == '0') {
                        $weekly_total_avg[$start_q][$end_q] = 0;
                    } else {
                        $weekly_total_avg[$start_q][$end_q] = $overall_prod / $overall_total;
                    }
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
                    if ($overall_prod == '0' || $overall_total == '') {
                        $weekly_total_avg_wo_pamp[$start_q][$end_q] = 0;
                    } else {
                        $weekly_total_avg_wo_pamp[$start_q][$end_q] = $overall_prod / $overall_total;
                    }
                    $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
                }


                $ctr = 1;
                echo "<thead class='header'>";
                echo "<th></th>";
                $start_q = $start_date;
                while ($start_q <= $breaker_date) {
                    $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
                    echo "<th colspan='4'>Week $ctr</th>";
                    $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
                    $ctr++;
                }
                echo "</thead>";

                echo "<tr class='header'>";
                echo "<td>Branch</td>";
                $start_q = $start_date;
                while ($start_q <= $breaker_date) {
                    $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
                    echo "<td colspan='4'>$start_q $end_q</td>";
                    $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
                }
                echo "</tr>";
                echo "<tr class='header'>";
                echo "<td></td>";
                $start_q = $start_date;
                while ($start_q <= $breaker_date) {
                    $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
                    echo "<td>Target</td>";
                    echo "<td>Target Cost</td>";
                    echo "<td>Tonnage</td>";
                    echo "<td>Weighted-Avg</td>";
                    $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
                }
                echo "</tr>";
                $ct = 1;
                foreach ($branch_array as $branch) {
                    if ($ct % 2) {
                        echo "<tr class='ho'>";
                    } else {
                        echo "<tr class='ha'>";
                    }

                    echo "<td>$branch</td>";
                    $c = 1;
                    $start_q = $start_date;
                    while ($start_q <= $breaker_date) {

                        $month_v = date('M', strtotime($start_q));
                        $month_q = date('F', strtotime($start_q));
                        $year_q = date('Y', strtotime($start_q));
                        $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
                        if ($branch != 'Pampanga') {
                            $total_target_per_branch_weekly_wo_pamp[$start_q][$end_q]+=$target_per_branch_weekly[$branch][$start_q][$end_q];
                        }
                        $total_target_per_branch_weekly[$start_q][$end_q]+=$target_per_branch_weekly[$branch][$start_q][$end_q];
                        if (!empty($target_per_branch_weekly[$branch][$start_q][$end_q])) {
                            echo "<td>";
                            echo "<span id = '" . $c . "_" . $branch . "' class = 'text'>";
                            echo "<div id = 'expctd_vol_value_" . $c . "_" . $branch . "'>" . $target_per_branch_weekly[$branch][$start_q][$end_q] . "</div>";
                            echo "</span>";
                            echo "<div id = 'expected_vol_edit_" . $c . "_" . $branch . "' class = 'editbox'>";
                            echo "<input class = 'marketing' id = 'expected_vol_" . $c . "_" . $branch . "' value = '" . $target_per_branch_weekly[$branch][$start_q][$end_q] . "' size = '4'>";
                            echo "</td>";
                        } else {
                            echo "<td>";
                            echo "<span id = '" . $c . "_" . $branch . "' class = 'text'>";
                            echo "<div id = 'expctd_vol_value_" . $c . "_" . $branch . "'>0</div>";
                            echo "</span>";
                            echo "<div id = 'expected_vol_edit_" . $c . "_" . $branch . "' class = 'editbox'>";
                            echo "<input class = 'marketing' id = 'expected_vol_" . $c . "_" . $branch . "' value = '' size = '4'>";
                            echo "</td>";
                        }
                        if ($branch != 'Pampanga') {
                            $total_target_cost_per_branch_weekly_wo_pamp[$start_q][$end_q]+=$target_cost_per_branch_weekly[$branch][$start_q][$end_q] * $target_per_branch_weekly[$branch][$start_q][$end_q];
                        }
                        $total_target_cost_per_branch_weekly[$start_q][$end_q]+=$target_cost_per_branch_weekly[$branch][$start_q][$end_q] * $target_per_branch_weekly[$branch][$start_q][$end_q];
                        if (!empty($target_cost_per_branch_weekly[$branch][$start_q][$end_q])) {
                            echo "<td>";
                            echo "<span id='" . $c . "_" . $branch . "' class='text'>";
                            echo "<div id='addl_price_value_" . $c . "_" . $branch . "'>" . round($target_cost_per_branch_weekly[$branch][$start_q][$end_q], 2) . "</div>";
                            echo "</span>";
                            echo "<div id='addl_price_edit_" . $c . "_" . $branch . "' class='editbox'>";
                            echo "<input class='marketing' id='addtl_price_" . $c . "_" . $branch . "' value='" . round($target_cost_per_branch_weekly[$branch][$start_q][$end_q], 2) . "' size='4'>";
                            echo "<button id='" . $c . "_" . $branch . "_" . $end_q . "_" . $_POST['wp_grade'] . "'>Save</button></div>";
                            echo "</td>";
                        } else {
                            echo "<td>";
                            echo "<span id='" . $c . "_" . $branch . "' class='text'>";
                            echo "<div id='addl_price_value_" . $c . "_" . $branch . "'>0</div>";
                            echo "</span>";
                            echo "<div id='addl_price_edit_" . $c . "_" . $branch . "' class='editbox'>";
                            echo "<input class='marketing' id='addtl_price_" . $c . "_" . $branch . "' value='' size='4'>";
                            echo "<button id='" . $c . "_" . $branch . "_" . $end_q . "_" . $_POST['wp_grade'] . "'>Save</button></div>";
                            echo "</td>";
                        }

                        if ($branch != 'Pampanga') {
                            $total_tonnage_per_branch_weekly_wo_pamp[$start_q][$end_q]+=$total_tonnage[$branch][$start_q][$end_q];
                        }
                        $total_tonnage_per_branch_weekly[$start_q][$end_q]+=$total_tonnage[$branch][$start_q][$end_q];
                        echo "<td id='" . $branch . "_" . $_POST['wp_grade'] . "_" . $start_q . "_" . $end_q . "' onclick='view(this.id);'>" . round($total_tonnage[$branch][$start_q][$end_q], 2) . "</td>";
                        if ($branch != 'Pampanga') {
                            $total_tonnage_cost_per_branch_weekly_wo_pamp[$start_q][$end_q]+=$weight_avg[$branch][$start_q][$end_q] * $total_tonnage[$branch][$start_q][$end_q];
                        }
                        $total_tonnage_cost_per_branch_weekly[$start_q][$end_q]+=$weight_avg[$branch][$start_q][$end_q] * $total_tonnage[$branch][$start_q][$end_q];
                        echo "<td>" . round($weight_avg[$branch][$start_q][$end_q], 2) . "</td>";
                        $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
                        $c++;
                    }
                    echo "</tr>";
                    $ct++;
                }

                echo "<tr class='total_wo_pamp'>";
                echo "<td>Total w/o Pamp</td>";
                $start_q = $start_date;
                while ($start_q <= $breaker_date) {
                    $month_v = date('M', strtotime($start_q));
                    $month_q = date('F', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
                    echo "<td>" . $total_target_per_branch_weekly_wo_pamp[$start_q][$end_q] . "</td>";
                    echo "<td>" . number_format($total_target_cost_per_branch_weekly_wo_pamp[$start_q][$end_q] / $total_target_per_branch_weekly[$start_q][$end_q], 2) . "</td>";
                    echo "<td>" . $total_tonnage_per_branch_weekly_wo_pamp[$start_q][$end_q] . "</td>";
                    echo "<td>" . number_format($total_tonnage_cost_per_branch_weekly_wo_pamp[$start_q][$end_q] / $total_tonnage_per_branch_weekly[$start_q][$end_q], 2) . "</td>";
                    $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
                }
                echo "</tr>";

                echo "<tr class='total'>";
                echo "<td>Total</td>";
                $start_q = $start_date;
                while ($start_q <= $breaker_date) {
                    $month_v = date('M', strtotime($start_q));
                    $month_q = date('F', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));
                    echo "<td>" . $total_target_per_branch_weekly[$start_q][$end_q] . "</td>";
                    echo "<td>" . number_format($total_target_cost_per_branch_weekly[$start_q][$end_q] / $total_target_per_branch_weekly[$start_q][$end_q], 2) . "</td>";
                    echo "<td>" . $total_tonnage_per_branch_weekly[$start_q][$end_q] . "</td>";
                    echo "<td>" . number_format($total_tonnage_cost_per_branch_weekly[$start_q][$end_q] / $total_tonnage_per_branch_weekly[$start_q][$end_q], 2) . "</td>";
                    $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
                }
                echo "</tr>";
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

