<?php
include("templates/template.php");
$wp_array=array();
$branch='';

if($branch=='all') {
    $branch='';
}

include("config.php");

$query="SELECT wp_grade  from actual where branch like '%$branch%' group by wp_grade ";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    $wp_grade=$row['wp_grade'];
    array_push($wp_array,trim($wp_grade));
}


/*
$query="SELECT wp_grade  from month_end_loose where branch like '%$branch%'  group by wp_grade ";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    $wp_grade=$row['wp_grade'];
    array_push($wp_array,trim($wp_grade));
}
*/

/*
$query="SELECT wp_grade  from outgoing  where (branch like '%$branch%' and type!='OTHER-SALES') and str!='VOID' group by wp_grade ";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    array_push($wp_array,trim($row['wp_grade']));
}
*/
$query="SELECT wp_grade from sup_deliveries where branch_delivered like '%$branch%'  group by wp_grade ";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    $wp_grade=trim($row['wp_grade']);
    if (strpos($wp_grade,'LC') !== true ) {
        $wp_grade="LC".$wp_grade;
    }
    $wp_grade=strtoupper($wp_grade);
    array_push($wp_array,trim($wp_grade));

}


$query="SELECT wp_grade from bales where branch like '%$branch%'  group by wp_grade ";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    $wp_grade=trim($row['wp_grade']);
    if (strpos($wp_grade,'LC') !== true ) {
        $wp_grade="LC".$wp_grade;
    }
    $wp_grade=strtoupper($wp_grade);
    array_push($wp_array,trim($wp_grade));

}
array_push($wp_array,trim('CHIPBOARD'));
$wp_array=array_diff($wp_array, array("LCCHIPBOARD"));
$wp_array=array_diff($wp_array, array("LCLCWL"));
$wp_array=array_diff($wp_array, array("LCCB"));
$wp_array=array_diff($wp_array, array("LC"));
$wp_array=array_diff($wp_array, array("LCVOID"));
$wp_array=array_diff($wp_array, array("LCCORETUBE"));
$wp_array=array_diff($wp_array, array("LCFB"));
$wp_array=array_diff($wp_array, array("LCFE"));
$wp_array=array_diff($wp_array, array("LCOIC"));
$wp_array=array_diff($wp_array, array("LCSP"));
$wp_array=array_diff($wp_array, array("LCPENDING"));
$wp_array=array_diff($wp_array, array("0"));
$wp_array=array_unique($wp_array);

?>
<style>
    td{
        background-color:#FFEBD6;
        border-style: solid;

        font-size:12px;
    }
    th{
        border-style: solid;

        font-size:12px;
    }
    #positive{
        color:blue;
    }
    #negative{
        color:red;
    }
    table{
    }
    #total{
        background-color: yellow;
        font-weight: bold;
    }
</style>
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
<body>
    <div class="grid_3">
        <div class="box round first grid">
            <h2>Filtering Options </h2>
            <form action="filter_analysis.php" method="POST">
                Pick a month: <input type='text'  id='inputField' name='from' value="" onfocus='date1(this.id);' readonly><br>
                <input type='hidden'  id='inputField2' name='to' value="" onfocus='date1(this.id);' readonly><br>
                <input type="submit" value="Filter">
            </form>
            <a href="clear_analysis.php"><button>Clear Filter</button></a>
        </div>
    </div>
    <div class="grid_10">
        <div class="box round first grid">
            <table class="data display datatable" id="example">
                <?php
                $from=$_SESSION['analysis_from'];
                $specific_day=$from;
                $to=$_SESSION['analysis_to'];
                echo "<thead>";
                echo "<th>WP GRADE</th>";
                echo "<th>BEG INV</th>";
                echo "<th>RECEIVING</th>";
                echo "<th>PICK-UP</th>";
                echo "<th>OUTGOING</th>";
                echo "<th>RECORD</th>";
                echo "<th>ACTUAL</th>";
                echo "<th>VARIANCE</th>";
                echo "<th>AVG. COST</th>";
                echo "<th>AMT. LOSS/GAIN</th>";
                echo "<th>TS DIFF.</th>";
                echo "<th>ACTUAL BALES.</th>";
                echo "</thead>";
                $ngayon=date('F d, Y');
                if($from=='') {
                    $month=date('Y/m');
                    $current_date=date('Y/m/d');
                    $last_1st_day=date("Y/m/d", mktime(0,0,0, date("m")-1, 1, date("Y")));
                    $last_last_day=date("Y/m/t", strtotime($last_1st_day));
                    $last_month= date("Y/m", strtotime($last_1st_day));
                }else {
                    $month=date("Y/m", strtotime($from));
                    $current_date=date("Y/m/d", strtotime($from));
                    $filter_from=preg_split("[/]",$current_date);
                    $filter_month=$filter_from[1];
                    $filter_year=$filter_from[0];
                    $last_1st_day=date("Y/m/d", mktime(0,0,0, date($filter_month)-1, 1, date($filter_year)));
                    $last_last_day=date("Y/m/t", strtotime($last_1st_day));
                    $last_month= date("Y/m", strtotime($last_1st_day));

                }

                if($from=='') {
                    echo "<h2> CONSOLIDATED Inventory Analysis as of : <u><b><i>".$ngayon."</i></b></u></h2>";
                }else {


                    echo "<h2> CONSOLIDATED Inventory Analysis as of: <u><b><i>". date("F d, Y", strtotime($from))
                            ."</i></b></u></h2>";
                }
                $total_beg=0;
                $total_receive=0;
                $total_outgoing=0;
                $total_record=0;
                $total_actual=0;
                $total_variance=0;
                $total_avg_cost=0;
                $total_amt_loss_gain=0;
                $total_ts_diff=0;
                $total_bales=0;
                $total_pick_up=0;


                foreach($wp_array as $wp_grade) {
                    echo "<tr>";
                    echo "<td>";


                    echo $wp_grade;
                    echo "</td>";
                    echo "<td>";
                    $beg_iv='';
                    if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB') {
                        $wp_grade2= substr($wp_grade, 2);
                        $query20="SELECT sum(bale_weight) from bales where wp_grade='$wp_grade2' and (date like '%$last_month%'  )  and ((out_date > '$last_last_day'  or out_date < '$last_1st_day' or out_date='')) and (date_rebaled > '$last_last_day' or date_rebaled < '$last_1st_day' or date_rebaled='') group by wp_grade";
                    }else {
                        if($wp_grade=='LCWL') {
                            $query20="SELECT sum(bale_weight) from bales where wp_grade='LCWL'  and (date like '%$last_month%'  ) and  ((out_date > '$last_last_day' or out_date < '$last_1st_day' or out_date='' )) and (date_rebaled > '$last_last_day' or date_rebaled < '$last_1st_day' or date_rebaled='') group by wp_grade";
                        } else if($wp_grade=='CHIPBOARD' || $wp_grade=='LCCB') {
                            $query20="SELECT sum(bale_weight) from bales where (wp_grade='CHIPBOARD' or wp_grade='cb') and (date like '%$last_month%' ) and  ((out_date > '$last_last_day' or out_date < '$last_1st_day' ))  and (date_rebaled > '$last_last_day' or date_rebaled < '$last_1st_day' or date_rebaled='') group by wp_grade";
                        }
                    }


                    if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB') {

                        $query21="SELECT sum(weight) from month_end_loose where wp_grade='$wp_grade'  and month_end_date='$last_month' ";
                    }else {
                        if($wp_grade=='LCWL') {
                            $query21="SELECT sum(weight) from month_end_loose where wp_grade='LCWL' and month_end_date='$last_month' ";
                        } else if($wp_grade=='CHIPBOARD' || $wp_grade=='LCCB') {
                            $query21="SELECT sum(weight) from month_end_loose where  (wp_grade='CHIPBOARD' or wp_grade='cb')  and month_end_date='$last_month'";
                        }
                    }
                    $result21=mysql_query($query21);
                    $month_end_loose_weight=0;
                    if($row21 = mysql_fetch_array($result21)) {
                        $month_end_loose_weight=$row21['sum(weight)'];

                    }


                    $result20=mysql_query($query20);
                    $beg_iv=0;
                    if($row20 = mysql_fetch_array($result20)) {
                        $beg_iv=$row20['sum(bale_weight)'];

                    }
                    $beg_iv=$beg_iv+$month_end_loose_weight;
                    echo  number_format($beg_iv,2);
                    $total_beg+=$beg_iv;
                    echo "</td>";
                    echo "<td>";
                    if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB'  &&  $wp_grade  != 'chipboard' ) {
                        if($wp_grade =='LCMW') {
                            $query="SELECT wp_grade,sum(weight) from sup_deliveries where date_delivered like '%$month%'  and (wp_grade='$wp_grade2' or wp_grade='coretube') group by wp_grade";
                        }else {
                            $query="SELECT wp_grade,sum(weight) from sup_deliveries where date_delivered like '%$month%'  and wp_grade='$wp_grade2' group by wp_grade";

                        }

                    }else {
                        if($wp_grade=='CHIPBOARD' || $wp_grade=='LCCB'  || $wp_grade =='chipboard') {
                            $query="SELECT wp_grade,sum(weight) from sup_deliveries where date_delivered like '%$month%'   and (wp_grade='cb' or wp_grade='chipboard' or wp_grade='CHIPBOARD') group by wp_grade";
                        }else {
                            $query="SELECT wp_grade,sum(weight) from sup_deliveries where date_delivered like '%$month%'  and wp_grade='LCWL' group by wp_grade";
                        }
                    }
                    $result=mysql_query($query);
                    $receiving=0;
                    while($row = mysql_fetch_array($result)) {
                        $receiving+=$row['sum(weight)'];
                    }


                    echo number_format($receiving,2);
                    $total_receive+=$receiving;
                    echo "</td>";



                    echo "<td>";

                    if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB'  &&  $wp_grade  != 'chipboard' ) {

                        if($wp_grade =='LCMW') {
                            $query="SELECT wp_grade,sum(net_weight) from pick_up where date like '%$month%'  and (wp_grade='$wp_grade2' or wp_grade='coretube')  group by wp_grade";
                        }else {
                            $query="SELECT wp_grade,sum(net_weight) from pick_up where date like '%$month%'  and wp_grade='$wp_grade2'   group by wp_grade";

                        }

                    }else {
                        if($wp_grade=='CHIPBOARD' || $wp_grade=='LCCB'  || $wp_grade =='chipboard') {
                            $query="SELECT wp_grade,sum(net_weight) from pick_up where date like '%$month%'   and (wp_grade='cb' or wp_grade='chipboard' or wp_grade='CHIPBOARD')  group by wp_grade";
                        }else {
                            $query="SELECT wp_grade,sum(net_weight) from pick_up where date like '%$month%'  and wp_grade='LCWL'  group by wp_grade";
                        }
                    }


                    $result=mysql_query($query);
                    $pick_up=0;
                    while($row = mysql_fetch_array($result)) {
                        $pick_up+=$row['sum(net_weight)'];
                    }


                    echo number_format($pick_up,2);
                    $total_pick_up+=$pick_up;



                    echo "</td>";










                    echo "<td>";
                    if ($wp_grade!='chipboard'  &&  $wp_grade!='cb') {
                        $query2="SELECT wp_grade,sum(weight) from outgoing where date like '%$month%'   and wp_grade='$wp_grade' group by wp_grade";
                    }else if ($wp_grade =='chipboard' || $wp_grade ='cb') {
                        $query2="SELECT wp_grade,sum(weight) from outgoing where date like '%$month%'  and wp_grade='chipboard'  or wp_grade ='cb' group by wp_grade";

                    }
                    $result2=mysql_query($query2);
                    $outgoing=0;
                    while($row2 = mysql_fetch_array($result2)) {
                        $outgoing+= $row2['sum(weight)'];
                    }
                    echo number_format($outgoing,2);

                    $total_outgoing+=$outgoing;
                    echo "</td>";
                    $record=(($beg_iv+$receiving+$pick_up)-$outgoing);

                    echo "<td>";

                    if($record > 0) {
                        echo "<span id='positive'>".number_format($record,2)."</span>";
                    }else if($record<0) {

                        echo "<span id='negative'>(".number_format($record*-1,2).")</span>";

                    }else {
                        echo "<span id=''>".number_format($record,2)."</span>";
                    }

                    echo "</td>";

                    $total_record+=$record;
                    echo "<td>";
                    $first_day_of_the_month=$month."/01";
                    $last_day_of_the_month=date("Y/m/t",strtotime($month."/01"));
                    if($from =='') {
                        if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB') {
                            $query3="SELECT wp_grade,sum(bale_weight) from bales where     wp_grade='$wp_grade2'   and str_no=0  and wp_grade!='VOID' AND str_no NOT LIKE  '%DR%'  and status !='rebaled'  group by wp_grade";
                        }else {
                            if($wp_grade=='CHIPBOARD'  || $wp_grade=='LCCB') {
                                $query3="SELECT wp_grade,sum(bale_weight) from bales where   (wp_grade='cb' or wp_grade='chipboard')  and str_no =0   and wp_grade!='VOID' AND str_no NOT LIKE  '%DR%'  and status !='rebaled'  group by wp_grade";
                            }else {
                                $query3="SELECT wp_grade,sum(bale_weight) from bales where   wp_grade='LCWL' and str_no =0    and wp_grade!='VOID'   AND str_no NOT LIKE  '%DR%'  and status !='rebaled'  group by wp_grade";
                            }
                        }
                    }else {

                        if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB') {
                            $query3="SELECT wp_grade,sum(bale_weight) from bales where date like '%$month%'  and wp_grade='$wp_grade2'   and str_no!='VOID'  and  (out_date > '$last_day_of_the_month' or out_date < '$first_day_of_the_month' or out_date=''  )    and (date_rebaled > '$last_day_of_the_month' or date_rebaled < '$first_day_of_the_month' or date_rebaled='')   group by wp_grade";
                        }else {
                            if($wp_grade=='CHIPBOARD'  || $wp_grade=='LCCB') {
                                $query3="SELECT wp_grade,sum(bale_weight) from bales where date like '%$month%'   and (wp_grade='cb' or wp_grade='chipboard')   and str_no!='VOID'  and  ((out_date > '$last_day_of_the_month' or out_date < '$first_day_of_the_month' or out_date='' ))   and (date_rebaled > '$last_day_of_the_month' or date_rebaled < '$first_day_of_the_month' or date_rebaled='')    group by wp_grade";
                            }else {
                                $query3="SELECT wp_grade,sum(bale_weight) from bales where date like '%$month%'  and wp_grade='LCWL'   and str_no!='VOID'  and  ((out_date > '$last_day_of_the_month' or out_date < '$first_day_of_the_month' or out_date='' ))   and (date_rebaled > '$last_day_of_the_month' or date_rebaled < '$first_day_of_the_month' or date_rebaled='')   group by wp_grade";
                            }
                        }
                    }
                    $result3=mysql_query($query3);
                    $actual=0;
                    $loose=0;
                    if($row3= mysql_fetch_array($result3)) {
                    }
                    $date=date('Y/m/d');
                    if($from=='') {
                        $query10="SELECT weight FROM loose_papers where date='$date' and wp_grade='$wp_grade' " ;
                    }else {
                        $query10="SELECT weight  FROM loose_papers where date='$specific_day' and wp_grade='$wp_grade'" ;
                    }
                    $result10=mysql_query($query10);
                    if($row10= mysql_fetch_array($result10)) {
                        $loose=$row10['weight'];
                    }
                    if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB') {
                        $query22="SELECT sum(weight) from month_end_loose where wp_grade='$wp_grade'  and month_end_date='$month' ";
                    }else {
                        if($wp_grade=='LCWL') {
                            $query22="SELECT sum(weight)  from month_end_loose where wp_grade='LCWL'  and month_end_date='$month'";
                        } else if($wp_grade=='CHIPBOARD' || $wp_grade=='LCCB') {
                            $query22="SELECT sum(weight)  from month_end_loose where  (wp_grade='CHIPBOARD' or wp_grade='cb') and month_end_date='$month' ";
                        }
                    }
                    $actual_loose_weight=0;
                    $result22=mysql_query($query22);
                    if($row22 = mysql_fetch_array($result22)) {
                        $actual_loose_weight=$row22['sum(weight)'];

                    }
                    $actual= $row3['sum(bale_weight)']+$loose+$actual_loose_weight;

                    echo number_format($actual,2);



                    $total_actual+=$actual;
                    echo "</td>";
                    echo "<td id='variance'>";
                    $variance=($actual-(+$record));
                    $variance_number=$variance;
                    $total_variance+=$variance;
                    if($variance <0) {

                        echo "<span id='negative'>(".number_format($variance_number *-1,2).")</span>";

                    }else if($variance==0) {
                        echo number_format($variance_number,2);
                    }else {
                        echo "<span id='positive'>".number_format($variance_number,2)."</span>";
                    }


                    echo "</td>";
                    echo "<td>";
                    if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB') {

                        $query3="SELECT AVG(cost) FROM buying_cost where  month='$month' and wp_grade='$wp_grade' ";
                    }else {
                        if($wp_grade=='CHIPBOARD'  || $wp_grade=='LCCB') {
                            $query3="SELECT AVG(cost) FROM buying_cost where month='$month' and wp_grade='CHIPBOARD' ";

                        }else {
                            $query3="SELECT AVG(cost) FROM buying_cost where month='$month' and wp_grade='LCWL' ";
                        }
                    }
                    $result3=mysql_query($query3);
                    $avg_cost=0;
                    if($row3= mysql_fetch_array($result3)) {
                        $avg_cost=$row3['AVG(cost)'];
                        echo number_format($avg_cost,2);
                    }else {
                        echo number_format($avg_cost,2);
                    }
                    $total_avg_cost+=$avg_cost;
                    echo "</td>";
                    echo "<td>";
                    $amt_loss_gain=$variance_number*$avg_cost;
                    $total_amt_loss_gain+=$amt_loss_gain;

                    if($amt_loss_gain<0) {

                        $amt_loss_gain="<span id='negative'>(".number_format($amt_loss_gain*-1,2).")</span>";

                        echo $amt_loss_gain;

                    }else if($amt_loss_gain==0) {
                        echo number_format($amt_loss_gain,2);

                    }
                    else if($amt_loss_gain>0) {

                        echo $amt_loss_gain="<span id='positive'>".number_format($amt_loss_gain,2)."</span>";

                    }

                    echo"</td>";
                    $ts_diff_branch=$branch;
                    if($branch=='Kaybiga') {
                        $ts_diff_branch='Novaliches';
                    }
                    if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB') {

                        $query5="SELECT actual.wp_grade as actual_grade,outgoing.wp_grade as outgoing_grade,actual.log_id as actual_log,actual.weight as actual_weight, outgoing.log_id as outgoing_log, outgoing.weight as outgoing_weight FROM actual
                                JOIN outgoing
                                ON actual.wp_grade=outgoing.wp_grade where actual.wp_grade='$wp_grade' and actual.str_no=outgoing.str and actual.date like '%$month%' and outgoing.date like '%$month%'  and outgoing.str !='VOID'  group by outgoing.wp_grade;
                                ";

                    }else {
                        if($wp_grade=='CHIPBOARD'  || $wp_grade=='LCCB') {
                            $query5="SELECT actual.wp_grade as actual_grade,outgoing.wp_grade as outgoing_grade,actual.log_id as actual_log,actual.weight as actual_weight, outgoing.log_id as outgoing_log, outgoing.weight as outgoing_weight FROM actual
                                JOIN outgoing
                                ON actual.wp_grade=outgoing.wp_grade where (actual.wp_grade='LCCB' or actual.wp_grade='chipboard') and actual.str_no=outgoing.str and actual.date like '%$month%' and outgoing.date like '%$month%'    and outgoing.str !='VOID'  group by outgoing.wp_grade;
                                    ";

                        }else {
                            $query5="SELECT actual.wp_grade as actual_grade,outgoing.wp_grade as outgoing_grade,actual.log_id as actual_log,actual.weight as actual_weight, outgoing.log_id as outgoing_log, outgoing.weight as outgoing_weight FROM actual
                                JOIN outgoing
                                ON actual.wp_grade=outgoing.wp_grade where (actual.wp_grade='LCWL' or actual.wp_grade='chipboard') and actual.str_no=outgoing.str and actual.date like '%$month%' and outgoing.date like '%$month%'    and outgoing.str !='VOID'  group by outgoing.wp_grade;
                                    ";
                        }
                    }
                    echo "<td>";
                    $from_loc=0;
                    $corrected=0;
                    $ts_diff=0;
                    $result5=mysql_query($query5);
                    if($row5= mysql_fetch_array($result5)) {
                        $from_loc=$row5['outgoing_weight'];
                        $corrected= $row5['actual_weight'];
                        $ts_diff=$corrected-$from_loc;

                        $total_ts_diff+=$ts_diff;
                    }

                    if($ts_diff > 0) {
                        echo "<span id='positive'>".number_format($ts_diff,2)."</span>";
                    }else if($ts_diff<0) {

                        echo "<span id='negative'>(".number_format($ts_diff *-1,2).")</span>";

                    }else {
                        echo "<span id=''>".number_format($ts_diff,2)."</span>";
                    }


                    echo  "</td>";
                    echo "<td>";

                    if($from =='') {
                        if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB' && $wp_grade !='lccb' && $wp_grade !='CB' && $wp_grade !='chipboard' && $wp_grade !='cb' && $wp_grade !='lcwl') {
                            $query6="SELECT wp_grade,count(wp_grade) from bales where wp_grade='$wp_grade2'  and str_no=0  and str_no not like '%DR%'    and str_no!='VOID'  and status !='rebaled'   group by wp_grade";

                        }else if($wp_grade=='LCWL' || $wp_grade=='CHIPBOARD' || $wp_grade=='CB' || $wp_grade=='cb' || $wp_grade=='chipboard'  || $wp_grade=='lcwl' ) {
                            if($wp_grade=='chipboard' || $wp_grade=='cb' || $wp_grade=='CHIPBOARD'  || $wp_grade=='LCCB' ) {

                                $query6="SELECT wp_grade,count(wp_grade) from bales where (wp_grade='cb' or wp_grade='chipboard' or wp_grade ='CB' or wp_grade ='CHIPBOARD')    and str_no!='VOID'  and str_no not like '%DR%'   and str_no=0    and status !='rebaled'  group by wp_grade";
                            }else {

                                $query6="SELECT wp_grade,count(wp_grade) from bales where (wp_grade='LCWL' or wp_grade='lcwl')  and str_no=0 and str_no not like '%DR%'    and str_no!='VOID'  and status !='rebaled'  group by wp_grade";

                            }

                        }



                    }else {
                        if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB' && $wp_grade !='lccb' && $wp_grade !='CB') {
                            $query6="SELECT wp_grade,count(wp_grade) from bales where wp_grade='$wp_grade2' and  date like '%$month%' and ((out_date > '$last_day_of_the_month' or out_date < '$first_day_of_the_month' or out_date='' or str_no=0))    and status !='rebaled'  group by wp_grade";
                        }else {
                            if($wp_grade=='CHIPBOARD'  || $wp_grade=='LCCB' || $wp_grade =='chipboard' || $wp_grade =='cb') {

                                $query6="SELECT wp_grade,count(wp_grade) from bales where (wp_grade='cb' or wp_grade='chipboard' or wp_grade ='CB' or wp_grade='CHIPBOARD')  and  date like '%$month%' and ((out_date > '$last_day_of_the_month' or out_date < '$first_day_of_the_month' or out_date='' or str_no=0))  and str_no!='VOID'  and status !='rebaled'  group by wp_grade";
                            }else {
                                $query6="SELECT wp_grade,count(wp_grade) from bales where wp_grade='LCWL' and  date like '%$month%' and ((out_date > '$last_day_of_the_month' or out_date < '$first_day_of_the_month' or out_date='' or str_no=0))    and str_no!='VOID'   and status !='rebaled'  group by wp_grade";
                            }
                        }


                    }
                    $result6=mysql_query($query6);
                    $bale_count=0;
                    while($row6= mysql_fetch_array($result6)) {
                        $bale_count=$bale_count=$row6 ['count(wp_grade)'];
                    }
                    echo $bale_count;
                    $total_bales+=$bale_count;
                    echo
                    "</td>";

                    echo "</tr>";

                }

                echo "<tr id='total'>";
                echo "<td id='total'>z__TOTAL__z</td>";

                if($total_beg>0) {
                    echo "<td id='total'>".number_format($total_beg,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_beg*-1 ,2).")</td>";
                }

                if($total_receive>0) {
                    echo "<td id='total'>".number_format($total_receive,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_receive*-1 ,2).")</td>";
                }


                if($total_pick_up>0) {
                    echo "<td id='total'>".number_format($total_pick_up,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_pick_up*-1 ,2).")</td>";
                }

                if($total_outgoing>0) {
                    echo "<td id='total'>".number_format($total_outgoing,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_outgoing*-1 ,2).")</td>";
                }

                if($total_record>0) {
                    echo "<td id='total'>".number_format($total_record,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_record*-1 ,2).")</td>";
                }


                if($total_actual>0) {
                    echo "<td id='total'>".number_format($total_actual,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_actual*-1 ,2).")</td>";
                }



                if($total_variance>0) {
                    echo "<td id='total'>".number_format($total_variance,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_variance*-1 ,2).")</td>";
                }


                if($total_avg_cost>0) {
                    echo "<td id='total'>".number_format($total_avg_cost,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_avg_cost*-1 ,2).")</td>";
                }

                if($total_amt_loss_gain>0) {
                    echo "<td id='total'>".number_format($total_amt_loss_gain,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_amt_loss_gain*-1 ,2).")</td>";
                }
                if($total_ts_diff>0) {
                    echo "<td id='total'>".number_format($total_ts_diff,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_ts_diff*-1 ,2).")</td>";
                }

                if($total_bales>0) {
                    echo "<td id='total'>".number_format($total_bales,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_bales*-1 ,2).")</td>";
                }




                echo "</tr>";




                ?>
            </table>
            <a rel="facebox" href="frmEncodeAvgCost.php"><button> Encode Avg Buying Cost</button></a>
            <a rel="facebox" href="frmMonthlyLoose.php"><button> Encode Month End Loose</button></a>

            <a rel="facebox" href="formAdjustment.php"><button> Encode Daily Loose</button></a>
        </div>
    </div>


    <div class="grid_5">
        <div class="box round first grid">
            <h2>Daily Loose Update History</h2>
            <table class="data display datatable" id="example">
                <?php
                echo "<thead>";
                echo "<th>Log ID</th>";
                echo "<th>Date</th>";
                echo "<th>Wp Grade</th>";
                echo "<th>Weight</th>";
                echo "<th>Branch</th>";
                echo "<th></th>";
                echo "</thead>";
                $query="SELECT * from loose_papers where branch like '%$branch%' and date like '%$month%' order by log_id ";
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>".$row['log_id']."</td>";
                    echo "<td>".$row['date']."</td>";
                    echo "<td>".$row['wp_grade']."</td>";
                    echo "<td>".$row['weight']."</td>";
                    echo "<td>".$row['branch']."</td>";
                    echo "<td>";
                    echo "<a href='delete_daily_loose.php?log_id=".$row['log_id']." ' title='Click to delete' ><img src='icon/bura.png'></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <div class="grid_5">
        <div class="box round first grid">
            <h2>Monthly Inventory Loose Update History</h2>
            <table class="data display datatable" id="example">
                <?php
                echo "<thead>";
                echo "<th>Log ID</th>";
                echo "<th>Month</th>";
                echo "<th>Wp Grade</th>";
                echo "<th>Weight</th>";
                echo "<th>Branch</th>";
                echo "<th></th>";
                echo "</thead>";
                $query="SELECT * from month_end_loose where branch like '%$branch%'  order by log_id ";
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>".$row['log_id']."</td>";
                    $month_end_string=   $row['month_end_date']."/01";
                    echo "<td>". date("F", strtotime($month_end_string))."</td>";
                    echo "<td>".$row['wp_grade']."</td>";
                    echo "<td>".$row['weight']."</td>";
                    echo "<td>".$row['branch']."</td>";
                    echo "<td><a href='delete_monthly_loose.php?log_id=".$row['log_id']." ' title='Click to delete' ><img src='icon/bura.png'></a></td>";

                    echo "</tr>";
                }
                ?>



            </table>
        </div>
    </div>
    <div class="clear">

    </div>

    <div class="clear">

    </div>
</body>