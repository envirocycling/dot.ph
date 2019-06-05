<?php
date_default_timezone_set('America/Los_Angeles');
include("templates/template.php");
?>
<div id="container" class="clear">
    <div id="content">
        <?php
        $ngayon=date('m/d/y');
        echo "<h2>  Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>";


        ?>
        <table summary="Summary Here" cellpadding="0" cellspacing="0" border="2">
            <?php
            echo "<thead>";
            echo "<th>ID NUMBER</th>";
            echo "<th>Supplier Name</th>";
            echo "<th>Scheme</th>";
            echo "<th>Quota (KG)</th>";
            echo "<th>Incentive</th>";
            echo "<th>Paper Grade</th>";
            echo "<th>Total Deliveries (KG)</th>";
            echo "<th>Covered with Incentive (KG)</th>";
            echo "<th>Incentive to Receive (Php)</th>";
            echo "<th>Percentage to Quota</th>";
            echo "<th>Action</th>";
            echo "</thead>";
            include("config.php");
            include("incSearchForm.php");

            if($_SESSION['incentive_criteria']=='met') {
                $query="SELECT * FROM incentive_scheme where percentage>=1 ";
            }else if($_SESSION['incentive_criteria']=='above 50') {
                $query="SELECT * FROM incentive_scheme where percentage>=.5 ";
            }else {
                $query="SELECT * FROM incentive_scheme ";

            }
            $result=mysql_query($query);
            while($row = mysql_fetch_array($result)) {
                $range=$row['scheme'];
                $range_date_array=preg_split('/[ -.]/',$range);
                $query2="SELECT supplier_name,sum(weight),wp_grade FROM sup_deliveries where supplier_id='".$row['sup_id']."'and wp_grade='".$row['wp_grade']."' and date_delivered between '".$range_date_array[0]."' and '".$range_date_array[1]."' group by wp_grade";
                $result2=mysql_query($query2);
                $row2 = mysql_fetch_array($result2);
                echo "<tr class='light'>";
                echo "<td>".$row['sup_id']."</td>";
                echo "<td>".$row2['supplier_name']."</td>";
                echo "<td>".$row['scheme']."</td>";
                echo "<td>".number_format($row['quota'],1)."</td>";
                $formatted_inc=number_format($row['incentive'],2);
                echo "<td>".$formatted_inc."</td>";
                echo "<td>".$row['wp_grade']."</td>";
                echo "<td>".number_format($row2['sum(weight)'],1)."</td>";
                echo "<td>".number_format($row['covered_incentive'],1)."</td>";
                $incentive_to_receive=0;
                if($row['computed_incentive']<1 && $row2['sum(weight)']>=$row['covered_incentive']) {
                    $coverage=$row['covered_incentive'];
                    $incentive=$row['incentive'];
                    $incentive_to_receive= ($coverage)*($incentive);
                    mysql_query("UPDATE incentive_scheme set computed_incentive='".$incentive_to_receive."' where sup_id='".$row['sup_id']."' and del_id='".$row['del_id']."';");
                }
                echo "<td>".$row['computed_incentive']."</td>";
                $quotient=$row2['sum(weight)']/$row['quota'];
                $quotient=round($quotient*100)."%";
                echo "<td>".($row['percentage']*100)."%</td>";
                echo "<td>";
                echo "
                    <form action='reportIncentiveDeliveries.php' method='POST'>
                    <input type=hidden  name='sup_id' value='".$row['sup_id']."'>
                    <input type=hidden  name='wp_grade' value='".$row['wp_grade']."'>
                    <input type=hidden  name='scheme' value='".$row['scheme']."'>
                    <input type=hidden  name='quota' value='".$row['quota']."'>
                    <input type=hidden  name='incentive' value='".$row['incentive']."'>
                    <input type=hidden  name='supplier_name' value='".$row2['supplier_name']."'>
                    <input type='Submit' value='Generate Report'>
                   </form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "<tr class='dark'>";
            echo "<td>TOTAL</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";

            echo "</table>";



            ?>







        </table>

    </div>
</div>