<?php
include("templates/template.php");
?>


<script>
    function openWindow(str){
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("view_supplier.php?sup_id="+str,'mywindow','width=1000,height=650');
    }
</script>

<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        echo "<h2>  Pending Suppliers as of : <u><b><i>".$ngayon."</i></b></u></h2>";
        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';

            echo "<th class='data'> Supplier ID</th>";
            echo "<th class='data'>Supplier Name</th>";
            echo "<th class='data'>Classification</th>";
            echo "<th class='data'>Desc</th>";
            echo "<th class='data'>Branch</th>";
            echo "<th class='data'>BH In-Charge</th>";
            echo "<th class='data'>BH to Verified</th>";
            echo "<th class='data'>Owner</th>";
            echo "<th class='data'>Contact</th>";
            echo "<th class='data'>Address</th>";
            echo "<th class='data'>Action</th>";
            echo "</tr>";

            echo "</thead>";
            include("config.php");

            $initial = $_SESSION['initial'];
            if ($_SESSION['username'] == 'lonlon' || $_SESSION['username']=='lorna_regala') {
                $query="SELECT * FROM supplier_details where verified='0'";
            } else {
                $query="SELECT * FROM supplier_details where verified='0' and bh_to_verified='$initial'";
            }
            $result=mysql_query($query);
            while($row = mysql_fetch_array($result)) {

                echo "<tr class='data'>";
                echo "<td class='data'>".$row['supplier_id']."</td>";
                echo "<td class='data'>".$row['supplier_name']."</td>";
                echo "<td class='data'>".$row['style']."</td>";
                echo "<td class='data'>".$row['description']."</td>";
                echo "<td class='data'>".$row['branch']."</td>";
                echo "<td class='data'>".$row['bh_in_charge']."</td>";
                echo "<td class='data'>".$row['bh_to_verified']."</td>";
                echo "<td class='data'>".$row['owner']."</td>";
                echo "<td class='data'>".$row['owner_contact']."</td>";
                if ($row['street']=='' && $row['municipality']=='' && $row['province']=='') {
                    echo "<td class='data'>-</td>";
                } else {
                    echo "<td class='data'>".$row['street'].",".$row['municipality'].",".$row['province']."</td>";
                }
                echo "<td class='data'><button id='".$row['supplier_id']."' onclick='openWindow(this.id);'>View</button></td>";
                echo "</tr>";
            }
            echo "</table>";

            ?>

    </div>
</div>
