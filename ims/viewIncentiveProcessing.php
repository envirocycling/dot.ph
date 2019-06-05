<?php
date_default_timezone_set('America/Los_Angeles');
include("templates/template.php");
?>




<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');

        echo "<h2>Incentive Processing Log</h2>";

        ?>

        <table class="data display datatable" id="example">


            <?php

            include ("config.php");

            $query="SELECT * FROM inc_processing;";
            $result=mysql_query($query);

            echo "<thead>";
            echo "<th class='data'>Supplier</th>";
            echo "<th class='data'>Scheme</th>";
            echo "<th class='data'>Processed By</th>";
            echo "<th class='data'>Date Processed</th>";
            echo "<th class='data'>TIME</th>";
            echo "</thead>";
            while($row = mysql_fetch_array($result)) {
                echo "<tr class='data'>";
                $query2="SELECT * FROM incentive_scheme where del_id='".$row['del_id']."';";
                $result2=mysql_query($query2);
                $row2 = mysql_fetch_array($result2);
                echo "<td class='data'>".$row2['sup_id']."</td>";
                echo "<td class='data'>".$row2['scheme']."</td>";
                echo "<td class='data'>".$row['processed_by']."</td>";
                echo "<td class='data'>".$row['date_processed']."</td>";
                echo "<td class='data'>".$row['time_processed']."</td>";
                echo "</tr>";

            }




            ?>

        </table>
        <?php
        echo "<a   href='".$_SERVER['HTTP_REFERER']."'><button>Back to List</button></a>";

        ?>
    </div>

</div>