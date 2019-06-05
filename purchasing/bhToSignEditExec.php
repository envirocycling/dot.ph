<?php
$prNumber=$_POST['request_id'];
$branch=$_POST['branch'];
$canvasser=$_POST['canvasser'];
$verified=$_POST['verified'];
$approved=$_POST['approved'];
$date=$_POST['date'];
$date_needed=$_POST['date_needed'];
$end_use=$_POST['end_use'];
$justification=$_POST['justification'];
$qty1=$_POST['qty1'];
$qty2=$_POST['qty2'];
$qty3=$_POST['qty3'];
$qty4=$_POST['qty4'];
$qty5=$_POST['qty5'];
$qty6=$_POST['qty6'];
$qty7=$_POST['qty7'];
$qty8=$_POST['qty8'];
$qty9=$_POST['qty9'];
$qty10=$_POST['qty10'];
$qty11=$_POST['qty11'];
$qty12=$_POST['qty12'];

$um1=$_POST['um1'];
$um2=$_POST['um2'];
$um3=$_POST['um3'];
$um4=$_POST['um4'];
$um5=$_POST['um5'];
$um6=$_POST['um6'];
$um7=$_POST['um7'];
$um8=$_POST['um8'];
$um9=$_POST['um9'];
$um10=$_POST['um10'];
$um11=$_POST['um11'];
$um12=$_POST['um12'];

$desc1=$_POST['desc1'];
$desc2=$_POST['desc2'];
$desc3=$_POST['desc3'];
$desc4=$_POST['desc4'];
$desc5=$_POST['desc5'];
$desc6=$_POST['desc6'];
$desc7=$_POST['desc7'];
$desc8=$_POST['desc8'];
$desc9=$_POST['desc9'];
$desc10=$_POST['desc10'];
$desc11=$_POST['desc11'];
$desc12=$_POST['desc12'];

$lpp1=$_POST['lpp1'];
$lpp2=$_POST['lpp2'];
$lpp3=$_POST['lpp3'];
$lpp4=$_POST['lpp4'];
$lpp5=$_POST['lpp5'];
$lpp6=$_POST['lpp6'];
$lpp7=$_POST['lpp7'];
$lpp8=$_POST['lpp8'];
$lpp9=$_POST['lpp9'];
$lpp10=$_POST['lpp10'];
$lpp11=$_POST['lpp11'];
$lpp12=$_POST['lpp12'];

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
$quotation=$_POST['quotation'];
$type=$_POST['type'];

include('config.php');

//mysql_query("DELETE from pr_to_sign where request_id='$prNumber'");


if(mysql_query("UPDATE pr_to_sign SET branch='$branch',canvasser='$canvasser',verified='$verified',approved='$approved',date='$date',date_needed='$date_needed',end_use='$end_use',justification='$justification',qty1='$qty1',qty2='$qty2',qty3='$qty3',qty4='$qty4',qty5='$qty5',qty6='$qty6',qty7='$qty7',qty8='$qty8',qty9='$qty9',qty10='$qty10',qty11='$qty11',qty12='$qty12',um1='$um1',um2='$um2',um3='$um3',um4='$um4',um5='$um5',um6='$um6',um7='$um7',um8='$um8',um9='$um9',um10='$um10',um11='$um11',um12='$um12',desc1='$desc1',desc2='$desc2',desc3='$desc3',desc4='$desc4',desc5='$desc5',desc6='$desc6',desc7='$desc7',desc8='$desc8',desc9='$desc9',desc10='$desc10',desc11='$desc11',desc12='$desc12',
        lpp1='$lpp1',lpp2='$lpp2',lpp3='$lpp3',lpp4='$lpp4',lpp5='$lpp5',lpp6='$lpp6',lpp7='$lpp7',lpp8='$lpp8',lpp9='$lpp9',lpp10='$lpp10',lpp11='$lpp11',lpp12='$lpp12',lpp_total='$lpp_total',
        cv_sup1='$cv1_sup',cv1_1='$cv1_1',cv1_2='$cv1_2',cv1_3='$cv1_3',cv1_4='$cv1_4',cv1_5='$cv1_5',cv1_6='$cv1_6',cv1_7='$cv1_7',cv1_8='$cv1_8',cv1_9='$cv1_9',cv1_10='$cv1_10',cv1_11='$cv1_11',cv1_12='$cv1_12',cv1_total='$cv1_total',
        cv_sup2='$cv2_sup',cv2_1='$cv2_1',cv2_2='$cv2_2',cv2_3='$cv2_3',cv2_4='$cv2_4',cv2_5='$cv2_5',cv2_6='$cv2_6',cv2_7='$cv2_7',cv2_8='$cv2_8',cv2_9='$cv2_9',cv2_10='$cv2_10',cv2_11='$cv2_11',cv2_12='$cv2_12',cv2_total='$cv2_total',
        cv_sup3='$cv3_sup',cv3_1='$cv3_1',cv3_2='$cv3_2',cv3_3='$cv3_3',cv3_4='$cv3_4',cv3_5='$cv3_5',cv3_6='$cv3_6',cv3_7='$cv3_7',cv3_8='$cv3_8',cv3_9='$cv3_9',cv3_10='$cv3_10',cv3_11='$cv3_11',cv3_12='$cv3_12',cv3_total='$cv3_total' where request_id='$prNumber'") or die(mysql_error())){


        mysql_query("UPDATE requests SET branch='$branch',canvasser='$canvasser',verified='$verified',approved='$approved',date='$date',date_needed='$date_needed',end_use='$end_use',justification='$justification',qty1='$qty1',qty2='$qty2',qty3='$qty3',qty4='$qty4',qty5='$qty5',qty6='$qty6',qty7='$qty7',qty8='$qty8',qty9='$qty9',qty10='$qty10',qty11='$qty11',qty12='$qty12',um1='$um1',um2='$um2',um3='$um3',um4='$um4',um5='$um5',um6='$um6',um7='$um7',um8='$um8',um9='$um9',um10='$um10',um11='$um11',um12='$um12',desc1='$desc1',desc2='$desc2',desc3='$desc3',desc4='$desc4',desc5='$desc5',desc6='$desc6',desc7='$desc7',desc8='$desc8',desc9='$desc9',desc10='$desc10',desc11='$desc11',desc12='$desc12',
        lpp1='$lpp1',lpp2='$lpp2',lpp3='$lpp3',lpp4='$lpp4',lpp5='$lpp5',lpp6='$lpp6',lpp7='$lpp7',lpp8='$lpp8',lpp9='$lpp9',lpp10='$lpp10',lpp11='$lpp11',lpp12='$lpp12',lpp_total='$lpp_total',
        cv_sup1='$cv1_sup',cv1_1='$cv1_1',cv1_2='$cv1_2',cv1_3='$cv1_3',cv1_4='$cv1_4',cv1_5='$cv1_5',cv1_6='$cv1_6',cv1_7='$cv1_7',cv1_8='$cv1_8',cv1_9='$cv1_9',cv1_10='$cv1_10',cv1_11='$cv1_11',cv1_12='$cv1_12',cv1_total='$cv1_total',
        cv_sup2='$cv2_sup',cv2_1='$cv2_1',cv2_2='$cv2_2',cv2_3='$cv2_3',cv2_4='$cv2_4',cv2_5='$cv2_5',cv2_6='$cv2_6',cv2_7='$cv2_7',cv2_8='$cv2_8',cv2_9='$cv2_9',cv2_10='$cv2_10',cv2_11='$cv2_11',cv2_12='$cv2_12',cv2_total='$cv2_total',
        cv_sup3='$cv3_sup',cv3_1='$cv3_1',cv3_2='$cv3_2',cv3_3='$cv3_3',cv3_4='$cv3_4',cv3_5='$cv3_5',cv3_6='$cv3_6',cv3_7='$cv3_7',cv3_8='$cv3_8',cv3_9='$cv3_9',cv3_10='$cv3_10',cv3_11='$cv3_11',cv3_12='$cv3_12',cv3_total='$cv3_total' where request_id='$prNumber'") or die(mysql_error());     

echo "<script>
alert('Updated successfully...');
window.location = 'forBHApproval.php';
</script>";
 }else{
     echo "<script>
alert('ERROR');
window.location = 'forBHApproval.php';
</script>";
 }

?>