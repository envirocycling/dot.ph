<center>
<?php
$del_id=$_GET['del_id'];

echo "<h3>Encode Corrected Weight</h3>";
echo "<hr>";
echo "<form action='mcDirt.php' method='POST'>";
echo "<input type='hidden' value='$del_id' name='del_id'>";
echo "MC%:<input type='text' value='' name='mc_percentage' size='5'><br>";
echo "MC Weight:<input type='text' value='' name='mc_weight' size='5'><br>";
echo "Dirt %:<input type='text' value='' name='dirt_percentage' size='5'><br>";
echo "Dirt Weight:<input type='text' value='' name='dirt_weight' size='5'><br>";
echo "Correct Weight:<input type='text' value='' name='corrected_weight' size='5'><br>";
echo "Remarks :<input type='text' value='' name='remarks' size='20'><br>";
echo "<input type='submit' value='Record'>";
echo "</form>";

?>
</center>