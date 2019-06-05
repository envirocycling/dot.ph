<?php
include("config.php");
echo "<form action='show_affected_suppliers.php?answer=YES' method='POST'>";
$query = "SELECT * FROM branches  ";
$result = mysql_query($query) ;
echo "On which branch?: ";
$dropdown = "<select name='branch_affected' >";
$dropdown .= "\r\n<option value=''>All</option>";
while($row = mysql_fetch_array($result)) {
    $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
}
$dropdown  .= "\r\n</select><br>";
echo $dropdown;
echo "<input type='submit' value='Submit'>";
echo "</form>";
?>