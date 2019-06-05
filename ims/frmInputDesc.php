<?php
include("config.php");
$desc="";
$name="";
$result=mysql_query("SELECT * FROM supplier_details where supplier_id=".$_GET['id']." ");
while($row=mysql_fetch_array($result)) {
    $desc=$row['description'];
    $name=$row['supplier_name'];
}
echo "<form  action='input_desc.php' method='POST'>";
echo "<input type='hidden' name='supplier_id' value='".$_GET['id']."'>";
echo "Description for supplier  <u><b>".$name."</b></u>: <br><textarea cols='38' rows='4' name='desc'>$desc</textarea><br>";


echo "<input type='Submit' value='Submit'>";
echo "</form>";

?>