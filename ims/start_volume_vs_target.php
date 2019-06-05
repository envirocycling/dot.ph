<?php
include('config.php');
include('templates/template.php');
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

    #total{
        background-color: yellow;
    }

</style>

</head>
<div class="grid_5">
    <div class="box round first grid">
        <h2>Stating Volume vs. Target</h2>
        <form action="start_volume_vs_target.php" method="POST">
            <br>
            <h6>Filtering Option</h6>
            Select Month: <input type='text'  id='inputField' name='date' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>
            <?php
            $query = "SELECT * FROM wp_grades ";
            $result = mysql_query($query);

            $dropdown = "<select name='wp_grade' >";
            $dropdown .= "\r\n<option value=''>All Grades</option>";
            $dropdown .= "\r\n<option value=''>__________</option>";
            while ($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
            }
            $dropdown .= "</select><br>";
            ?>


            <input type="submit" value="Generate Report">
        </form>
    </div>
</div>
<?php
if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $month_target = date("Y/m", strtotime($date));
    $new_sup = $month_target."/01";
    echo $new_sup;
    $year_q = date("Y", strtotime($date));
    $month_q = date("F", strtotime($date));
    $wp_grade = $_POST['wp_grade'];
    ?>
<div class="grid_10" >
    <div class="box round first grid">
        <h2> Start Volume Vs Target Vs Current Volume in <?php echo $month_q . ", " . $year_q; ?></h2>

        <table class="data display datatable" id="example" border="1">
                <?php
                $total_target = 0;
                $start_volume = 0;
                $total_perf = 0;
                $total_del_new = 0;
                $total_trans = 0;
                $total_tot = 0;

                echo "<thead>";
                echo "<th>Branch Name</th>";
                echo "<th>Target</th>";
                echo "<th>Start Volume</th>";
                echo "<th>Perf of Existing</th>";
                echo "<th>Del of New Supplier</th>";
                echo "<th>Total of New & Existing</th>";
                echo "<th>Transfer</th>";
                echo "<th>Total</th>";
                echo "</thead>";

                $sql_branch2 = mysql_query("SELECT * FROM branches");
                while ($rs_branch2 = mysql_fetch_array($sql_branch2)) {
                    $total_existing = 0;
                    $total_new = 0;
                    $total = 0;
                    $total_new_and_existing = 0;
                    echo "<tr>";
                    echo "<td>" . $rs_branch2['branch_name'] . "</td>";
                    $branch = $rs_branch2['branch_name'];
                    $branch = strtoupper($branch);
                    if ($wp_grade == '') {
                        $sql_target = mysql_query("SELECT sum(target) FROM monthly_target WHERE branch='$branch' and month='$month_target'");
                    } else {
                        $sql_target = mysql_query("SELECT sum(target) FROM monthly_target WHERE wp_grade='$wp_grade' and branch='$branch' and month='$month_target'");
                    }
                    $rs_target = mysql_fetch_array($sql_target);
                    if (!empty($rs_target['sum(target)'])) {
                        $total_target+=$rs_target['sum(target)'];
                        echo "<td>" . $rs_target['sum(target)'] . "</td>";
                    } else {
                        echo "<td>--</td>";
                    }
                    $sql_volume = mysql_query("SELECT sum(starting_volume) FROM sup_starting_volume WHERE branch='" . $rs_branch2['branch_name'] . "'");
                    $rs_volume = mysql_fetch_array($sql_volume);
                    echo "<td>" . round($rs_volume['sum(starting_volume)'], 2) . "</td>";
                    $start_volume+=$rs_volume['sum(starting_volume)'];
                    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE branch='" . $rs_branch2['branch_name'] . "' and date_added<='$date' and restrained='1' and verified='1'");
                    while ($rs_sup = mysql_fetch_array($sql_sup)) {
                        if ($wp_grade == '') {
                            $sql_sup_perf = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE branch_delivered='" . $rs_branch2['branch_name'] . "' and supplier_id='" . $rs_sup['supplier_id'] . "' and month_delivered='$month_q' and year_delivered='$year_q'");
                        } else {
                            $sql_sup_perf = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$wp_grade' and branch_delivered='" . $rs_branch2['branch_name'] . "' and supplier_id='" . $rs_sup['supplier_id'] . "' and month_delivered='$month_q' and year_delivered='$year_q'");
                        }
                        $rs_sup_perf = mysql_fetch_array($sql_sup_perf);
                        $total_existing+=$rs_sup_perf['sum(weight)'];
                    }
                    $total+=$total_existing;
                    $total_perf+=$total_existing / 1000;
                    echo "<td>" . round($total_existing / 1000, 2) . "</td>";
                    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE branch='" . $rs_branch2['branch_name'] . "' and date_added>='$new_sup' and restrained='1' and verified='1'");
                    while ($rs_sup = mysql_fetch_array($sql_sup)) {
                        if ($wp_grade == '') {
                            $sql_sup_perf = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE branch_delivered='" . $rs_branch2['branch_name'] . "' and supplier_id='" . $rs_sup['supplier_id'] . "' and month_delivered='$month_q' and year_delivered='$year_q'");
                        } else {
                            $sql_sup_perf = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$wp_grade' and branch_delivered='" . $rs_branch2['branch_name'] . "' and supplier_id='" . $rs_sup['supplier_id'] . "' and month_delivered='$month_q' and year_delivered='$year_q'");
                        }
                        $rs_sup_perf = mysql_fetch_array($sql_sup_perf);
                        $total_new+=$rs_sup_perf['sum(weight)'];
                    }
                    $total+=$total_new;
                    $total_del_new+=$total_new / 1000;
                    echo "<td>" . round($total_new / 1000, 2) . "</td>";
                    if ($wp_grade == '') {
                        $sql_trans_branch2 = mysql_query("SELECT sum(sup_deliveries.weight) FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE sup_deliveries.branch_delivered!='" . $rs_branch2['branch_name'] . "' and supplier_details.branch='" . $rs_branch2['branch_name'] . "' and sup_deliveries.month_delivered='$month_q' and sup_deliveries.year_delivered='$year_q'");
//                        $sql_trans_branch2 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE delivered_branch!='" . $rs_branch2['branch_name'] . "' and month_delivered='$month_q' and year_delivered='$year_q'");
                    } else {
                        $sql_trans_branch2 = mysql_query("SELECT sum(sup_deliveries.weight) FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE sup_deliveries.branch_delivered!='" . $rs_branch2['branch_name'] . "' and supplier_details.branch='" . $rs_branch2['branch_name'] . "' and sup_deliveries.wp_grade='$wp_grade' and sup_deliveries.month_delivered='$month_q' and sup_deliveries.year_delivered='$year_q'");
//                        $sql_trans_branch2 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$wp_grade' and delivered_branch!='" . $rs_branch2['branch_name'] . "' and month_delivered='$month_q' and year_delivered='$year_q'");
                    }
                    echo "<td>" . round(($total_new + $total_existing) / 1000, 2) . "</td>";
                    $rs_trans_branch2 = mysql_fetch_array($sql_trans_branch2);
                    $total-=$rs_trans_branch2['sum(sup_deliveries.weight)'];
                    echo "<td>" . round($rs_trans_branch2['sum(sup_deliveries.weight)'] / 1000, 2) . "</td>";
                    $total_trans+=$rs_trans_branch2['sum(sup_deliveries.weight)'] / 1000;
                    echo "<td id='total'>" . round($total / 1000, 2) . "</td>";
                    $total_tot+=$total / 1000;
                    echo "</tr>";
                }
                echo "<tr id='total'>";
                echo "<td>!Total!</td>";

                echo "<td>" . round($total_target, 2) . "</td>";
                echo "<td>" . round($start_volume, 2) . "</td>";
                echo "<td>" . round($total_perf, 2) . "</td>";
                echo "<td>" . round($total_del_new, 2) . "</td>";
                echo "<td>" . round($total_perf + $total_del_new, 2) . "</td>";
                echo "<td>" . round($total_trans, 2) . "</td>";
                echo "<td>" . round($total_tot, 2) . "</td>";
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
