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
<?php
include("config.php");
?>
<?php
$branch = $_POST['branch'];
$wp_grade = $_POST['wp_grade'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$supplier_start_array = array();
$supplier_array = array();
$supplier_name_array = array();
$supplier_branch_array = array();
$del_per_month = array();
$month = array();
$year = array();
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
            ?> Per Month</h2>

        <table class="data display datatable" id="example" border="1">
            <?php
            echo "<thead>";
            echo "<th>Supplier ID</th>";
            echo "<th>Supplier Name</th>";
            echo "<th>Branch</th>";
            echo "<th>Province</th>";
            $start_q = $start_date;
            while ($start_q <= $end_date) {
                $month_q = date('M', strtotime($start_q));
                $year_q = date('Y', strtotime($start_q));
                echo "<th>" . $month_q . " " . $year_q . "</th>";
                $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
            }
            echo "</thead>";

            $sql = mysql_query("SELECT * FROM supplier_details WHERE supplier_id!='1450' and supplier_id!='1453' and supplier_id!='1456' and supplier_id!='1458' and branch like '%$branch%' and date_added>='$start_date' and date_added<='$end_date' and status!='inactive' ORDER BY date_added ASC");
            while ($rs = mysql_fetch_array($sql)) {
                array_push($supplier_array,$rs['supplier_id']);
                $supplier_start_array[$rs['supplier_id']]=$rs['month_added']."_".$rs['year_added'];
                $supplier_name_array[$rs['supplier_id']]=$rs['supplier_name'];
                $supplier_branch_array[$rs['supplier_id']]=$rs['branch'];
                $supplier_province_array[$rs['supplier_id']]=$rs['province'];
            }
            foreach ($supplier_array as $supplier_id) {
                $sql = mysql_query("SELECT supplier_details.supplier_id,supplier_details.supplier_name,sum(sup_deliveries.weight),sup_deliveries.month_delivered,sup_deliveries.year_delivered FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE supplier_details.supplier_id='$supplier_id' GROUP BY supplier_details.supplier_id,sup_deliveries.month_delivered,sup_deliveries.year_delivered ORDER BY sup_deliveries.date_delivered");
                while($rs = mysql_fetch_array($sql)) {
                    $del_per_month[$rs['supplier_id']][$rs['month_delivered']][$rs['year_delivered']]=$rs['sum(sup_deliveries.weight)'];
                }
            }

            foreach ($supplier_array as $supplier_id) {
                echo "<tr>";
                echo "<td>$supplier_id</td>";
                echo "<td>$supplier_name_array[$supplier_id]</td>";
                echo "<td>$supplier_branch_array[$supplier_id]</td>";
                echo "<td>$supplier_province_array[$supplier_id]</td>";
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $month_q = date('F', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    $start_sup = $month_q."_".$year_q;
                    if ($supplier_start_array[$supplier_id] == $start_sup) {
                        if (!empty($del_per_month[$supplier_id][$month_q][$year_q])) {
                            echo "<td>".round($del_per_month[$supplier_id][$month_q][$year_q]/1000,2)."</td>";
                        } else {
                            echo "<td>--</td>";
                        }
                    } else {
                        echo "<td>--</td>";
                    }
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }
                echo "</tr>";
            }

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




