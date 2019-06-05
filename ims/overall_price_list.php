<?php
include('templates/template.php');
date_default_timezone_set('America/Los_Angeles');

include("config.php");
$query2="SELECT effect_date from pricing_with_competitors order by change_log_id desc limit 1";
$result2=mysql_query($query2);
$row2 = mysql_fetch_array($result2);
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>WP Pricing, Last updated: <u><i><b><?php echo $row2['effect_date']?></b></i></u></h2>

        <?php

        $query="SELECT * FROM pricing_with_competitors where effect_date='".$row2['effect_date']."'  ";
        $result=mysql_query($query);
        ?>

        <table class="data display datatable" id="example">

            <?php
            echo "<thead>";
            echo "<tr class='data'>";
            echo "<th class='data'>Grade</th>";
            echo "<th class='data'>Tipco Price</th>";
            echo "<th class='data'>Competitor's Price</th>";
            echo "<th class='data'>Sales</th>";
            echo "</tr>";
            echo "</thead>";
            while($row = mysql_fetch_array($result)) {
                echo "<tr class='data'>";
                echo "<td class='data'>".$row['grade_id']."</td>";
                echo "<td class='data'>".$row['tipco_price']."</td>";
                echo "<td class='data'>".$row['competitor_price']."</td>";
                echo "<td class='data'>".$row['total_sales']."</td>";

                echo "</tr>";

            }
            echo "</table>";

            ?>



    </div>
</div>
