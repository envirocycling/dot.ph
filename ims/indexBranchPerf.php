<style>
    #branchPerf{
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
$query="select branch_delivered,sum(weight) from sup_deliveries where branch_delivered !='' and branch_delivered != '0' group by branch_delivered ; ";
$result=mysql_query($query);
echo "<table border=2 id='branchPerf'>";
echo "<thead>";

echo "<th>Branch</th>";
echo "<th>Receiving(MT)</th>";
echo "</thead>";
$total=0;
while($row = mysql_fetch_array($result)) {
    echo "<tr class='light'>";
    echo "<td>".$row['branch_delivered']."</td>";
    $quotient=$row['sum(weight)']/1000;
    $total+=$row['sum(weight)'];
    $quotient=number_format($quotient,2);
    echo "<td>".$quotient."</td>";
    $total+=$quotient;
    echo "</tr>";
}
$total/=1000;
echo "<tr class='dark'>";
echo "<td>"."TOTAL"."</td>";
echo "<td>".number_format($total,2)."</td>";
echo "</tr>";
echo "</table>";

?>