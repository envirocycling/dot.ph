<?php
include("templates/template.php");
ini_set('max_execution_time', 1000);
include("config.php");
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
<style>
    .total{
        font-weight: bold;
        background-color: yellow;
    }
    body{
        background-color: 2e5e79;
    }
    .table{
        font-size: 11px;
        padding:5px;
        border: 1px solid;
    }
    .table td {
        padding: 5px;
        border: 1px solid;
        font-weight: bold;
    }
    .thead{
        font-size: 12px;
        background-color:gray;
        color:white;
        padding:5px;
        border: 1px solid;
    }
</style>
<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="acctg_wastepaper_receipts.php" method="POST">
            Start date: <input type='text' id='inputField' name='start_date' value="<?php
            if (isset($_POST['start_date'])) {
                echo $_POST['start_date'];
            } else {
                echo date("Y/m/d");
            }
            ?>" onfocus='date1(this.id);' readonly size="8"><br>
            End date: <input type='text' id='inputField2' name='end_date' value="<?php
            if (isset($_POST['end_date'])) {
                echo $_POST['end_date'];
            } else {
                echo date("Y/m/d");
            }
            ?>" onfocus='date1(this.id);' readonly size="8"><br>
                             <?php
                             $query = "SELECT * FROM branches  ";
                             $result = mysql_query($query);
                             echo "Branch:";
                             $dropdown = "<select name='branch' >";

                             if (isset($_POST['branch'])) {
                                 $dropdown .= "\r\n<option value='" . $_POST['branch'] . "'>" . $_POST['branch'] . "</option>";
                             }

                             $dropdown .= "\r\n<option value=''>All Branches</option>";
                             while ($row = mysql_fetch_array($result)) {
                                 $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
                             }
                             $dropdown .= "\r\n</select><br>";
                             echo $dropdown;
                             ?>
            Cut off: <select name="cutOff">
                <option value="sunday">Sunday</option>
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
                <option value="saturday">Saturday</option>
            </select>
            <br>
            <input type="submit" name="submit" value="Filter">
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    ?>
    <div class="grid_16" >
        <div class="box round first grid">
            <h2>Wastepaper Receipts (MT) <?php
                if ($_POST['branch'] == '') {
                    echo "All Branch.";
                } else {
                    echo "in " . ucfirst($_POST['branch']);
                }
                ?></h2>

            <table class="table">
                <?php
                $start_date = $_POST['start_date'];
                $start_date_month = date('Y/m', strtotime($start_date));
                $end_date = $_POST['end_date'];
                $end_date_month = date('Y/m', strtotime($end_date));
                $cut_off = $_POST['cutOff'];

                $cur_month_start = $end_date_month . "/01";
                $cur_month_end = $end_date;

                $branch = $_POST['branch'];
                $wp_grade_array = array("LCWL", "ONP", "CBS", "OCC", "MW", "CHIPBOARD");
                $wp_grade_inv = array();
                $wp_grade_inv_weekly = array();
                $wp_grade_tot_actual = array();
                $wp_grade_tot_weekly = array();
                $wp_grade_unit_cost = array();
                $wp_grade_total_weight = array();
                $wp_grade_paper_buying = array();
                $wp_grade_inv_target = array();
                $total_mtd = 0;
                $total_target = array();
                $total_amount = array();

                foreach ($wp_grade_array as $wp_grade) {
                    $start_q = $start_date;
                    while ($start_q <= $end_date) {
                        $total_weight = 0;
                        $total_paper_buying = 0;
                        $q_month = date('Y/m', strtotime($start_q));
                        $start_q = $q_month . "/01";
                        if ($q_month == $start_date_month) {
                            $start_q = $start_date;
                            if ($q_month == $end_date_month) {
                                $end_q = $end_date;
                            } else {
                                $end_q = date('Y/m/t', strtotime($start_q));
                            }
                        } else if ($q_month == $end_date_month) {
                            $start_q = $start_q;
                            $end_q = $end_date;
                        } else {
                            $end_q = date('Y/m/t', strtotime($start_q));
                        }

                        $month_q = date('F', strtotime($start_q));
                        $year_q = date('Y', strtotime($start_q));
                        if ($wp_grade == 'LCWL') {
                            $sql_del = mysql_query("SELECT sum(weight) from sup_deliveries where date_delivered>='$start_q' and date_delivered<='$end_q' and branch_delivered like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='WB' or wp_grade='WBOND')");

                            $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_q' and date_received<='$end_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='WB' or wp_grade='WBOND')");
                        } else if ($wp_grade == 'ONP') {
                            $sql_del = mysql_query("SELECT sum(weight) from sup_deliveries where date_delivered>='$start_q' and date_delivered<='$end_q' and branch_delivered like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='NPB' or wp_grade='OIN' or wp_grade='OPD')");

                            $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_q' and date_received<='$end_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='NPB' or wp_grade='OIN' or wp_grade='OPD')");
                        } else if ($wp_grade == 'MW') {
                            $sql_del = mysql_query("SELECT sum(weight) from sup_deliveries where date_delivered>='$start_q' and date_delivered<='$end_q' and branch_delivered like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='CORETUBE' or wp_grade='CT')");

                            $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_q' and date_received<='$end_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='CORETUBE' or wp_grade='CT')");
                        } else if ($wp_grade == 'CHIPBOARD') {
                            $sql_del = mysql_query("SELECT sum(weight) from sup_deliveries where date_delivered>='$start_q' and date_delivered<='$end_q' and branch_delivered like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='CB')");

                            $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_q' and date_received<='$end_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='CB')");
                        } else {
                            $sql_del = mysql_query("SELECT sum(weight) from sup_deliveries where date_delivered>='$start_q' and date_delivered<='$end_q' and branch_delivered like '%$branch%'  and wp_grade='$wp_grade'");

                            $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_q' and date_received<='$end_q' and branch like '%$branch%'  and wp_grade='$wp_grade'");
                        }
                        $rs_del = mysql_fetch_array($sql_del);
                        $wp_grade_inv[$wp_grade][$start_q][$end_q] = $rs_del['sum(weight)'];

                        $rs_unit_cost = mysql_fetch_array($sql_unit_cost);
                        $wp_grade_unit_cost[$wp_grade][$start_q][$end_q] = $rs_unit_cost['sum(paper_buying)'] / $rs_unit_cost['sum(corrected_weight)'];
                        if ($q_month == $end_date_month) {
                            $total_mtd+=$rs_del['sum(weight)'];
                        }

                        $sql_target = mysql_query("SELECT sum(target) FROM monthly_target WHERE month like '%$q_month%' and branch like '%$branch%' and wp_grade='$wp_grade'");
                        $rs_target = mysql_fetch_array($sql_target);
                        $wp_grade_inv_target[$wp_grade][$start_q][$end_q] = $rs_target['sum(target)'];

                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                    }
                }

                foreach ($wp_grade_array as $wp_grade) {
                    $start_week_q = $cur_month_start;
                    while ($start_week_q < $cur_month_end) {
                        $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        if ($start_week_q == $cur_month_start) {
                            $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        } else {
                            if ($end_week_q > $cur_month_end) {
                                $end_week_q = $cur_month_end;
                            } else {
                                $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                            }
                        }
                        if ($wp_grade == 'LCWL') {
                            $sql_del = mysql_query("SELECT sum(weight) from sup_deliveries where date_delivered>='$start_week_q' and date_delivered<='$end_week_q' and branch_delivered like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='WB' or wp_grade='WBOND')");
                        } else if ($wp_grade == 'ONP') {
                            $sql_del = mysql_query("SELECT sum(weight) from sup_deliveries where date_delivered>='$start_week_q' and date_delivered<='$end_week_q' and branch_delivered like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='NPB' or wp_grade='OIN' or wp_grade='OPD')");
                        } else if ($wp_grade == 'MW') {
                            $sql_del = mysql_query("SELECT sum(weight) from sup_deliveries where date_delivered>='$start_week_q' and date_delivered<='$end_week_q' and branch_delivered like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='CORETUBE' or wp_grade='CT')");
                        } else if ($wp_grade == 'CHIPBOARD') {
                            $sql_del = mysql_query("SELECT sum(weight) from sup_deliveries where date_delivered>='$start_week_q' and date_delivered<='$end_week_q' and branch_delivered like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='CB')");
                        } else {
                            $sql_del = mysql_query("SELECT sum(weight) from sup_deliveries where date_delivered>='$start_week_q' and date_delivered<='$end_week_q' and branch_delivered like '%$branch%'  and wp_grade='$wp_grade'");
                        }
                        $rs_del = mysql_fetch_array($sql_del);
                        $wp_grade_inv_weekly[$wp_grade][$start_week_q][$end_week_q] = $rs_del['sum(weight)'];
                        if ($start_week_q == $cur_month_start) {
                            $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                            $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                        } else {
                            $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                        }
                    }
                }

                echo "<tr class='thead'>";
                echo "<td rowspan='2'>WP Grade</td>";
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $q_month = date('Y/m', strtotime($start_q));
                    $start_q = $q_month . "/01";
                    if ($q_month == $start_date_month) {
                        $start_q = $start_date;
                        if ($q_month == $end_date_month) {
                            $end_q = $end_date;
                        } else {
                            $end_q = date('Y/m/t', strtotime($start_q));
                        }
                    } else if ($q_month == $end_date_month) {
                        $start_q = $start_q;
                        $end_q = $end_date;
                    } else {
                        $end_q = date('Y/m/t', strtotime($start_q));
                    }
                    $month_q = date('M', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    echo "<td colspan='4'>$month_q - $year_q</td>";
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }
                $ctr = 1;
                $start_week_q = $cur_month_start;
                while ($start_week_q < $cur_month_end) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    if ($start_week_q == $cur_month_start) {
                        $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                    } else {
                        if ($end_week_q > $cur_month_end) {
                            $end_week_q = $cur_month_end;
                        } else {
                            $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        }
                    }
                    echo "<td>Week $ctr <br>" . date("M d", strtotime($start_week_q)) . " - " . date("M d, Y", strtotime($end_week_q)) . "</td>";
                    if ($start_week_q == $cur_month_start) {
                        $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                    } else {
                        $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                    }
                    $ctr++;
                }
                echo "<td rowspan='2'>MTD</td>";
                echo "<td rowspan='2'>Target</td>";
                echo "<td rowspan='2'>% Variance</td>";
                echo "</tr>";


                echo "<tr class='thead'>";
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $q_month = date('Y/m', strtotime($start_q));
                    $start_q = $q_month . "/01";
                    if ($q_month == $start_date_month) {
                        $start_q = $start_date;
                        if ($q_month == $end_date_month) {
                            $end_q = $end_date;
                        } else {
                            $end_q = date('Y/m/t', strtotime($start_q));
                        }
                    } else if ($q_month == $end_date_month) {
                        $start_q = $start_q;
                        $end_q = $end_date;
                    } else {
                        $end_q = date('Y/m/t', strtotime($start_q));
                    }
                    $month_q = date('M', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    echo "<td>Target</td>";
                    echo "<td>Qty (MT)</td>";
                    echo "<td>Unit Php</td>";
                    echo "<td>Amount</td>";
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }

                $start_week_q = $cur_month_start;
                while ($start_week_q < $cur_month_end) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    if ($start_week_q == $cur_month_start) {
                        $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                    } else {
                        if ($end_week_q > $cur_month_end) {
                            $end_week_q = $cur_month_end;
                        } else {
                            $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        }
                    }
                    echo "<td></td>";
                    if ($start_week_q == $cur_month_start) {
                        $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                    } else {
                        $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                    }
                    $ctr++;
                }
                echo "</tr>";

                foreach ($wp_grade_array as $wp_grade) {
                    echo "<tr>";
                    echo "<td>$wp_grade</td>";
                    $start_q = $start_date;
                    while ($start_q <= $end_date) {
                        $q_month = date('Y/m', strtotime($start_q));
                        $start_q = $q_month . "/01";
                        if ($q_month == $start_date_month) {
                            $start_q = $start_date;
                            if ($q_month == $end_date_month) {
                                $end_q = $end_date;
                            } else {
                                $end_q = date('Y/m/t', strtotime($start_q));
                            }
                        } else if ($q_month == $end_date_month) {
                            $start_q = $start_q;
                            $end_q = $end_date;
                        } else {
                            $end_q = date('Y/m/t', strtotime($start_q));
                        }
                        if (!isset($wp_grade_tot_actual[$start_q][$end_q])) {
                            $wp_grade_tot_actual[$start_q][$end_q] = 0;
                        }
                        $total_target[$start_q][$end_q]+=$wp_grade_inv_target[$wp_grade][$start_q][$end_q];
                        $total_amount[$start_q][$end_q]+=$wp_grade_inv[$wp_grade][$start_q][$end_q] * $wp_grade_unit_cost[$wp_grade][$start_q][$end_q];
                        if ($wp_grade_inv[$wp_grade][$start_q][$end_q] == '') {
                            echo "<td>" . $wp_grade_inv_target[$wp_grade][$start_q][$end_q] . "</td>";
                            echo "<td>-</td>";
                            echo "<td>" . number_format($wp_grade_unit_cost[$wp_grade][$start_q][$end_q], 2) . "</td>";
                            echo "<td></td>";
                        } else {
                            echo "<td>" . $wp_grade_inv_target[$wp_grade][$start_q][$end_q] . "</td>";
                            echo "<td>" . round($wp_grade_inv[$wp_grade][$start_q][$end_q] / 1000, 2) . "</td>";
                            echo "<td>" . number_format($wp_grade_unit_cost[$wp_grade][$start_q][$end_q], 2) . "</td>";
                            echo "<td>" . number_format($wp_grade_inv[$wp_grade][$start_q][$end_q] * $wp_grade_unit_cost[$wp_grade][$start_q][$end_q], 2) . "</td>";
                            $wp_grade_tot_actual[$start_q][$end_q]+=$wp_grade_inv[$wp_grade][$start_q][$end_q] / 1000;
                        }
                        $actual = $wp_grade_inv[$wp_grade][$start_q][$end_q] / 1000;
                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                    }

                    $start_week_q = $cur_month_start;
                    while ($start_week_q < $cur_month_end) {
                        $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        if ($start_week_q == $cur_month_start) {
                            $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        } else {
                            if ($end_week_q > $cur_month_end) {
                                $end_week_q = $cur_month_end;
                            } else {
                                $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                            }
                        }
                        if (!isset($wp_grade_tot_weekly[$start_week_q][$end_week_q])) {
                            $wp_grade_tot_weekly[$start_week_q][$end_week_q] = 0;
                        }
                        if ($wp_grade_inv_weekly[$wp_grade][$start_week_q][$end_week_q] == '') {
                            echo "<td>-</td>";
                        } else {
                            echo "<td>" . round($wp_grade_inv_weekly[$wp_grade][$start_week_q][$end_week_q] / 1000, 2) . "</td>";
                            $wp_grade_tot_weekly[$start_week_q][$end_week_q]+=$wp_grade_inv_weekly[$wp_grade][$start_week_q][$end_week_q] / 1000;
                        }
                        if ($start_week_q == $cur_month_start) {
                            $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                            $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                        } else {
                            $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                        }
                    }
                    echo "<td>" . round($actual, 2) . "</td>";
//                    $total_target+=$wp_grade_inv_target[$wp_grade][$start_week_q][$end_week_q];
                    echo "<td>" . $wp_grade_inv_target[$wp_grade][date('Y/m/d', strtotime("-1 month", strtotime($start_q)))][$end_q] . "</td>";
                    echo "<td>" . round(($actual / $wp_grade_inv_target[$wp_grade][date('Y/m/d', strtotime("-1 month", strtotime($start_q)))][$end_q]) * 100, 2) . " %</td>";
                    echo "</tr>";
                }
                echo "<tr class='total'>";



                echo "<td>Total in MT</td>";
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $q_month = date('Y/m', strtotime($start_q));
                    $start_q = $q_month . "/01";
                    if ($q_month == $start_date_month) {
                        $start_q = $start_date;
                        if ($q_month == $end_date_month) {
                            $end_q = $end_date;
                        } else {
                            $end_q = date('Y/m/t', strtotime($start_q));
                        }
                    } else if ($q_month == $end_date_month) {
                        $start_q = $start_q;
                        $end_q = $end_date;
                    } else {
                        $end_q = date('Y/m/t', strtotime($start_q));
                    }
                    $month_q = date('M', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    echo "<td>" . $total_target[$start_q][$end_q] . "</td>";
                    echo "<td>" . round($wp_grade_tot_actual[$start_q][$end_q], 2) . "</td>";
                    echo "<td>" . number_format($total_amount[$start_q][$end_q] / ($wp_grade_tot_actual[$start_q][$end_q] * 1000), 2) . "</td>";
                    echo "<td>" . number_format($total_amount[$start_q][$end_q], 2) . "</td>";
                    $actual = $wp_grade_inv[$wp_grade][$start_q][$end_q] / 1000;
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }

                $start_week_q = $cur_month_start;
                while ($start_week_q < $cur_month_end) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    if ($start_week_q == $cur_month_start) {
                        $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                    } else {
                        if ($end_week_q > $cur_month_end) {
                            $end_week_q = $cur_month_end;
                        } else {
                            $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        }
                    }
                    echo "<td>" . round($wp_grade_tot_weekly[$start_week_q][$end_week_q], 2) . "</td>";
                    if ($start_week_q == $cur_month_start) {
                        $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                    } else {
                        $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                    }
                }
                echo "<td>" . round($total_mtd / 1000, 2) . "</td>";
                echo "<td>" . round($total_target[date('Y/m/d', strtotime("-1 month", strtotime($start_q)))][$end_q], 2) . "</td>";
                echo "<td>" . round((($total_mtd / 1000) / $total_target[date('Y/m/d', strtotime("-1 month", strtotime($start_q)))][$end_q]) * 100, 2) . " %</td>";
                echo "</tr>";
                ?>

            </table>
        </div>
    </div>
    <?php
}
?>

<div class="clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>