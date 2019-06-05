<?php
session_start();
$date_of_effectivity=$_POST['date_of_effectivity'];
$date_array=preg_split ( "[/]" ,$date_of_effectivity);
include('config.php');
$grade=$_POST['grade'];
$tipco_price=$_POST['tipco_price'];
$competitor_price=$_POST['competitor_price'];
$competitor2_price=$_POST['competitor2_price'];
$total_sales=$_POST['total_sales'];
$month=$date_array[1];
$day_changed=$date_array[2];
$year=$date_array[0];
$effect_date=$date_of_effectivity;
$time_changed=date('g a');
$updated_by=$_SESSION['username'];




mysql_query("INSERT INTO pricing_with_competitors (grade_id,tipco_price,competitor_price,total_sales,month,day_changed,year,effect_date,time_changed,updated_by,competitor2_price) VALUES ('$grade','$tipco_price','$competitor_price','$total_sales','$month','$day_changed','$year','$effect_date','$time_changed','$updated_by','$competitor2_price');");

echo "<script>

alert('Price Updated Successfully... ');
 window.history.back();
</script>";


?>