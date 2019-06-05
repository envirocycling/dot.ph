<?php
include("templates/template.php");
$wp_array=array();
$branch=$_SESSION['selected_branch'];

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

$query="SELECT wp_grade  from month_end_loose where branch like '%$branch%'  group by wp_grade ";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    $wp_grade=$row['wp_grade'];
    array_push($wp_array,trim($wp_grade));
}



$query="SELECT wp_grade  from outgoing  where branch like '%$branch%' group by wp_grade ";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    array_push($wp_array,trim($row['wp_grade']));
}

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

                $total_beg=0;
                $total_receiving=0;
                $total_pick_up=0;
                $total_outgoing=0;
                $total_adjustment=0;
                $total_sorted=0;
                $total_ideal=0;
                $total_actual=0;
                $total_variance=0;
                $total_avg_cost=0;
                $total_amt_loss_gain=0;












                $from=$_SESSION['analysis_from'];
                $specific_day=$from;
                $to=$_SESSION['analysis_to'];
                echo "<thead>";
                echo "<th>WP GRADE</th>";
                echo "<th>BEG INV</th>";
                echo "<th>RECEIVING</th>";
                echo "<th>PICK-UP</th>";
                echo "<th>OUTGOING</th>";
                echo "<th>ADJUSTMENT</th>";
                echo "<th>SORTED</th>";
                echo "<th>IDEAL</th>";
                echo "<th>Actual</th>";
                echo "<th>VARIANCE</th>";
                echo "<th>AVG. COST</th>";
                echo "<th>AMT LOSS/GAIN</th>";
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
                    echo "<h2> ".$_SESSION['selected_branch']." Inventory Analysis as of : <u><b><i>".$ngayon."</i></b></u></h2>";
                }else {


                    echo "<h2> ".$_SESSION['selected_branch']." Inventory Analysis as of: <u><b><i>". date("F d, Y", strtotime($from))
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


                foreach($wp_array as $wp_grade) {

                    if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB') {
                        $wp_grade2= substr($wp_grade, 2);
                    }else {
                        $wp_grade2=$wp_grade;
                    }




                    echo "<tr>";
                    echo "<td>";
                    echo $wp_grade;
                    echo "</td>";
                    echo "<td>";
                    $beg_iv=0;



                    $query21="SELECT weight from month_end_loose where wp_grade='$wp_grade' and branch like '%$branch%' and month_end_date='$last_month' order by log_id desc limit 1";


                    $result21=mysql_query($query21);
                    $month_end_loose_weight=0;
                    if($row21 = mysql_fetch_array($result21)) {
                        $month_end_loose_weight=$row21['weight'];

                    }

                    $beg_iv=$month_end_loose_weight;
                    $total_beg=$total_beg+$month_end_loose_weight;


                    echo  number_format($beg_iv,2);

                    echo "</td>";
                    echo "<td>";
                    if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD'  && $wp_grade!='LCCB'  &&  $wp_grade  != 'chipboard' ) {
                        $query="SELECT wp_grade,sum(weight) from sup_deliveries where date_delivered like '%$month%' and  branch_delivered like '%$branch%'  and wp_grade='$wp_grade2' group by wp_grade";
                    }else {
                        if($wp_grade=='CHIPBOARD' || $wp_grade=='LCCB'  || $wp_grade =='chipboard') {
                            $query="SELECT wp_grade,sum(weight) from sup_deliveries where date_delivered like '%$month%' and  branch_delivered like '%$branch%'  and (wp_grade='cb' or wp_grade='chipboard' or wp_grade='CHIPBOARD') group by wp_grade";
                        }else {
                            $query="SELECT wp_grade,sum(weight) from sup_deliveries where date_delivered like '%$month%' and  branch_delivered like '%$branch%'  and wp_grade='LCWL' group by wp_grade";
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
                        $query="SELECT sum(net_weight) from pick_up where date like '%".$month."%' and  branch like '%$branch%'  and wp_grade='$wp_grade2' ";
                    }else {
                        if($wp_grade=='CHIPBOARD' || $wp_grade=='LCCB'  || $wp_grade =='chipboard') {
                            $query="SELECT sum(net_weight) from pick_up where date like '%".$month."%' and  branch like '%$branch%'  and wp_grade='chipboard' ";
                        }else {
                            $query="SELECT sum(net_weight) from pick_up where date like '%".$month."%' and  branch like '%$branch%'  and wp_grade='lcwl' ";
                        }
                    }

                    $result=mysql_query($query);
                    $pick_up=0;
                    while($row = mysql_fetch_array($result)) {
                        $pick_up+=$row['sum(net_weight)'];

                    }
                    $total_pick_up+=$pick_up;

                    echo number_format($pick_up,2);

                    echo "</td>";


                    echo "<td>";
                    if ($wp_grade!='chipboard'  &&  $wp_grade!='cb') {
                        $query2="SELECT wp_grade,sum(weight) from outgoing where date like '%$month%' and  branch like '%$branch%'  and wp_grade='$wp_grade' and str!='VOID' group by wp_grade";
                    }else if ($wp_grade =='chipboard' || $wp_grade ='cb') {
                        $query2="SELECT wp_grade,sum(weight) from outgoing where date like '%$month%' and  branch like '%$branch%' and str!='VOID'  and wp_grade='chipboard'  or wp_grade ='cb'  group by wp_grade";

                    }
                    $result2=mysql_query($query2);
                    $outgoing=0;
                    while($row2 = mysql_fetch_array($result2)) {
                        $outgoing+= $row2['sum(weight)'];
                    }

                    $total_outgoing+=$outgoing;
                    echo number_format($outgoing,2);


                    echo "</td>";




                    echo "<td>";

                    if($from =='') {
                        $query10="SELECT weight FROM adjustment where date='".date('Y/m/d')."' and wp_grade='$wp_grade' and branch like '%$branch%' order by log_id limit 1" ;
                    }else {
                        $query10="SELECT weight FROM adjustment where date='$from' and wp_grade='$wp_grade' and branch like '%$branch%' order by log_id limit 1" ;

                    }



                    $result10=mysql_query($query10);
                    $adjustment=0;
                    while($row10 = mysql_fetch_array($result10)) {
                        $adjustment+= $row10['weight'];
                    }
                    $total_adjustment+=$adjustment;
                    echo number_format($adjustment,2);
                    /*
                    if($adjustment !=0) {
                        echo number_format($adjustment,2);
                    }else {
                        
                        if($from =='') {
                            $query10="SELECT sum(weight) FROM sorting_prod where date like'%".date('Y/m')."%' and wp_grade='$wp_grade2' and branch like '%$branch%' " ;
                        }else {
                            $query10="SELECT sum(weight) FROM sorting_prod where date like'%".$month."%' and wp_grade='$wp_grade2' and branch like '%$branch%' " ;
                        }

                        $result10=mysql_query($query10);
                        $sorting_prod=0;
                        while($row10 = mysql_fetch_array($result10)) {
                            $sorting_prod+= $row10['sum(weight)'];
                        }

                        $adjustment=$sorting_prod;
                        
                        echo number_format($adjustment,2);
                    }
   * 
                    */
                    echo "</td>";








                    echo  "</td>";


                    echo "<td>";
                    if($from =='') {
                        $query10="SELECT sum(weight) FROM sorting_prod where date like'%".date('Y/m')."%' and wp_grade='$wp_grade2' and branch like '%$branch%' " ;
                    }else {
                        $query10="SELECT sum(weight) FROM sorting_prod where date like'%".$month."%' and wp_grade='$wp_grade2' and branch like '%$branch%' " ;
                    }

                    $result10=mysql_query($query10);
                    $sorting_prod_col=0;
                    while($row10 = mysql_fetch_array($result10)) {
                        $sorting_prod_col+= $row10['sum(weight)'];
                    }
                    $total_sorted+=$sorting_prod_col;

                    echo number_format($sorting_prod_col,2);

                    echo "</td>";

                    /////////////////////////////////////////////////////////////////////////////////////////

                    echo "<td>";

                    $ideal=0;
                    $ideal=($beg_iv+$receiving+$pick_up+$adjustment+$sorting_prod_col)-$outgoing;
                    $total_ideal+=$ideal;


                    if($ideal > 0) {
                        echo "<span id='positive'>".number_format($ideal,2)."</span>";
                    }else if($ideal<0) {

                        echo "<span id='negative'>(".number_format($ideal*-1,2).")</span>";

                    }else {
                        echo "<span id=''>".number_format($ideal,2)."</span>";
                    }



                    echo "</td>";




                    /////////////////////////////////////////////////////////////////////////////////////////////////

                    echo "<td>";
                    $actual=0;

                    $query21="SELECT weight from month_end_loose where wp_grade='$wp_grade' and branch like '%$branch%' and month_end_date='$month' order by log_id desc limit 1";


                    $result21=mysql_query($query21);
                    $month_end_loose_weight=0;

                    if($row21 = mysql_fetch_array($result21)) {
                        $month_end_loose_weight=$row21['weight'];

                    }
                    if($from=='') {
                        $query21="SELECT weight from loose_papers where wp_grade='$wp_grade' and branch like '%$branch%' and date='".date('Y/m/d')."' order by log_id desc limit 1";
                    }else {
                        $query21="SELECT weight from loose_papers where wp_grade='$wp_grade' and branch like '%$branch%' and date='$from' order by log_id desc limit 1";

                    }

                    $result21=mysql_query($query21);
                    $daily_loose_weight=0;

                    if($row21 = mysql_fetch_array($result21)) {
                        $daily_loose_weight=$row21['weight'];

                    }



                    $actual=$daily_loose_weight+$month_end_loose_weight;
                    $total_actual+=$actual;
                    echo  number_format($actual,2);

                    echo"</td>";
//////////////////////////////////
                    echo "<td>";

                    $variance=$actual-(+$ideal);
                    $total_variance+=$variance;
                    if($variance <0) {

                        echo "<span id='negative'>(".number_format($variance*-1,2).")</span>";

                    }else if($variance==0) {
                        echo number_format($variance,2);
                    }else {
                        echo "<span id='positive'>".number_format($variance,2)."</span>";
                    }



                    echo "</td>";

                    echo "<td>";

                    $query3="SELECT cost FROM buying_cost where branch='$branch' and month='$month' and wp_grade='$wp_grade' order by log_id desc limit 1";

                    $result3=mysql_query($query3);
                    $avg_cost=0;
                    if($row3= mysql_fetch_array($result3)) {
                        $avg_cost=$row3['cost'];
                        echo number_format($avg_cost,2);
                    }else {
                        echo number_format($avg_cost,2);
                    }


                    $total_avg_cost+=$avg_cost;



                    echo "</td>";
                    echo "<td>";
                    $total_amt_loss_gain+=($avg_cost*$variance);
                    $amt_loss_gain=$avg_cost*$variance;

                    if($amt_loss_gain>0) {
                        echo  "<span id='positive'>".number_format($amt_loss_gain,2)."</span>";
                    }else if($amt_loss_gain==0) {
                        echo  number_format($amt_loss_gain,2);

                    }else {
                        echo   "<span id='negative'>(".number_format($amt_loss_gain*-1,2).")</span>";

                    }


                    echo "</td>";


                    echo "</tr>";

                }

                echo "<tr id='total'>";
                echo "<td id='total'>z__TOTAL__z</td>";

                if($total_beg>0) {
                    echo "<td id='total'>".number_format($total_beg,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_beg*-1,2).")</td>";
                }



                if($total_receive>0) {
                    echo "<td id='total'>".number_format($total_receive,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_receive*-1,2).")</td>";
                }

                if($total_pick_up>0) {
                    echo "<td id='total'>".number_format($total_pick_up,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_pick_up*-1,2).")</td>";
                }
                if($total_outgoing>0) {
                    echo "<td id='total'>".number_format($total_outgoing,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_outgoing*-1,2).")</td>";
                }
                if($total_adjustment>0) {
                    echo "<td id='total'>".number_format($total_adjustment,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_adjustment*-1,2).")</td>";
                }
                if($total_sorted>0) {
                    echo "<td id='total'>".number_format($total_sorted,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_sorted*-1,2).")</td>";
                }
                if($total_ideal>0) {
                    echo "<td id='total'>".number_format($total_ideal,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_ideal*-1,2).")</td>";
                }
                if($total_actual>0) {
                    echo "<td id='total'>".number_format($total_actual,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_actual*-1,2).")</td>";
                }
                if($total_variance>0) {
                    echo "<td id='total'>".number_format($total_variance,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_variance*-1,2).")</td>";
                }
                if($total_avg_cost>0) {
                    echo "<td id='total'>".number_format($total_avg_cost,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_avg_cost*-1,2).")</td>";
                }
                if($total_amt_loss_gain>0) {
                    echo "<td id='total'>".number_format($total_amt_loss_gain,2)."</td>";
                }else {
                    echo "<td id='total'>(".number_format($total_amt_loss_gain*-1,2).")</td>";
                }


                echo "</tr>";




                ?>
            </table>
            <a rel="facebox" href="form_adjustment.php"><button> Encode Adjustment</button></a>
            <a rel="facebox" href="frmEncodeAvgCost.php"><button> Encode Avg Buying Cost</button></a>
            <a rel="facebox" href="frmMonthlyLoose.php"><button> Encode Month End Loose</button></a>


            <a rel="facebox" href="formAdjustment.php"><button> Encode Daily Loose</button></a>
        </div>
    </div>

    <div class="grid_3">
        <div class="box round first grid">
            <h2>Adjustment Summary</h2>
            <table class="data display datatable" id="example">
                <?php
                echo "<thead>";
                echo "<th>Log ID</th>";
                echo "<th>Date</th>";
                echo "<th>Description</th>";
                echo "<th>Wp Grade</th>";
                echo "<th>Weight</th>";
                echo "<th></th>";
                echo "</thead>";
                $query="SELECT * from adjustment where branch like '%$branch%' and date like '%$month%' order by log_id ";
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>".$row['log_id']."</td>";
                    echo "<td>".$row['date']."</td>";
                    echo "<td>".$row['description']."</td>";
                    echo "<td>".$row['wp_grade']."</td>";
                    echo "<td>".$row['weight']."</td>";
                    echo "<td><a href='delete_adjustment.php?log_id=".$row['log_id']." ' title='Click to delete' ><img src='icon/bura.png'></a></td>";

                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <div class="grid_3">
        <div class="box round first grid">
            <h2>Daily Loose Update History</h2>
            <table class="data display datatable" id="example">
                <?php
                echo "<thead>";
                echo "<th>Log ID</th>";
                echo "<th>Date</th>";

                echo "<th>Wp Grade</th>";
                echo "<th>Weight</th>";
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
                    echo "<td><a href='delete_daily_loose.php?log_id=".$row['log_id']." ' title='Click to delete' ><img src='icon/bura.png'></a></td>";

                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <div class="grid_3">
        <div class="box round first grid">
            <h2>Monthly Inventory Loose Update History</h2>
            <table class="data display datatable" id="example">
                <?php
                echo "<thead>";
                echo "<th>Log ID</th>";
                echo "<th>Month</th>";
                echo "<th>Wp Grade</th>";
                echo "<th>Weight</th>";
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