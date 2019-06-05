<?php
include('config.php');
$query="SELECT * FROM bales where str_no !='0' and out_date ='' ";
$to_update_array=array();
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    $log_id= $row['log_id'];
    $str_ng_bale=$row['str_no'];

    $query2="SELECT * FROM outgoing where str ='$str_ng_bale'";
    $result2=mysql_query($query2);
    while($row2 = mysql_fetch_array($result2)) {
        $outgoing_date=$row2['date'];
        array_push($to_update_array,$str_ng_bale."~".$outgoing_date);

    }

}
$to_update_array=array_unique($to_update_array);
foreach($to_update_array as $value) {
    $var2=preg_split("[~]",$value);
    $str=$var2[0];
    $outgoing_date=$var2[1];

    if( mysql_query("UPDATE bales set out_date='$outgoing_date' where str_no='$str'")) {
        echo "un"."<br>";
    }else {
        echo "waley"."<br>";
        
    }


}

?>