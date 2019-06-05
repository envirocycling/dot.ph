
<?php
$parameter=$_GET['parameter'];
echo "<h2>$parameter Competitors Price Update History</h2>";
echo "<table height='700' width='600'>";
echo "<tr>";
echo "<td>";
echo "<iframe src='view_price_update_history.php?parameter=$parameter' height=65% width=100%></iframe>";
echo "</td>";
echo "</table>";
?>
