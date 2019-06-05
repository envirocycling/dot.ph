<style>
    #scheme{
        font-size:10px;
        height:200px;
        margin-left:-2px;
        padding: 5px;
    }
    #scheme td{
        padding:0px;
        font-size:15px;
        text-align:center;
    }
    #sceheme th{
        font-size:18px;

    }


</style>

<?php
date_default_timezone_set('America/Los_Angeles');
include("config.php");
$query="SELECT wp_grade,count(sup_id) FROM incentive_scheme where computed_incentive>1 group by wp_grade; ";
$result=mysql_query($query);
echo "<table border=2 id='scheme'>";
echo "<thead>";

echo "<th>WP Grade</th>";
echo "<th># of Suppliers who met the Scheme</th>";
echo "</thead>";
$total=0;
while($row = mysql_fetch_array($result)) {
    echo "<tr class='light'>";
    echo "<td>".$row['wp_grade']."</td>";
    echo "<td>".$row['count(sup_id)']."</td>";
    $total+=$row['count(sup_id)'];
    echo "</tr>";
}
echo "<tr class='dark'>";
echo "<td>TOTAL</td>";
echo "<td>".$total."</td>";
echo "</tr>";
echo "</table>";

?>