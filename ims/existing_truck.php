<?php
include("templates/template.php");
include("config.php");
if (isset ($_GET['del_id'])){
    $del_id = $_GET['del_id'];
    mysql_query("DELETE FROM truck WHERE truck_id='$del_id'");
    mysql_query("DELETE FROM truck_rent WHERE truck_id='$del_id'");
    echo "<script>";
    echo "alert('Successfully Deleted');";
    echo "location.replace('existing_truck.php');";
    echo "</script>";
}
?>
<style>

    #total{
        background-color: yellow;
    }
    #prev{
        background-color: orange;
    }

</style>
<link href='notifCss/sNotify_1.css' rel='stylesheet' type='text/css' />
<script>
    function openWindow(str){
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("view_truck_info.php?truck_id="+str,'mywindow','width=700,height=800');
    }
</script>

<div class="grid_10" >
    <div class="box round first grid">
        <h2> Existing Trucks</h2>

        <table class="data display datatable" id="example" border="1">
            <?php
            echo "<thead>";
            echo "<th>Plate Number</th>";
            echo "<th>Aquisition Cost</th>";
            echo "<th>NetBook Value</th>";
            echo "<th>Amount</th>";
            echo "<th>Truck Condition</th>";
            echo "<th>Given To</th>";
            echo "<th>Branch</th>";
            echo "<th width='150'>Action</th>";
            echo "</thead>";

            $sql_truck = mysql_query("SELECT * FROM truck");
            while($rs_truck = mysql_fetch_array($sql_truck)) {
                echo "<tr>";
                echo "<td>".$rs_truck['plate_number']."</td>";
                echo "<td>".$rs_truck['aquisition_cost']."</td>";
                echo "<td>".$rs_truck['netbook_value']."</td>";
                echo "<td>".$rs_truck['amount']."</td>";
                echo "<td>".$rs_truck['truck_condition']."</td>";
                $sql_rent = mysql_query("SELECT * FROM truck_rent WHERE truck_id='".$rs_truck['truck_id']."'");
                $rs_rent = mysql_fetch_array($sql_rent);
                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$rs_rent['supplier_id']."'");
                $rs_sup = mysql_fetch_array($sql_sup);
                echo "<td>".$rs_sup['supplier_name']."</td>";
                echo "<td>".$rs_sup['branch']."</td>";
                echo "<td><button id='".$rs_truck['truck_id']."' onclick='openWindow(this.id);'>View / Edit</button> | ";
                ?>
                <a href='existing_truck.php?del_id=<?php echo $rs_truck['truck_id']; ?>' onclick="return confirm('Are you sure you want to delete?')">
                <button>Delete</button></td></a>
                <?php
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