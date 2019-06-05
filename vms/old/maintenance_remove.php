<?php
include('connect.php');
$_POST['id'];
$qty = mysql_query("Select * from tbl_trucktools Where ti ='".$_POST['id']."'") or die (mysql_error());
$rqty = mysql_fetch_array($qty);



$name = mysql_query("Select * from tbl_addinventorytool Where name='".$rqty['toolname']."'") or die (mysql_error());
$rname=mysql_fetch_array($name);
//echo $new_qty = $rqty['qty'] + $rname['qty'];
echo $new_issued = $rname['issued'] - $rqty['qty'];
echo  $new_available = $rname['available'] + $rqty['qty'] ;

$update = mysql_query("Update tbl_addinventorytool Set issued='$new_issued', available='$new_available', zero='0' Where name='".$rqty['toolname']."'") or die (mysql_error());
 mysql_query("Delete from tbl_trucktools Where ti = '".$_POST['id']."'") or die (mysql_error());;
?>