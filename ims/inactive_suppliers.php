<?php
include("templates/template.php");
?>




<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        echo "<h2>  Suppliers as of : <u><b><i>".$ngayon."</i></b></u></h2>";


        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';

            echo "<th class='data'> Supplier ID</th>";
            echo "<th class='data'>Supplier Name</th>";
            echo "<th class='data'>Classification</th>";
            echo "<th class='data'>Branch</th>";
            echo "<th class='data'>BH In-Charge</th>";
            echo "<th class='data'>Owner</th>";
            echo "<th class='data'>Contact</th>";
            echo "<th class='data'>Address</th>";


            echo "<th class='data'>Action</th>";
            echo "</tr>";

            echo "</thead>";
            include("config.php");



            $query="SELECT * FROM supplier_details where status ='inactive'";

            $result=mysql_query($query);
            while($row = mysql_fetch_array($result)) {

                echo "<tr class='data'>";
                echo "<td class='data'>".$row['supplier_id']."</td>";
                echo "<td class='data'>".$row['supplier_name']."</td>";
                echo "<td class='data'>".$row['style']."</td>";
                echo "<td class='data'>".$row['branch']."</td>";
                echo "<td class='data'>".$row['bh_in_charge']."</td>";
                echo "<td class='data'>".$row['owner']."</td>";
                echo "<td class='data'>".$row['owner_contact']."</td>";
                if ($row['street']=='' && $row['municipality']=='' && $row['province']=='') {
                    echo "<td class='data'>-</td>";
                } else {
                    echo "<td class='data'>".$row['street'].",".$row['municipality'].",".$row['province']."</td>";
                }
                echo "<td class='data'><a href='editSupplier.php?sup_id=".$row['supplier_id']."'><button>View/Edit</button></a>|";
                echo "<a href='unhide_supplier.php?sup_id=".$row['supplier_id']."'><button>Mark As Active</button></a>|";
                ?>

            <a href="delete_supplier.php?sup_id=<?php echo $row['supplier_id']; ?>" onclick="return confirm('Are you sure you want to delete?')"><button>Delete</button></a></td>
                <?php
                echo "</tr>";
            }


            echo "</table>";

            ?>







        </table>

    </div>
</div>
