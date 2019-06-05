<?php
include('config.php');

$query="SELECT * from pricing_with_competitors where grade_id='".$_GET['grade']."'";
$result=mysql_query($query);


echo "<h3><u><i>".$_GET['grade']."</i></u> Price History</h3>";

echo "<table border='1'>";

echo "<th>TIPCO PRICE (Php)</th>";

echo "<th>DATE CHANGED</th>";


while($row = mysql_fetch_array($result)) {
    echo "<tr>";

    echo "<td>".$row['tipco_price']."</td>";

    echo "<td>".$row['effect_date']."</td>";
    echo "</tr>";
    ;

}

?>
