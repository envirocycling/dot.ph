<script type='text/javascript' src='jquery-1.3.2.min.js'></script>
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
<script src="js_2/jquery-1.6.4.min.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>-->
<script src="js_2/setup.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>

<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"
        });
    };

</script>
<script src="js_2/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js_2/jquery-ui/jquery.ui.core.min.js"></script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage : 'src/loading.gif',
            closeImage   : 'src/closelabel.png'
        })
    })

</script>

<?php
include("config.php");
session_start();
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$wp_grade=$_GET['wp_grade'];

$breaker_date=$end_date;
$filtering_grade=$wp_grade;
$filtering_branch=$_GET['branch'];
$weekly_month=date("F", strtotime($breaker_date));
$weekly_year=date("Y", strtotime($breaker_date));
$ngayon=date("F d,Y", strtotime($breaker_date));
$current_day=date("d", strtotime($breaker_date));
$last_day_of_month=date("t", strtotime($breaker_date));
$week_for_comparison_total=0;
$current_week_total=0;
$last_week_total=0;
$average_prev_month_total=0;
$five_week_total_final=0;
$last_6_months_total=0;
$wp_array=array();
$supplier_array=array();
$deliveries_per_month=array();
$total_quota=0;
$total_perf=0;



?>

<style>
    .total{        background-color: yellow;        font-weight: bold;    }
    th{
        font-size: 9px;
    }
    #last_months_avg{
        font-weight: bold;
        background-color: #FFAB00;
    }
    #current_month{
        font-weight: bold;
        background-color: #FFC040;
    }
    button{
        border-style:hidden;
        background-color:transparent;
        font-size: 9px;
    }
    #weekly{
        background-color:#FFE6B2;
    }
    #TARGET{
        background-color:#FFEBC2;
        font-weight:bold;
    }
    #percentage{
        background-color:#FFF0D1;

    }
    td{
        background-color:#FFF5E0;
        font-size:9px;
    }
    #left_header{
        background-color:#FFFAF0;
        font-size: 9px;
    }
    #view_brkdwn{
        font-size: 9px;
    }
    #static_size{
        width:200px;
        height:50px;

    }
    #variance{
        font-weight:bold;
        background-color:#FF6840;
    }
    #price{
        background-color:#EBE0CC;
    }
    #price{
        background-color:#EBE0CC;
    }
    .quota{
        font-weight:bold;

    }
    .quota_percent:after{
        font-weight:bold;
        content:"%";

    }
</style>
<table class="data display datatable" id="example">
    <?php
    $total_array=array();
    $weeks_array=array();
    $months_array=array();
    $remarks_array=array();
    $final_week1_total=0;
    $final_week2_total=0;
    $final_week3_total=0;
    $final_week4_total=0;
    $final_week5_total=0;



    if($filtering_branch=='Sauyo/Kaybiga') {
        $query="SELECT date_delivered FROM sup_deliveries where  month_delivered='$weekly_month' and year_delivered='$weekly_year' group by  date_delivered";

    }else {
        $query="SELECT date_delivered FROM sup_deliveries where  month_delivered='$weekly_month' and year_delivered='$weekly_year'   group by  date_delivered";

    }
    $result=mysql_query($query);
    $day_counter=0;
    while($row = mysql_fetch_array($result)) {
        array_push($wp_array,$row['date_delivered']);
        $day_counter++;
    }


    $price_array=array();

    $query21="SELECT  unit_cost,supplier_id FROM paper_buying where  wp_grade = '$filtering_grade' and date_received >='$start_date' and date_received <='$breaker_date' and branch like '%$filtering_branch%' order by date_received asc;";
    $result21=mysql_query($query21);

    while($row21 = mysql_fetch_array($result21)) {
        $price_array[$row21['supplier_id']]=$row21['unit_cost'];

    }

    $remarks_start_date_array=preg_split("[/]",$start_date);
    $remarks_end_date_array=preg_split("[/]",$breaker_date);
    $remarks_start_date=$remarks_start_date_array[0]."/".$remarks_start_date_array[1];
    $remarks_end_date=$remarks_end_date_array[0]."/".$remarks_end_date_array[1];
    if($filtering_grade=='') {
        $query21="SELECT * FROM monthly_remarks where date>='$remarks_start_date' and date<='$remarks_end_date'   ";
    }else {
        $query21="SELECT * FROM monthly_remarks where date>='$remarks_start_date' and date<='$remarks_end_date'  and wp_grade = '$filtering_grade' ";

    }
    $result21=mysql_query($query21);
    while($row21 = mysql_fetch_array($result21)) {
        $remarks_array[$row21['supplier_id']]=$row21['remarks'];
    }
    if($filtering_branch=='Sauyo/Kaybiga') {
        $query="SELECT month_delivered,year_delivered FROM sup_deliveries where date_delivered >='$start_date' and date_delivered <='$breaker_date' and (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo') group by  month_delivered,year_delivered order by date_delivered";
    }else {
        $query="SELECT month_delivered,year_delivered FROM sup_deliveries where  date_delivered >='$start_date' and date_delivered <='$breaker_date'  and branch_delivered like '%".$filtering_branch."%' group by  year_delivered,month_delivered order by date_delivered";
    }
    $supplier_details_array=array();
    $query40=" select * from supplier_details where status !='inactive'" ;
    $result40=mysql_query($query40);
    while($row40 = mysql_fetch_array($result40)) {
        $supplier_details_array[$row40['supplier_id']]=($row40['supplier_name']."+".$row40['branch']."+".$row40['style']."+".$row40['description']);
    }

    $result=mysql_query($query);

    $month_counter=0;


    $last_month=0;
    while($row = mysql_fetch_array($result)) {
        $buwan=$row['month_delivered']."-".$row['year_delivered'];
        if($buwan==(date("F-Y",strtotime($breaker_date)))) {
            // $avg_column=date("M-y",strtotime($start_date))."-".date("M-y",strtotime($breaker_date . ' - 1 month'))."  AVG";
            $avg_column='Last 6 Mos AVG';
            array_push($weeks_array,$avg_column);
            array_push($weeks_array,$buwan);
        }else {
            array_push($weeks_array,$buwan);
        }

        array_push($months_array,$row['month_delivered']."-".$row['year_delivered']);
        $month_counter++;
    }

    $months_array2=$months_array;
    array_pop($months_array2);
    $last_month=array_pop($months_array2);
    $month_counter=($month_counter-1);

    $current_month_total=0;

    if($filtering_branch=='Sauyo/Kaybiga') {
        $query5="SELECT sum(weight),month_delivered,supplier_details.supplier_id as supplier_id,date_delivered,year_delivered from sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where   date_delivered >='$start_date' and  date_delivered <='$breaker_date' and wp_grade like '%".$filtering_grade."%' and (supplier_details.branch ='Kaybiga' or supplier_details.branch ='Sauyo') and supplier_details.status!='inactive' group by  supplier_details.supplier_id,month_delivered,year_delivered order by date_delivered";
    }else {
        $query5="SELECT sum(weight),month_delivered,supplier_details.supplier_id as supplier_id,date_delivered,year_delivered from sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where    date_delivered >='$start_date' and date_delivered <='$breaker_date' and wp_grade like '%".$filtering_grade."%' and supplier_details.branch like '%".$filtering_branch."%' and supplier_details.status!='inactive' group by  supplier_details.supplier_id,month_delivered,year_delivered order by date_delivered";
    }
    $result5 =mysql_query($query5);
    while($row5 = mysql_fetch_array($result5)) {
        $deliveries_per_month[$row5['supplier_id']."+".ucfirst(strtolower($row5['month_delivered']))."-".$row5['year_delivered']]=(($row5['sum(weight)'])/1000);
    }

    $supplier_head_count=0;
    $quota_array=array();
    $total_quota=0;
    $query40="SELECT incentive_scheme.sup_id as sup_id,incentive_scheme.quota as quota,start_date as start_date,end_date ,wp_grade,sup_id,incentive_scheme.scheme as scheme from incentive_scheme where incentive_scheme.remarks ='' and incentive_scheme.wp_grade like '%$filtering_grade%'" ;
    $result40=mysql_query($query40);
    while($row40 = mysql_fetch_array($result40)) {
        $query41="SELECT sum(weight) from sup_deliveries where  date_delivered >= '".$row40['start_date']."' and date_delivered <='".$row40['end_date']."' and wp_grade='".$row40['wp_grade']."' and supplier_id='".$row40['sup_id']."' " ;
        $result41=mysql_query($query41);
        $quota_tonnage=0;
        while($row41 = mysql_fetch_array($result41)) {
            $quota_tonnage=$row41['sum(weight)'];
            $quota_tonnage=$quota_tonnage/1000;
        }
        $quota_array[$row40['sup_id']]=($row40['quota']/1000)."-".$quota_tonnage."-".$row40['scheme'];
    }

    echo "<thead>";
    echo "<th>ID</th>";

    echo "<th>Supplier Name</th>";
    echo "<th>Branch Registered</th>";
    echo "<th>Character</th>";
    //   echo "<th>Desc</th>";
    array_pop($months_array);
    array_push($weeks_array,"VAR on Expctd Perf");
    array_push($weeks_array,"Week 1");
    array_push($weeks_array,"Week 2");
    array_push($weeks_array,"Week 3");
    array_push($weeks_array,"Week 4");
    array_push($weeks_array,"Week 5");
    foreach ($weeks_array as $value) {
        echo "<th>".$value."</th>";
    }
    echo "<th>Current Week VS Prev. Week</th>";
    echo "<th>Buying Price</th>";

    echo "<th>____Remarks____</th>";
    echo "</thead>";
    if($filtering_branch=='Sauyo/Kaybiga') {
        $query="SELECT supplier_id FROM supplier_details where status!='inactive' and (branch ='Kaybiga' or branch ='Sauyo') ";
    }else {
        $query="SELECT supplier_id FROM supplier_details where status!='inactive' and  branch like '%".$filtering_branch."%' ";
    }
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        array_push($supplier_array,$row['supplier_id']);
    }
    $supplier_array=array_unique($supplier_array);
    $deliveries_array =array();

    if(trim($filtering_grade)!='') {
        if($filtering_branch=='Sauyo/Kaybiga') {
            $query3="SELECT sup_deliveries.supplier_id as supplier_id,sum(weight),date_delivered,month_delivered FROM sup_deliveries  join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and month_delivered='$weekly_month' and year_delivered='$weekly_year' and wp_grade = '$filtering_grade' and   (supplier_details.branch ='Kaybiga' or supplier_details.branch ='Sauyo')  group by supplier_details.supplier_id,date_delivered";
        }else {
            $query3="SELECT sup_deliveries.supplier_id as supplier_id,sum(weight),date_delivered,month_delivered FROM sup_deliveries  join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and month_delivered='$weekly_month' and year_delivered='$weekly_year' and wp_grade = '$filtering_grade' and supplier_details.branch like '%".$filtering_branch."%' group by supplier_details.supplier_id,date_delivered";
        }

    }else {
        if($filtering_branch=='Sauyo/Kaybiga') {
            $query3="SELECT sup_deliveries.supplier_id as supplier_id,sum(weight),date_delivered,month_delivered FROM sup_deliveries  join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and month_delivered='$weekly_month' and year_delivered='$weekly_year'  and   (supplier_details.branch ='Kaybiga' or supplier_details.branch ='Sauyo') group by supplier_details.supplier_id,date_delivered";
        }else {
            $query3="SELECT sup_deliveries.supplier_id as supplier_id,sum(weight),date_delivered,month_delivered FROM sup_deliveries  join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and month_delivered='$weekly_month' and year_delivered='$weekly_year'  and supplier_details.branch like '%".$filtering_branch."%' group by supplier_details.supplier_id,date_delivered";
        }
    }

    $result3=mysql_query($query3);
    while($row3 = mysql_fetch_array($result3)) {

        $deliveries_array[$row3['supplier_id']."+".$row3['date_delivered']]=($row3['sum(weight)']);
    }


    $week1_total=0;
    $week2_total=0;
    $week3_total=0;
    $week4_total=0;
    $week5_total=0;
    $total_deliveries_all_supplier=0;
    foreach ($supplier_array as $value2) {
        $total_per_branch=0;
        echo "<tr class='data'>";
        if(!empty($supplier_details_array[$value2])) {
            $supplier_details= $supplier_details_array[$value2];
            $supplier_details=preg_split("/[+]/",$supplier_details);
            echo "<td id='' class='data' >".$value2."</td>";

            echo "<td id='left_header' >"."<a rel='facebox' href='view_delivery_brkdwn.php?sup_id=$value2 && year=".$weekly_year." && wp_grade=".$filtering_grade."' id='view_brkdwn' >".$supplier_details[0]."</a></td>";
            echo "<td id='left_header' >".$supplier_details[1]."</td>";

            if($supplier_details[2]!='') {
                echo "<td id='left_header'><button  value='".$value2."' onclick='editCharacter(this.value);'><u style='color:blue; font-size:10'><i>".$supplier_details[2]."</i></u></button></td>";
            }else {
                echo "<td id='left_header'><button  value='".$value2."' onclick='editCharacter(this.value);'><u style='color:blue; font-size:10'><i>edit</i></u></button></td>";
            }
            //   echo "<td id='left_header' >".$supplier_details[3]."</td>";

        }else {
            echo "<td id='' >".$value2."</td>";
            echo "<td id='left_header' >"."<a rel='facebox' href='view_delivery_brkdwn.php?sup_id=$value2 && year=".$weekly_year." && wp_grade=".$filtering_grade."' id='view_brkdwn' >UNKNOWN</a></td>";
            echo "<td id='left_header' ><i>Undefined</i></td>";
            echo "<td id='left_header' ><i>Undefined</i></td>";
            //     echo "<td id='left_header' ><i>Undefined</i></td>";

        }

        foreach($wp_array as $value) {
            $key_finder=$value2."+".$value;
            $seven_identifier=preg_split('[/]',$value);
            if($seven_identifier[2] %7 != 0) {
                if(!empty($deliveries_array[$key_finder])) {
                    if($seven_identifier[2]<7 ) {
                        $week1_total+= $deliveries_array[$key_finder];
                    }else if($seven_identifier[2]<14 && $seven_identifier[2]>7 ) {
                        $week2_total+= $deliveries_array[$key_finder];
                    }else if($seven_identifier[2]<21 && $seven_identifier[2]>14) {
                        $week3_total+= $deliveries_array[$key_finder];
                    }else if($seven_identifier[2]<28 && $seven_identifier[2]>21) {
                        $week4_total+= $deliveries_array[$key_finder];
                    }else if($seven_identifier[2]>28) {
                        $week5_total+= $deliveries_array[$key_finder];
                    }
                }else {
                }
            }else {
                if($seven_identifier[2]==7 ) {
                    if(!empty($deliveries_array[$key_finder])) {
                        $week1_total+= $deliveries_array[$key_finder];
                    }
                }
                if($seven_identifier[2]==14 ) {
                    if(!empty($deliveries_array[$key_finder])) {
                        $week2_total+= $deliveries_array[$key_finder];
                    }
                }
                if($seven_identifier[2]==21 ) {
                    if(!empty($deliveries_array[$key_finder])) {
                        $week3_total+= $deliveries_array[$key_finder];
                    }
                }
                if($seven_identifier[2]==28 ) {
                    if(!empty($deliveries_array[$key_finder])) {
                        $week4_total+= $deliveries_array[$key_finder];
                    }
                }
            }

        }
////////////////////////////////////////////////////////////////////////////////////////
        $total_deliveries_per_supplier=0;
        $week_for_comparision=0;
        $month_counter_for_average=$month_counter;
        $month_counter_for_average=$month_counter_for_average;
        $total_delivery_for_average=0;
        $average_divisor=0;
        foreach($months_array as $months) {
            $key_finder2=$value2."+".$months;
            $filtering_tool=$value2."_".$months;
            if(!empty($deliveries_per_month[$key_finder2])) {
                $end_of_the_month= date("Y/m/t", strtotime($months));
                $divider=((date("j", strtotime($end_of_the_month)))/7);
                echo "<td>".round(($deliveries_per_month[$key_finder2]),2)."</td>";
                $total_deliveries_per_supplier+=($deliveries_per_month[$key_finder2]);
                $total_deliveries_all_supplier+=($deliveries_per_month[$key_finder2]);
                if($months==$last_month) {
                    $week_for_comparision=($deliveries_per_month[$key_finder2]);
                }
                if($month_counter_for_average<=6) {
                    $total_delivery_for_average+=$deliveries_per_month[$key_finder2];
                    $average_divisor++;
                }
            }
            else {
                echo "<td></td>";
            }
            $month_counter_for_average--;
        }
        $week_for_comparison_total+=$week_for_comparision;
        $average_prev_month=0;
        $last_6_months=0;
        if($total_delivery_for_average>0) {
            echo "<td id='last_months_avg'>".round(($total_delivery_for_average/$average_divisor),2)."</td>";
            $last_6_months=round(($total_delivery_for_average/$average_divisor),2);
            $last_6_months_total+=round(($total_delivery_for_average/$average_divisor),2);
        }else {
            echo "<td id='last_months_avg'></td>";
        }
        $week1_total=($week1_total/1000);
        $week2_total=($week2_total/1000);
        $week3_total=($week3_total/1000);
        $week4_total=($week4_total/1000);
        $week5_total=($week5_total/1000);
        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////----Weekly Breakdown----/////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        $five_week_total=0;
        $five_week_total=($week1_total+$week2_total+$week3_total+$week4_total+$week5_total);
        $five_week_total_final+=$five_week_total;
        $current_month_divider=($day_counter/7);
        if ($five_week_total==0) {
            echo "<td id='current_month' ></td>";
        }else {
            echo "<td id='current_month'>".number_format(($five_week_total),2)."</td>";
            $current_month_total+=($five_week_total);
        }

        $day_percentage=$current_day/$last_day_of_month;
        if(round(($five_week_total)-($day_percentage*$last_6_months),2)==0) {
            echo "<td id='variance' ></td>";
        }else {
            echo "<td id='variance' >".round(($five_week_total)-($day_percentage*$last_6_months),2)."</td>";
        }
        if($week1_total==0) {
            echo "<td id='weekly'></td>";
        }else {
            echo "<td id='weekly'>".round($week1_total,2)."</td>";
        }
        $final_week1_total+=$week1_total;
        if($week2_total==0) {
            echo "<td id='weekly'></td>";
        }else {
            echo "<td id='weekly'>".round($week2_total,2)."</td>";
        }
        $final_week2_total+=$week2_total;
        if($week3_total==0) {
            echo "<td id='weekly'></td>";
        }else {
            echo "<td id='weekly'>".round($week3_total,2)."</td>";
        }
        $final_week3_total+=$week3_total;
        if($week4_total==0) {
            echo "<td id='weekly'></td>";
        }else {
            echo "<td id='weekly'>".round($week4_total,2)."</td>";
        }
        $final_week4_total+=$week4_total;
        if($week5_total==0) {
            echo "<td id='weekly'></td>";
        }else {
            echo "<td id='weekly'>".round($week5_total,2)."</td>";
        }
        $current_week=0;
        $last_week=0;
        if($week5_total>0) {
            $current_week=$week5_total;
            $last_week=$week4_total;
        }else if($week4_total>0) {
            $current_week=$week4_total;
            $last_week=$week3_total;
        }else if($week3_total>0) {
            $current_week=$week3_total;
            $last_week=$week2_total;
        }else if($week2_total>0) {
            $current_week=$week2_total;
            $last_week=$week1_total;
        }else if($week1_total>0) {
            $current_week=$week1_total;
        }
        $current_week_total+=$current_week;
        $last_week_total+=$last_week;
        $final_week5_total+=$week5_total;
        $week1_total=0;
        $week2_total=0;
        $week3_total=0;
        $week4_total=0;
        $week5_total=0;
        echo "<td  id='variance'>".round($current_week-$last_week,2)."</td>";
        if(!empty($price_array[$value2])) {
            echo "<td id='price'>";
            $price=$price_array[$value2];
            echo $price;
            echo "</div></td>";
        }else {
            echo "<td  id='price'></td>";
        }
        if(!empty($remarks_array[$value2])) {
            echo "<td><div style='overflow:scroll; overflow-x:hidden; width:350px;height:60px;'>";
            $remarks=$remarks_array[$value2];
            $comment_date_array=preg_split("[/]",$breaker_date);
            $remarks_param=$value2."_".$comment_date_array[1]."_".$comment_date_array[0];
            echo "  <a  rel='facebox' href='monthlyRemarks.php?id=$remarks_param' target='_blank'><u style='color:blue; font-size:10'><i>$remarks</i></u></a></td>";
            echo "</div>";
        }else {
            $comment_date_array=preg_split("[/]",$breaker_date);
            $remarks_param=$value2."_".$comment_date_array[1]."_".$comment_date_array[0];
            echo " <td>
              <a  rel='facebox' href='monthlyRemarks.php?id=$remarks_param' target='_blank'><u style='color:blue; font-size:10'><i>input</i></u></a> </td>";
        }
        echo "</tr>";
        $supplier_head_count++;
    }

    echo "<tr class='data'>";
    echo "<td class='TOTAL' >!TOTAL!</td>";
    echo "<td class='TOTAL' >Head Count: $supplier_head_count</td>";

    echo "<td class='TOTAL' ></td>";
    echo "<td class='TOTAL' ></td>";

    foreach($months_array as $var) {
        $total_date=preg_split("/[-]/",$var);
        $month=$total_date[0];
        $year=$total_date[1];
        if(trim($filtering_grade)!='') {
            if($filtering_branch=='Sauyo/Kaybiga') {
                $query31="SELECT sum(weight)/1000 as weight, month_delivered,year_delivered,date_delivered FROM sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and wp_grade='".$filtering_grade."' and year_delivered='$year' and month_delivered ='$month'  and   (supplier_details.branch ='Kaybiga' or supplier_details.branch ='Sauyo')  ";
            }else {
                $query31="SELECT sum(weight)/1000 as weight, month_delivered,year_delivered,date_delivered FROM sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and   wp_grade='".$filtering_grade."' and year_delivered='$year' and month_delivered ='$month' and supplier_details.branch like '%".$filtering_branch."%'  ";
            }
        }else {
            if($filtering_branch=='Sauyo/Kaybiga') {
                $query31="SELECT sum(weight)/1000 as weight, month_delivered,year_delivered,date_delivered FROM sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and  year_delivered='".$year."' and month_delivered ='$month' and (supplier_details.branch ='Kaybiga' or supplier_details.branch ='Sauyo') ";
            }else {
                $query31="SELECT sum(weight)/1000 as weight, month_delivered,year_delivered,date_delivered FROM sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and  year_delivered='".$year."' and month_delivered ='$month'   and supplier_details.branch like '%".$filtering_branch."%'  ";
            }
        }
        $result31=mysql_query($query31);
        if($row31 = mysql_fetch_array($result31)) {
            $end_of_the_month= date("Y/m/t", strtotime($row31['date_delivered']));
            $divider=((date("j", strtotime($end_of_the_month)))/7);
            echo "<td class='TOTAL' >".round(($row31['weight']),2)."</td>";
        }else {
            echo "<td class='TOTAL' ></td>";
        }
    }
    echo "<td id='last_months_avg' >".round($last_6_months_total,2)."</td>";
    echo "<td id='current_month' >".round($current_month_total,2)."</td>";
    echo "<td id='variance' >".round(($current_month_total)-($last_6_months_total*$day_percentage),2)."</td>";
    echo "<td class='TOTAL' >".round($final_week1_total,2)."</td>";
    echo "<td class='TOTAL' >".round($final_week2_total,2)."</td>";
    echo "<td class='TOTAL' >".round($final_week3_total,2)."</td>";
    echo "<td class='TOTAL' >".round($final_week4_total,2)."</td>";
    echo "<td class='TOTAL' >".round($final_week5_total,2)."</td>";

    if($final_week5_total>0) {
        echo "<td id='variance' >".round($final_week5_total-$final_week4_total,2)."</td>";
    }else if($final_week5_total>0) {
        echo "<td id='variance' >".round($final_week4_total-$final_week3_total,2)."</td>";
    }else if($final_week3_total>0) {
        echo "<td id='variance' >".round($final_week3_total-$final_week2_total,2)."</td>";
    }else if($final_week2_total>0) {
        echo "<td id='variance' >".round($final_week2_total-$final_week1_total,2)."</td>";
    }else {
        echo "<td id='variance' >0</td>";
    }

    echo "<td class='TOTAL' ></td>";


    echo "<td class='TOTAL' ></td>";
    
    ?>
</table>