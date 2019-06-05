<?php
include("templates/template.php");
$_SESSION['selected_grade']='onp';
include("config.php");
?>
<div id="container" class="clear">
    <div id="content">
        <?php
        include("searchForm.php");
        $ngayon=date('m/d/y');
        echo "<h2> OCC Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>";

        include("summary.php");

        ?>
        <table summary="Summary Here" cellpadding="0" cellspacing="0" border="2">
            <?php

            $query="SELECT * FROM sup_deliveries group by month_delivered order by del_id asc;";
            $result=mysql_query($query);
            echo "<thead>";
            $month_delivered=array();
            echo "<th>ID NUMBER</th>";
            echo "<th>Supplier Name</th>";

            while($row = mysql_fetch_array($result)) {
                echo "<th>".$row['month_delivered']."</th>";
                array_push($month_delivered,$row['month_delivered']);
            }
            echo "</thead>";

            $query="SELECT supplier_id,del_id,supplier_name,sum(weight) FROM sup_deliveries  where wp_grade='onp' group by supplier_name,month_delivered order by supplier_name asc,del_id asc;";
            $result=mysql_query($query);
            $array_delivery_details=array();
            $counter=0;
            while($row = mysql_fetch_array($result)) {
                if($counter<=$_SESSION['current_month']) {
                    if($counter==0) {
                        echo "<tr class='light'>";
                        echo "<td>".$row['supplier_id']."</td>";
                        echo "<td>".$row['supplier_name']."</td>";

                    }
                    if($counter<$_SESSION['current_month']) {
                        echo "<td>".$row['sum(weight)']."</td>";
                        $counter++;
                    }
                    if($counter==$_SESSION['current_month']) {
                        echo "</tr>";
                        $counter=0;
                    }

                }
            }




            ?>







        </table>

    </div>
</div>