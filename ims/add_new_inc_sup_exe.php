<?php

include('config.php');

$sup_id = $_POST['supplier_id'];
$scheme = $_POST['start_date'] . "-" . $_POST['end_date'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$quota = $_POST['quota'];
$base_price = $_POST['base_price'];
$incentive = $_POST['incentive'];
$covered_incentive = $_POST['covered_incentive'];
$wp_grade = $_POST['wp_grade'];
$type = $_POST['type'];

if($wp_grade == 'all_without_lcwl'){
    $query2 = "SELECT sum(weight) FROM sup_deliveries where supplier_id='" . $sup_id . "'and wp_grade NOT LIKE '%LCWL%' and date_delivered between '" . $start_date . "' and '" . $end_date . "' group by wp_grade";
}else if($wp_grade == 'all_without_occ'){
    $query2 = "SELECT sum(weight) FROM sup_deliveries where supplier_id='" . $sup_id . "'and wp_grade NOT LIKE '%OCC%' and date_delivered between '" . $start_date . "' and '" . $end_date . "' group by wp_grade";
}else{
    $query2 = "SELECT sum(weight) FROM sup_deliveries where supplier_id='" . $sup_id . "'and wp_grade='" . $wp_grade . "' and date_delivered between '" . $start_date . "' and '" . $end_date . "' group by wp_grade";
}
$result2 = mysql_query($query2);
$row2 = mysql_fetch_array($result2);
$current_deliveries = $row2['sum(weight)'];

if ($wp_grade == 'all_grades') {
    $filter_grade = '';
} else {
    $filter_grade = $wp_grade;
}
$wp_array = array();
if($wp_grade == 'all_without_lcwl'){
$sql_wp = mysql_query("SELECT * FROM paper_buying WHERE supplier_id='$sup_id' and wp_grade NOT like '%LCWL%' and date_received<='" . date("Y/m/d") . "'  and branch!='' and paper_buying > 0  GROUP BY wp_grade");
}else{
$sql_wp = mysql_query("SELECT * FROM paper_buying WHERE supplier_id='$sup_id' and wp_grade like '%$filter_grade%' and date_received<='" . date("Y/m/d") . "'  and branch!='' and paper_buying > 0  GROUP BY wp_grade");
}
while ($rs_wp = mysql_fetch_array($sql_wp)) {
    array_push($wp_array, $rs_wp['wp_grade']);
}

$wp_prices = '';
$count = count($wp_array);
$ctr = 1;
foreach ($wp_array as $wp) {
    if($wp_grade == 'all_without_lcwl'){
    $sql_prices = mysql_query("SELECT * FROM paper_buying WHERE supplier_id='$sup_id' and wp_grade NOT LIKE '%LCWL%' and date_received<='" . date("Y/m/d") . "'  and branch!='' and paper_buying > 0 ORDER BY date_received DESC");
    }else{
    $sql_prices = mysql_query("SELECT * FROM paper_buying WHERE supplier_id='$sup_id' and wp_grade='$wp' and date_received<='" . date("Y/m/d") . "'  and branch!='' and paper_buying > 0  ORDER BY date_received DESC");
    }
    $rs_prices = mysql_fetch_array($sql_prices);
    if ($wp_prices == '') {
        if ($count == $ctr) {
            $wp_prices.=$wp . ':' . $rs_prices['unit_cost'];
        } else {
            $wp_prices.=$wp . ':' . $rs_prices['unit_cost'] . '&nbsp;&nbsp;|';
        }
    } else if ($count == $ctr) {
        $wp_prices.='&nbsp;&nbsp;' . $wp . ':' . $rs_prices['unit_cost'];
    } else {
        $wp_prices.='&nbsp;&nbsp;' . $wp . ':' . $rs_prices['unit_cost'] . '&nbsp;&nbsp;|';
    }
    $ctr++;
}

mysql_query("INSERT INTO incentive_scheme(sup_id,scheme,start_date,end_date,quota,current_deliveries,base_price,incentive,covered_incentive,wp_grade,wp_prices,type)
                         VALUES('$sup_id','$scheme','$start_date','$end_date','$quota','$current_deliveries','$base_price','$incentive','$covered_incentive','$wp_grade','$wp_prices','$type')

        ");

header("Location:inc_deliveries.php");
?>