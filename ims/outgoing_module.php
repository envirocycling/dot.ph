<?php

include("config.php");
$counter=0;
$parameter= $_POST['parameter'];
$branch=$_POST['branch'];
$outgoing_details=preg_split("/[|]/",$parameter);
array_pop($outgoing_details);

foreach ($outgoing_details as $var) {
    $outgoing_detailslvl2=preg_split("/[+]/",$var);
    $str=$outgoing_detailslvl2[0];
    $date=$outgoing_detailslvl2[1];
    $priority_no=$outgoing_detailslvl2[2];
    $trucking=$outgoing_detailslvl2[3];
    $plate_number=$outgoing_detailslvl2[4];

    $wp_grade=$outgoing_detailslvl2[5];

    if((strpos($wp_grade,'LCWL') === FALSE ) && (strpos($wp_grade,'CHIPBOARD') === FALSE )) {
        $wp_grade="LC".$wp_grade;
    }
    if((strpos($wp_grade,'.') == TRUE) ) {
        $wp_grade='LCMW';
    }
    if($wp_grade == 'LCCB') {
        $wp_grade='CHIPBOARD';
    }

    $weight=$outgoing_detailslvl2[6];
    $trucking_fee=$outgoing_detailslvl2[7];
    if ($str != '') {
        if(mysql_query("INSERT INTO outgoing(str,date,trucking,plate_number,wp_grade,weight,branch,trucking_fee)
                                VALUES('$str','$date','$trucking','$plate_number','$wp_grade','$weight','$branch','$trucking_fee')")) {
            $counter++;
        }
    } 
}
echo "<script>";
echo "alert('$counter records has been inserted successfully...');";
echo "window.history.back();";
echo "</script>";

?>