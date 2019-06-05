<?php
include("templates/template.php");
?>
<style>

    #total{
        background-color: yellow;
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
    function monthlyRemarks(str) {
        var x = screen.width / 2 - 700 / 2;
        var y = screen.height / 2 - 450 / 2;
        window.open("monthlyRemarks.php?id=" + str, 'mywindow', 'width=800,height=500');
    }
    function editCharacter(str) {
        window.open("frmEditCharacter.php?id=" + str, 'mywindow', 'width=400,height=400');
    }


    function hideSupplier(str) {
        window.open("frmHideSupplier.php?id=" + str, 'mywindow', 'width=500,height=150');
    }

    function showCapacity(str) {
        window.open("frmShowCapacity.php?parameter=" + str, 'mywindow', 'width=600,height=500');
    }
</script>
<?php
$branch = $_POST['branch'];
$date = date("Y/m/d");
$month_target = date("Y/m");
$year = date("Y", strtotime($date));
$month = date("m", strtotime($date));
$date_from = $year . "/" . $month . "/01";
$total_start_volume = 0;
$total_cur = 0;
$total_var = 0;
$total_trans = 0;
$total_l6m = array();
$ctr = 0;
?>
<div class="grid_8" >
    <div class="box round first grid">
        <h2>Start Volume Vs Current Performance of Existing Suppliers in
            <?php
            if($branch=='') {
                echo "All Branches";
            } else {
                echo $branch;
            }
            ?></h2>

        <table class="data display datatable" id="example" border="1">
            <?php
            echo "<thead>";
            echo "<th>Supplier Name</th>";
            echo "<th>Start Volume</th>";
            $l6_months = date('Y/m/d', strtotime("-7 months", strtotime($date_from)));
            while ($ctr < 6) {
                echo "<th>" . date('M', strtotime("+1 month", strtotime($l6_months))) . "</th>";
                $l6_months = date('Y/m/d', strtotime("+1 month", strtotime($l6_months)));
                $ctr++;
            }
            echo "<th>Current</th>";
            echo "<th>Var of Prev Vs Start Vol</th>";
            echo "<th>Transfer</th>";
            echo "</thead>";
            $sql = mysql_query("SELECT * FROM sup_starting_volume WHERE branch='$branch'");
            while ($rs = mysql_fetch_array($sql)) {
                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='" . $rs['supplier_id'] . "'");
                $rs2 = mysql_fetch_array($sql_sup);
                echo "<tr>";
                echo "<td>" . $rs2['supplier_name'] . "</td>";
                echo "<td>" . $rs['starting_volume'] . "</td>";
                $total_start_volume+=$rs['starting_volume'];
                $ctr = 0;
                $l6_months = date('Y/m/d', strtotime("-7 months", strtotime($date_from)));
                while ($ctr < 6) {
                    $month_start = $l6_months;
                    $month_end = date('Y/m/d', strtotime("+1 month", strtotime($l6_months)));
                    $sql_l6 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE date_delivered>='$month_start' and date_delivered<='$month_end' and branch_delivered='$branch' and supplier_id='" . $rs['supplier_id'] . "'");
                    $rs_l6 = mysql_fetch_array($sql_l6);
                    if (!empty($rs_l6['sum(weight)'])) {
                        echo "<td>" . round($rs_l6['sum(weight)'] / 1000, 2) . "</td>";
                    } else {
                        echo "<td>--</td>";
                    }
                    $total_l6m[$ctr]+=$rs_l6['sum(weight)'] / 1000;
                    $l6_months = date('Y/m/d', strtotime("+1 month", strtotime($l6_months)));
                    $ctr++;
                }
                $sql_cur = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE date_delivered>='$date_from' and date_delivered<='$date' and branch_delivered='$branch' and supplier_id='" . $rs['supplier_id'] . "'");
                $rs_cur = mysql_fetch_array($sql_cur);
                $total_cur+= $rs_cur['sum(weight)'] / 1000;
                echo "<td>" . round($rs_cur['sum(weight)'] / 1000, 2) . "</td>";
                $total_var+= $rs['starting_volume'] - ($rs_cur['sum(weight)'] / 1000);
                echo "<td>" . round($rs['starting_volume'] - ($rs_cur['sum(weight)'] / 1000), 2) . "</td>";
                $sql_trans = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE date_delivered>='$date_from' and date_delivered<='$date' and branch_delivered!='$branch' and supplier_id='" . $rs['supplier_id'] . "'");
                $rs_trans = mysql_fetch_array($rs_trans);
                $total_trans+=$rs_trans['sum(weight)'] / 1000;
                echo "<td>" . round($rs_trans['sum(weight)'] / 1000, 2) . "</td>";
                echo "<td></td>";
            }
            echo "</tr>";
            echo "<tr id='total'>";
            echo "<td>!Total!</td>";
            echo "<td>".round($total_start_volume,2)."</td>";
            $ctr=0;
            while ($ctr<6) {
                echo "<td>".round($total_l6m[$ctr],2)."</td>";
                $ctr++;
            }
            echo "<td>".round($total_cur,2)."</td>";
            echo "<td>".round($total_var,2)."</td>";
            echo "<td>".round($total_trans,2)."</td>";
            echo "</tr>";
            ?>

        </table>
    </div>
</div>

<div class="grid_4" >
    <div class="box round first grid">
        <h2>New Suppliers</h2>

        <table class="data display datatable" id="example" border="1">
            <?php
            $total_new_sup=0;
            echo "<thead>";
            echo "<th>Supplier Name</th>";
            echo "<th>Current Volume</th>";
            echo "</thead>";
            $sql = mysql_query("SELECT * FROM supplier_details WHERE branch='$branch' and date_added>='$date_from' and date_added<='$date'");
            while ($rs = mysql_fetch_array($sql)) {
                echo "<tr>";
                echo "<td>".$rs['supplier_name']."</td>";
                $sql_new = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='".$rs['supplier_id']."' and date_delivered>='$date_from' and date_delivered<='$date' and branch_delivered='$branch'");
                $rs_new = mysql_fetch_array($sql_new);
                if (!empty ($rs_new['sum(weight)'])) {
                    echo "<td>".round($rs_new['sum(weight)']/1000,2)."</td>";
                    $total_new_sup+=$rs_new['sum(weight)']/1000;
                } else {
                    echo "<td>--</td>";
                }
                echo "</tr>";
            }
            echo "<tr id='total'>";
            echo "<td>!Total!</td>";
            echo "<td>".round($total_new_sup,2)."</td>";
            echo "</tr>";
            ?>

        </table>
    </div>
</div>

<div class="grid_10" >
    <div class="box round first grid">
        <h2> Summary Of Moving Suppliers</h2>

        <table class="data display datatable" id="example" border="1">
            <?php
            $total = 0;
            echo "<thead>";
            echo "<th>Supplier Name</th>";
            echo "<th>Branch Orig</th>";
            $sql_branch = mysql_query("SELECT * FROM branches");
            while ($rs_branch = mysql_fetch_array($sql_branch)) {
                echo "<th>" . $rs_branch['branch_name'] . "</th>";
            }
            echo "<th>TOTAL</th>";
            echo "</thead>";
            $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE restrained='1' and verified='1'");
            while ($rs_sup = mysql_fetch_array($sql_sup)) {
                echo "<tr>";
                echo "<td>" . $rs_sup['supplier_name'] . "</td>";
                echo "<td>" . $rs_sup['branch'] . "</td>";
                $sql_branch = mysql_query("SELECT * FROM branches");
                while ($rs_branch = mysql_fetch_array($sql_branch)) {
                    $sql_trans_branch = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='" . $rs_sup['supplier_id'] . "' and branch_delivered!='$branch' and branch_delivered='" . $rs_branch['branch_name'] . "' and and date_delivered>='$date_from' and date_delivered<='$date'");
                    $rs_trans_branch = mysql_fetch_array($sql_trans_branch);
                    if (!empty($rs_trans_branch['sum(weight)'])) {
                        $total+=$rs_trans_branch['sum(weight)'];
                        echo "<td>" . round($rs_trans_branch['sum(weight)'] / 1000, 2) . "</td>";
                    } else {
                        echo "<td>--</td>";
                    }
                }
                echo "<td id='total'>" . round($total / 1000, 2) . "</td>";
                echo "</tr>";
            }
            ?>

        </table>
    </div>
</div>

<div class="grid_10" >
    <div class="box round first grid">
        <h2> *********</h2>

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
            echo "<th>Transfer</th>";
            echo "<th>Total</th>";
            echo "</thead>";

            $sql_branch2 = mysql_query("SELECT * FROM branches");
            while ($rs_branch2 = mysql_fetch_array($sql_branch2)) {
                $total_existing = 0;
                $total_new = 0;
                $total = 0;
                echo "<tr>";
                echo "<td>" . $rs_branch2['branch_name'] . "</td>";
                $branch = $rs_branch2['branch_name'];
                $branch = strtoupper($branch);
                $sql_target = mysql_query("SELECT sum(target) FROM monthly_target WHERE branch='$branch' and month='$month_target'");
                $rs_target = mysql_fetch_array($sql_target);
                if(!empty($rs_target['sum(target)'])) {
                    $total_target+=$rs_target['sum(target)'];
                    echo "<td>".$rs_target['sum(target)']."</td>";
                } else {
                    echo "<td>--</td>";
                }
                $total+=$rs_target['sum(target)'];
                $sql_volume = mysql_query("SELECT sum(starting_volume) FROM sup_starting_volume WHERE branch='".$rs_branch2['branch_name']."'");
                $rs_volume = mysql_fetch_array($sql_volume);
                echo "<td>".round($rs_volume['sum(starting_volume)'],2)."</td>";
                $start_volume+=$rs_volume['sum(starting_volume)'];
                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE branch='".$rs_branch2['branch_name']."' and date_added<='$date_from' and restrained='1' and verified='1'");
                while ($rs_sup = mysql_fetch_array($sql_sup)) {
                    $sql_sup_perf = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE branch_delivered='".$rs_branch2['branch_name']."' and supplier_id='".$rs_sup['supplier_id']."' and date_delivered>='$date_from' and date_delivered<='$date'");
                    $rs_sup_perf = mysql_fetch_array($sql_sup_perf);
                    $total_existing+=$rs_sup_perf['sum(weight)'];
                }
                $total+=$total_existing;
                $total_perf+=$total_existing/1000;
                echo "<td>".round($total_existing/1000,2)."</td>";
                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE branch='".$rs_branch2['branch_name']."' and date_added>='$date_from' and restrained='1' and verified='1'");
                while ($rs_sup = mysql_fetch_array($sql_sup)) {
                    $sql_sup_perf = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE branch_delivered='".$rs_branch2['branch_name']."' and supplier_id='".$rs_sup['supplier_id']."' and date_delivered>='$date_from' and date_delivered<='$date'");
                    $rs_sup_perf = mysql_fetch_array($sql_sup_perf);
                    $total_new+=$rs_sup_perf['sum(weight)'];
                }
                $total+=$total_new;
                $total_del_new+=$total_new/1000;
                echo "<td>".round($total_new/1000,2)."</td>";
                $sql_trans_branch2 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE  delivered_branch!='" . $rs_branch2['branch_name'] . "' and date_delivered>='$date_from' and date_delivered<='$date'");
                $rs_trans_branch2 = mysql_fetch_array($sql_trans_branch2);
                $total-=$rs_trans_branch2['sum(weight)'];
                echo "<td>".round($rs_trans_branch2['sum(weight)']/1000,2)."</td>";
                $total_trans+=$rs_trans_branch2['sum(weight)']/1000;
                echo "<td id='total'>".round($total/1000,2)."</td>";
                $total_tot+=$total/1000;
                echo "</tr>";
            }
            echo "<tr id='total'>";
            echo "<td>!Total!</td>";
            echo "<td>".round($total_target,2)."</td>";
            echo "<td>".round($start_volume,2)."</td>";
            echo "<td>".round($total_perf,2)."</td>";
            echo "<td>".round($total_del_new,2)."</td>";
            echo "<td>".round($total_trans,2)."</td>";
            echo "<td>".round($total_tot,2)."<?td>";
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