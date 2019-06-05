<?php
include("templates/template.php");
include 'config.php';
?>
<script>
    function insertvolume(str) {
        window.open("frm_insert_truck_volume.php?id=" + str, 'mywindow', 'width=400,height=300');
    }

    function editvolume(str) {
        window.open("frm_edit_truck_volume.php?id=" + str, 'mywindow', 'width=500,height=400');
    }
</script>
<style>
    #months{
        background-color: #FFE6B2;
    }
    #current{
        background-color: #FFC040;
    }
    #qouta{
        background-color: #FFAB00;
    }
    #percent{
        background-color: yellow;
    }
</style>
<?php
$date_now = date("Y/m/d");
$month_now = date("F", strtotime($date_now));
$year_now = date("Y", strtotime($date_now));
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
?>
<div class="grid_16" >
    <div class="box round first grid">
        <h2>Volume Monitoring of EFI TRUCKS from
            <?php
            echo $start_date." to ".$end_date;
            ?></h2>

        <table class="data display datatable" id="example" border="1">
            <?php
            echo "<thead>";
            echo "<th>Truck Plate</th>";
            echo "<th width='100'>Given To</th>";
            echo "<th>Branch</th>";
            echo "<th>Issuance Date</th>";
            echo "<th>Stating Volume</th>";
//            echo "<th>Aquisition Cost</th>";
//            echo "<th>Netbook Value</th>";
//            echo "<th>Amount</th>";
            echo "<th>Current Volume</th>";
            echo "<th>Quota</th>";
            echo "<th>Percent Perf</th>";
            $start_q = $start_date;
            while ($start_q < $end_date) {
                $month_q = date('M', strtotime($start_q));
                $year_q = date('Y', strtotime($start_q));
                echo "<th>" . $month_q . " " . $year_q . "</th>";
                $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
            }
            echo "</thead>";
            $sql_truck_rent = mysql_query("SELECT * FROM truck_rent");
            while ($rs_truck_rent = mysql_fetch_array($sql_truck_rent)) {
                echo "<tr>";
                $sql_truck = mysql_query("SELECT * FROM truck WHERE truck_id='".$rs_truck_rent['truck_id']."'");
                $rs_truck = mysql_fetch_array($sql_truck);
                echo "<td>".$rs_truck['plate_number']."</td>";
                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$rs_truck_rent['supplier_id']."'");
                $rs_sup = mysql_fetch_array($sql_sup);
                echo "<td>".$rs_sup['supplier_name']."</td>";
                echo "<td>".$rs_sup['branch']."</td>";
                echo "<td>".$rs_truck_rent['issuance_date']."</td>";
                if (empty($rs_truck_rent['starting_volume'])) {
                    echo "<td id='".$rs_truck_rent['supplier_id']."_".$rs_truck_rent['truck_id']."_".$rs_sup['supplier_name']."_".$rs_truck['plate_number']."' onclick='insertvolume(this.id);'>Insert</td>";
                } else {
                    echo "<td id='".$rs_truck_rent['supplier_id']."_".$rs_truck_rent['truck_id']."_".$rs_sup['supplier_name']."_".$rs_truck['plate_number']."_".$rs_truck_rent['starting_volume']."_".$rs_truck_rent['starting_volume_date']."' onclick='editvolume(this.id);' onclick='editvolume(this.id);'>".$rs_truck_rent['starting_volume']."</td>";
                }
                $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='".$rs_truck_rent['supplier_id']."' and month_delivered='$month_now' and year_delivered='$year_now'");
                $rs_del = mysql_fetch_array($sql_del);
                echo "<td id='current'>".$rs_del['sum(weight)']."</td>";
                echo "<td id='qouta'>".$rs_truck_rent['proposed_volume']."</td>";
                echo "<td id='percent'>".round(($rs_del['sum(weight)']/$rs_truck_rent['proposed_volume'])*100,2)."</td>";
                $start_q = $start_date;
                while ($start_q < $end_date) {
                    $month_q = date('F', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='".$rs_truck_rent['supplier_id']."' and month_delivered='$month_q' and year_delivered='$year_q'");
                    $rs_del = mysql_fetch_array($sql_del);
                    echo "<td id='months'>".$rs_del['sum(weight)']."</td>";
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