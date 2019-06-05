<?php
include("templates/template.php");
?>
<style>

    #total{
        background-color: yellow;
    }
    #total2{
        background-color: #FFAD33;
    }
    #total3{
        background-color: #FFCC00;
    }
    #total4{
        background-color: #FFC266;
    }

</style>
<link href='notifCss/sNotify_1.css' rel='stylesheet' type='text/css' />
<?php
include("config.php");
?>
<?php
$branch = $_POST['branch'];
$wp_grade = $_POST['wp_grade'];
$date = date("Y/m/d");
$month_target = date("Y/m");
$year = date("Y", strtotime($date));
$month = date("m", strtotime($date));
$month_c = date("F", strtotime($date));
$date_from = $year . "/" . $month . "/01";
$total_start_volume = 0;
$total_cur = 0;
$total_var = 0;
$total_trans = 0;
$total_new = 0;
$total_l6m = array();
$ctr = 0;
$cur = 0;
?>
<div class="grid_10" >
    <div class="box round first grid">
        <h2>Start Volume Vs Current Performance of Existing Suppliers in
            <?php
            if ($branch=='') {
                echo "All Branches";
            } else {
                echo $branch;
            }
            echo " on ";
            if ($wp_grade=='') {
                echo "All grades";
            } else {
                echo $wp_grade;
            }
            ?></h2>

        <table class="data display datatable" id="example" border="1">
            <?php
            echo "<thead>";
            echo "<th>Supplier ID</th>";
            echo "<th>Supplier Name</th>";
            echo "<th>Start Volume</th>";
            $l6_months = date('Y/m/d', strtotime("-7 months", strtotime($date_from)));
            while ($ctr < 6) {
                echo "<th>" . date('M', strtotime("+1 month", strtotime($l6_months))) . "</th>";
                $l6_months = date('Y/m/d', strtotime("+1 month", strtotime($l6_months)));
                $ctr++;
            }
            $current_month = date('M', strtotime("+1 month", strtotime($l6_months)));
            echo "<th>Current ".$current_month."</th>";
            echo "<th>Var of Prev Vs Start Vol</th>";
            echo "<th>New Supplier Volume</th>";
            echo "</thead>";
            $sql_sup = mysql_query("SELECT * FROM supplier_details INNER JOIN sup_starting_volume ON supplier_details.supplier_id = sup_starting_volume.supplier_id WHERE supplier_details.inter_branch='0' and supplier_details.branch='$branch' and supplier_details.status!='inactive' and sup_starting_volume.starting_volume>'0' and supplier_details.date_added<'$date_from'");
            while ($rs = mysql_fetch_array($sql_sup)) {
                echo "<tr>";
                echo "<td>" . $rs['supplier_id'] . "</td>";
                echo "<td>" . $rs['supplier_name'] . "</td>";
                if (!empty($rs['starting_volume'])) {
                    echo "<td>" . $rs['starting_volume'] . "</td>";
                } else {
                    echo "<td>--</td>";
                }
                $s_vol = $rs['starting_volume'];
                $total_start_volume+=$rs['starting_volume'];
                $ctr = 0;
                $l6_months = date('Y/m/d', strtotime("-6 months", strtotime($date_from)));
                while ($ctr < 6) {
                    $month_start = $l6_months;
                    $year_q = date('Y', strtotime($l6_months));
                    $month_q = date('F', strtotime($l6_months));

                    $sql_l6 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade like '%$wp_grade%' and month_delivered='$month_q' and year_delivered='$year_q' and branch_delivered like '%$branch%' and supplier_id='" . $rs['supplier_id'] . "'");

                    $rs_l6 = mysql_fetch_array($sql_l6);
                    if (!empty($rs_l6['sum(weight)'])) {
                        echo "<td>" . round($rs_l6['sum(weight)'] / 1000, 2) . "</td>";
                    } else {
                        echo "<td>--</td>";
                    }
                    if($ctr=='5') {
                        $cur = $rs_l6['sum(weight)'] / 1000;
                    }
                    $total_l6m[$ctr]+=$rs_l6['sum(weight)'] / 1000;
                    $l6_months = date('Y/m/d', strtotime("+1 month", strtotime($l6_months)));
                    $ctr++;
                }

                $sql_cur = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade like '%$wp_grade%' and month_delivered='$month_c' and year_delivered='$year' and branch_delivered like '%$branch%' and supplier_id='" . $rs['supplier_id'] . "'");

                $rs_cur = mysql_fetch_array($sql_cur);
                $total_cur+= $rs_cur['sum(weight)'] / 1000;
                echo "<td id='total2'>" . round($rs_cur['sum(weight)'] / 1000, 2) . "</td>";
                $total_var+= $cur - $s_vol;
                echo "<td id='total3'>" . round($cur - $s_vol, 2) . "</td>";
                echo "<td id='total4'>--</td>";
                echo "</tr>";
//                }
            }



            $sql_new_sup = mysql_query("SELECT * FROM supplier_details INNER JOIN sup_starting_volume ON supplier_details.supplier_id = sup_starting_volume.supplier_id WHERE supplier_details.inter_branch='0' and supplier_details.branch='$branch' and supplier_details.status!='inactive' and sup_starting_volume.starting_volume>'0' and supplier_details.date_added>'$date_from'");
            while ($rs_new_sup = mysql_fetch_array($sql_new_sup)) {
                echo "<tr>";
                echo "<td>z_".$rs_new_sup['supplier_id']."</td>";
                echo "<td>z_".$rs_new_sup['supplier_name']."</td>";
                $sql_new_sup_vol = mysql_query("SELECT sum(weight),supplier_name FROM sup_deliveries WHERE date_delivered>='$date_from' and supplier_id='".$rs_new_sup['supplier_id']."' and branch_delivered like '%$branch%'");
                $rs_new_sup_vol = mysql_fetch_array($sql_new_sup_vol);
                if (!empty($rs_new_vol['starting_volume'])) {
                    echo "<td>" . $rs_new_vol['starting_volume'] . "</td>";
                } else {
                    echo "<td>--</td>";
                }
                echo "<td>--</td>";
                echo "<td>--</td>";
                echo "<td>--</td>";
                echo "<td>--</td>";
                echo "<td>--</td>";
                echo "<td>--</td>";
                if (!empty ($rs_new_sup_vol['sum(weight)'])) {
                    echo "<td id='total2'>".$rs_new_sup_vol['sum(weight)']."</td>";
                    $total_cur+=$rs_new_sup_vol['sum(weight)']/1000;
                } else {
                    echo "<td  id='total2'>--</td>";
                }
                if (!empty ($rs_new_sup_vol['sum(weight)'])) {
                    echo "<td  id='total3'>".$rs_new_sup_vol['sum(weight)']."</td>";
                    $total_var+=( $rs_new_sup_vol['sum(weight)']/1000);
                } else {
                    echo "<td  id='total3'>--</td>";
                }
                if (!empty ($rs_new_sup_vol['sum(weight)'])) {
                    echo "<td id='total4'>".$rs_new_sup_vol['sum(weight)']."</td>";
                    $total_new+=$rs_new_sup_vol['sum(weight)']/1000;
                } else {
                    echo "<td id='total4'>--</td>";
                }
                echo "</tr>";
//                }
            }

            echo "<tr id='total'>";
            echo "<td>!Total!</td>";
            echo "<td>--</td>";
            echo "<td>".round($total_start_volume,2)."</td>";
            $ctr=0;
            while ($ctr<6) {
                echo "<td>".round($total_l6m[$ctr],2)."</td>";
                $ctr++;
            }
            echo "<td id='total2'>".round($total_cur,2)."</td>";
            echo "<td id='total3'>".round($total_var,2)."</td>";
            echo "<td id='total4'>".round($total_new,2)."</td>";
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




