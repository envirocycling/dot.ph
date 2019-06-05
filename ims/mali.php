<?php
include 'config.php';
$ctr = 0;
$sql = mysql_query("SELECT * FROM supplier_details WHERE branch='Cainta' and status!='inactive'");
while($rs = mysql_fetch_array($sql)) {
    $address = $rs['address'];
    $que = preg_split("[/]",$address);

    echo $rs['supplier_id']."_".$que[0]."_".$que[1]."_".$que[2]."<br>";
    $province=$que[2];
    if($province=='Quezon') {
        $province=='Quezon City';
    }
    mysql_query("UPDATE supplier_details SET province='$province' WHERE supplier_id='".$rs['supplier_id']."'");

    $ctr++;

}
echo $ctr;
?>