<?php
include('config.php');

$query="SELECT * from pricing_with_competitors where grade_id='".$_GET['grade']."' and  month='".$_GET['month']."'";
$result=mysql_query($query);

$date="2012/".$_GET['month']."/"."01";
$newDate = date("F", strtotime($date));
echo "<h3>".$newDate." <u><i>".$_GET['grade']."</i></u> Price History</h3>";

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
