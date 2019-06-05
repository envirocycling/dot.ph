<?php

ini_set('max_execution_time', 1000000);
include 'config.php';

echo "<div align='center'>";
echo "<br><br><br>";
echo "<font color='Blue' size='30'>Saving Data to IMS</font>";
echo "<br>";
echo "<font color='Blue' size='30'>Please Wait</font>";
echo "<br>";
echo "<img src='images/ajax-loader.gif'>";
echo "</div>";

$from = $_POST['from'];
$to = $_POST['to'];
$branch = $_POST['branch'];

mysql_query("DELETE FROM sup_deliveries WHERE date_delivered>='$from' and date_delivered<='$to' and branch_delivered='$branch'");

$c = $_POST['ctr'];
$failed_to_insert = 0;
$ctr = 0;
$counter = 0;
while ($ctr < $c) {
    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='" . $_POST['supplier_id' . $ctr] . "'");
    $rs_sup = mysql_fetch_array($sql_sup);
    $supplier_id = $_POST['supplier_id' . $ctr];
    $supplier_name = $rs_sup['supplier_name'];
    $classification = $rs_sup['classification'];
    $bh_ic_charge = $rs_sup['bh_in_charge'];
    $priority_no = $_POST['priority_no' . $ctr];
    $wp_grade = $_POST['wp_grade' . $ctr];

    if ($wp_grade == 'HM.M.WASTE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'HM.MW') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'M.WASTE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'MW.PLAYING CARDS') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CORETUBE M.WASTE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CARDS') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'MW-PPQ') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CT') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'HM.OCC') {
        $wp_grade = 'OCC';
    }
    if ($wp_grade == 'CB') {
        $wp_grade = 'CHIPBOARD';
    }
    if ($wp_grade == 'STICKIES LCWL') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL PADJ') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL STICKIES') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'GUMS LCWL') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL FLEXO' || $wp_grade == 'LCWL Flexo') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL BOOKS') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'ONP BOOKS') {
        $wp_grade = 'ONP ';
    }
    if ($wp_grade == 'GUMS ONP') {
        $wp_grade = 'ONP';
    }
    if ($wp_grade == 'STICKIES ONP') {
        $wp_grade = 'ONP';
    }
    if ($wp_grade == 'BOOKS ONP') {
        $wp_grade = 'ONP';
    }
    if ($wp_grade == 'CBS W/ GUMS') {
        $wp_grade = 'CBS';
    }
    if ($wp_grade == 'CORETUBE') {
        $wp_grade = 'MW';
    }

    $weight = $_POST['weight' . $ctr];
    $date = $_POST['date' . $ctr];
    $month_delivered = date("F", strtotime($date));
    $day_delivered = date("d", strtotime($date));
    $year_delivered = date("Y", strtotime($date));

    $priority_number = $_POST['priority_no' . $ctr];
    $weight_adj = $_POST['weight_adj' . $ctr];
    $mc_percentage = $_POST['mc_percentage' . $ctr];

    $remarks = '';
    $mc_percentage = '';
    $mc_weight = '';

//    if ($weight_adj  == 'moisture') {
//        if ($branch == 'Kaybiga') {
//            if ($mc_percentage > 10) {
//                $remarks = 'High Moisture';
//                $mc_percentage=$mc_percentage-10;
//                $mc_weight=($weight*($mc_percentage/100));
//                $weight=($weight-($weight*($mc_percentage/100)));
//
//            } else {
//                $remarks = '';
//                $mc_percentage = '';
//                $mc_weight = '';
//            }
//        } else if($branch == 'Sauyo') {
//            if ($mc_percentage > 8) {
//                $remarks = 'High Moisture';
//                $mc_percentage=$mc_percentage-8;
//                $mc_weight=($weight*($mc_percentage/100));
//                $weight=($weight-($weight*($mc_percentage/100)));
//
//            } else {
//                $remarks = '';
//                $mc_percentage = '';
//                $mc_weight = '';
//            }
//        } else if($branch == 'Mangaldan') {
//            if ($mc_percentage > 8) {
//                $remarks = 'High Moisture';
//                $mc_percentage=$mc_percentage-8;
//                $mc_weight=($weight*($mc_percentage/100));
//                $weight=($weight-($weight*($mc_percentage/100)));
//
//            } else {
//                $remarks = '';
//                $mc_percentage = '';
//                $mc_weight = '';
//            }
//        } else {
//            $remarks = '';
//            $mc_percentage = '';
//            $mc_weight = '';
//        }
//    } else {
//        $remarks = '';
//        $mc_percentage = '';
//        $mc_weight = '';
//    }

    if ($wp_grade != 'OTHERS') {
        $plate_number = $_POST['plate_number' . $ctr];
        $ic_in_charge = $_POST['encoder' . $ctr];
        $sic_in_charge = $_POST['shift_in_charge' . $ctr];
        if ($weight >= 0) {
            if (mysql_query("INSERT INTO sup_deliveries (supplier_id,
        supplier_name,
        supplier_type,
        bh_in_charge,
        wp_grade,
        weight,
        branch_delivered,
        date_delivered,
        month_delivered,
        day_delivered,
        year_delivered,
        encoder,
        shift_in_charge,
        priority_number,
        mc_percentage,
        mc_weight,
        remarks,
        plate_number)
            VALUES('$supplier_id',
            '$supplier_name',
            '$classification',
            '$bh_ic_charge',
            '$wp_grade',
            '$weight',
            '$branch',
            '$date',
            '$month_delivered',
            '$day_delivered',
            '$year_delivered',
            '$ic_in_charge',
            '$sic_in_charge',
            '$priority_no',
            '$mc_percentage',
            '$mc_weight',
            '$remarks',
            '$plate_number')")) {

                $counter++;
            } else {
                $failed_to_insert++;
?>
<script>
alsert("error");
</script>
<?php
            }
            
        }
    }
	$ctr++;
}
echo "<script>";
echo "alert('$counter records has been inserted successfully...');";
echo "alert('$failed_to_insert records failed to insert...');";
echo "window.history.back();";
echo "</script>";
?>
