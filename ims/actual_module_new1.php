<?php

include("config.php");
$num =0;
$counter=0;
$parameter= $_POST['parameter'];
$actual_details=preg_split("/[|]/",$parameter);
array_pop($actual_details);


foreach ($actual_details as $var) {
    $actual_detailslvl2=preg_split("/[+]/",$var);
    $str=$actual_detailslvl2[0];
     $delivered_to=$actual_detailslvl2[1];
    $plate_number=$actual_detailslvl2[2];
    $wp_grade=$actual_detailslvl2[3];
    $weight=$actual_detailslvl2[4];
     $branch=utf8_decode($actual_detailslvl2[5]);
	 $wp_type ='';

    if ($branch=='NOVALICHES'){
   $branch="kaybiga";
    }
    if ($branch=='MAKATI') {
       $branch="pasay";
    }
   $date=$actual_detailslvl2[6];
   $mc=$actual_detailslvl2[7];
   $dirt=$actual_detailslvl2[8];
   $net_wt=$actual_detailslvl2[9];
   $remarks=$actual_detailslvl2[10];
   $id=$actual_detailslvl2[11];
   $dtld_id=$actual_detailslvl2[12];
   $delete=$actual_detailslvl2[13];
   
  // $wp_grade = str_replace(" ", "_", $wp_grade);
  // $wp_grade1 = explode("_",$wp_grade);
 //  $wp_grade = $wp_grade1[0];
   
    if($delete == 1){
		mysql_query("DELETE from actual WHERE branch='Pampanga' and trans_id='$trans_id'") or die(mysql_error());
	}
	
	 $check = mysql_query("SELECT * from actual WHERE trans_id='$id' And detail_id='$dtld_id'") or die (mysql_error());
	 
	 if(mysql_num_rows($check) > 0){
	 	if(mysql_query("UPDATE actual SET detail_id='$dtld_id',trans_id='$id',str_no='$str',date='$date',delivered_to='$delivered_to',plate_number='$plate_number',wp_grade='$wp_grade',weight='$weight',branch='$branch',mc='$mc',dirt='$dirt',net_wt='$net_wt',comments='$remarks',dr_number='$str' WHERE trans_id='$id' And detail_id='$dtld_id'")) {
        $counter++;
		$num=1;
                echo "UPDATE actual SET detail_id='$dtld_id',trans_id='$id',str_no='$str',date='$date',delivered_to='$delivered_to',plate_number='$plate_number',wp_grade='$wp_grade',weight='$weight',branch='$branch',mc='$mc',dirt='$dirt',net_wt='$net_wt',comments='$remarks',dr_number='$str' WHERE trans_id='$id' And detail_id='$dtld_id'";
    }
	 }else if(mysql_num_rows($check) == 0){
    if(mysql_query("INSERT INTO actual(detail_id,trans_id,str_no,date,delivered_to,plate_number,wp_grade,weight,branch,mc,dirt,net_wt,comments,dr_number) VALUES('$dtld_id','$id','$str','$date','$delivered_to','$plate_number','$wp_grade','$weight','$branch','$mc','$dirt','$net_wt','$remarks','$str')")) {
        $counter++;
		$num=1;
                
                echo "INSERT INTO actual(detail_id,trans_id,str_no,date,delivered_to,plate_number,wp_grade,weight,branch,mc,dirt,net_wt,comments,dr_number) VALUES('$dtld_id','$id','$str','$date','$delivered_to','$plate_number','$wp_grade','$weight','$branch','$mc','$dirt','$net_wt','$remarks','$str')";
    }
	}


}
if($num == 1){

 $id=$actual_detailslvl2[11];
 $dtld_id=$actual_detailslvl2[12];
/*include('config_new.php');
if(mysql_query("UPDATE scale_outgoing SET upload='1' WHERE str_no='$str' and trans_id='$id'") or die(mysql_error()))*/
?>
<script>
setTimeout(function () {
window.top.location.href = "http://10.151.16.231/export_receiving.php?strno=<?php echo $str.'& tid='.$id.'& update=yes';?>";
}, 15000);
</script>
<?php

}else if($num == 0){
?>
<script>
setTimeout(function () {
window.top.location.href = "http://10.151.16.231/export_receiving.php"; 
}, 10500);
</script>
<?php
}

?>
