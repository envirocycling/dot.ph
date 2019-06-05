<?php
session_start();
if(!isset ($_SESSION['username'])) {
    echo "<script> alert('Your session has expired.. Please login Again'); window.location('index.php')</script>";
}else {
    include('config.php');
    $supplier_id=$_POST['supplier_id'];
    $supplier_name=$_POST['supplier_name'];
    $classification=$_POST['classification'];
    $reason=$_POST['reason'];
    $branch=$_POST['branch'];
    $bh_in_charge=$_POST['bh_in_charge'];
    $address=$_POST['street']."/".$_POST['municipality']."/".$_POST['province'];
    $street = $_POST['street'];
    $municipality = $_POST['municipality'];
    $province = $_POST['province'];
    $owner=$_POST['owner'];
    $owner_contact=$_POST['owner_contact'];
    $representative=$_POST['representative'];
    $representative_contact=$_POST['representative_contact'];
    $no_of_trucks=$_POST['no_of_trucks'];
    $plate_numbers=$_POST['plate_numbers'];

    $no_of_wh=$_POST['no_of_wh'];
    $wh_address=$_POST['wh_address'];
    $payable_online=$_POST['payable_online'];
    $bank=$_POST['bank'];
    $acct_name=$_POST['acct_name'];
    $acct_no=$_POST['acct_no'];

    $wh_add1 = $_POST['wh_st1']."/".$_POST['wh_city1']."/".$_POST['wh_prov1'];
    $wh_add2 = $_POST['wh_st2']."/".$_POST['wh_city2']."/".$_POST['wh_prov2'];
    $wh_add3 = $_POST['wh_st3']."/".$_POST['wh_city3']."/".$_POST['wh_prov3'];
    $wh_add4 = $_POST['wh_st4']."/".$_POST['wh_city4']."/".$_POST['wh_prov4'];
    $wh_add5 = $_POST['wh_st5']."/".$_POST['wh_city5']."/".$_POST['wh_prov5'];

    $image = $_FILES['image']['tmp_name'];

    if(empty($image)) {
//        $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$supplier_id'");
//        $rs_sup = mysql_fetch_array($sql_sup);
////        if ($rs_sup['classification'] != $classification) {
////            if ($rs_sup['classification_history'] == '') {
////                $history = $rs_sup['classification']."_".$classification."|".date("Y/m/d");
////            } else {
////                $history = $rs_sup['classification_history']."_".$classification."|".date("Y/m/d");
////            }
////            mysql_query("UPDATE supplier_details SET supplier_name='$supplier_name',classification='$classification',classification_history='$history',branch='$branch',bh_in_charge='$bh_in_charge',address='$address',street='$street',municipality='$municipality',province='$province',owner='$owner',owner_contact='$owner_contact',representative_contact='$representative_contact',representative='$representative',no_of_trucks='$no_of_trucks',plate_number='$plate_numbers',no_of_warehouse='$no_of_wh',warehouse_address='$wh_address',payable_online='$payable_online',bank='$bank',acct_name='$acct_name',acct_no='$acct_no',warehouse_add1='$wh_add1',warehouse_add2='$wh_add2',warehouse_add3='$wh_add3',warehouse_add4='$wh_add4',warehouse_add5='$wh_add5',style='$classification' WHERE supplier_id='$supplier_id'");
////            echo "<script> alert('Updated Successfully...Kindly refresh the list once your done updating your records'); window.close();<script>";
////
////        } else {
        $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$supplier_id'");
        $rs_sup = mysql_fetch_array($sql_sup);
        if ($rs_sup['classification'] != $classification) {
            mysql_query("INSERT INTO sup_class_movement (`supplier_id`, `classification`, `reason`, `date`)
                VALUES ('$supplier_id','$classification','$reason','".date("Y/m/d")."')");
        }

        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'cb');
        foreach ($grades_array as $grade) {
            $ctr = 0;
            $capacity = $_POST[$grade.'_capacity'];
            $capacitydum = $_POST[$grade.'_capacitydum'];
            if ($capacitydum!=$capacity) {
                $date_effective = $_POST[$grade.'_date_effective'];
                mysql_query("INSERT INTO supplier_capacity (`supplier_id`, `wp_grade`, `capacity`, `updated_by`, `date_effective`, `date_updated`)
                    VALUES ('$supplier_id','$grade','$capacity','".$_SESSION['username']."','$date_effective','".date("Y/m/d")."')");
            }
            while ($ctr < 3) {
                $delivers_to = preg_split("[_]", $_POST[$grade . '_sup_' . $ctr]);
                if ($delivers_to[0] != "") {
                    $type = $_POST[$grade . '_type_' . $ctr];
                    $volume = $_POST[$grade . '_volume_' . $ctr];
                    if ($grade == 'cb') {
                        $grade = 'chipboard';
                    } else {
                        $gradeq = $grade;
                    }
                    $date = date("Y/m/d");
                    mysql_query("INSERT INTO supplier_assessment (
                                    `supplier_id`,
                                    `class`,
                                    `deliver_to`,
                                    `wp_grade`,
                                    `type`,
                                    `volume`,
                                    `date`)
                            VALUES ('$supplier_id',
                                    '$delivers_to[1]',
                                    '$delivers_to[0]',
                                    '$grade',
                                    '$type',
                                    '$volume',
                                    '$date')");
                }
                $ctr++;
            }
        }


        mysql_query("UPDATE supplier_details SET supplier_name='$supplier_name',classification='$classification',branch='$branch',bh_in_charge='$bh_in_charge',address='$address',street='$street',municipality='$municipality',province='$province',owner='$owner',owner_contact='$owner_contact',representative_contact='$representative_contact',representative='$representative',no_of_trucks='$no_of_trucks',plate_number='$plate_numbers',no_of_warehouse='$no_of_wh',warehouse_address='$wh_address',payable_online='$payable_online',bank='$bank',acct_name='$acct_name',acct_no='$acct_no',warehouse_add1='$wh_add1',warehouse_add2='$wh_add2',warehouse_add3='$wh_add3',warehouse_add4='$wh_add4',warehouse_add5='$wh_add5',style='$classification',date_updated='".date("Y/m/d")."',up='0',branch_update='' WHERE supplier_id='$supplier_id'");
// mysql_query("UPDATE sup_deliveries SET supplier_name='$supplier_name',supplier_type='$classification',bh_in_charge='$bh_in_charge' WHERE supplier_id='$supplier_id'");

        echo "<script> alert('Updated Successfully...Kindly refresh the list once your done updating your records'); window.close();</script>";

    } else {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $image_size = getimagesize($_FILES['image']['tmp_name']);
        $fsize = $_FILES["image"]["size"];
        if($image_size==False) {
            echo '<script type="text/javascript">
                alert("Thats not an image!");
                history.back();
                </script>';
        }
        else if($fsize < 1000) {
            echo '<script type="text/javascript">
                alert("The image file size exceeded the maximum limit!");
                history.back();
                </script>';
        }
        else {
//            $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$supplier_id'");
//            $rs_sup = mysql_fetch_array($sql_sup);
//            if ($rs_sup['classification'] != $classification) {
//                if ($rs_sup['classification_history'] == '') {
//                    $history = $rs_sup['classification']."_".$classification;
//                } else {
//                    $history = $rs_sup['classification_history']."_".$classification;
//                }
//                mysql_query("UPDATE supplier_details SET image='$image',supplier_name='$supplier_name',classification='$classification',classification_history='$history',branch='$branch',bh_in_charge='$bh_in_charge',address='$address',street='$street',municipality='$municipality',province='$province',owner='$owner',owner_contact='$owner_contact',representative_contact='$representative_contact',representative='$representative',no_of_trucks='$no_of_trucks',plate_number='$plate_numbers',no_of_warehouse='$no_of_wh',warehouse_address='$wh_address',payable_online='$payable_online',bank='$bank',acct_name='$acct_name',acct_no='$acct_no',warehouse_add1='$wh_add1',warehouse_add2='$wh_add2',warehouse_add3='$wh_add3',warehouse_add4='$wh_add4',warehouse_add5='$wh_add5',style='$classification' WHERE supplier_id='$supplier_id'");
//                // mysql_query("UPDATE sup_deliveries SET supplier_name='$supplier_name',supplier_type='$classification',bh_in_charge='$bh_in_charge' WHERE supplier_id='$supplier_id'");
//                echo "<script> alert('Updated Successfully...Kindly refresh the list once your done updating your records'); window.close();</script>";
//
//            } else {

            $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$supplier_id'");
            $rs_sup = mysql_fetch_array($sql_sup);
            if ($rs_sup['classification'] != $classification) {
                mysql_query("INSERT INTO sup_class_movement (`supplier_id`, `classification`, `date`)
                VALUES ('$supplier_id','$classification','".date("Y/m/d")."')");
            }

            $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'cb');
            foreach ($grades_array as $grade) {
                $ctr = 0;
                $capacity = $_POST[$grade.'_capacity'];
                if (!empty ($capacity)) {
                    $date_effective = $_POST[$grade.'_date_effective'];
                    mysql_query("INSERT INTO supplier_capacity (`supplier_id`, `wp_grade`, `capacity`, `updated_by`, `date_effective`, `date_updated`)
                    VALUES ('$supplier_id','$grade','$capacity','".$_SESSION['username']."','$date_effective','".date("Y/m/d")."')");
                }
                while ($ctr < 3) {
                    $delivers_to = preg_split("[_]", $_POST[$grade . '_sup_' . $ctr]);
                    if ($delivers_to[0] != "") {
                        $type = $_POST[$grade . '_type_' . $ctr];
                        $volume = $_POST[$grade . '_volume_' . $ctr];
                        if ($grade == 'cb') {
                            $grade = 'chipboard';
                        } else {
                            $gradeq = $grade;
                        }
                        $date = date("Y/m/d");
                        mysql_query("INSERT INTO supplier_assessment (
                                    `supplier_id`,
                                    `class`,
                                    `deliver_to`,
                                    `wp_grade`,
                                    `type`,
                                    `volume`,
                                    `date`)
                            VALUES ('$supplier_id',
                                    '$delivers_to[1]',
                                    '$delivers_to[0]',
                                    '$grade',
                                    '$type',
                                    '$volume',
                                    '$date')");
                    }
                    $ctr++;
                }
            }

            mysql_query("UPDATE supplier_details SET image='$image',supplier_name='$supplier_name',classification='$classification',branch='$branch',bh_in_charge='$bh_in_charge',address='$address',street='$street',municipality='$municipality',province='$province',owner='$owner',owner_contact='$owner_contact',representative_contact='$representative_contact',representative='$representative',no_of_trucks='$no_of_trucks',plate_number='$plate_numbers',no_of_warehouse='$no_of_wh',warehouse_address='$wh_address',payable_online='$payable_online',bank='$bank',acct_name='$acct_name',acct_no='$acct_no',warehouse_add1='$wh_add1',warehouse_add2='$wh_add2',warehouse_add3='$wh_add3',warehouse_add4='$wh_add4',warehouse_add5='$wh_add5',style='$classification',up='0' WHERE supplier_id='$supplier_id'");
            // mysql_query("UPDATE sup_deliveries SET supplier_name='$supplier_name',supplier_type='$classification',bh_in_charge='$bh_in_charge' WHERE supplier_id='$supplier_id'");
            echo "<script> alert('Updated Successfully...Kindly refresh the list once your done updating your records'); window.close();</script>";

//            }
        }

    }






}



?>	