<?php
include('config.php');
$query="SELECT * from sup_deliveries where branch_delivered='Sauyo' or branch_delivered='Kaybiga' and wp_grade='onp' and year_delivered='2013' and month_delivered !='October' group by supplier_id  ;";
$result=mysql_query($query);
$counter=0;
$suppliers_array=array();
while($row=mysql_fetch_array($result)) {
array_push($suppliers_array,$row['supplier_id']);
}
$suppliers_array=array_unique($suppliers_array);
foreach ($supplier_array as $value){
     echo $value;
}
echo $counter;
?>