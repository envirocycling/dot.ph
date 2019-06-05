<?php
@session_start();
include("config.php");
ini_set('max_execution_time', 1000);
//include("templates/template.php");
?>
<script type='text/javascript' src='js/TableLock.js'></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script>
    $(window).load(function () {
        $(".editbox").hide();
        var count = $("#count").val();
        var c = 0;
        while (c < count){
            var val = $("#dum_total_"+c).val();
            $("#total_"+c).html(val);
            c++;
        }
    });
    function txt(str){
        $("#addl_price_value_" + str).hide(500);
        $("#addl_price_edit_" + str).show(500);
        $("#expctd_vol_value_" + str).hide(500);
        $("#expctd_vol_edit_" + str).show(500);
        $("#addtl_vol_value_" + str).hide(500);
        $("#addtl_vol_edit_" + str).show(500);
    }

    function remarks (str){
        $("#remarks_value_" + str).hide(500);
        $("#remarks_edit_" + str).show(500);
    }

    function save (str) {
        var splits = str.split("_");
        var id = splits[0]+'_'+splits[1];
        var supplier_id = splits[0];
        var date = splits[2];
        var wp_grade = splits[3];
        $("#addl_price_edit_" + id).hide(500);
        $("#addl_price_value_" + id).show(500);
        $("#expctd_vol_edit_" + id).hide(500);
        $("#expctd_vol_value_" + id).show(500);
        $("#addtl_vol_edit_" + id).hide(500);
        $("#addtl_vol_value_" + id).show(500);

        var addtl_price = $("#addtl_price_" + id).val();
        var expctd_vol = $("#expctd_vol_" + id).val();
        var addtl_vol = $("#addtl_vol_" + id).val();

        $("#addl_price_value_" + id).html(addtl_price);
        $("#expctd_vol_value_" + id).html(expctd_vol);
        $("#addtl_vol_value_" + id).html(addtl_vol);

        if (addtl_price != '' || expctd_vol != '' || addtl_vol!=''){
            alert('Successfully Save');
            var dataString = 'supplier_id=' + supplier_id + '&date=' + date + '&addtl_price=' + addtl_price + '&expctd_vol=' + expctd_vol +'&addtl_vol='+addtl_vol +'&wp_grade='+wp_grade;
            $.ajax({
                type: "POST",
                url: "save_sup_buying_price.php",
                data: dataString,
                cache: false
            });
        }
    }

    function save2(str){
        var splits = str.split("_");
        var supplier_id = splits[0];
        var wp_grade = splits[1];
        var remarks = $("#remarks_" + supplier_id).val();

        $("#remedit_" + supplier_id).html(remarks);

        $("#remarks_edit_" + supplier_id).hide(500);
        $("#remarks_value_" + supplier_id).show(500);

        if (remarks != ''){
            alert('Successfully Save');

            var dataString = 'supplier_id='+supplier_id+'&remarks=' + remarks + '&wp_grade='+wp_grade;
            $.ajax({
                type: "POST",
                url: "save_sup_buying_price_remarks.php",
                data: dataString,
                cache: false
            });

        }
    }
</script>
<body onload='TableLock("mytable_t1", "rowclass_t1", "colclass_t1", "lockclass_t1");
    /* TableLock("mytable_t2", "rowclass_t2", "colclass_t2", "lockclass_t2"); */
      '>
<style>
    body{
        font-family: Arial;
    }
    .lockclass_t1{
        font-weight: bold;
    }
    .colclass_t1{
        font-weight: bold;
    }
    #bold {
        font-weight: bold;
    }
    .marketing{
        width: 45px
    }
    .remarks{
        width: 200px
    }
    td{
        text-align: right;
        vertical-align: top;
    }
</style>
<?php
$ngayon=date('F d, Y');
$start_date=$_POST['start_date'];
$breaker_date=$_POST['end_date'];
$start_week=$_POST['start_week'];

$last_month = date('Y/m/d', strtotime("-1 month", strtotime($breaker_date)));
$last_month_last_day = date('Y/m/t', strtotime($last_month));

$end_week = date('Y/m/d', strtotime("+27 days", strtotime($start_week)));

$prev_start_week = date('Y/m/d', strtotime("-28 days", strtotime($start_week)));
$prev_end_week = date('Y/m/d', strtotime("+27 days", strtotime($prev_start_week)));

$last_6month = date('Y/m/d', strtotime("-6 months", strtotime($breaker_date)));
$last_6month_1st_day = date('Y/m', strtotime($last_6month));
$last_6month_1st_day = $last_6month_1st_day."/01";


$current_month_last_day_day = date('t', strtotime($breaker_date));
$current_month_current_day_day = date('d', strtotime($breaker_date));
$day_percentage = $current_month_current_day_day / $current_month_last_day_day;

$filtering_grade=$_POST['wp_grade'];
$filtering_branch=$_POST['branch'];
$breaker_month = date("Y/m", strtotime($breaker_date));
if(strtoupper($filtering_branch)!='') {
    if($filtering_grade!='') {
        echo "<h2>".strtoupper($filtering_branch)." Suppliers Weekly Receiving from <u>$start_date to $breaker_date</u> and start week of target is <u>$start_week to $end_week</u> in MT on ".$filtering_grade."</h2>";
    }else {
        echo "<h2>".strtoupper($filtering_branch)." Suppliers Weekly Receiving from <u>$start_date to $breaker_date</u> and start week of target is <u>$start_week to $end_week</u> in MT on all grades</h2>";
    }
}else {
    if($filtering_grade!='') {
        echo "<h2>CONSOLIDATED Suppliers Weekly Receiving from <u>$start_date to $breaker_date</u> and start week of target is <u>$start_week to $end_week</u> in MT on wp grade: ".$filtering_grade."</h2>";
    }else {
        echo "<h2>CONSOLIDATED Suppliers Weekly Receiving from <u>$start_date to $breaker_date</u> and start week of target is <u>$start_week to $end_week</u> in MT on all grades</h2>";
    }
}

echo "<h7><a href='frm_customize_report.php'>Back</a></h7>";

$wp_array=array();
$supplier_id_array=array();
$supplier_name_array=array();
$supplier_cap_array=array();
$supplier_price_array=array ();
$supplier_addtl_price_array=array ();
$supplier_expected_vol_array=array ();
$supplier_addtl_vol_array=array ();
$supplier_remarks=array();
$deliveries_per_month=array();
$deliveries_per_week=array();
$deliveries_cur_per_week=array();
$week_count=array ();
$deliveries_last_6month=array();



$sql_sup = mysql_query("SELECT supplier_id,supplier_name FROM supplier_details WHERE status!='inactive' and branch like '%$filtering_branch%'");
while ($rs_sup = mysql_fetch_array($sql_sup)) {
    array_push($supplier_id_array,$rs_sup['supplier_id']);
    $supplier_name_array[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

    $sql_del = mysql_query("SELECT sum(weight),month_delivered,year_delivered FROM sup_deliveries WHERE supplier_id='".$rs_sup['supplier_id']."' and  date_delivered>='$start_date' and date_delivered<='$breaker_date' and wp_grade like '%$filtering_grade%' GROUP BY month_delivered,year_delivered ORDER BY date_delivered");
    while ($rs_del = mysql_fetch_array($sql_del)) {
        $deliveries_per_month[$rs_sup['supplier_id']][$rs_del['month_delivered']][$rs_del['year_delivered']]=$rs_del['sum(weight)'];
    }
}

//foreach ($supplier_id_array as $supplier_id) {
//    $sql_del = mysql_query("SELECT sum(weight),month_delivered,year_delivered FROM sup_deliveries WHERE supplier_id='$supplier_id' and  date_delivered>='$start_date' and date_delivered<='$breaker_date' and wp_grade like '%$filtering_grade%' GROUP BY month_delivered,year_delivered ORDER BY date_delivered");
//    while ($rs_del = mysql_fetch_array($sql_del)) {
//        $deliveries_per_month[$supplier_id][$rs_del['month_delivered']][$rs_del['year_delivered']]=$rs_del['sum(weight)'];
//    }
//}
//$supplier_id_array = array_unique($supplier_id_array);
sort($supplier_id_array);

foreach ($supplier_id_array as $supplier_id) {
    $start_week_q = $prev_start_week;
    while ($start_week_q < $prev_end_week) {
        $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
//        echo $start_week_q."-".$end_week_q."<br>";
        $sql_last_month = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$supplier_id' and wp_grade like '%$filtering_grade%' and date_delivered>='$start_week_q' and date_delivered<='$end_week_q'");
        $rs_last_month = mysql_fetch_array($sql_last_month);
        $deliveries_per_week[$supplier_id][$start_week_q][$end_week_q]=$rs_last_month['sum(weight)'];
        $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
    }

    $sql_last_6months = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$supplier_id' and wp_grade like '%$filtering_grade%' and date_delivered>='$last_6month_1st_day' and date_delivered<='$last_month_last_day'");
    $rs_last_6months = mysql_fetch_array($sql_last_6months);
    $deliveries_last_6month[$supplier_id]=$rs_last_6months['sum(weight)']/6;

    $start_week_q = $start_week;
    while ($start_week_q < $end_week) {
        $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
        $sql_last_cur = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$supplier_id' and wp_grade='$filtering_grade' and date_delivered>='$start_week_q' and date_delivered<='$end_week_q'");
        $rs_last_cur = mysql_fetch_array($sql_last_cur);
        $deliveries_cur_week[$supplier_id][$start_week_q][$end_week_q]=$rs_last_cur['sum(weight)'];
        $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));

    }

    $sql_cap = mysql_query("SELECT capacity FROM supplier_capacity WHERE supplier_id='$supplier_id' and date_effective<='$breaker_date' and wp_grade like '%$filtering_grade%' ORDER BY date_effective DESC LIMIT 1");
    $rs_cap = mysql_fetch_array($sql_cap);
    $supplier_cap_array[$supplier_id] = $rs_cap['capacity'];

    $sql_price = mysql_query("SELECT unit_cost FROM paper_buying WHERE supplier_id='$supplier_id' and date_received<='$breaker_date' and wp_grade like '%$filtering_grade%' ORDER BY date_received DESC LIMIT 1");
    $rs_price = mysql_fetch_array($sql_price);
    $supplier_price_array[$supplier_id] = $rs_price['unit_cost'];

    $start_week_q = $start_week;
    while ($start_week_q < $end_week) {
        $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
        $sql_price_marketing = mysql_query("SELECT unit_cost,additional_price,expected_volume,additional_volume FROM sup_buying_price WHERE supplier_id='$supplier_id' and wp_grade like '%$filtering_grade%' and date_effective='$end_week_q' ORDER BY date_effective DESC LIMIT 1");
        $rs_price_marketing = mysql_fetch_array($sql_price_marketing);
        $supplier_addtl_price_array[$supplier_id][$start_week_q][$end_week_q]=$rs_price_marketing['unit_cost'];
        $supplier_expected_vol_array[$supplier_id][$start_week_q][$end_week_q]=$rs_price_marketing['expected_volume'];
//        $supplier_addtl_vol_array[$supplier_id][$start_week_q][$end_week_q]=$rs_price_marketing['additional_volume'];
        $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
    }
    $sql_marketing_remarks = mysql_query("SELECT remarks FROM sup_buying_price_remarks WHERE supplier_id='$supplier_id' and wp_grade like '%$filtering_grade%' and date_updated<='$breaker_date' ORDER BY date_updated DESC LIMIT 1");
    $rs_marketing_remarks = mysql_fetch_array($sql_marketing_remarks);
    $supplier_remarks[$supplier_id]=$rs_marketing_remarks['remarks'];

}
$count_tot = 0;
echo "<table id='mytable_t1' border=2 cellpadding=2>";
echo "<tr id='bold' style='border:1px solid black; font-weight: bold;'>";
echo "<td style='background:cyan; font-weight: bold;' class='lockclass_t1'>Supplier ID</td>";
echo "<td style='background:cyan; font-weight: bold;' class='lockclass_t1'>Supplier Name</td>";
$start_q = $start_date;
while ($start_q <= $breaker_date) {
    $start_q_month = date("Y/m", strtotime($start_q));
    $month_q = date('M', strtotime($start_q));
    $year_q = date('Y', strtotime($start_q));
    if ($start_q_month != $breaker_month) {
        $count_tot++;
        echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'>".$month_q."-".$year_q."</th>";
    } else {
        $count = 0;
        $start_week_q = $prev_start_week;
        while ($start_week_q < $prev_end_week) {
            $count_tot++;
            $count++;
            $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'>Prev Del Week $count <font size='2'>$start_week_q-$end_week_q</font> </th>";
            $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
        }
        $count_tot++;
        echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'>Last 6 Month Avg</th>";
        $count_tot++;
        echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'>".$month_q."-".$year_q."</th>";

        $count = 0;
        $start_week_q = $start_week;
        while ($start_week_q < $end_week) {
            $count_tot++;
            $count++;
            $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'>Actual Del Week $count <font size='2'>$start_week_q-$end_week_q</font></th>";
            $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
        }
        $count_tot++;
        echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'>Capacity</th>";
        $count_tot++;
        echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'>Var on Expctd Perf</th>";
        echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'>Buying Price</th>";

        $count = 0;
        $start_week_q = $start_week;
        while ($start_week_q < $end_week) {
            $count++;
            $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
            $count_tot++;
            $count_tot++;
            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'><font size='2'>New Price</font> Week $count</th>";
            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'><font size='2'>Target Vol</font> Week $count</th>";
//            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'><font size='2'>Addl Vol</font> Week $count</th>";
            $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
        }
        echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'>_________________________Remarks_________________________</th>";
    }

    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
}
echo "</tr>";

if ($_SESSION['username']=='lonlon') {
    $ctr = 0;
    echo "<tr id='bold' style='border:1px solid black; font-weight: bold;'>";
    echo "<td style='background:cyan; font-weight: bold;' class='lockclass_t1'>TOTAL</td>";
    echo "<td style='background:cyan; font-weight: bold;' class='lockclass_t1'></td>";
    $start_q = $start_date;
    while ($start_q <= $breaker_date) {
        $start_q_month = date("Y/m", strtotime($start_q));
        $month_q = date('M', strtotime($start_q));
        $year_q = date('Y', strtotime($start_q));
        if ($start_q_month != $breaker_month) {
            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'><span id='total_$ctr'></span></th>";
            $ctr++;
        } else {
            $start_week_q = $prev_start_week;
            while ($start_week_q < $prev_end_week) {
                echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'><span id='total_$ctr'></span></th>";
                $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                $ctr++;
            }
            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'><span id='total_$ctr'></span></th>";
            $ctr++;
            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'><span id='total_$ctr'></span></th>";
            $ctr++;

            $start_week_q = $start_week;
            while ($start_week_q < $end_week) {
                echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'><span id='total_$ctr'></span></th>";
                $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                $ctr++;
            }
            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'><span id='total_$ctr'>$ctr</span></th>";
            $ctr++;
            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'><span id='total_$ctr'>$ctr</span></th>";
            $ctr++;
            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'></th>";

            $start_week_q = $start_week;
            while ($start_week_q < $end_week) {
                echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'><span id='total_$ctr'>$ctr</span></th>";
                $ctr++;
                echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'><span id='total_$ctr'>$ctr</span></th>";
                $ctr++;
//            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'></th>";
                $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
            }
            echo "<TH style='background:grey; font-weight: bold;' class='colclass_t1'></th>";
        }
        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
    }
    echo "</tr>";
}
$total = array ();

foreach ($supplier_id_array as $supplier_id) {
    $ctr = 0;
    echo "<tr>";
    echo "<td class='rowclass_t1' style='background:yellow;'>$supplier_id</td>";
    echo "<td class='rowclass_t1' style='background:yellow;'>".$supplier_name_array[$supplier_id]."</td>";
    $start_q = $start_date;

    while ($start_q <= $breaker_date) {
        $start_q_month = date("Y/m", strtotime($start_q));
        $month_q = date('F', strtotime($start_q));
        $year_q = date('Y', strtotime($start_q));
        if ($start_q_month != $breaker_month) {
            $total[$ctr++]+=$deliveries_per_month[$supplier_id][$month_q][$year_q]/1000;
            echo "<td>".round($deliveries_per_month[$supplier_id][$month_q][$year_q]/1000,2)."</td>";
        } else {
            $start_week_q = $prev_start_week;
            while ($start_week_q < $prev_end_week) {
                $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                $total[$ctr++]+=$deliveries_per_week[$supplier_id][$start_week_q][$end_week_q]/1000;
                echo "<td>".round($deliveries_per_week[$supplier_id][$start_week_q][$end_week_q]/1000,2)."</td>";
                $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
//            }
                if ($deliveries_last_6month[$supplier_id] == '0' || $deliveries_last_6month[$supplier_id] == '') {
                    $total[$ctr++]+=0;
                } else {
                    $total[$ctr++]+=$deliveries_last_6month[$supplier_id]/1000;
                }
                echo "<td>".round($deliveries_last_6month[$supplier_id]/1000,2)."</td>";
                $total[$ctr++]+=$deliveries_per_month[$supplier_id][$month_q][$year_q]/1000;
                if ($deliveries_per_month[$supplier_id][$month_q][$year_q] == '' || $deliveries_per_month[$supplier_id][$month_q][$year_q] == '0') {
                    echo "<td>0</td>";
                } else {
                    echo "<td>".round($deliveries_per_month[$supplier_id][$month_q][$year_q]/1000,2)."</td>";
                }

                $start_week_q = $start_week;
                while ($start_week_q < $end_week) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    $total[$ctr++]+=$deliveries_cur_week[$supplier_id][$start_week_q][$end_week_q]/1000;
                    echo "<td>".round($deliveries_cur_week[$supplier_id][$start_week_q][$end_week_q]/1000,2)."</td>";
                    $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));

                }
                $total[$ctr++]+=$supplier_cap_array[$supplier_id];
                echo "<td>".$supplier_cap_array[$supplier_id]."</td>";
                $current_month = $deliveries_per_month[$supplier_id][$month_q][$year_q]/1000;
                $last_6_month = $deliveries_last_6month[$supplier_id]/1000;
                $total[$ctr++]+=$current_month - ($day_percentage * $last_6_month);
                echo "<td>".round($current_month - ($day_percentage * $last_6_month),2)."</td>";
                echo "<td>".$supplier_price_array[$supplier_id]."</td>";

                $c = 1;
                $start_week_q = $start_week;
                while ($start_week_q < $end_week) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    $total[$ctr++]+=$supplier_addtl_price_array[$supplier_id][$start_week_q][$end_week_q]*$supplier_expected_vol_array[$supplier_id][$start_week_q][$end_week_q];
                    echo "<td id='".$supplier_id."_".$c."' onclick='txt(this.id);'>";
                    echo "<div id='addl_price_value_".$supplier_id."_".$c."'>".$supplier_addtl_price_array[$supplier_id][$start_week_q][$end_week_q]."</div>";
                    echo "<div id='addl_price_edit_".$supplier_id."_".$c."' class='editbox'>
<input class='marketing' id='addtl_price_".$supplier_id."_".$c."' value='".$supplier_addtl_price_array[$supplier_id][$start_week_q][$end_week_q]."'></div>";
                    echo "</td>";
                    $total[$ctr++]+=$supplier_expected_vol_array[$supplier_id][$start_week_q][$end_week_q];
                    echo "<td>";
                    echo "<div id='expctd_vol_value_".$supplier_id."_".$c."'>".$supplier_expected_vol_array[$supplier_id][$start_week_q][$end_week_q]."</div>";
                    echo "<div id='expctd_vol_edit_".$supplier_id."_".$c."' class='editbox'>
<input class='marketing' id='expctd_vol_".$supplier_id."_".$c."' value='".$supplier_expected_vol_array[$supplier_id][$start_week_q][$end_week_q]."'>
                <button id='".$supplier_id."_".$c."_".$end_week_q."_".$filtering_grade."' onclick='save(this.id);'>Save</button>
                </div>";
                    echo "</td>";
//                echo "<td id='".$supplier_id."_".$c."' onclick='txt(this.id);'>";
//                echo "<div id='addtl_vol_value_".$supplier_id."_".$c."'>".$supplier_addtl_vol_array[$supplier_id][$start_week_q][$end_week_q]."</div>";
//                echo "<div id='addtl_vol_edit_".$supplier_id."_".$c."' class='editbox'>
//<input class='marketing' id='addtl_vol_".$supplier_id."_".$c."' value='".$supplier_addtl_vol_array[$supplier_id][$start_week_q][$end_week_q]."'></div>";
//                echo "</td>";
                    $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                    $c++;
                }
                echo "<td>";
                if ($supplier_remarks[$supplier_id] == '') {
                    echo "<div id='remarks_value_$supplier_id'><a id='".$supplier_id."' onclick='remarks(this.id);'><div id='remedit_$supplier_id'>Input</div></a></div>";
                } else {
                    echo "<div id='remarks_value_$supplier_id'><a id='".$supplier_id."' onclick='remarks(this.id);'><div id='remedit_$supplier_id'>".$supplier_remarks[$supplier_id]."</div></a></div>";
                }

                echo "<div id='remarks_edit_$supplier_id' class='editbox'><input class='remarks' id='remarks_$supplier_id' value='".$supplier_remarks[$supplier_id]."'>
            <button id='".$supplier_id."_".$filtering_grade."' onclick='save2(this.id)'>Save</button>
            </div>";
                echo "</td>";
            }
            $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
        }
        echo "</tr>";
    }
}
echo "</table>";

$l6m = $count_tot-15;
$week1 = $count_tot-8;
$week2 = $count_tot-6;
$week3 = $count_tot-4;
$week4 = $count_tot-2;
//echo $week1."-".$week2."-".$week3."-".$week4."<br>";
$ctr = 0;
while ($ctr < $count_tot) {
    if ($l6m == $ctr) {
        echo "<input id='dum_total_$ctr' type='hidden' name='total_$ctr' value='".round($total[$ctr]/6,2)."'>";
    } else if ($week1 == $ctr) {
        $exp_vol = $ctr+1;
        echo "<input id='dum_total_$ctr' type='hidden' name='total_$ctr' value='".round($total[$ctr]/$total[$exp_vol],2)."'>";
    }  else if ($week2 == $ctr) {
        $exp_vol = $ctr+1;
        echo "<input id='dum_total_$ctr' type='hidden' name='total_$ctr' value='".round($total[$ctr]/$total[$exp_vol],2)."'>";
    }  else if ($week3 == $ctr) {
        $exp_vol = $ctr+1;
        echo "<input id='dum_total_$ctr' type='hidden' name='total_$ctr' value='".round($total[$ctr]/$total[$exp_vol],2)."'>";
    }  else if ($week4 == $ctr) {
        $exp_vol = $ctr+1;
        echo "<input id='dum_total_$ctr' type='hidden' name='total_$ctr' value='".round($total[$ctr]/$total[$exp_vol],2)."'>";
    } else {
        echo "<input id='dum_total_$ctr' type='hidden' name='total_$ctr' value='".round($total[$ctr],2)."'>";
    }
    $ctr++;
}
echo "<input id='count' type='hidden' name='count' value='$ctr'>";
?>

<!-- <h1>This Page is not available.</h1> -->




