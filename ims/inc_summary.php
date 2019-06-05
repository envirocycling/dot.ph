<?php
date_default_timezone_set('America/Los_Angeles');
include("templates/template.php");
include("config.php");
$total_quota = 0;
$total_actual = 0;
?>
<style>
    #total{
        background-color: yellow;
}
</style>
<script>
    function openWindow(str){
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("view_inc_summary.php?sup_id="+str,'mywindow','width=700,height=500');
    }
</script>


<div class="grid_10">
    <div class="box round first grid">
        <?php
        $branch = $_POST['branch'];
        $date = $_POST['date'];
        $month = date("F", strtotime($date));
        $year = date("Y", strtotime($date));
        $date = date("Y/m", strtotime($date));
        echo "<h2> Incentive Summary in $branch</h2>";

        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo "<th class='data'>Branch</th>";
            echo "<th class='data'>Supplier Name</th>";
            echo "<th class='data'>Date</th>";
            echo "<th class='data'>Quota</th>";
            echo "<th class='data'>Type</th>";
            echo "<th class='data'>Incentive</th>";
            echo "<th class='data'>Base Price</th>";
            echo "<th class='data'>Grades</th>";
            echo "<th class='data'>Actual Corrected Weight</th>";
            echo "<th class='data'>Amount Cost</th>";
            echo "<th class='data'>Remarks</th>";
            echo "<th class='data'>Action</th>";
            echo "</thead>";

            $sql_inc = mysql_query("SELECT * FROM incentive_scheme JOIN supplier_details ON incentive_scheme.sup_id = supplier_details.supplier_id WHERE incentive_scheme.start_date like '%$date%' and incentive_scheme.confirm = '1' and supplier_details.branch like '%$branch%'");
            $amount = 0;
            while ($rs_inc = mysql_fetch_array($sql_inc)) {
                
                if($rs_inc['wp_grade'] == 'all_grades'){
                $sql_del = mysql_query("SELECT sum(corrected_weight) FROM paper_buying WHERE wp_grade !='' and supplier_id='".$rs_inc['sup_id']."' and date_received>='".$rs_inc['start_date']."' and date_received<='".$rs_inc['end_date']."'");
                }else if($rs_inc['wp_grade'] == 'all_without_lcwl'){
                $sql_del = mysql_query("SELECT sum(corrected_weight) FROM paper_buying WHERE wp_grade NOT LIKE 'LCWL%' and supplier_id='".$rs_inc['sup_id']."' and date_received>='".$rs_inc['start_date']."' and date_received<='".$rs_inc['end_date']."'");
                }else if($rs_inc['wp_grade'] == 'all_without_occ'){
                $sql_del = mysql_query("SELECT sum(corrected_weight) FROM paper_buying WHERE wp_grade NOT LIKE '%OCC%' and supplier_id='".$rs_inc['sup_id']."' and date_received>='".$rs_inc['start_date']."' and date_received<='".$rs_inc['end_date']."'");
                }else{
                $sql_del = mysql_query("SELECT sum(corrected_weight) FROM paper_buying WHERE wp_grade like '%".$rs_inc['wp_grade']."%' and supplier_id='".$rs_inc['sup_id']."' and date_received>='".$rs_inc['start_date']."' and date_received<='".$rs_inc['end_date']."'");
                }
                $rs_del = mysql_fetch_array($sql_del);
                $total_actual+=$rs_del['sum(corrected_weight)'];
                
                if($rs_del['sum(corrected_weight)'] < $rs_inc['quota']){
                    $amount = 0;
                }else if($rs_inc['type'] == 'Covered all deliveries'){
                    $amount = round($rs_inc['incentive'] * $rs_del['sum(corrected_weight)'],2);
                }else if($rs_inc['type'] == 'Covered all excess deliveries in quota'){
                    $amount = round($rs_inc['incentive'] * ($rs_del['sum(corrected_weight)'] - $rs_inc['quota']),2);
                }else{
                    $amount = round($rs_inc['incentive'] *  $rs_inc['quota'],2);
                }
                echo "<tr>";
                echo "<td>".$rs_inc['branch']."</td>";
                echo "<td>".$rs_inc['sup_id']."-".$rs_inc['supplier_name']."</td>";
                echo "<td>".$rs_inc['scheme']."</td>";
                $total_quota+=$rs_inc['quota'];
                echo "<td>".$rs_inc['quota']."</td>";
                echo "<td>".$rs_inc['type']."</td>";
                $total_inc+=$rs_inc['incentive'];
                echo "<td>".$rs_inc['incentive']."</td>";
                $total_base_price+=$rs_inc['base_price'];
                echo "<td>".$rs_inc['base_price']."</td>";
                echo "<td>".$rs_inc['wp_grade']."</td>";
                echo "<td>".$rs_del['sum(corrected_weight)']."</td>";
                echo "<td>".number_format($amount,2)."</td>";
                echo "<td>".$rs_inc['remarks']."</td>";
                echo "<td><button id='".$rs_inc['sup_id']."/".$rs_inc['supplier_name']."/".$rs_inc['wp_grade']."/".$rs_inc['del_id']."' onclick='openWindow(this.id);'>View</button></td>";
                echo "</tr>";
            }
            echo "<tr id='total'>";
            echo "<td>!Total!</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td>$total_quota</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td>$total_actual</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";
            ?>

        </table>

    </div>
</div>
