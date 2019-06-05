<?php
include("config.php");
$request_id=$_POST['canvass_req_id'];
$cv1_sup=$_POST['cvt1'];
$cv1_1=$_POST['cv1_1'];
$cv1_2=$_POST['cv1_2'];
$cv1_3=$_POST['cv1_3'];
$cv1_4=$_POST['cv1_4'];
$cv1_5=$_POST['cv1_5'];
$cv1_6=$_POST['cv1_6'];
$cv1_7=$_POST['cv1_7'];
$cv1_8=$_POST['cv1_8'];
$cv1_9=$_POST['cv1_9'];
$cv1_10=$_POST['cv1_10'];
$cv1_11=$_POST['cv1_11'];
$cv1_12=$_POST['cv1_12'];

$cv2_sup=$_POST['cvt2'];
$cv2_1=$_POST['cv2_1'];
$cv2_2=$_POST['cv2_2'];
$cv2_3=$_POST['cv2_3'];
$cv2_4=$_POST['cv2_4'];
$cv2_5=$_POST['cv2_5'];
$cv2_6=$_POST['cv2_6'];
$cv2_7=$_POST['cv2_7'];
$cv2_8=$_POST['cv2_8'];
$cv2_9=$_POST['cv2_9'];
$cv2_10=$_POST['cv2_10'];
$cv2_11=$_POST['cv2_11'];
$cv2_12=$_POST['cv2_12'];

$cv3_sup=$_POST['cvt3'];
$cv3_1=$_POST['cv3_1'];
$cv3_2=$_POST['cv3_2'];
$cv3_3=$_POST['cv3_3'];
$cv3_4=$_POST['cv3_4'];
$cv3_5=$_POST['cv3_5'];
$cv3_6=$_POST['cv3_6'];
$cv3_7=$_POST['cv3_7'];
$cv3_8=$_POST['cv3_8'];
$cv3_9=$_POST['cv3_9'];
$cv3_10=$_POST['cv3_10'];
$cv3_11=$_POST['cv3_11'];
$cv3_12=$_POST['cv3_12'];
$lpp_total=$_POST['totalLPP'];
$cv1_total=$_POST['total1'];
$cv2_total=$_POST['total2'];
$cv3_total=$_POST['total3'];

$cost_1 = $_POST['cost_1'];
$cost_2 = $_POST['cost_2'];
$cost_3 = $_POST['cost_3'];
$cost_4 = $_POST['cost_4'];
$cost_5 = $_POST['cost_5'];
$cost_6 = $_POST['cost_6'];
$cost_7 = $_POST['cost_7'];
$cost_8 = $_POST['cost_8'];
$cost_9 = $_POST['cost_9'];
$cost_10 = $_POST['cost_10'];
$cost_11 = $_POST['cost_11'];
$cost_12 = $_POST['cost_12'];

$total_cost = $_POST['total_cost'];

$type=$_POST['type'];
$stamp='';

if($type!='for_sample' && $type!='heavy_vehicles') {
    $type='for approval';
}else {
    $stamp='notify';
}
if(mysql_query("Update requests set
                                 cv1_1='$cv1_1',
                                 cv1_2='$cv1_2',
                                 cv1_3='$cv1_3',
                                 cv1_4='$cv1_4',
                                 cv1_5='$cv1_5',
                                 cv1_6='$cv1_6',
                                 cv1_7='$cv1_7',
                                 cv1_8='$cv1_8',
                                 cv1_9='$cv1_9',
                                 cv1_10='$cv1_10',
                                 cv1_11='$cv1_11',
                                 cv1_12='$cv1_12',

                                 cv2_1='$cv2_1',
                                 cv2_2='$cv2_2',
                                 cv2_3='$cv2_3',
                                 cv2_4='$cv2_4',
                                 cv2_5='$cv2_5',
                                 cv2_6='$cv2_6',
                                 cv2_7='$cv2_7',
                                 cv2_8='$cv2_8',
                                 cv2_9='$cv2_9',
                                 cv2_10='$cv2_10',
                                 cv2_11='$cv2_11',
                                 cv2_12='$cv2_12',

                                 cv3_1='$cv3_1',
                                 cv3_2='$cv3_2',
                                 cv3_3='$cv3_3',
                                 cv3_4='$cv3_4',
                                 cv3_5='$cv3_5',
                                 cv3_6='$cv3_6',
                                 cv3_7='$cv3_7',
                                 cv3_8='$cv3_8',
                                 cv3_9='$cv3_9',
                                 cv3_10='$cv3_10',
                                 cv3_11='$cv3_11',
                                 cv3_12='$cv3_12',

                                 lpp_total='$lpp_total',
                                 cv_sup1='$cv1_sup',
                                 cv1_total='$cv1_total',
                                 cv_sup2='$cv2_sup',
                                 cv2_total='$cv2_total',
                                 cv_sup3='$cv3_sup',
                                 cv3_total='$cv3_total',
                                 type='$type',
                                 status='for approval',
                                 stamp='$stamp',

                                 cost_1='$cost_1',
                                 cost_2='$cost_2',
                                 cost_3='$cost_3',
                                 cost_4='$cost_4',
                                 cost_5='$cost_5',
                                 cost_6='$cost_6',
                                 cost_7='$cost_7',
                                 cost_8='$cost_8',
                                 cost_9='$cost_9',
                                 cost_10='$cost_10',
                                 cost_11='$cost_11',
                                 cost_12='$cost_12',
                                 total_cost='$total_cost'

                                 where request_id=$request_id")) {

    echo "<script>";
    echo "alert('Canvass has been updated successfully...');";
    echo "window.location = 'canvassing_home.php'";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed update canvass...');";
    echo "window.location = 'canvassPR.php?request_id=$request_id'";
    
    echo "</script>";
}



?>