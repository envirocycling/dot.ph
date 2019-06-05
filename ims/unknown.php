<?php

include("config.php");

$total1 = 0;
$total2 = 0;
$total3 = 0;
$total4 = 0;
$total5 = 0;
$total6 = 0;
echo "<table border='1'>";
echo "<thead>";
echo "<th>supplier_id</th>";
echo "<th>supplier_name</th>";
echo "<th>branch</th>";
echo "<th>Province</th>";
echo "<th>jan</th>";
echo "<th>feb</th>";
echo "<th>mar</th>";
echo "<th>apr</th>";
echo "<th>may</th>";
echo "<th>june</th>";
echo "</thead>";
$ctr =0;
$sql = mysql_query("SELECT * FROM supplier_details WHERE status='inactive' and province='' and street='' and municipality=''");
while ($rs = mysql_fetch_array($sql)) {
    echo "<tr>";
    echo "<td>".$rs['supplier_id']."</td>";
    echo "<td>".$rs['supplier_name']."</td>";
    echo "<td>".$rs['branch']."</td>";
    if (!empty($rs['province'])){
        echo "<td>".$rs['province']."</td>";
    } else {
        echo "<td>UNKNOWN</td>";
    }
    
    $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='".$rs['supplier_id']."' and month_delivered='january' and year_delivered='2014'");
    $rs_del = mysql_fetch_array($sql_del);
    $total1+=$rs_del['sum(weight)']/1000;
    echo "<td>".round($rs_del['sum(weight)']/1000,2)."</td>";
    $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='".$rs['supplier_id']."' and month_delivered='february' and year_delivered='2014'");
    $rs_del = mysql_fetch_array($sql_del);
    $total2+=$rs_del['sum(weight)']/1000;
    echo "<td>".round($rs_del['sum(weight)']/1000,2)."</td>";
    $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='".$rs['supplier_id']."' and month_delivered='march' and year_delivered='2014'");
    $rs_del = mysql_fetch_array($sql_del);
    $total3+=$rs_del['sum(weight)']/1000;
    echo "<td>".round($rs_del['sum(weight)']/1000,2)."</td>";
    $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='".$rs['supplier_id']."' and month_delivered='april' and year_delivered='2014'");
    $rs_del = mysql_fetch_array($sql_del);
    $total4+=$rs_del['sum(weight)']/1000;
    echo "<td>".round($rs_del['sum(weight)']/1000,2)."</td>";
    $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='".$rs['supplier_id']."' and month_delivered='may' and year_delivered='2014'");
    $rs_del = mysql_fetch_array($sql_del);
    $total5+=$rs_del['sum(weight)']/1000;
    echo "<td>".round($rs_del['sum(weight)']/1000,2)."</td>";
    $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='".$rs['supplier_id']."' and month_delivered='june' and year_delivered='2014'");
    $rs_del = mysql_fetch_array($sql_del);
    $total6+=$rs_del['sum(weight)']/1000;
    echo "<td>".round($rs_del['sum(weight)']/1000,2)."</td>";
    echo "</tr>";
    $ctr++;
}
echo "<tr>";
echo "<td>!TOTAL</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>".round($total1,2)."</td>";
echo "<td>".round($total2,2)."</td>";
echo "<td>".round($total3,2)."</td>";
echo "<td>".round($total4,2)."</td>";
echo "<td>".round($total5,2)."</td>";
echo "<td>".round($total6,2)."</td>";
echo "</tr>";
echo "<table>";

echo "TOTAL UNKNOWN SUPPLIERS:".$ctr;
?>