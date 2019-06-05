<?php include("templates/template.php"); ?><style>    table{        font-size:12.5px;    }    .total{        background-color: yellow;        font-weight: bold;    }    th{        width:500px;    }    #totalFooter{        background-color: yellow;        font-weight: bold;    }</style><?php include("config.php");
$wp_array=array();
$branch_array=array();?>
<style>
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
    }
    #left_header{
        background-color:#FFFAF0;
        font-weight:bold;
    }
</style>
<div class="grid_30">
    <div class="box round first grid">
        <h2><?php $ngayon=date('F d, Y');
            if(strtoupper($_SESSION['weekly_wp_grade'])!='') {
                echo "<h2>".strtoupper($_SESSION['weekly_wp_grade'])." Branch Weekly Receiving for ".$_SESSION['weekly_month']." in MT</h2>";
            }else {
                echo "<h2>CONSOLIDATED Branch Weekly Receiving for ".$_SESSION['weekly_month']." in MT</h2>";
            }
            ?>
            <?php
            $query = "SELECT * FROM wp_grades ";
            $result = mysql_query($query) ;
            echo "<form action='weekly_filter.php' method='POST'>";
            echo "WP Grade:";
            $dropdown = "<td><select name='wp_grade' onchange='this.form.submit()'>";
            $dropdown .= "\r\n<option value='{$_SESSION['weekly_wp_grade']}'>{$_SESSION['weekly_wp_grade']}</option>";
            $dropdown .= "\r\n<option value=''>All Grades</option>";
            $dropdown .= "\r\n<option value=''>__________</option>";
            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
            }
            $dropdown  .= "\r\n</select></td>";
            echo $dropdown;
            ?> Month: <select name="weekly_month" onchange='this.form.submit()'>
                <option value="<?php echo $_SESSION['weekly_month'];?>">
                    <?php echo $_SESSION['weekly_month'];?></option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>
            Year: <select name="weekly_year" onchange='this.form.submit()'>
                <option value="<?php echo $_SESSION['weekly_year'];?>">
                    <?php echo $_SESSION['weekly_year'];?></option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
            </select>
            <?php
            echo "</form><br>";
            ?>
            <table class="data display datatable" id="example">
                <?php
                $total_array=array();
                $final_week1_total=0;
                $final_week2_total=0;
                $final_week3_total=0;
                $final_week4_total=0;
                $final_week5_total=0;
                $current_month_total=0;

                $final_percentage1_total=0;
                $final_percentage2_total=0;
                $final_percentage3_total=0;
                $final_percentage4_total=0;
                $final_percentage5_total=0;

                $total_target_receiving=0;
                $query="SELECT date_delivered FROM sup_deliveries where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' group by  date_delivered";
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    $newDate=date("M d", strtotime($row['date_delivered']));
                    array_push($wp_array,$row['date_delivered']);
                }
                $weeks_array=array();
                $months_array=array();
                $breaker_date='';
                $period_date='';
                if($_SESSION['weekly_month']=='January') {
                    $breaker_date=$_SESSION['weekly_year']."/"."01"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."01";
                }else if($_SESSION['weekly_month']=='February') {
                    $breaker_date=$_SESSION['weekly_year']."/"."02"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."02";
                }else if($_SESSION['weekly_month']=='March') {
                    $breaker_date=$_SESSION['weekly_year']."/"."03"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."03";
                }else if($_SESSION['weekly_month']=='April') {
                    $breaker_date=$_SESSION['weekly_year']."/"."04"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."04";
                }else if($_SESSION['weekly_month']=='May') {
                    $breaker_date=$_SESSION['weekly_year']."/"."05"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."05";
                }else if($_SESSION['weekly_month']=='June') {
                    $breaker_date=$_SESSION['weekly_year']."/"."06"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."06";
                }else if($_SESSION['weekly_month']=='July') {
                    $breaker_date=$_SESSION['weekly_year']."/"."07"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."07";
                }else if($_SESSION['weekly_month']=='August') {
                    $breaker_date=$_SESSION['weekly_year']."/"."08"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."08";
                }else if($_SESSION['weekly_month']=='September') {
                    $breaker_date=$_SESSION['weekly_year']."/"."09"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."09";
                }else if($_SESSION['weekly_month']=='October') {
                    $breaker_date=$_SESSION['weekly_year']."/"."10"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."10";
                }else if($_SESSION['weekly_month']=='November') {
                    $breaker_date=$_SESSION['weekly_year']."/"."11"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."11";
                }else if($_SESSION['weekly_month']=='December') {
                    $breaker_date=$_SESSION['weekly_year']."/"."12"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."12";
                }
                $period_checker=$_SESSION['weekly_month'];
                $query="SELECT month_delivered FROM sup_deliveries where month_delivered!='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and date_delivered <'$breaker_date' group by  month_delivered order by date_delivered";
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    array_push($weeks_array,$row['month_delivered']);
                    array_push($months_array,$row['month_delivered']);
                }
                array_push($weeks_array,"Week 1");
                array_push($weeks_array,"%");
                array_push($weeks_array,"Week 2");
                array_push($weeks_array,"%");
                array_push($weeks_array,"Week 3");
                array_push($weeks_array,"%");
                array_push($weeks_array,"Week 4");
                array_push($weeks_array,"%");
                array_push($weeks_array,"Week 5");
                array_push($weeks_array,"%");
                echo "<thead>";
                echo "<th>Branch Name</th>";
                foreach ($weeks_array as $value) {
                    echo "<th>".$value."</th>";
                }
                echo "<th>".$_SESSION['weekly_month']."</th>";
                echo "<th>TARGET</th>";
                echo "</thead>";
                $query="SELECT UCASE(branch_delivered) FROM sup_deliveries where  year_delivered='".$_SESSION['weekly_year']."' group by branch_delivered";
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    array_push($branch_array,$row['UCASE(branch_delivered)']);
                }
                $deliveries_array =array();
                if(trim($_SESSION['weekly_wp_grade'])!='') {
                    $query3="SELECT UCASE(branch_delivered),sum(weight),date_delivered FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and wp_grade = '".$_SESSION['weekly_wp_grade']."' group by branch_delivered,date_delivered";
                }else {
                    $query3="SELECT UCASE(branch_delivered),sum(weight),date_delivered FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' group by branch_delivered,date_delivered";
                }
                $result3=mysql_query($query3);
                while($row3 = mysql_fetch_array($result3)) {
                    $deliveries_array[$row3['UCASE(branch_delivered)']."+".$row3['date_delivered']]=$row3['sum(weight)'];
                }
                $week1_total=0;
                $week2_total=0;
                $week3_total=0;
                $week4_total=0;
                $week5_total=0;

                foreach ($branch_array as $value2) {
                    $total_per_branch=0;
                    echo "<tr class='data'>";
                    echo "<td class='data' id='left_header' >".$value2."</td>";
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
                    foreach($months_array as $month) {
                        if(trim($_SESSION['weekly_wp_grade'])!='') {
                            $query31="SELECT sum(weight),month_delivered FROM sup_deliveries where branch_delivered='".$value2."' and wp_grade='".$_SESSION['weekly_wp_grade']."' and year_delivered='".$_SESSION['weekly_year']."' and month_delivered ='$month'  ";
                        }else {
                            $query31="SELECT sum(weight),month_delivered FROM sup_deliveries where branch_delivered='".$value2."' and year_delivered='".$_SESSION['weekly_year']."' and month_delivered ='$month'  ";

                        }
                        $result31=mysql_query($query31);

                        if($row31 = mysql_fetch_array($result31)) {
                            echo "<td>".number_format($row31['sum(weight)']/1000,2)."</td>";
                        }else {
                            echo "<td>0.00</td>";

                        }
                    }


                    if($period_checker=='January' || $period_checker=='February' || $period_checker=='March' ) {


                        $period='first';
                    }else if(
                    $period_checker=='April' ||  $period_checker=='May' ||  $period_checker=='June') {


                        $period='second';
                    }else if(
                    $period_checker=='July' ||  $period_checker=='August' ||  $period_checker=='September') {


                        $period='third';
                    }else if(
                    $period_checker=='October' || $period_checker=='November' ||  $period_checker=='December' ) {
                        $period='fourth';
                    }



                    if($_SESSION['weekly_wp_grade']!='') {
                        $query3="SELECT * from target_receiving where branch='$value2' and wp_grade='".$_SESSION['weekly_wp_grade']."' and period='$period' and date like '%".$period_date."%' order by log_id desc limit 1";
                        $result3=mysql_query($query3);
                        $target_receiving=1;
                        $tester=0;
                        if($row3 = mysql_fetch_array($result3)) {
                            $target_receiving=($row3['weight']/1000);
                            $tester++;
                        }
                        if($tester==0) {
                            $query3="SELECT * from target_receiving where branch='$value2' and wp_grade='".$_SESSION['weekly_wp_grade']."' and period='$period' and date <='".$period_date."' order by log_id desc limit 1";
                            $result3=mysql_query($query3);
                            $target_receiving=0;
                            $tester=0;
                            if($row3 = mysql_fetch_array($result3)) {
                                $target_receiving=($row3['weight']/1000);
                            }
                        }


                    }else {

                        $query3="SELECT sum(weight) from target_receiving where branch='$value2' and period='$period' and date like '%".$period_date."%' group by date order by log_id desc limit 1";
                        $result3=mysql_query($query3);
                        $target_receiving=1;
                        $tester=0;
                        if($row3 = mysql_fetch_array($result3)) {
                            $target_receiving=($row3['sum(weight)']/1000);
                            $tester++;
                        }
                        if($tester==0) {
                            $query3="SELECT sum(weight) from target_receiving where branch='$value2'  and period='$period' and date <='".$period_date."'  group by date order by log_id desc limit 1";
                            $result3=mysql_query($query3);
                            $target_receiving=0;
                            $tester=0;
                            if($row3 = mysql_fetch_array($result3)) {
                                $target_receiving=($row3['sum(weight)']/1000);
                            }
                        }


                    }
                    $week1_total=($week1_total/1000);
                    $week2_total=($week2_total/1000);
                    $week3_total=($week3_total/1000);
                    $week4_total=($week4_total/1000);
                    $week5_total=($week5_total/1000);



                    echo "<td id='weekly'>".number_format($week1_total,2)."</td>";
                    $final_week1_total+=$week1_total;

                    if($target_receiving>0) {
                        echo "<td id='percentage'>".number_format((($week1_total/$target_receiving)*100),0)."%</td>";
                        $final_percentage1_total+=(($week1_total/$target_receiving)*100);

                    }else {
                        echo "<td id='percentage'>0%</td>";
                    }


                    echo "<td id='weekly'>".number_format($week2_total,2)."</td>";
                    $final_week2_total+=$week2_total;

                    if($target_receiving>0) {
                        echo "<td id='percentage'>".number_format(((($week1_total+$week2_total)/$target_receiving)*100),0)."%</td>";
                        $final_percentage2_total+=((($week1_total+$week2_total)/$target_receiving)*100);
                    }else {
                        echo "<td id='percentage'>0%</td>";
                    }
                    echo "<td id='weekly'>".number_format($week3_total,2)."</td>";
                    $final_week3_total+=$week3_total;

                    if($target_receiving>0) {
                        echo "<td id='percentage'>".number_format(((($week1_total+$week2_total+$week3_total)/$target_receiving)*100),0)."%</td>";
                        $final_percentage3_total+=((($week1_total+$week2_total+$week3_total)/$target_receiving)*100);
                    }else {
                        echo "<td id='percentage'>0%</td>";
                    }
                    echo "<td id='weekly'>".number_format($week4_total,2)."</td>";
                    $final_week4_total+=$week4_total;

                    if($target_receiving>0) {
                        echo "<td id='percentage'>".number_format(((($week1_total+$week2_total+$week3_total+$week4_total)/$target_receiving)*100),0)."%</td>";
                        $final_percentage4_total+=((($week1_total+$week2_total+$week3_total+$week4_total)/$target_receiving)*100);
                    }else {
                        echo "<td id='percentage'>0%</td>";
                    }
                    echo "<td id='weekly'>".number_format($week5_total,2)."</td>";
                    $final_week5_total+=$week5_total;

                    if($target_receiving>0) {
                        echo "<td id='percentage'>".number_format(((($week1_total+$week2_total+$week3_total+$week4_total+$week5_total)/$target_receiving)*100),0)."%</td>";
                        $final_percentage5_total+=((($week1_total+$week2_total+$week3_total+$week4_total+$week5_total)/$target_receiving)*100);


                    }else {
                        echo "<td id='percentage'>0%</td>";
                    }
                    echo "<td class='TOTAL'>".number_format(($week1_total+$week2_total+$week3_total+$week4_total+$week5_total+0),2)."</td>";
                    echo "<td id='TARGET'>".number_format($target_receiving+0,2)."</td>";
                    $total_target_receiving+=$target_receiving;
                    $current_month_total+=($week1_total+$week2_total+$week3_total+$week4_total+$week5_total+0);

                    $week1_total=0;
                    $week2_total=0;
                    $week3_total=0;
                    $week4_total=0;
                    $week5_total=0;
                    echo "</tr>";




                }
/////////////////////////////////////////////
                echo "<tr class='data'>";
                echo "<td class='TOTAL' >z_TOTAL_z</td>";

                foreach($months_array as $month) {
                    if(trim($_SESSION['weekly_wp_grade'])!='') {
                        $query31="SELECT sum(weight),month_delivered FROM sup_deliveries where  wp_grade='".$_SESSION['weekly_wp_grade']."' and year_delivered='".$_SESSION['weekly_year']."' and month_delivered ='$month'  ";
                    }else {
                        $query31="SELECT sum(weight),month_delivered FROM sup_deliveries where year_delivered='".$_SESSION['weekly_year']."' and month_delivered ='$month'  ";

                    }
                    $result31=mysql_query($query31);

                    if($row31 = mysql_fetch_array($result31)) {
                        echo "<td class='TOTAL' >".number_format($row31['sum(weight)']/1000,2)."</td>";
                    }else {
                        echo "<td class='TOTAL' >0.00</td>";

                    }
                }
                echo "<td class='TOTAL'  >".number_format($final_week1_total,2)."</td>";
                echo "<td class='TOTAL'  >".number_format($final_percentage1_total,0)."%</td>";
                echo "<td class='TOTAL'  >".number_format($final_week2_total,2)."</td>";
                echo "<td class='TOTAL'  >".number_format($final_percentage2_total,0)."%</td>";
                echo "<td class='TOTAL'  >".number_format($final_week3_total,2)."</td>";
                echo "<td class='TOTAL'  >".number_format($final_percentage3_total,0)."%</td>";
                echo "<td class='TOTAL'  >".number_format($final_week4_total,2)."</td>";
                echo "<td class='TOTAL'  >".number_format($final_percentage4_total,0)."%</td>";
                echo "<td class='TOTAL' >".number_format($final_week5_total,2)."</td>";
                echo "<td class='TOTAL'  >".number_format($final_percentage5_total,0)."%</td>";
                echo "<td class='TOTAL' >".number_format($current_month_total,2)."</td>";
                echo "<td class='TOTAL' >".number_format($total_target_receiving,2)."</td>";
                
/////////////////////////////////////////////
                ?>
            </table>
    </div>
</div>
<div class="clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>