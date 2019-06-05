<?php include("templates/template.php"); ?>

<style>

    h2{

        color:orange;

    }

    h2 i{

        color:yellow;

    }



    #total{



        font-weight:bold;

        background-color: yellow;

    }

    #standing{

        font-weight:bold;

        background-color: orange;

    }

</style>

<?php
$date_now = date("Y/m/d");

$from = $_POST['start_date'];

$to = $_POST['end_date'];

$date = date("M d, Y", strtotime($to));

if ($date_now == $to) {

    $to = date("Y/m/d", strtotime("-1 day"));
}

$month = date("Y/m", strtotime($to));

$branch = $_POST['branch'];

$katapusan_in_number = date("t", strtotime($to));

$katapusan_in_date = date("Y/m/t", strtotime($to));



$start_date = preg_split('[/]', $from);

$end_date = preg_split('[/]', $to);

$start_date_month_and_year = $start_date[0] . "/" . $start_date[1];

$start_date = $start_date[2];

$end_date = $end_date[2];

$end_date_month_and_year = $end_date[0] . "/" . $end_date[1];

$count = 0;

while ($start_date <= $end_date) {

    $start_date+=0;

    $petsa = '';

    if ($start_date < 10) {

        $petsa = $start_date_month_and_year . "/0" . $start_date;
    } else {

        $petsa = $start_date_month_and_year . "/" . $start_date;
    }

    $aldo = date("D", strtotime($petsa));

    if ($aldo == 'Sun') {

        $count++;
    }

    $start_date++;
}

function countSundays($from_param, $to_param) {

    $start_date = preg_split('[/]', $from_param);

    $end_date = preg_split('[/]', $to_param);

    $start_date_month_and_year = $start_date[0] . "/" . $start_date[1];

    $start_date = $start_date[2];

    $end_date = $end_date[2];

    $end_date_month_and_year = $end_date[0] . "/" . $end_date[1];

    $count = 0;

    while ($start_date <= $end_date) {

        $start_date+=0;

        $petsa = '';

        if ($start_date < 10) {

            $petsa = $start_date_month_and_year . "/0" . $start_date;
        } else {

            $petsa = $start_date_month_and_year . "/" . $start_date;
        }

        $aldo = date("D", strtotime($petsa));

        if ($aldo == 'Sun') {

            $count++;
        }

        $start_date++;
    }

    return $count;
}

if ($branch == '' || $branch == 'Pampanga') {

    $operational_day = $end_date;

    $number_of_days = $katapusan_in_number;
} else {

    $operational_day = $end_date - $count;

    $number_of_days = $katapusan_in_number - countSundays($from, $katapusan_in_date);
}





echo "<center>";

if ($branch == '') {

    echo "<h1>Envirocycling Fiber Inc. as of $date</h1>";
} else {

    echo"<h1>$branch as of $date</h1>";
}



$operational_percent = round((($operational_day / $number_of_days) * 100), 0);

echo "<h2>Operational Days: <i>$operational_day</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

echo "Number of Days: <i>$number_of_days </i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

echo "Percentage: <i>$operational_percent % </i></h2>";



echo "</center>";

$grades_array = array('LCWL', 'ONP', 'CBS', 'OCC', 'MW', 'CHIPBOARD', 'OTHERS');



$query = "SELECT sum(target) as target,wp_grade FROM monthly_target where month ='$month' and( branch like '%$branch%') group by wp_grade order by log_id asc";

$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {

    $target_per_grade[$row['wp_grade']] = $row['target'];
}


$query = "SELECT sum(weight),date_delivered,wp_grade FROM sup_deliveries where branch_delivered like '%$branch%' and date_delivered >= '$from' and date_delivered <='$to' group by date_delivered,wp_grade";

$result = mysql_query($query);

$daily_deliveries = array();

$export_deliveries = 0;

$array_of_dates = array();

while ($row = mysql_fetch_array($result)) {

    $daily_deliveries[$row['wp_grade'] . "+" . $row['date_delivered']] = ($row['sum(weight)'] / 1000);
    if ($row['wp_grade'] === "OCC_E") {
        $export_deliveries+=($row['sum(weight)'] / 1000);
    }
    array_push($array_of_dates, $row['date_delivered']);
}


$query = "SELECT sum(weight),wp_grade FROM actual where branch like '%$branch%' and date >= '$from' and date <='$to'  group by wp_grade";
//echo "SELECT sum(weight),wp_grade FROM actual where branch like '%$branch%' and date >= '$from' and date <='$to'  group by wp_grade";
$result = mysql_query($query);

$actual_array = array();
//echo '<h1>'.$to.'</h1>';
while ($row = mysql_fetch_array($result)) {

    $actual_wp_grade = $row['wp_grade'];

    if ($actual_wp_grade != 'LCWL') {

        $actual_wp_grade = str_replace('LC', '', $actual_wp_grade);
    }

    if ($actual_wp_grade == 'OCC' && $branch == '') {
        $query2 = "SELECT sum(weight),wp_grade FROM actual where branch like '%$branch%' and date >= '$from' and date <='$to' and wp_grade LIKE '%OCC%' and delivered_to LIKE '%SAUYO%'";
        $result2 = mysql_query($query2);
        $row2 = mysql_fetch_array($result2);
//        $actual_array[$actual_wp_grade] = ($row2['sum(weight)'] / 1000);
    }
    $actual_array[$actual_wp_grade] += ($row['sum(weight)'] / 1000);
    
    
}



$query = "SELECT sum(weight),date,wp_grade FROM outgoing where branch like '%$branch%' and date >= '$from' and date <='$to' group by date,wp_grade";

$result = mysql_query($query);

$daily_outgoing = array();



while ($row = mysql_fetch_array($result)) {

    $wp_grades = $row['wp_grade'];

    if ($row['wp_grade'] == 'LCMW-PPQ') {

        $wp_grades = "LCMW";
    }

    if ($row['wp_grade'] == 'LCAP_K') {

        $wp_grades = "LCMW";
    }

    if ($row['wp_grade'] == 'LCOPD') {

        $wp_grades = "LCONP";
    }

    //if ($row['wp_grade'] == 'LCMW_S') {
    //  $wp_grades = "LCMW";
//}

    $daily_outgoing[$wp_grades . "+" . $row['date']] = ($row['sum(weight)'] / 1000);


    array_push($array_of_dates, $row['date']);
}




$query = "SELECT sum(weight),date,wp_grade FROM actual where branch like '%$branch%'and date >= '$from' and date <='$to' group by date,wp_grade";

$result = mysql_query($query);

$daily_actual = array();



while ($row = mysql_fetch_array($result)) {

    $actual_wp_grade = $row['wp_grade'];

    if ($actual_wp_grade != 'LCWL') {

        $actual_wp_grade = str_replace('LC', '', $actual_wp_grade);
    }



    $daily_actual[$actual_wp_grade . "+" . $row['date']] = ($row['sum(weight)'] / 1000);



    array_push($array_of_dates, $row['date']);
}



$array_of_dates = array_unique($array_of_dates);

$branch_del = array();

$sql_branch_del = mysql_query("SELECT * FROM actual WHERE branch!='' and date>='$from' and date<='$to' GROUP BY branch");

while ($rs = mysql_fetch_array($sql_branch_del)) {

    array_push($branch_del, $rs['branch']);
}

$del_perf = array();

$total_per_branch = array();

$total_per_grade = array();

if ($date_now == $to) {

    $q_date = date('Y/m/d', strtotime("-1 day", strtotime($to)));
} else {

    $q_date = $to;
}

foreach ($branch_del as $branch_name) {

    $sql = mysql_query("SELECT sum(weight),wp_grade FROM actual WHERE branch= '$branch_name' and date='$q_date'GROUP BY wp_grade");

    while ($rs = mysql_fetch_array($sql)) {

        $grade = $rs['wp_grade'];

        $del_perf[$branch_name][$grade] = $rs['sum(weight)'];
        $branch_nameChk = strtoupper($branch_name);
        $gradeChk = strtoupper($grade);
        if($branch_nameChk == 'SAUYO'){
            if($gradeChk != 'LCOCC_E'){
                $total_per_branch[$branch_name]+=$rs['sum(weight)'];
            }
        }else{
            $total_per_branch[$branch_name]+=$rs['sum(weight)'];
        }

        $total_per_grade[$grade]+=$rs['sum(weight)'];
    }
}
?>



<div class="grid_9">

    <div class="box round first">

        <h2>Monitoring Stats</h2>



        <table class="data display datatable" id="example">

            <thead>

                <tr class='data'>

                    <?php
                    echo "<th></th>";

                    echo "<th>EFI</th>";

                    foreach ($grades_array as $wp_grade) {

                        echo "<th>$wp_grade</th>";
                    }

                    echo "<th>TOTAL</th>";
                    ?>

                </tr>

            </thead>

            <?php
            echo "<tr>";

            echo "<td>1</td>";

            echo "<td>TARGET ON SALES</td>";

            $total_target = 0;

            foreach ($grades_array as $wp_grade) {
                if (!empty($target_per_grade[$wp_grade])) {

                    echo "<td>" . round($target_per_grade[$wp_grade], 0) . "</td>";

                    $total_target+=round($target_per_grade[$wp_grade], 0);
                } else {

                    echo "<td></td>";
                }
            }



            echo "<td id='TOTAL'>$total_target</td>";



            echo "</tr>";



            echo "<tr>";

            echo "<td>2</td>";

            echo "<td>TARGET AVG</td>";

            $total_target_avg = 0;

            foreach ($grades_array as $wp_grade) {

                if (!empty($target_per_grade[$wp_grade])) {

                    echo "<td>" . round($target_per_grade[$wp_grade] / $number_of_days, 0) . "</td>";

                    $total_target_avg+=round($target_per_grade[$wp_grade] / $number_of_days, 0);
                } else {

                    echo "<td></td>";
                }
            }



            echo "<td id='TOTAL'>$total_target_avg</td>";



            echo "</tr>";







            echo "<tr>";

            echo "<td>3</td>";

            echo "<td>Sales MTD</td>";

            $total_sales_mtd = 0;

            $actual_array['MW_S'] . '-';

            foreach ($grades_array as $wp_grade) {



                // if (!empty($actual_array[$wp_grade])) {
//                    if($wp_grade=='LCWL') {
//                        $actual_array[$wp_grade]=$actual_array[$wp_grade]-1;
//                    }
//                    if($wp_grade=='OCC') {
//                        $actual_array[$wp_grade]=$actual_array[$wp_grade]+1;
//                    }

                if ($wp_grade == 'MW') {
                    $actual_array[$wp_grade] = $actual_array['MW_S'] + $actual_array[$wp_grade];
                } else if ($wp_grade == 'ONP') {
                    $actual_array[$wp_grade] = $actual_array[$wp_grade] + $actual_array['NPB'] + $actual_array['OPD'] + $actual_array['OIN'];
                } else if ($wp_grade == 'LCWL') {
                    $actual_array[$wp_grade] = $actual_array[$wp_grade] + $actual_array['WL_GW'] + $actual_array['WL_CBS'];
                } else if ($wp_grade == 'OCC') {
                    $actual_array[$wp_grade] = ($actual_array[$wp_grade] + $actual_array['OCC_E']) - $export_deliveries;
                   // echo $actual_array[$wp_grade].'+'.$actual_array['OCC_E'].'-'.$export_deliveries.'<br>';
                }
                $nums = round($actual_array[$wp_grade]);

                if ($nums != 0) {
                    echo "<td>" . round($actual_array[$wp_grade]) . "</td>";

                    $total_sales_mtd+= round($actual_array[$wp_grade]);
                    //echo '-'.$actual_array[$wp_grade].'<br/>';
                } else {

                    echo "<td></td>";
                }
            }

            echo "<td id='TOTAL'>" . round($total_sales_mtd) . "</td>";



            echo "</tr>";











            echo "<tr>";

            echo "<td>4</td>";

            echo "<td>AVG Sales Daily</td>";

            $total_avg_sales_daily = 0;

            foreach ($grades_array as $wp_grade) {

                if (!empty($actual_array[$wp_grade])) {

                    echo "<td>" . round($actual_array[$wp_grade] / $operational_day, 0) . "</td>";

                    $total_avg_sales_daily+=round($actual_array[$wp_grade] / $operational_day, 0);
                } else {

                    echo "<td></td>";
                }
            }



            echo "<td id='TOTAL'>$total_avg_sales_daily</td>";



            echo "</tr>";









            echo "<tr>";

            echo "<td>5</td>";

            echo "<td>VAR on(T & A)</td>";

            $total_var = 0;

            foreach ($grades_array as $wp_grade) {

                if (!empty($actual_array[$wp_grade])) {

                    echo "<td>" . round(($actual_array[$wp_grade] / $operational_day) - ($target_per_grade[$wp_grade] / $number_of_days), 0) . "</td>";

                    $total_var+=round(($actual_array[$wp_grade] / $operational_day) - ($target_per_grade[$wp_grade] / $number_of_days), 0);
                } else {

                    echo "<td></td>";
                }
            }



            echo "<td id='TOTAL'>$total_var</td>";



            echo "</tr>";







            echo "<tr>";

            echo "<td>6.A</td>";

            echo "<td id='TOTAL'>PROJECTED (MT)</td>";

            $total_we_end_mt = round(($total_avg_sales_daily * $number_of_days), 0);

            foreach ($grades_array as $wp_grade) {

                if (!empty($actual_array[$wp_grade])) {

                    echo "<td id='TOTAL'>" . round(($actual_array[$wp_grade] / $operational_day) * $number_of_days, 0) . "</td>";

//                    echo "<td id='TOTAL'>".round($actual_array[$wp_grade],0)."-".round(($actual_array[$wp_grade]/$operational_day),0)*$number_of_days."</td>";
                } else {

                    echo "<td id='TOTAL'></td>";
                }
            }



            echo "<td id='TOTAL'>$total_we_end_mt</td>";

            echo "</tr>";





            echo "<tr>";

            echo "<td>6.B</td>";

            echo "<td id='TOTAL'>PROJECTED %</td>";

            $total_we_end = round((($total_avg_sales_daily * $number_of_days) / $total_target) * 100, 0);

            foreach ($grades_array as $wp_grade) {

                if (!empty($actual_array[$wp_grade])) {



                    echo "<td id='TOTAL'>" . round(((($actual_array[$wp_grade] / $operational_day) * $number_of_days) / $target_per_grade[$wp_grade]) * 100, 0) . "%</td>";
                } else {

                    echo "<td id='TOTAL'></td>";
                }
            }



            echo "<td id='TOTAL'>$total_we_end%</td>";

            echo "</tr>";

            echo "<tr>";

            echo "<td>7</td>";

            echo "<td  id='standing'>CURRENT STANDING</td>";



            foreach ($grades_array as $wp_grade) {

                $target_standing = 0;

                $sales_mtd = 0;



                if (!empty($target_per_grade[$wp_grade])) {

                    $target_standing = round($target_per_grade[$wp_grade], 0);
                }

                if (!empty($actual_array[$wp_grade])) {

                    $sales_mtd = round($actual_array[$wp_grade], 0);
                }





                if ($sales_mtd == 0 || $target_standing == 0) {

                    echo "<td id='standing'></td>";
                } else {

                    echo "<td id='standing'>" . round((($sales_mtd / $target_standing) * 100), 0) . "%</td>";
                }
            }



            echo "<td id='standing'>" . round((( $total_sales_mtd / $total_target) * 100), 0) . "%</td>";



            echo "</tr>";
            ?>

        </table>

    </div>

</div>





<div class="grid_9">

    <div class="box round first">

        <?php
        echo "<center><h2>Actual Vs Target</h2>";
        ?>



        <div id="bar-chart">

            <?php
            echo '<iframe src="dist/graphs/salemtd_vs_target.php?from=' . $from . '&&to=' . $to . '&&branch=' . $branch . '" height="350" width="100%"></iframe>';
            ?>

        </div>

    </div>

</div>



<?php
if ($branch == '') {
    ?>

    <div class="grid_9">

        <div class="box round first">

            <h2>Per Branch Breakdown (Date: <?php echo $q_date; ?>)</h2>

            <table class="data display datatable" id="example">

                <thead>

                    <tr>

                        <th>Branch</th>

                        <th>LCWL</th>

                        <th>ONP</th>

                        <th>CBS</th>

                        <th>OCC</th>

                        <th>MW</th>

                        <th>CHIPBOARD</th>

                        <th>TOTAL</th>

                    </tr>

                </thead>



                <?php
                $total_tot = 0;

                foreach ($branch_del as $branch_name) {

                    echo "<tr>";

                    echo "<td>" . strtoupper($branch_name) . "</td>";

                    echo "<td>" . round((($del_perf[$branch_name]['LCWL'] + $del_perf[$branch_name]['LCWL_GW'] + $del_perf[$branch_name]['LCWL_CBS']) / 1000), 1) . "</td>";

                    echo "<td>" . round(($del_perf[$branch_name]['LCONP'] + $del_perf[$branch_name]['LCOPD'] + $del_perf[$branch_name]['LCNPB']) / 1000, 1) . "</td>";

                    echo "<td>" . round($del_perf[$branch_name]['LCCBS'] / 1000, 1) . "</td>";

                    echo "<td>" . round(($del_perf[$branch_name]['LCOCC']) / 1000, 1) . "</td>";

                    echo "<td>" . round(($del_perf[$branch_name]['LCMW'] + $del_perf[$branch_name]['LCMW-PPQ'] + $del_perf[$branch_name]['LCAP_K'] + $del_perf[$branch_name]['LCMW_S']) / 1000, 1) . "</td>";

                    echo "<td>" . round($del_perf[$branch_name]['CHIPBOARD'] / 1000, 1) . "</td>";

                    echo "<td id='TOTAL'>" . round($total_per_branch[$branch_name] / 1000, 1) . "</td>";

                    echo "</tr>";

                    $total_tot+=$total_per_branch[$branch_name];
                }

                // $wl = $total_per_grade['LCWL'] / 1000;
                // $onp = ($total_per_grade['LCONP'] + $total_per_grade['LCOPD'] + $total_per_grade['LCNPB']) / 1000;
                //$cbs = $total_per_grade['LCCBS'] / 1000;
                //$occ = $total_per_grade['LCOCC'] / 1000;
                //$mw = ($total_per_grade['LCMW'] + $total_per_grade['LCMW-PPQ'] + $total_per_grade['LCAP_K'] + $total_per_grade['LCMW_S']) / 1000;
                //$chip = $total_per_grade['CHIPBOARD'] / 1000;

                echo "<tr id='TOTAL'>";

                echo "<td>!TOTAL!</td>";

                echo "<td>" . $wl+=round((($total_per_grade['LCWL'] + $total_per_grade['LCWL_GW'] + $total_per_grade['LCWL_CBS']) / 1000), 0) . "</td>";

                echo "<td>" . $onp+=round(($total_per_grade['LCONP'] + $total_per_grade['LCOPD'] + $total_per_grade['LCNPB']) / 1000, 1) . "</td>";

                echo "<td>" . $cbs+=round($total_per_grade['LCCBS'] / 1000, 1) . "</td>";

                echo "<td>" . $occ+=round(($total_per_grade['LCOCC']) / 1000, 1) . "</td>";

                echo "<td>" . $mw+=round(($total_per_grade['LCMW'] + $total_per_grade['LCMW-PPQ'] + $total_per_grade['LCAP_K'] + $total_per_grade['LCMW_S']) / 1000, 1) . "</td>";

                echo "<td>" . $chip+=round($total_per_grade['CHIPBOARD'] / 1000, 1) . "</td>";

                echo "<td>" . round(($wl + $onp + $cbs + $mw + $chip + $occ), 0) . "</td>";

                echo "</tr>";
                ?>

            </table>



        </div>

    </div>

    <?php
}
?>



<!-- Daily Outgoing -->





<div class="grid_5">

    <div class="box round first">

        <h2>Daily Outgoing in MT (From Branch Truck Scale )</h2>



        <table class="data display datatable" id="example">

            <thead>



                <?php
                echo "<th>Date</th>";

                foreach ($grades_array as $wp_grade) {

                    echo "<th>$wp_grade</th>";
                }

                echo "<th>TOTAL</th>";
                ?>

            </thead>

            <?php
            $total_outgoing_final = 0;

            foreach ($array_of_dates as $date_delivered) {

                $total_outgoing = 0;

                echo "<tr>";

                echo "<td>" . $date_delivered . "</td>";

                foreach ($grades_array as $grade_element) {

                    if ($grade_element != 'LCWL' && $grade_element != 'CHIPBOARD') {

                        $grade_element = "LC" . $grade_element . "";

                        if (!empty($daily_outgoing[$grade_element . "+" . $date_delivered])) {


                            if ($grade_element == 'LCMW') {

                                echo "<td>" . round($daily_outgoing[$grade_element . "+" . $date_delivered] + $daily_outgoing["LCMW-PPQ+" . $date_delivered] + $daily_outgoing["LCAP_K+" . $date_delivered] + $daily_outgoing["LCMW_S+" . $date_delivered], 0) . "</td>";

                                $total_outgoing+=$daily_outgoing[$grade_element . "+" . $date_delivered] + $daily_outgoing["LCMW-PPQ+" . $date_delivered] + $daily_outgoing["LCAP_K+" . $date_delivered] + $daily_outgoing["LCMW_S+" . $date_delivered];
                            } else if ($grade_element == 'LCONP') {

                                echo "<td>" . round($daily_outgoing[$grade_element . "+" . $date_delivered] + $daily_outgoing["LCOPD+" . $date_delivered] + $daily_outgoing["LCNPB+" . $date_delivered], 0) . "</td>";

                                $total_outgoing+=$daily_outgoing[$grade_element . "+" . $date_delivered] + $daily_outgoing["LCOPD+" . $date_delivered] + $daily_outgoing["LCNPB+" . $date_delivered];
                            } else if ($grade_element == 'LCOCC') {

                                echo "<td>" . round($daily_outgoing[$grade_element . "+" . $date_delivered] - $daily_deliveries["OCC_E+" . $date_delivered], 0) . "</td>";

                                $total_outgoing+=$daily_outgoing[$grade_element . "+" . $date_delivered] - $daily_deliveries["OCC_E+" . $date_delivered];
                            } else {

                                echo "<td>" . round($daily_outgoing[$grade_element . "+" . $date_delivered], 0) . "</td>";

                                $total_outgoing+=$daily_outgoing[$grade_element . "+" . $date_delivered];
                            }
                        } else {

                            echo "<td>0</td>";
                        }
                    } else {

                        if (!empty($daily_outgoing[$grade_element . "+" . $date_delivered])) {

                            echo "<td>" . round($daily_outgoing[$grade_element . "+" . $date_delivered], 0) . "</td>";

                            $total_outgoing+=$daily_outgoing[$grade_element . "+" . $date_delivered];
                        } else {

                            echo "<td>0</td>";
                        }
                    }
                }

                echo "<td id='TOTAL'>" . round($total_outgoing, 0) . "</td>";

                echo "</tr>";

                $total_outgoing_final+=$total_outgoing;
            }

            echo "<tr id='total'>";

            echo "<td>!TOTAL!</td>";

            foreach ($grades_array as $grade_element) {

                $total_on_grade = 0;

                if ($grade_element != 'LCWL' && $grade_element != 'CHIPBOARD' && $grade_element != 'OTHERS') {

                    $grade = "LC" . $grade_element . "";

                    foreach ($array_of_dates as $date) {



                        if (!empty($daily_outgoing[$grade . "+" . $date])) {

                            $total_on_grade+=$daily_outgoing[$grade . "+" . $date];
                        }
                    }

                    echo "<td>" . round($total_on_grade, 0) . "</td>";
                } else {

                    foreach ($array_of_dates as $date) {

                        if (!empty($daily_outgoing[$grade_element . "+" . $date])) {

                            $total_on_grade+=$daily_outgoing[$grade_element . "+" . $date];
                        }
                    }

                    echo "<td>" . round($total_on_grade, 0) . "</td>";
                }
            }

            echo "<td>" . round($total_outgoing_final, 0) . "</td>";

            echo "</tr>";

            echo "</tr>";
            ?>







        </table>

    </div>

</div>







<!-- Daily Sales -->





<div class="grid_5">

    <div class="box round first">

        <h2>Daily Sales  in MT (From TIPCO Truck Scale )</h2>

        <table class="data display datatable" id="example">

            <thead>



                <?php
                echo "<th>Date</th>";

                foreach ($grades_array as $wp_grade) {

                    echo "<th>$wp_grade</th>";
                }

                echo "<th>TOTAL</th>";
                ?>

            </thead>

            <?php
            $total_actual_final = 0;

            foreach ($array_of_dates as $date_delivered) {

                $total_actual = 0;



                echo "<tr>";

                echo "<td>" . $date_delivered . "</td>";

                foreach ($grades_array as $grade_element) {

                    if (!empty($daily_actual[$grade_element . "+" . $date_delivered])) {

                        if ($grade_element == 'MW') {

                            $actual_array[$wp_grade] = $actual_array[$wp_grade] + $actual_array['MW-PPQ'] + $actual_array['AP_K'] + $actual_array['MW_S'];

                            echo "<td>" . round($daily_actual[$grade_element . "+" . $date_delivered] + $daily_actual["MW-PPQ+" . $date_delivered] + $daily_actual["AP_K+" . $date_delivered] + $daily_actual["MW_S+" . $date_delivered], 0) . "</td>";

                            $total_actual+=$daily_actual[$grade_element . "+" . $date_delivered] + $daily_actual["MW-PPQ+" . $date_delivered] + $daily_actual["AP_K+" . $date_delivered] + $daily_actual["MW_S+" . $date_delivered];
                        } else if ($grade_element == 'ONP') {

                            echo "<td>" . round($daily_actual[$grade_element . "+" . $date_delivered] + $daily_actual["OPD+" . $date_delivered] + $daily_actual["NPB+" . $date_delivered], 0) . "</td>";

                            $total_actual+=$daily_actual[$grade_element . "+" . $date_delivered] + $daily_actual["OPD+" . $date_delivered] + $daily_actual["NPB+" . $date_delivered];
                        } else if ($grade_element == 'OCC') {

                            echo "<td>" . round($daily_actual[$grade_element . "+" . $date_delivered] - $daily_deliveries["OCC_E+" . $date_delivered], 0) . "</td>";

                            $total_actual+=$daily_actual[$grade_element . "+" . $date_delivered] - $daily_deliveries["OCC_E+" . $date_delivered];
                        } else {

                            echo "<td>" . round($daily_actual[$grade_element . "+" . $date_delivered], 0) . "</td>";

                            $total_actual+=$daily_actual[$grade_element . "+" . $date_delivered];
                        }
                    } else {

                        echo "<td>0</td>";
                    }
                }

                $tot = $total_actual;

                echo "<td id='TOTAL'>" . round($total_actual, 0) . "</td>";

                echo "</tr>";

                $total_actual_final+=$total_actual;
            }

            echo "<tr id='total'>";

            echo "<td>!TOTAL!</td>";

            foreach ($grades_array as $grade_element) {

                $total_on_grade = 0;



                foreach ($array_of_dates as $date) {

                    if (!empty($daily_actual[$grade_element . "+" . $date])) {

                        $total_on_grade+=$daily_actual[$grade_element . "+" . $date];

                        if ($grade_element == 'ONP') {

                            $total_on_grade += $daily_actual["NPB+" . $date];

                            $total_on_grade += $daily_actual["OPD+" . $date];
                        }

                        if ($grade_element == 'MW') {

                            $total_on_grade += $daily_actual["MW_S+" . $date];

                            $total_on_grade += $daily_actual["MW-PPQ+" . $date];
                        }

                        if ($grade_element == 'OCC') {

                            $total_on_grade -= $daily_actual["OCC_E+" . $date];
                        }

                        $total_on_grade;
                    }
                }

                echo "<td>" . $grade = round($total_on_grade, 0) . "</td>";

                $tots += $grade;
            }

            echo "<td>" . round($tots) . "</td>";

            echo "</tr>";

            echo "</tr>";
            ?>







        </table>

    </div>

</div>



<!-- Daily Incoming -->





<div class="grid_5">

    <div class="box round first">

        <h2>Daily Incoming</h2>

        <table class="data display datatable" id="example">

            <thead>



                <?php
                echo "<th>Date</th>";

                foreach ($grades_array as $wp_grade) {

                    echo "<th>$wp_grade</th>";
                }

                echo "<th>TOTAL</th>";
                ?>

            </thead>

            <?php
            $total_receiving_final = 0;

            foreach ($array_of_dates as $date_delivered) {

                $total_receiving = 0;

                echo "<tr>";

                echo "<td>" . $date_delivered . "</td>";

                foreach ($grades_array as $grade_element) {

                    if (!empty($daily_deliveries[$grade_element . "+" . $date_delivered])) {

                        if ($grade_element == 'MW') {

                            echo "<td>" . round($daily_deliveries[$grade_element . "+" . $date_delivered] + $daily_deliveries["MW-PPQ+" . $date_delivered] + $daily_deliveries["AP_K+" . $date_delivered] + $daily_deliveries["MW_S+" . $date_delivered], 0) . "</td>";

                            $total_receiving+=$daily_deliveries[$grade_element . "+" . $date_delivered] + $daily_deliveries["MW-PPQ+" . $date_delivered] + $daily_deliveries["AP_K+" . $date_delivered] + $daily_deliveries["MW_S+" . $date_delivered];
                        } else if ($grade_element == 'ONP') {

                            echo "<td>" . round($daily_deliveries[$grade_element . "+" . $date_delivered] + $daily_deliveries["OPD+" . $date_delivered] + $daily_deliveries["NPB+" . $date_delivered], 0) . "</td>";

                            $total_receiving+=$daily_deliveries[$grade_element . "+" . $date_delivered] + $daily_deliveries["OPD+" . $date_delivered] + $daily_deliveries["NPB+" . $date_delivered];
                        } else if ($grade_element == 'OCC') {

                            echo "<td>" . round($daily_deliveries[$grade_element . "+" . $date_delivered] + $daily_deliveries["OCC_E+" . $date_delivered], 0) . "</td>";

                            $total_receiving+=$daily_deliveries[$grade_element . "+" . $date_delivered] + $daily_deliveries["OCC_E+" . $date_delivered];
                        } else {

                            echo "<td>" . round($daily_deliveries[$grade_element . "+" . $date_delivered], 0) . "</td>";

                            $total_receiving+=$daily_deliveries[$grade_element . "+" . $date_delivered];
                        }
                    } else {

                        echo "<td>0</td>";
                    }
                }

                echo "<td id='TOTAL'>" . round($total_receiving, 0) . "</td>";

                echo "</tr>";

                $total_receiving_final+=$total_receiving;
            }

            echo "<tr id='total'>";

            echo "<td>!TOTAL!</td>";

            foreach ($grades_array as $grade_element) {

                $total_on_grade = 0;

                foreach ($array_of_dates as $date) {

                    if (!empty($daily_deliveries[$grade_element . "+" . $date])) {

                        $total_on_grade+=$daily_deliveries[$grade_element . "+" . $date];
                    }
                }

                echo "<td>" . round($total_on_grade, 0) . "</td>";
            }

            echo "<td>" . round($total_receiving_final, 0) . "</td>";

            echo "</tr>";

            echo "</tr>";
            ?>







        </table>



    </div>

</div>













<div class="clear">



</div>







<div class="clear">



</div>

