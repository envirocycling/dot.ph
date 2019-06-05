<?php
include('config.php');
$sup_id=$_GET['sup_id'];
$year=$_GET['year'];
$wp_grade=$_GET['wp_grade'];
$query=mysql_query("SELECT branch_delivered,month_delivered,sum(weight),wp_grade from sup_deliveries where supplier_id='$sup_id' and year_delivered='$year' and wp_grade like '%$wp_grade%' group by month_delivered,branch_delivered,wp_grade order by date_delivered asc;");
echo "<h3>Supplier:$sup_id Branch Delivery Breakdown for the year $year </h3><hr>";
echo "<table>";
while($row=mysql_fetch_array($query)) {
    echo "<tr>";
    echo "<td>".strtoupper($row['month_delivered'])."</td>";
    echo "<td>-------------------</td>";
    echo "<td>".strtoupper($row['branch_delivered'])."</td>";
    echo "<td>-------------------</td>";
    echo "<td>".strtoupper($row['wp_grade'])."</td>";
    echo "<td>-------------------</td>";
    echo "<td>".number_format($row['sum(weight)'])."</td>";
    echo "</tr>";

}
echo "</table>";

?>