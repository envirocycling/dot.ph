<?php
//
include('config.php');

include('templates/template.php');
//$sql_sup = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive' and branch='Cainta' and date_added<='2014/07/01' and restrained='1' and verified='1'");
//while ($rs_sup = mysql_fetch_array($sql_sup)) {
//    $sql_sup_perf = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade like '%%' and branch_delivered='Cainta' and supplier_id='" . $rs_sup['supplier_id'] . "' and month_delivered='July' and year_delivered='2014'");
//    $rs_sup_perf = mysql_fetch_array($sql_sup_perf);
//    $total_existing+=$rs_sup_perf['sum(weight)'];
//}
//echo $total_existing;
?>



<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />

<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>

<script type="text/javascript">

    function date1(str) {

        new JsDatePick({
            useMode: 2,
            target: str,
            dateFormat: "%Y/%m"



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

        <form action="start_vs_target_vs_current_volume.php" method="POST">

            <br>

            <h6>Filtering Option</h6>

            Select Month: <input type='text'  id='inputField' name='date' value="<?php echo date('Y/m'); ?>" onfocus='date1(this.id);' readonly size="8"><br>
            Select Grade: 
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
            echo $dropdown;
            ?>





            <input type="submit" value="Generate Report">

        </form>

    </div>

</div>

<?php
if (isset($_POST['date'])) {

    $date = $_POST['date'];
    $date = $date . "/01";
    $month_target = date("Y/m", strtotime($date));
    $year_q = date("Y", strtotime($date));
    $month_q = date("F", strtotime($date));
    $wp_grade = $_POST['wp_grade'];
    ?>

    <div class="grid_10" >

        <div class="box round first grid">

            <h2> Start Volume Vs Target Vs Current Volume in <?php echo $month_q . ", " . $year_q; ?></h2>

            <table class="data display datatable" id="example" border="1">


                <?php
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

                $accumulated = array();
                $branch_array = array();
                $collected_array = array();
                $total_array = array();
                $sql_branch = mysql_query("SELECT * FROM branches");
                while ($rs_branch = mysql_fetch_array($sql_branch)) {
                    array_push($branch_array, $rs_branch['branch_name']);
                }

                array_push($collected_array, "Target", "SVolume", "PerfExist", "DelNew", "NewExist", "Transfer", "Total");

                foreach ($branch_array as $branch) {

                    foreach ($collected_array as $collected) {
                        $total_existing = 0;
                        $total_new = 0;
                        if ($collected = 'Target') {
                            $sql_target = mysql_query("SELECT sum(target) FROM monthly_target WHERE wp_grade like '%$wp_grade%' and branch='$branch' and month='$month_target'");
                            $rs_target = mysql_fetch_array($sql_target);
                            $accumulated[$branch][$collected] = $rs_target['sum(target)'];
                        }
                        if ($collected = 'SVolume') {
                            $sql_volume = mysql_query("SELECT sum(starting_volume) FROM sup_starting_volume WHERE branch='$branch'");
                            $rs_volume = mysql_fetch_array($sql_volume);
                            $accumulated[$branch][$collected] = round($rs_volume['sum(starting_volume)'], 2);
                        }
                        if ($collected = 'PerfExist') {
                            $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive' and branch='$branch' and date_added<='$date' and restrained='1' and verified='1'");
                            while ($rs_sup = mysql_fetch_array($sql_sup)) {
                                $sql_sup_perf = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade like '%$wp_grade%' and branch_delivered='$branch' and supplier_id='" . $rs_sup['supplier_id'] . "' and month_delivered='$month_q' and year_delivered='$year_q'");
//            $sql_sup_perf = mysql_query("SELECT sum(sup_deliveries.weight) FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE supplier_details.branch='$branch' and supplier_details.date_added<='$date' and supplier_details.restrained='1' and supplier_details.verified='1' and supplier_details.status!='inactive' and sup_deliveries.wp_grade like '%$wp_grade%' and sup_deliveries.month_delivered='$month_q' and sup_deliveries.year_delivered='$year_q'");
                                $rs_sup_perf = mysql_fetch_array($sql_sup_perf);
                                $total_existing+=$rs_sup_perf['sum(weight)'];
                            }
                            $accumulated[$branch][$collected] = round($total_existing / 1000, 2);
                        }
                        if ($collected = 'DelNew') {
                            $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive' and branch='$branch' and date_added>='$date'");
                            while ($rs_sup = mysql_fetch_array($sql_sup)) {
                                $sql_sup_perf = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade like '%$wp_grade%' and branch_delivered='$branch' and supplier_id='" . $rs_sup['supplier_id'] . "' and month_delivered='$month_q' and year_delivered='$year_q'");
                                $rs_sup_perf = mysql_fetch_array($sql_sup_perf);
                                $total_new+=$rs_sup_perf['sum(weight)'];
                            }
                            $accumulated[$branch][$collected] = round($total_new / 1000, 2);
                        }
                        if ($collected = 'NewExist') {
                            $accumulated[$branch][$collected] = $accumulated[$branch]['PerfExist'] + $accumulated[$branch]['DelNew'];
                        }
                        if ($collected = 'Transfer') {
                            $sql_trans_branch2 = mysql_query("SELECT sum(sup_deliveries.weight) FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE sup_deliveries.branch_delivered!='$branch' and supplier_details.branch='$branch' and sup_deliveries.wp_grade like '%$wp_grade%' and sup_deliveries.month_delivered='$month_q' and sup_deliveries.year_delivered='$year_q'");
                            $rs_trans_branch2 = mysql_fetch_array($sql_trans_branch2);
                            $accumulated[$branch][$collected] = round($rs_trans_branch2['sum(sup_deliveries.weight)'] / 1000, 2);
                        }
                        if ($collected = 'Total') {
                            $accumulated[$branch][$collected] = $accumulated[$branch]['NewExist'] - $accumulated[$branch]['Transfer'];
                        }
                    }
                }
                foreach ($branch_array as $branch) {
                    echo "<tr>";
                    echo "<td>$branch</td>";
                    foreach ($collected_array as $collected) {
                        $total_array[$collected]+=$accumulated[$branch][$collected];
                        if ($collected == 'Total') {
                            echo "<td id='Total'>" . $accumulated[$branch][$collected] . "</td>";
                        } else {
                            echo "<td>" . $accumulated[$branch][$collected] . "</td>";
                        }
                    }
                    echo "</tr>";
                }
                echo "<tr id='total'>";
                echo "<td>!Total</td>";
                foreach ($collected_array as $collected) {

                    echo "<td>" . $total_array[$collected] . "</td>";
                }
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

