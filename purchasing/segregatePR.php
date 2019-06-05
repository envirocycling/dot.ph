<?php

$branch = $_POST['branch'];
$canvasser = $_POST['canvasser'];
$verified = $_POST['verified'];
$approved = $_POST['approved'];
$date = $_POST['date'];
$date_needed = $_POST['date_needed'];
$end_use = $_POST['end_use'];
$justification = $_POST['justification'];
$qty1 = $_POST['qty1'];
$qty2 = $_POST['qty2'];
$qty3 = $_POST['qty3'];
$qty4 = $_POST['qty4'];
$qty5 = $_POST['qty5'];
$qty6 = $_POST['qty6'];
$qty7 = $_POST['qty7'];
$qty8 = $_POST['qty8'];
$qty9 = $_POST['qty9'];
$qty10 = $_POST['qty10'];
$qty11 = $_POST['qty11'];
$qty12 = $_POST['qty12'];

$um1 = $_POST['um1'];
$um2 = $_POST['um2'];
$um3 = $_POST['um3'];
$um4 = $_POST['um4'];
$um5 = $_POST['um5'];
$um6 = $_POST['um6'];
$um7 = $_POST['um7'];
$um8 = $_POST['um8'];
$um9 = $_POST['um9'];
$um10 = $_POST['um10'];
$um11 = $_POST['um11'];
$um12 = $_POST['um12'];


$desc1 = $_POST['desc1'];
$desc2 = $_POST['desc2'];
$desc3 = $_POST['desc3'];
$desc4 = $_POST['desc4'];
$desc5 = $_POST['desc5'];
$desc6 = $_POST['desc6'];
$desc7 = $_POST['desc7'];
$desc8 = $_POST['desc8'];
$desc9 = $_POST['desc9'];
$desc10 = $_POST['desc10'];
$desc11 = $_POST['desc11'];
$desc12 = $_POST['desc12'];

$lpp1 = $_POST['lpp1'];
$lpp2 = $_POST['lpp2'];
$lpp3 = $_POST['lpp3'];
$lpp4 = $_POST['lpp4'];
$lpp5 = $_POST['lpp5'];
$lpp6 = $_POST['lpp6'];
$lpp7 = $_POST['lpp7'];
$lpp8 = $_POST['lpp8'];
$lpp9 = $_POST['lpp9'];
$lpp10 = $_POST['lpp10'];
$lpp11 = $_POST['lpp11'];
$lpp12 = $_POST['lpp12'];

$cv1_sup = $_POST['cvt1'];
$cv1_1 = $_POST['cv1_1'];
$cv1_2 = $_POST['cv1_2'];
$cv1_3 = $_POST['cv1_3'];
$cv1_4 = $_POST['cv1_4'];
$cv1_5 = $_POST['cv1_5'];
$cv1_6 = $_POST['cv1_6'];
$cv1_7 = $_POST['cv1_7'];
$cv1_8 = $_POST['cv1_8'];
$cv1_9 = $_POST['cv1_9'];
$cv1_10 = $_POST['cv1_10'];
$cv1_11 = $_POST['cv1_11'];
$cv1_12 = $_POST['cv1_12'];

$cv2_sup = $_POST['cvt2'];
$cv2_1 = $_POST['cv2_1'];
$cv2_2 = $_POST['cv2_2'];
$cv2_3 = $_POST['cv2_3'];
$cv2_4 = $_POST['cv2_4'];
$cv2_5 = $_POST['cv2_5'];
$cv2_6 = $_POST['cv2_6'];
$cv2_7 = $_POST['cv2_7'];
$cv2_8 = $_POST['cv2_8'];
$cv2_9 = $_POST['cv2_9'];
$cv2_10 = $_POST['cv2_10'];
$cv2_11 = $_POST['cv2_11'];
$cv2_12 = $_POST['cv2_12'];

$cv3_sup = $_POST['cvt3'];
$cv3_1 = $_POST['cv3_1'];
$cv3_2 = $_POST['cv3_2'];
$cv3_3 = $_POST['cv3_3'];
$cv3_4 = $_POST['cv3_4'];
$cv3_5 = $_POST['cv3_5'];
$cv3_6 = $_POST['cv3_6'];
$cv3_7 = $_POST['cv3_7'];
$cv3_8 = $_POST['cv3_8'];
$cv3_9 = $_POST['cv3_9'];
$cv3_10 = $_POST['cv3_10'];
$cv3_11 = $_POST['cv3_11'];
$cv3_12 = $_POST['cv3_12'];
$lpp_total = $_POST['totalLPP'];
$cv1_total = $_POST['total1'];
$cv2_total = $_POST['total2'];
$cv3_total = $_POST['total3'];

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

$type = $_POST['type'];
$status = '';
include('config.php');
@$file = $_FILES['quotation']['tmp_name'];
@$image = addslashes(file_get_contents($_FILES['quotation']['tmp_name']));
@$image_name = addslashes($_FILES['quotation']['name']);
@$image_size = getimagesize($_FILES['quotation']['tmp_name']);
move_uploaded_file($_FILES["quotation"]["tmp_name"], "quotations/" . $_FILES["quotation"]["name"]);
@$quotation_directory = "quotations/" . $_FILES["quotation"]["name"];

@$branch_to_canvass = $_POST['branch_will_canvass'];

if($type != 'heavy_vehicles') {

	if($type == 'electric_equipment') {
    	$mecha_sig = '';
    }else{ 
        $mecha_sig = 'RB' ;
    }

}else if($type != 'electric_equipment') {

	if($type == 'heavy_vehicles') {
        $mecha_sig = '';
        $status = 'for mechanic';
    }else { 
        $mecha_sig = 'RFE' ;
    }
}

		
if ($type != 'unclassified') {
    if ($canvasser == 'EFI HR') {
        if (mysql_query("INSERT INTO requests(branch,canvasser,verified,approved,date,date_needed,end_use,justification,qty1,qty2,qty3,qty4,qty5,qty6,qty7,qty8,qty9,qty10,qty11,qty12,um1,um2,um3,um4,um5,um6,um7,um8,um9,um10,um11,um12,desc1,desc2,desc3,desc4,desc5,desc6,desc7,desc8,desc9,desc10,desc11,desc12,lpp1,lpp2,lpp3,lpp4,lpp5,lpp6,lpp7,lpp8,lpp9,lpp10,lpp11,lpp12,lpp_total,cv_sup1,cv1_1,cv1_2,cv1_3,cv1_4,cv1_5,cv1_6,cv1_7,cv1_8,cv1_9,cv1_10,cv1_11,cv1_12,cv1_total,cv_sup2,cv2_1,cv2_2,cv2_3,cv2_4,cv2_5,cv2_6,cv2_7,cv2_8,cv2_9,cv2_10,cv2_11,cv2_12,cv2_total,cv_sup3,cv3_1,cv3_2,cv3_3,cv3_4,cv3_5,cv3_6,cv3_7,cv3_8,cv3_9,cv3_10,cv3_11,cv3_12,cv3_total,type,quotation,mecha_signature,branch_to_canvass,cost_1,cost_2,cost_3,cost_4,cost_5,cost_6,cost_7,cost_8,cost_9,cost_10,cost_11,cost_12,total_cost,status,date_verified,verified_signature, new)
                                   values('$branch','$canvasser','$verified','$approved','$date','$date_needed','$end_use','$justification','$qty1','$qty2','$qty3','$qty4','$qty5','$qty6','$qty7','$qty8','$qty9','$qty10','$qty11','$qty12','$um1','$um2','$um3','$um4','$um5','$um6','$um7','$um8','$um9','$um10','$um11','$um12','$desc1','$desc2','$desc3','$desc4','$desc5','$desc6','$desc7','$desc8','$desc9','$desc10','$desc11','$desc12'
                                            ,'$lpp1','$lpp2','$lpp3','$lpp4','$lpp5','$lpp6','$lpp7','$lpp8','$lpp9','$lpp10','$lpp11','$lpp12','$lpp_total'
                                            ,'$cv1_sup','$cv1_1','$cv1_2','$cv1_3','$cv1_4','$cv1_5','$cv1_6','$cv1_7','$cv1_8','$cv1_9','$cv1_10','$cv1_11','$cv1_12','$cv1_total'
                                            ,'$cv2_sup','$cv2_1','$cv2_2','$cv2_3','$cv2_4','$cv2_5','$cv2_6','$cv2_7','$cv2_8','$cv2_9','$cv2_10','$cv2_11','$cv2_12','$cv2_total'
                                            ,'$cv3_sup','$cv3_1','$cv3_2','$cv3_3','$cv3_4','$cv3_5','$cv3_6','$cv3_7','$cv3_8','$cv3_9','$cv3_10','$cv3_11','$cv3_12','$cv3_total','$type','$quotation_directory','$mecha_sig','$branch_to_canvass'
                                            ,'$cost_1','$cost_2','$cost_3','$cost_4','$cost_5','$cost_6','$cost_7','$cost_8','$cost_9','$cost_10','$cost_11','$cost_12','$total_cost','pending','".date("Y/m/d h:i s")."','$verified','1')")) {
            echo "<script>
            alert('Submitted successfully...');
            window.location = 'prRequests.php';
            </script>";
        } else {
            echo "<script>
            alert('Failed to Submit PR...');
            window.history.back();
            </script>";
        }
    } else {
//        $sql_signatory = mysql_query("SELECT * from pr_signatory WHERE pr_type='$type'") or die(mysql_error());
//        if(mysql_num_rows($sql_signatory) == 0){
//            $approved = $approved;
//        }else{
//            $row_signatory = mysql_fetch_array($sql_signatory);
//            $sql_user = mysql_query("SELECT * from users WHERE user_id='".$row_signatory['user_id']."'") or die(mysql_error());
//            $row_user = mysql_fetch_array($sql_signatory);
//            $approved = $row_user['name'];
//            
//        }
        
        if (mysql_query("INSERT INTO requests(branch,canvasser,verified,approved,date,date_needed,end_use,justification,qty1,qty2,qty3,qty4,qty5,qty6,qty7,qty8,qty9,qty10,qty11,qty12,um1,um2,um3,um4,um5,um6,um7,um8,um9,um10,um11,um12,desc1,desc2,desc3,desc4,desc5,desc6,desc7,desc8,desc9,desc10,desc11,desc12,lpp1,lpp2,lpp3,lpp4,lpp5,lpp6,lpp7,lpp8,lpp9,lpp10,lpp11,lpp12,lpp_total,cv_sup1,cv1_1,cv1_2,cv1_3,cv1_4,cv1_5,cv1_6,cv1_7,cv1_8,cv1_9,cv1_10,cv1_11,cv1_12,cv1_total,cv_sup2,cv2_1,cv2_2,cv2_3,cv2_4,cv2_5,cv2_6,cv2_7,cv2_8,cv2_9,cv2_10,cv2_11,cv2_12,cv2_total,cv_sup3,cv3_1,cv3_2,cv3_3,cv3_4,cv3_5,cv3_6,cv3_7,cv3_8,cv3_9,cv3_10,cv3_11,cv3_12,cv3_total,status,type,quotation,mecha_signature,branch_to_canvass,cost_1,cost_2,cost_3,cost_4,cost_5,cost_6,cost_7,cost_8,cost_9,cost_10,cost_11,cost_12,total_cost, new)
                                   values('$branch','$canvasser','$verified','$approved','$date','$date_needed','$end_use','$justification','$qty1','$qty2','$qty3','$qty4','$qty5','$qty6','$qty7','$qty8','$qty9','$qty10','$qty11','$qty12','$um1','$um2','$um3','$um4','$um5','$um6','$um7','$um8','$um9','$um10','$um11','$um12','$desc1','$desc2','$desc3','$desc4','$desc5','$desc6','$desc7','$desc8','$desc9','$desc10','$desc11','$desc12'
                                            ,'$lpp1','$lpp2','$lpp3','$lpp4','$lpp5','$lpp6','$lpp7','$lpp8','$lpp9','$lpp10','$lpp11','$lpp12','$lpp_total'
                                            ,'$cv1_sup','$cv1_1','$cv1_2','$cv1_3','$cv1_4','$cv1_5','$cv1_6','$cv1_7','$cv1_8','$cv1_9','$cv1_10','$cv1_11','$cv1_12','$cv1_total'
                                            ,'$cv2_sup','$cv2_1','$cv2_2','$cv2_3','$cv2_4','$cv2_5','$cv2_6','$cv2_7','$cv2_8','$cv2_9','$cv2_10','$cv2_11','$cv2_12','$cv2_total'
                                            ,'$cv3_sup','$cv3_1','$cv3_2','$cv3_3','$cv3_4','$cv3_5','$cv3_6','$cv3_7','$cv3_8','$cv3_9','$cv3_10','$cv3_11','$cv3_12','$cv3_total','$status','$type','$quotation_directory','$mecha_sig','$branch_to_canvass'
                                            ,'$cost_1','$cost_2','$cost_3','$cost_4','$cost_5','$cost_6','$cost_7','$cost_8','$cost_9','$cost_10','$cost_11','$cost_12','$total_cost','1')")) {
            echo "<script>
            alert('Submitted successfully...');
            window.location = 'prRequests.php';
            </script>";
        } else {
            echo "<script>
            alert('Failed to Submit PR...');
            window.history.back();
            </script>";
        }
    }
} else {
    echo "<script>
        alert('Please select PR Type...');
        window.history.back();
        </script>";
}
?>