<?php
include("config.php");
$counter=0;
$parameter= $_POST['parameter'];
$actual_details=preg_split("/[|]/",$parameter);
array_pop($actual_details);
$date=$_POST['date'];


mysql_query("DELETE FROM actual where date like '%$date%' and dr_number!='';");

foreach ($actual_details as $var) {
    $actual_detailslvl2=preg_split("/[+]/",$var);
    $str=$actual_detailslvl2[0];
    $delivered_to=$actual_detailslvl2[1];
    $plate_number=$actual_detailslvl2[2];
    $wp_grade=$actual_detailslvl2[3];
    $weight=$actual_detailslvl2[4];
    $branch=$actual_detailslvl2[5];
    if ($branch=='NOVALICHES'){
        $branch="kaybiga";
    }
    if ($branch=='MAKATI') {
        $branch="pasay";
    }
    $date=$actual_detailslvl2[6];
    $dr_number=$actual_detailslvl2[7];
    $mc=$actual_detailslvl2[8];
    $dirt=$actual_detailslvl2[9];
    $net_wt=$actual_detailslvl2[10];
    $comments=$actual_detailslvl2[11];
    if(mysql_query("INSERT INTO actual(str_no,date,delivered_to,plate_number,wp_grade,weight,branch,dr_number,mc,dirt,net_wt,comments) VALUES('$str','$date','$delivered_to','$plate_number','$wp_grade','$weight','$branch','$dr_number','$mc','$dirt','$net_wt','$comments')")) {
        $counter++;
    }
//    $que = preg_split("[/]", $date);
//    $q_date = $que[0].$que[1];
//    mysql_query("UPDATE outgoing SET notations='$comments' WHERE str='$str' and wp_grade='$wp_grade' and date like '%$q_date%' and notations=''");
}
echo "<script>";


echo "alert ('$counter records has been inserted successfully...');";
echo "window.history.back();";
echo "</script>";


?>