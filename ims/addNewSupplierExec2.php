<?php

session_start();

if (!isset($_SESSION['username'])) {

    echo "<script> alert('Your session has expired.. Please login Again'); window.location('index.php')</script>";

} else {

    include('config.php');

    $checker = 0;

    $result = mysql_query("SELECT * FROM supplier_details  order by supplier_id desc limit 1");

    $row = mysql_fetch_array($result);

    $supplier_id = $row['supplier_id']+1;

//    $supplier_id = $_POST['supplier_id'];

//    $result = mysql_query("SELECT * FROM supplier_details where supplier_id='$supplier_id'");

//    if ($row = mysql_fetch_array($result)) {

//        echo "<script> alert('Sorry.. This ID is already been assigned by another user.. System will redirect you back to the form and assign another ID number.. Thank you...'); window.location='formAddNewSupplier.php';";

//    } else {



    $supplier_name = $_POST['supplier_name'];

    $classification = $_POST['classification'];

    $branch = $_POST['branch'];

    $bh_in_charge = $_POST['bh_in_charge'];

    $bh_to_verified = $_POST['bh_to_verified'];

    $restrained = $_POST['restrained'];

    $address = $_POST['street'] . "/" . $_POST['municipality'] . "/" . $_POST['province'];

    $street = $_POST['street'];

    $municipality = $_POST['municipality'];

    $province = $_POST['province'];

    $owner = $_POST['owner'];

    $owner_contact = $_POST['owner_contact'];

    $representative = $_POST['representative'];

    $representative_contact = $_POST['representative_contact'];

    $no_of_trucks = $_POST['no_of_trucks'];

    $plate_numbers = $_POST['plate_numbers'];
	$group_island = $_POST['group_island'];



    $no_of_wh = $_POST['no_of_wh'];

    $wh_address = $_POST['wh_address'];

    $payable_online = $_POST['payable_online'];

    $bank = $_POST['bank'];

    $acct_name = $_POST['acct_name'];

    $acct_no = $_POST['acct_no'];



    $wh_add1 = $_POST['wh_st1'] . "/" . $_POST['wh_city1'] . "/" . $_POST['wh_prov1'];

    $wh_add2 = $_POST['wh_st2'] . "/" . $_POST['wh_city2'] . "/" . $_POST['wh_prov2'];

    $wh_add3 = $_POST['wh_st3'] . "/" . $_POST['wh_city3'] . "/" . $_POST['wh_prov3'];

    $wh_add4 = $_POST['wh_st4'] . "/" . $_POST['wh_city4'] . "/" . $_POST['wh_prov4'];

    $wh_add5 = $_POST['wh_st5'] . "/" . $_POST['wh_city5'] . "/" . $_POST['wh_prov5'];



    $date = date("Y/m/d");

    $month = date("F", strtotime($date));

    $day = date("d", strtotime($date));

    $year = date("Y", strtotime($date));



    $image = $_FILES['image']['tmp_name'];



    if (empty($image)) {

        mysql_query("INSERT INTO supplier_details (supplier_id,supplier_name,classification,branch,bh_in_charge,bh_to_verified,restrained,address,street,municipality,province,owner,owner_contact,representative,representative_contact,no_of_trucks,plate_number,no_of_warehouse,warehouse_address,payable_online,bank,acct_name,acct_no,date_added,month_added,day_added,year_added,style,warehouse_add1,warehouse_add2,warehouse_add3,warehouse_add4,warehouse_add5,group_island)

                                            VALUES('$supplier_id','$supplier_name','$classification','$branch','$bh_in_charge','$bh_to_verified','$restrained','$address','$street','$municipality','$province','$owner','$owner_contact','$representative','$representative_contact','$no_of_trucks','$plate_numbers','$no_of_wh','$wh_address','$payable_online','$bank','$acct_name','$acct_no','$date','$month','$day','$year','$classification','$wh_add1','$wh_add2','$wh_add3','$wh_add4','$wh_add5','$group_island')");



        mysql_query("INSERT INTO sup_class_movement (`supplier_id`, `classification`, `reason`, `date`)

                VALUES ('$supplier_id','$classification','start_class','".date("Y/m/d")."')");



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

                    $price = $_POST[$grade . '_price_' . $ctr];

                    $volume = $_POST[$grade . '_volume_' . $ctr];

                    if ($grade == 'cb') {

                        $gradeq = 'chipboard';

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
                            
                                    `price`,

                                    `volume`,

                                    `date`)

                            VALUES ('$supplier_id',

                                    '$delivers_to[1]',

                                    '$delivers_to[0]',

                                    '$gradeq',

                                    '$type',

                                    '$price',

                                    '$volume',

                                    '$date')");

                }

                $ctr++;

            }

        }



        echo "<script> alert('Added Successfully...'); window.location='AddNewSupplierSuccess.php?sup_id=$supplier_id';</script>";

    } else {

        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

        $image_size = getimagesize($_FILES['image']['tmp_name']);

        $fsize = $_FILES["image"]["size"];

        if ($image_size == False) {

            echo '<script type="text/javascript">

                alert("Thats not an image!");

                history.back();

                </script>';

        } else if ($fsize < 1000) {

            echo '<script type="text/javascript">

                alert("The image file size exceeded the maximum limit!");

                history.back();

                </script>';

        } else {

            mysql_query("INSERT INTO supplier_details (supplier_id,image,supplier_name,classification,branch,bh_in_charge,bh_to_verified,restrained,address,street,municipality,province,owner,owner_contact,representative,representative_contact,no_of_trucks,plate_number,no_of_warehouse,warehouse_address,payable_online,bank,acct_name,acct_no,date_added,month_added,day_added,year_added,style,warehouse_add1,warehouse_add2,warehouse_add3,warehouse_add4,warehouse_add5)

                                            VALUES('$supplier_id','$image','$supplier_name','$classification','$branch','$bh_in_charge','$bh_to_verified','$restrained','$address','$street','$municipality','$province','$owner','$owner_contact','$representative','$representative_contact','$no_of_trucks','$plate_numbers','$no_of_wh','$wh_address','$payable_online','$bank','$acct_name','$acct_no','$date','$month','$day','$year','$classification','$wh_add1','$wh_add2','$wh_add3','$wh_add4','$wh_add5')");





            mysql_query("INSERT INTO sup_class_movement (`supplier_id`, `classification`, `date`)

                VALUES ('$supplier_id','$classification','".date("Y/m/d")."')");



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

            echo "<script> alert('Added Successfully...'); window.location='AddNewSupplierSuccess.php?sup_id=$supplier_id';</script>";

        }

    }

//    }

    $query = "SELECT supplier_id,supplier_name FROM supplier_details group by supplier_id  ";

    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result)) {

        array_push($_SESSION['supplier_names_array'], $row['supplier_id'] . "+" . $row['supplier_name']);

    }

}

?>