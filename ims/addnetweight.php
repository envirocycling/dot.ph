<?php
$st_no=$_POST['str'];
$date=$_POST['date'];
$delivered_to=strtoupper($_POST['delivered']);
$plate_number=$_POST['plate_number'];
$wp_grade=$_POST['wp_grade'];
$net_weight=$_POST['net_weight'];
$branch=$_POST['branch'];
$dr_number=$_POST['dr_number'];
$mc=$_POST['mc'];
$dirt=$_POST['dirt'];
$corrrected_weight=$_POST['corrected_weight'];
include('config.php');
if(mysql_query("INSERT INTO actual(str_no,date,delivered_to,plate_number,wp_grade,weight,branch,mc,dirt,net_wt)
                            VALUES('$st_no','$date','$delivered_to','$plate_number','$wp_grade','$corrrected_weight','$branch','$mc','$dirt','$net_weight');")) {
    echo "<script>";
    echo "alert('Recorded Successfully...');";
    echo "window.history.go(-1);";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to record actual weight...');";
    echo "window.history.go(-1);";
    echo "</script>";
}

?>